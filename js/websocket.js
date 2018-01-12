var wsUri = "ws://192.168.106.138:9300";
var output;
var websocket = new WebSocket(wsUri);
var id = '';
var user = new Array();
for (var i = 1; i < 9; i++) {
	user[i] = false;
}


function length(o) {
    var count = 0;
    for(var i in o){
        count ++;
    }
    return count;
};

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
			if(data.online[0] == id && data.gameing == 0){
				$('.start').show();
			}

		}

		if(data.action == "masg"){
			log("收到服务端的消息：" + data.name + "傳送了" + data.masg);
		}

		if(data.action == "start"){

			$('.gitporker').click();

			tablemoney = data.tablemoney;
			$('.tablemoney').html(tablemoney);
			poker = data.poker;
			for (var i = 1; i < 9; i++) {
				if (user[i]) {
					$('.user'+i).css("border-style","dashed");
					$('.user'+i).css("border-color","black");
					$('.user'+i).html('<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />');
					if(i == id){
						$('.user'+id).html('<img data="'+poker[0+(i*4)]+'" src="img/'+poker[0+(i*4)]+'.svg" />'+'<img data="'+poker[1+(i*4)]+'" src="img/'+poker[1+(i*4)]+'.svg" />'+'<img data="'+poker[2+(i*4)]+'" src="img/'+poker[2+(i*4)]+'.svg" />'+'<img data="'+poker[3+(i*4)]+'" src="img/'+poker[3+(i*4)]+'.svg" />');
					}
				}else{
					$('.user'+i).empty();
					$('.user'+i).css("border-style","");
				}
			}
		}

		if(data.action == "check"){
			$('.check').click();
			var upnum = [];
			var downunm = [];
			pokered = data.pokered;
			for (var i = 1; i < 9; i++) {
				if(user[i]){
					$('.user'+i).html('<img data="'+pokered[0+(i*4)]+'" src="img/'+pokered[0+(i*4)]+'.svg" />'+'<img data="'+pokered[1+(i*4)]+'" src="img/'+pokered[1+(i*4)]+'.svg" />'+'<img data="'+pokered[2+(i*4)]+'" src="img/'+pokered[2+(i*4)]+'.svg" />'+'<img data="'+pokered[3+(i*4)]+'" src="img/'+pokered[3+(i*4)]+'.svg" />');
				}
			}
			$('.user'+data.id).css("border-color","red");
			if (data.id == id) {
				money = parseInt($(".money").html());
				$('.money').html(data.money+money);
			}
			console.log(data.gameing);
			if(data.online[0] == id) {
				setTimeout(function(){
					if(data.gameing){
						$('.start').click();
					}else{
						$('.tablemoney').html('');
						$('.start').show();
					}
					
				}, 8000);
			}

			
		}

		if(data.action == "restart"){
			$('.start').click();
		}

		if(data.action == "quit"){
			user[data.userid] = false;
			$('.user'+data.userid).empty();
			$('.user'+data.userid).css("border-style","");
			console.log(length(data.online));
			if(length(data.online) == 1){
				$('.check').click();
			}
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