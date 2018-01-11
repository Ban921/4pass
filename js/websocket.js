var wsUri = "ws://192.168.106.138:9300";
var output;
var websocket = new WebSocket(wsUri);
var id = '';
var user = new Array();
for (var i = 1; i < 9; i++) {
	user[i] = false;
}

websocket.onopen = function(e) {
	log("連線成功");
	$('.web').click();
};
websocket.onmessage = function(e) {

	
	$( '.user'+ id ).sortable();
	$( "bady" ).disableSelection();

	if(isJSON(e.data)){
		data = JSON.parse(e.data);
		if(!id){
			id = data.userid;
		}

		if(data.action == "ready"){
			log("收到服务端的消息：" + data.name + "已準備");
			for (var i = 0; i < data.online.length; i++) {
				user[data.online[i]] = true;
				usernum++;
			}

			if(data.online[0] == id){
				$('.start').show();
			}
		}

		if(data.action == "masg"){
			log("收到服务端的消息：" + data.name + "傳送了" + data.masg);
		}

		if(data.action == "start"){
			$('.gitporker').click();
			console.log(usernum);
			tablemoney = tablemoney + (10*usernum);
			$('.tablemoney').html(tablemoney);
			
			log("start");
		}

		if(data.action == "quit"){
			user[data.userid] = false;
			$('.user'+data.userid).empty();
			$('.user'+data.userid).css("border-style","");
		}

	}else{
		if(e.data){
			log(e.data);
		}
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

function isJSON(str) {
    if (typeof str == 'string') {
        try {
            JSON.parse(str);
            return true;
        } catch(e) {
            return false;
        }
    }   
}