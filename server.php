<?php
require_once __DIR__ . '/Workerman/Autoloader.php';
use Workerman\Worker;
use \Workerman\Lib\Timer;
$global = 0;
$global_uid = [1,2,3,4,5,6,7,8];
$online = [];
$tablemoney = 0;

for ($i = 1; $i <= 52; $i++) {
	$poker[$i] = $i;
}


// 当客户端连上来时分配uid，并保存连接，并通知所有客户端
function connection($connection)
{
    global $worker, $global_uid, $global;
    // 为这个连接分配一个uid
    	$connection->uid = $global_uid[0];
    	array_shift($global_uid);
    	$data = "有玩家進入遊戲廳";
		broadcast($data);
    	
}

// 当客户端发送消息过来时，转发给所有人
function message($connection, $data)
{
    global $worker, $online, $poker, $tablemoney;

    $data = json_decode($data);
    $data->userid = $connection->uid;
    

    switch ($data->action) {
    	case 'ready':
    		if (!in_array($connection->uid, $online)){
				array_push($online,$connection->uid);
			}
    		$data->online = $online;
    		break;
    	case 'start':
				shuffle($poker);
    		break;
    	case 'raise':
    		
    		break;
    	case 'flod':
    		
    		break;
    	case 'restart':
    			$tablemoney = 0;
    		break;
    	default:
    		# code...
    		break;
    }
    $data->money = $money;
    
    $data = json_encode($data);
	broadcast($data);
}

// 当客户端断开时，广播给所有客户端
function close($connection)
{
    global $worker, $global_uid, $online;
    $data = new stdClass(); 
    $data->userid = $connection->uid;
    $data->action = "quit";
    $data->masg = "quit";
    $data = json_encode($data);

	broadcast($data);

    if($connection->uid || $connection->uid == 0){
    	foreach($online as $key => $value){
    	  if($value == $connection->uid){
    	     unset($online[$key]);
    	  }
    	}
    	$online = array_values($online);
    	array_push($global_uid,$connection->uid);
    }
}


// 向所有验证的用户推送数据
function broadcast($message)
{
   global $worker;
   foreach($worker->connections as $conn)
   {
        $conn->send($message);
   }
}

// 针对uid推送数据
function sendMessageByUid($uid, $message)
{
    global $worker;
    if(isset($worker->connections[$uid]))
    {
        $connection = $worker->connections[$uid];
        $connection->send($message);
    }
}

// 创建一个文本协议的Worker监听2347接口
$worker = new Worker("websocket://192.168.106.138:9300");

// 只启动1个进程，这样方便客户端之间传输数据
$worker->count = 1;

$worker->onConnect = 'connection';
$worker->onMessage = 'message';
$worker->onClose = 'close';

Worker::runAll();


