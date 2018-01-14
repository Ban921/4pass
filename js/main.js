var poker = new Array();
var compare = new Array();
var raisenum = 0, usernum = 0;

var tablemoney = 0;

function changnum(w,x,y,z){
	a = 0;
	b = 0;

	w = w %13; x = x %13; y = y %13; z = z %13;
	if(w == 0){w = 13;} if(x == 0){x = 13;} if(y == 0){y = 13;} if(z == 0){z = 13;}
	
	if(chk4pass(w,x,y,z)){
		a = 99; b = 99;
	}else{
		//13等於兩張
		if(chkpass(w,x,y,z)){
		}else{
			//12等於兩張大於10
			if(chklong(w,x,y,z)){
			}else{
				a = 0; b = 0;
				if(w==10){w=0;} if(x==10){x=0;} if(y==10){y=0;} if(z==10){z=0;}
				//牌等於娃娃的時候 點數為0.5
				if(w>10){w=0.5;} if(x>10){x=0.5;} if(y>10){y=0.5;} if(z>10){z=0.5;}
				if(a==''){a = w+x;} if(b==''){b = y+z;}
				if(a>=10){a=a-10;} if(b>=10){b=b-10;}
			}
		}
	}
	if(a>b){
		return false;
	}else{
		return true;
	}
}

//轉點數
function num1(w,x) {
	if(w==10){w=0;} if(x==10){x=0;}
	//牌等於娃娃的時候 點數為0.5
	if(w>10){w=0.5;} if(x>10){x=0.5;}

	if(a==''){a = w+x;}

	if(a>=10){a=a-10;}

	return a;
}
function num2(y,z) {
	if(y==10){y=0;} if(z==10){z=0;}
	//牌等於娃娃的時候 點數為0.5
	if(y>10){y=0.5;} if(z>10){z=0.5;}

	if(b==''){b = y+z;}

	if(b>=10){b=b-10;}

	return b;
}

//四支刀
function chk4pass(w,x,y,z) {
	if(w==x && x==y && y==z){return true;}
	return false;
}
//兩張一樣
function chkpass(w,x,y,z) {
	if(w == x){	a = w+12;	}else{	if(chklong(w,x,y,z)){}else{ a = num1(w,x);} }
	if(y == z){	b = y+12;	}else{	if(chklong(w,x,y,z)){}else{ b = num2(y,z);} }
	if(a == w+12 || b == y+12){return true;}
	return false;
}
//囉嗦
function chklong(w,x,y,z) {
	if(w > 10 && x > 10){ a = 12; }else{ if(a == ''){a = num1(w,x);} }
	if(y > 10 && z > 10){ b = 12; }else{ if(b == ''){b = num2(y,z);} }
	if(a == 12 || b == 12){ return true; }
	return false;
}

//A>B重牌
function calculate(w,x,y,z) {
	var rand = new Array;
	
	rand = [w,x,y,z];

	rand.sort(function(){return Math.random()>0.5?-1:1;});
	pokered = rand;

	for(i=0;i<rand.length;i++){
		rand[i] = parseInt(rand[i]);
	}

	if(changnum(rand[0],rand[1],rand[2],rand[3])){
		
	}else{
		calculate(rand[0],rand[1],rand[2],rand[3]);
	}
}

function findArray(key, value, haystack, strict) {
	for(var i = 0; i < haystack.length; i++) {
	    if (typeof strict !== 'undefined' && strict === true) {
	        if(haystack[i][key] === value) return haystack[i];
	    } else {
	        if(haystack[i][key] == value) return haystack[i];
	    }
	}
	return false;
}


$('.start').click(function () {
	websocket.send(JSON.stringify({
		'action':"start",
		'name': name,
	})); 
});

$('.gitporker').click(function () {
	raisenum = 0;
	usernum = 0;
	for (var i = 1; i < 9; i++) {
		if(user[i]){ usernum++};
	}

	gamemoney = parseInt($(".money").html());
	$(".money").html(gamemoney - 10);

	$('.start').hide();
	$('.raise, .call, .flod, .tablemoney, .yes').show();
});

$('.yes').click(function (){
	w = parseInt($('.user' + id).find("img").eq(0).attr('data'));
	x = parseInt($('.user' + id).find("img").eq(1).attr('data'));
	y = parseInt($('.user' + id).find("img").eq(2).attr('data'));
	z = parseInt($('.user' + id).find("img").eq(3).attr('data'));

	if(changnum(w,x,y,z)){
		$('.raise,.call,.flod,.check,.yes').hide();
		
		websocket.send(JSON.stringify({
			'action':"yes",
			'name': name,
			'userid': id,
			'upnum': a,
			'downunm': b,
			'w': w,
			'x': x,
			'y': y,
			'z': z,
		}));
	}else{
		alert("前墩不能大於後墩");
	}
});

$('.check').click(function (){
	
	var usernum = 0;

	for (var i = 1; i < 9; i++) {
		if(user[i]){ if(i != id){usernum++} };
	}

	tablemoney = parseInt($(".tablemoney").html());
	tablemoney = tablemoney+(raisenum*10*usernum);
	$('.tablemoney').html(tablemoney);

	// for (var i = 1; i < 9; i++) {
	// 	if(user[i]){
	// 		if(i != id){
	// 			calculate(poker[0+(i*4)],poker[1+(i*4)],poker[2+(i*4)],poker[3+(i*4)]);
	// 			$('.user'+i).html('<img src="img/'+pokered[0]+'.svg" />'+'<img src="img/'+pokered[1]+'.svg" />'+'<img src="img/'+pokered[2]+'.svg" />'+'<img src="img/'+pokered[3]+'.svg" />');
	// 		}
	// 	}
	// }
	
	

	// upnum.sort(function (a, b) { return a.up < b.up ? 1 : -1;});
	// downunm.sort(function (a, b) { return a.down < b.down ? 1 : -1;});

});

$('.flod').click(function (){
	websocket.send(JSON.stringify({
		'action':"flod",
		'name': name,
		'userid': id,
				
	}));
	tablemoney = 0;
	$('.tablemoney').html(tablemoney);
});	


$('.raise').click(function (){
	gamemoney = parseInt($(".money").html());
	raisenum++;
	$(".money").html(gamemoney - 10);
	tablemoney = tablemoney+10;
	$('.tablemoney').html(tablemoney);
});


$('.web').click(function (){
	websocket.send(JSON.stringify({
		'action':"ready",
		'name': name,
	}));
	$('.web').hide();
});



$(function() {
	$('#message').keypress(function(e) {
		if ( e.keyCode == 13 && this.value ) {
			//log( 'You: ' + this.value );
			websocket.send(JSON.stringify({
				'action':"masg",
				'name': name,
				'masg': this.value,
				
			})); 
			$(this).val('');
		}
	});
});


