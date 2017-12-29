var poker = new Array();
var open = new Array();
var game = new Array();
var pokeropen = new Array();

var uppork = new Array();
var rightpork = new Array();
var leftpork = new Array();
var downpork = new Array();

var num = new Array();


var a = '' , b = '' , x = 0, y = 0 ;

for (var i = 1; i <= 52; i++) {
	poker[i] = i;
}


function changnum(w,x,y,z){

	var a='',b='', c = '',d = '';

	w = w %13; x = x %13; y = y %13; z = z %13;
	if(w == 0){w = 13;} if(x == 0){x = 13;} if(y == 0){y = 13;} if(z == 0){z = 13;}
	console.log(w,x,y,z);
	
	if(chk4pass(w,x,y,z)){
		c = 99;
	}
	if(c == ''){
		//13等於兩張
		if(chkpass(w,x)){ a = "pass"; c = c;} if(chkpass(y,z)){ b = "pass"; d = c;}
		//12等於兩張大於10
		if(chklong(w,x)){ a = "long"; } if(chklong(y,z)){ b = "long"; }

		if(a == '' || b == ''){
			//牌等於10的時候 點數為0
			if(w==10){w=0;} if(x==10){x=0;} if(y==10){y=0;} if(z==10){z=0;}
			//牌等於娃娃的時候 點數為0.5
			if(w>10){w=0.5;} if(x>10){x=0.5;} if(y>10){y=0.5;} if(z>10){z=0.5;}

			if(a==''){a = w+x;} if(b==''){b = y+z;}

			if(a>=10){a=a-10;} if(b>=10){b=b-10;}
		}
	}

	if(a == "pass"){a = c+20;} if(a == "long"){a = 12;}
	if(b == "pass"){b = d+20;} if(b == "long"){b = 12;}
	// if(c == "4pass"){a = 14;b = 14;}

	if(a>b){
		return false;
	}else{
		return true;
	}
}

//確認第一墩不能大於第二墩
function chkcant(x,y){
	if(a>b){
		return false;
	}else{
		return true;
	}
}

//四支刀
function chk4pass(w,x,y,z) {
	if(w==x && x==y && y==z){
		return true;
	}
	return false;
}
//兩張一樣
function chkpass(w,x) {
	if(w == x){
		c = w ;
		return true;
	}
	return false;
}
//囉嗦
function chklong(w,x) {
	if(w > 10 && x > 10){
		return true;
	}
	return false;
}

//算出比較好的牌型
function calculate(w,x,y,z) {
	var rand = new Array;
	console.log(w,x,y,z);
	rand = [w,x,y,z];
	rand.sort(function(){return Math.random()>0.5?-1:1;});
	// console.log(w,x,y,z);
	for(i=0;i<rand.length;i++){
				rand[i] = parseInt(rand[i]);
			}
	

	
	console.log(w,x,y,z);

	if(changnum(rand[0],rand[1],rand[2],rand[3])){
		console.log(a,b);
	}else{
		calculate(rand[0],rand[1],rand[2],rand[3]);
		console.log(a,b);
	}

	

	// console.log(chkcant(w,x,y,z));
	// console.log(a,b);
	// a = ''; b = ''; 

	// console.log(chkcant(w,y,x,z));
	// console.log(a,b);
	// a = ''; b = ''; 

	// console.log(chkcant(w,z,x,y));
	// console.log(a,b);

	// w x y z
	// w y x z
	// w z x y

	// console.log(w,x,y,z);
}


$('.start').click(function () {
	poker.sort(function(){return Math.random()>0.5?-1:1;});

	$('.up').html('<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />');
	$('.right').html('<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />');
	$('.left').html('<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />'+'<img src="img/Red_Back.svg" />');
	$('.down').html('<img data="'+poker[12]+'" src="img/'+poker[12]+'.svg" />'+'<img data="'+poker[13]+'" src="img/'+poker[13]+'.svg" />'+'<img data="'+poker[14]+'" src="img/'+poker[14]+'.svg" />'+'<img data="'+poker[15]+'" src="img/'+poker[15]+'.svg" />');

	$(function() {
	  $( ".down" ).sortable();
	  $( "bady" ).disableSelection();
	});
	// $('.start').hide();
});


$('.go').click(function (){
	a = ''; b = ''; 
	w = parseInt($(".down").find("img").eq(0).attr('data'));
	x = parseInt($(".down").find("img").eq(1).attr('data'));
	y = parseInt($(".down").find("img").eq(2).attr('data'));
	z = parseInt($(".down").find("img").eq(3).attr('data'));
		if(changnum(w,x,y,z)){
			
			calculate(poker[0],poker[1],poker[2],poker[3]);
			$('.up').html('<img src="img/'+poker[0]+'.svg" />'+'<img src="img/'+poker[1]+'.svg" />'+'<img src="img/'+poker[2]+'.svg" />'+'<img src="img/'+poker[3]+'.svg" />');
			console.log(a,b);
			// calculate(poker[4],poker[5],poker[6],poker[7]);
			// console.log(a,b);
			// // calculate(poker[8],poker[9],poker[10],poker[11]);
			// console.log(a,b);
			
			$('.right').html('<img src="img/'+poker[4]+'.svg" />'+'<img src="img/'+poker[5]+'.svg" />'+'<img src="img/'+poker[6]+'.svg" />'+'<img src="img/'+poker[7]+'.svg" />');
			$('.left').html('<img src="img/'+poker[8]+'.svg" />'+'<img src="img/'+poker[9]+'.svg" />'+'<img src="img/'+poker[10]+'.svg" />'+'<img src="img/'+poker[11]+'.svg" />');
		}else{
			alert("前墩不能大於後墩");
		}
		// console.log(a,b);

		
		

		// if(open.length != 4){alert("請選擇4張牌"); return false;}

		
	});