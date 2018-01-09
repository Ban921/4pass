<?php
require_once __DIR__ . '/Workerman/Autoloader.php';
use Workerman\Worker;

$global_uid = [0,1,2,3,4,5,6,7];
$online = [];

// 当客户端连上来时分配uid，并保存连接，并通知所有客户端
function connection($connection)
{
    global $worker, $global_uid;
    // 为这个连接分配一个uid
    if(empty($global_uid)){
    	$worker->onClose;
    }else{
    	$connection->uid = $global_uid[0];
    	array_shift($global_uid);
    	foreach($worker->connections as $conn)
    	{
        	$conn->send("{$connection->uid}號玩家進入遊戲廳");
    	}
    }
    
    print_r($global_uid);

}

// 当客户端发送消息过来时，转发给所有人
function message($connection, $data)
{
    global $worker;
    $data = json_decode($data);
    if ($data->type == 'ready') {
    	$data->userid = $connection->uid;
    	$data = json_encode($data);
    }

    foreach($worker->connections as $conn)
    	{
    		if($connection->uid || $connection->uid == 0){

    			$conn->send($data);
    		}
    	}    
}

// 当客户端断开时，广播给所有客户端
function close($connection)
{
    global $worker, $global_uid;
    foreach($worker->connections as $conn)
    {
        $conn->send("玩家[{$connection->uid}] 離開");
    }
    if($connection->uid || $connection->uid == 0){
    	array_push($global_uid,$connection->uid);
    }
    print_r($global_uid);
    
}

// 创建一个文本协议的Worker监听2347接口
$worker = new Worker("websocket://192.168.106.138:9300");

// 只启动1个进程，这样方便客户端之间传输数据
$worker->count = 1;

$worker->onConnect = 'connection';
$worker->onMessage = 'message';
$worker->onClose = 'close';

Worker::runAll();