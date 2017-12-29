<!--
                       _oo0oo_
                      o8888888o
                      88" . "88
                      (| -_- |)
                      0\  =  /0
                    ___/`---'\___
                  .' \\|     |// '.
                 / \\|||  :  |||// \
                / _||||| -:- |||||- \
               |   | \\\  -  /// |   |
               | \_|  ''\---/''  |_/ |
               \  .-\__  '-'  ___/-. /
             ___'. .'  /--.--\  `. .'___
          ."" '<  `.___\_<|>_/___.' >' "".
         | | :  `- \`.;`\ _ /`;.`/ - ` : | |
         \  \ `_.   \_ __\ /__ _/   .-` /  /
     =====`-.____`.___ \_____/___.-`___.-'=====
                       `=---='


     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

               佛祖保佑         永无BUG

-->
<html>
<head>

	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<script
  src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>

<body>
	<div class="gametable">  
		<div class="start">發牌</div>
		<div class="up"></div>
		<div class="right"></div>
		<div class="left"></div>
		<div class="down"></div>
		<div class="go">比牌</div>
		<!-- <div class="back">取消</div> -->
	</div>
	<script type="text/javascript">

		var poker = new Array();
		var open = new Array();
		var game = new Array();
		var pokeropen = new Array();


		var a = '' , b = '' , x = 0, y = 0 ;
		
		for (var i = 1; i <= 52; i++) {
			poker[i] = i;
		}

		function chkcant(w,x,y,z){
			
			w = w %13; x = x %13; y = y %13; z = z %13;
			if(w == 0){w = 13;} if(x == 0){x = 13;} if(y == 0){y = 13;} if(z == 0){z = 13;}

			var c = '';
			if(chk4pass(w,x,y,z)){
				c = "4pass";
			}
			if(c == ''){
				//13等於兩張
				if(chkpass(w,x)){ a = "pass"; } if(chkpass(y,z)){ b = "pass"; }
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

			if(a == "pass"){a = 13;} if(a == "long"){a = 12;}
			if(b == "pass"){b = 13;} if(b == "long"){b = 12;}
			// if(c == "4pass"){a = 14;b = 14;}

			if(a>b){
				alert("前墩不能大於後墩");
				return false;
			}else{
				return true;
			}
		}

		//確認第一墩不能大於第二墩
		function oneand(x,y){

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

			console.log(w,x,y,z);

			// for(i=0;i<poker.length;i++){
			// 			pokeropen[i] = parseInt(pokeropen[i]);
			// 			pokeropen[i] = poker[i]%13;
			// 			if(pokeropen[i] == 0){pokeropen[i] = 13;}
			// 		}
			// a = ''; b = '';

			// chkcant(w,x,y,z);
			console.log(a,b);
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
				if(chkcant(w,x,y,z,poker)){
					// for(i=0;i<poker.length;i++){
					// 	pokeropen[i] = parseInt(pokeropen[i]);
					// 	pokeropen[i] = poker[i]%13;
					// 	if(pokeropen[i] == 0){pokeropen[i] = 13;}
					// }
					
					calculate(poker[0],poker[1],poker[2],poker[3],poker);
					// calculate(pokeropen[4],pokeropen[5],pokeropen[6],pokeropen[7]);
					// calculate(pokeropen[8],pokeropen[9],pokeropen[10],pokeropen[11]);
					$('.up').html('<img src="img/'+poker[0]+'.svg" />'+'<img src="img/'+poker[1]+'.svg" />'+'<img src="img/'+poker[2]+'.svg" />'+'<img src="img/'+poker[3]+'.svg" />');
					$('.right').html('<img src="img/'+poker[4]+'.svg" />'+'<img src="img/'+poker[5]+'.svg" />'+'<img src="img/'+poker[6]+'.svg" />'+'<img src="img/'+poker[7]+'.svg" />');
					$('.left').html('<img src="img/'+poker[8]+'.svg" />'+'<img src="img/'+poker[9]+'.svg" />'+'<img src="img/'+poker[10]+'.svg" />'+'<img src="img/'+poker[11]+'.svg" />');
				}
				// console.log(a,b);

				
				

				// if(open.length != 4){alert("請選擇4張牌"); return false;}

				
			});

	</script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</body>
</html>