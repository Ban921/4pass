var poker = new Array();
var compare = new Array();

var up = true;
var right = true;
var left = true;
var down = true;

var tablemoney = 0;

for (var i = 1; i <= 52; i++) {
	poker[i] = i;
}

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
	if(w==x && x==y && y==z){	return true;	}
	return false;
}
//兩張一樣
function chkpass(w,x,y,z) {
	if(w == x){	a = w+12;	}else{	a = num1(w,x);	}
	if(y == z){	b = y+12;	}else{	b = num2(y,z);	}
	if(a == w+12 || b == y+12){	return true;	}
	return false;
}
//囉嗦
function chklong(w,x,y,z) {
	a = 0; b = 0; 
	if(w > 10 && x > 10){	a = 12;	}else{	if(a == ''){a = num1(w,x);}	}
	if(y > 10 && z > 10){	b = 12;	}else{	if(b == ''){b = num2(y,z);}	}
	if(a == 12 || b == 12){	return true;	}
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


$('.start').click(function () {
	poker.sort(function(){return Math.random()>0.5?-1:1;});

	if(up){
		$('.up').css("border-style","dashed");
		$('.up').html('<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />');
	}
	if(right){
		$('.right').css("border-style","dashed");
		$('.right').html('<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />');
	}
	if(left){
		$('.left').css("border-style","dashed");
		$('.left').html('<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />');
	}
	if(down){
		$('.down').css("border-style","dashed");
		$('.down').html('<img data="'+poker[12]+'" src="img/'+poker[12]+'.svg" />'+'<img data="'+poker[13]+'" src="img/'+poker[13]+'.svg" />'+'<img data="'+poker[14]+'" src="img/'+poker[14]+'.svg" />'+'<img data="'+poker[15]+'" src="img/'+poker[15]+'.svg" />');
	}
	
	$(function() {
	  $( ".down" ).sortable();
	  $( "bady" ).disableSelection();
	});
	$('.start').hide();
	$('.check').show();
	$('.raise').show();
	$('.call').show();
	$('.flod').show();
});


$('.check').click(function (){
	var up = [];
	var down = [];
	

	w = parseInt($(".down").find("img").eq(0).attr('data'));
	x = parseInt($(".down").find("img").eq(1).attr('data'));
	y = parseInt($(".down").find("img").eq(2).attr('data'));
	z = parseInt($(".down").find("img").eq(3).attr('data'));
		if(changnum(w,x,y,z)){

			$('.raise').hide();
			$('.call').hide();
			$('.flod').hide();

			up.push({ name: "down", up: a, down: b });
			down.push({ name: "down", up: a, down: b });
			calculate(poker[0],poker[1],poker[2],poker[3]);
			up.push({ name: "up", up: a, down: b });
			down.push({ name: "up", up: a, down: b });
			$('.up').html('<img src="img/'+pokered[0]+'.svg" />'+'<img src="img/'+pokered[1]+'.svg" />'+'<img src="img/'+pokered[2]+'.svg" />'+'<img src="img/'+pokered[3]+'.svg" />');
			calculate(poker[4],poker[5],poker[6],poker[7]);
			up.push({ name: "right", up: a, down: b });
			down.push({ name: "right", up: a, down: b });
			$('.right').html('<img src="img/'+pokered[0]+'.svg" />'+'<img src="img/'+pokered[1]+'.svg" />'+'<img src="img/'+pokered[2]+'.svg" />'+'<img src="img/'+pokered[3]+'.svg" />');
			calculate(poker[8],poker[9],poker[10],poker[11]);
			up.push({ name: "left", up: a, down: b });
			down.push({ name: "left", up: a, down: b });
			$('.left').html('<img src="img/'+pokered[0]+'.svg" />'+'<img src="img/'+pokered[1]+'.svg" />'+'<img src="img/'+pokered[2]+'.svg" />'+'<img src="img/'+pokered[3]+'.svg" />');
			$('.check').hide();

			up.sort(function (a, b) { return a.up < b.up ? 1 : -1;});
			down.sort(function (a, b) { return a.down < b.down ? 1 : -1;});

			if(up[0].name == down[0].name){
				
				console.log("123");
			}else{
				
				console.log("321");
			}
			// setTimeout(function(){
			// 	$('.start').click();
			// },5000);
		}else{
			alert("前墩不能大於後墩");
		}
});