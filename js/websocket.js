var wsUri = "ws://192.168.106.138:9300";
var output;
var websocket = new WebSocket(wsUri);
var id = '';
websocket.onopen = function(e) {
	log("連線成功");
	var name = prompt("請輸入遊戲名稱");
};
websocket.onmessage = function(e) {
	log("收到服务端的消息：" + e.data);
	if(!id){
		id = e.data.substring(0,1);
		user[id] = true;
	}
};
websocket.onerror = function(e) {
	console.log(e);
	websocket.close();
};
websocket.onclose = function(e) {
	log("斷線 5 秒後重新整理");
	websocket.close();
	setTimeout(function(){
		location.reload();
	},5000);
};

function log( text ) {
	$log = $('#log');
	//Add text to log
	$log.append(($log.val()?"\n":'')+text);
	//Autoscroll
	$log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
}