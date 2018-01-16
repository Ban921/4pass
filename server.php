<?php
require_once __DIR__ . '/Workerman/Autoloader.php';
use Workerman\Worker;
use \Workerman\Lib\Timer;
$global = 0;
$global_uid = [1,2,3,4,5,6,7,8];
$online = [];
$onlinegame = [];
$raisenum = [];
$tablemoney = 0;
$yesnum = 0;
$gameing = 0;

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
    global $worker, $online, $onlinegame, $poker, $tablemoney, $yesnum, $pokered, $gameing, $upnum, $downunm, $name, $raisenum;

    $data = json_decode($data);
    $data->userid = $connection->uid;
    
    switch ($data->action) {
    	case 'ready':
    			if (!in_array($connection->uid, $onlinegame)){
    					array_push($onlinegame,$connection->uid);
				}
				$data->gameing = $gameing;
				$name[$data->userid] = $data->name;
    		break;
		case 'start':
				
    			if (!in_array($connection->uid, $online)){
    				array_push($online,$connection->uid);
				}
				if($onlinegame != $online){
					if ($gameing == 0) {
						$online = $onlinegame;
					}
					
				}
				if(count($onlinegame) == 1){
					$data->action = "quit";
				}else{
					shuffle($poker);
					$data->poker = $poker;
					$tablemoney = $tablemoney+count($online)*10;
					$gameing = 1;
					$yesnum = 0;
					$upnum = [];
					$downunm = [];
					$winup = [];
					$windown = [];
					$raisenum = [];
				}
				
    		break;
    	case 'raise':
				$raisenum[$connection->uid] = $data->raisenum;
				$tablemoney = $tablemoney+10;
				$data->action = "raise";
				$data->raisenum = $raisenum;
				$raisemax = max($raisenum);
				$data->raisemax = $raisemax;
				
    		break;
    	case 'flod':
    			$data->userid = $connection->uid;
    			foreach($online as $key => $value){
    				if($value == $connection->uid){
    			    	unset($online[$key]);
    				}
    			}
				$online = array_values($online);
				$data->money = 0;
				$data->action = "flod";
				$yesnum++;
    		break;
    	case 'restart':
    			$data->action = "restart";
    			$tablemoney = 0;
    			$data->startnum = 1;
    		break;
		case 'yes':
				
				$yesnum++;
				$pokered[0+$data->userid*4] = $data->w;
				$pokered[1+$data->userid*4] = $data->x;
				$pokered[2+$data->userid*4] = $data->y;
				$pokered[3+$data->userid*4] = $data->z;

				if (in_array($connection->uid,$online)) {
					$upnum[$data->userid] = $data->upnum;
    				$downunm[$data->userid] = $data->downunm;
				}

    			$data->pokered = $pokered;
    			if(count($online) == $yesnum){
    				usleep(3000);
    				arsort($upnum);
    				arsort($downunm);
    				$data->action = "check";
    				$data->poker = $poker;
    				
    				$data->upnum = $upnum;
    				$data->downunm = $downunm;

    				$winup = array_keys($upnum);
    				$windown = array_keys($downunm);
					if ($gameing == 0) {
						$online = $onlinegame;
					}
					print_r($upnum);
					print_r($downunm);

					if($winup[0] == $windown[0]){
						$data->id = $winup[0];
						$data->money = $tablemoney;
						$tablemoney = 0;
						$gameing = 0;
						$data->msg = $name[$winup[0]]."贏了";
					}else{
						$gameing = 1;
						if(end($winup) == end($windown)) {
							$data->msg = $name[end($winup)]."被夾了";
							$data->userid = end($winup);
							$data->lost = end($winup);
							foreach($online as $key => $value){
								if($value == $data->userid){
									unset($online[$key]);
								}
							}
							
						}
					}
					usleep(4000);
					$online = array_values($online);
    			}

    		break;	
    	default:
    		# code...
    		break;
    }
    $data->gameing = $gameing;
    $data->tablemoney = $tablemoney;
    $data->online = $online;
    $data->onlinegame = $onlinegame;
    $data = json_encode($data);
	broadcast($data);
}

// 当客户端断开时，广播给所有客户端
function close($connection)
{
    global $worker, $global_uid, $online, $onlinegame;
    $data = new stdClass(); 
    $data->userid = $connection->uid;
    $data->action = "quit";
    $data = json_encode($data);

	broadcast($data);


	foreach($online as $key => $value){
		if($value == $connection->uid){
			unset($online[$key]);
			unset($onlinegame[$key]);
		}
	}
    $online = array_values($online);
    $onlinegame = array_values($onlinegame);
    array_push($global_uid,$connection->uid);
 
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

function porkcom($upnum, $downunm)
{
	# code...
}

// 创建一个文本协议的Worker监听2347接口
$worker = new Worker("websocket://192.168.106.138:9300");

// 只启动1个进程，这样方便客户端之间传输数据
$worker->count = 1;

$worker->onConnect = 'connection';
$worker->onMessage = 'message';
$worker->onClose = 'close';

Worker::runAll();



