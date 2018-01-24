var wsUri = "ws://192.168.106.138:9300";
var output;
var websocket = new WebSocket(wsUri);
var id = '';
var raisemax = '';
var raisemin = '';
var user = new Array();

websocket.onopen = function (e) {
	log("連線成功");
	$('.web').click();
};
websocket.onmessage = function (e) {
	if (isJSON(e.data)) {
		data = JSON.parse(e.data);

		switch (data.action) {
			case "index_id":
				id = data.id;
				break;
			case "ready":
				log("收到服务端的消息：" + data.name + "已準備");
				if (data.onlinegame[0] == id && data.gameing == 0) {
					$('.start').show();
				}
				break;
			case "masg":
				log(data.name + "傳送了:" + data.masg);
				break;
			case "start":
				raisenum = '';
				raisemax = '';
				raisemin = '';
				raisenum1 = '';
				if (data.userid) {
					user[data.userid] = false;
					$('.user' + data.userid).empty();
					$('.user' + data.userid).css("border-style", "");
				}

				for (var i = 0; i < data.online.length; i++) {
					user[data.online[i]] = true;
				}
				$('.gitporker').click();

				poker = data.poker;
				for (var i = 1; i < 9; i++) {
					if (user[i]) {
						$('.user' + i).css("border-style", "dashed");
						$('.user' + i).css("border-color", "black");
						$('.user' + i).html('<img src="img/Red_Back.svg" />' + '<img src="img/Red_Back.svg" />' + '<img src="img/Red_Back.svg" />' + '<img src="img/Red_Back.svg" />');

						if (i == id) {
							$('.user' + id).html('<img data="' + poker[0 + (i * 4)] + '" src="img/' + poker[0 + (i * 4)] + '.svg" />' + '<img data="' + poker[1 + (i * 4)] + '" src="img/' + poker[1 + (i * 4)] + '.svg" />' + '<img data="' + poker[2 + (i * 4)] + '" src="img/' + poker[2 + (i * 4)] + '.svg" />' + '<img data="' + poker[3 + (i * 4)] + '" src="img/' + poker[3 + (i * 4)] + '.svg" />');
							$('.porkeropen').html('<img data="' + poker[0 + (i * 4)] + '" src="img/' + poker[0 + (i * 4)] + '.svg" />' + '<img data="' + poker[1 + (i * 4)] + '" src="img/' + poker[1 + (i * 4)] + '.svg" />' + '<img data="' + poker[2 + (i * 4)] + '" src="img/' + poker[2 + (i * 4)] + '.svg" />' + '<img data="' + poker[3 + (i * 4)] + '" src="img/' + poker[3 + (i * 4)] + '.svg" />');
						}
					} else {
						$('.user' + i).empty();
						$('.user' + i).css("border-style", "");
					}
				}
				$('.online').html('');

				break;
			case "check":
				for (var i = 0; i < data.online.length; i++) {
					user[data.online[i]] = true;
				}
				$('.check').click();
				var upnum = [];
				var downunm = [];
				pokered = data.pokered;
				for (var i = 1; i < 9; i++) {
					if (user[i]) {
						$('.user' + i).html('<img data="' + pokered[0 + (i * 4)] + '" src="img/' + pokered[0 + (i * 4)] + '.svg" />' + '<img data="' + pokered[1 + (i * 4)] + '" src="img/' + pokered[1 + (i * 4)] + '.svg" />' + '<img data="' + pokered[2 + (i * 4)] + '" src="img/' + pokered[2 + (i * 4)] + '.svg" />' + '<img data="' + pokered[3 + (i * 4)] + '" src="img/' + pokered[3 + (i * 4)] + '.svg" />');
						changnum(pokered[0 + (i * 4)], pokered[1 + (i * 4)], pokered[2 + (i * 4)], pokered[3 + (i * 4)]);
						$('.online').append(data.name1[i] + "第一副牌" + a + "第二副牌" + b + "<br>");
					}
				}
				$('.user' + data.id).css("border-color", "red");

				if (data.id == id) {
					money = parseInt($(".money").html());
					$('.money').html(data.money + money);
					log('賺了' + data.money);
				}
				if (data.lost) {
					console.log(data.name1);
					for (var i = 0; i < data.lost.length; i++) {
						user[data.lost[i]] = false;
						$('.user' + data.lost[i]).empty();
						$('.user' + data.lost[i]).css("border-style", "");
						log(data.name1[data.lost[i]] + "被夾了");
					}
				}
				if (data.online[0] == id) {
					setTimeout(function () {
						$('.tablemoney').html('');
						$('.start').show();
					}, 2000);
				} else {
					setTimeout(function () {
						$('.tablemoney').html('');
					}, 2000);
				}
				break;
			case "raise":
				$('.tablemoney').html(data.tablemoney);
				raisemax = data.raisemax;
				raisemin = data.raisemin;

				raisenum = '';

				for (i in data.raisenum) {
					raisenum = raisenum + data.name1[i] + "加碼次數" + data.raisenum[i] + "<br>";
				}
				$('.online').html(raisenum);
				if (raisenum1 < raisemax) {
					$('.call').show();
				} else {
					$('.call').hide();
				}

				break;
			case "flod":
				user[data.userid] = false;
				$('.user' + data.userid).hide();
				$('.online').html();

				break;
			case "quit":
				user[data.userid] = false;
				$('.user' + data.userid).empty();
				$('.user' + data.userid).css("border-style", "");
				break;
		}

		if (data.msg) {
			log(data.msg);
		}
		if (data.unid) {
			user[data.unid] = false;
		}
		tablemoney = data.tablemoney;
		$('.tablemoney').html(tablemoney);

	} else {
		if (e.data) {
			log(e.data);
		}
	}
};
websocket.onerror = function (e) {
	console.log(e);
	websocket.close();
};
websocket.onclose = function (e) {
	log("斷線 5 秒後重新整理");

	websocket.close();

	setTimeout(function () {
		location.reload();
	}, 5000);
};

function log(text) {
	$log = $('#log');
	//Add text to log
	$log.append(($log.val() ? "\n" : '') + text);
	//Autoscroll
	$log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
}

function isJSON(str) {
	if (typeof str == 'string') {
		try {
			JSON.parse(str);
			return true;
		} catch (e) {
			return false;
		}
	}
}