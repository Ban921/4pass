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
	<style type="text/css">
		body{
			cursor: pointer;
			overflow:hidden;
		}
		.gametable{
			height: 900px;
			width: 900px;
			margin: auto;
		}

		.up{
			width: 200px;
			height: 200px;
			margin-left:350px;
			border-style:dashed;

		}
		.down{
			width: 200px;
			height: 200px;
			margin-top:150px;
			margin-left:350px;
			border-style:dashed;


		}
		.right{
			width: 200px;
			height: 200px;
			margin-top:150px;
			float: right;
			border-style:dashed;
			
		}
		.left{
			width: 200px;
			height: 200px;
			margin-top:150px;
			border-style:dashed;
		}
		.start{
			color: rgba(255,255,255,1);
			text-decoration: none;
			background-color: rgba(219,87,5,1);
			font-family: 'Yanone Kaffeesatz';
			font-weight: 700;
			font-size: 3em;
			display: block;
			padding: 4px;
			-webkit-border-radius: 8px;
			-moz-border-radius: 8px;
			border-radius: 8px;
			-webkit-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
			-moz-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
			box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
			text-align: center;

			-webkit-transition: all .1s ease;
			-moz-transition: all .1s ease;
			-ms-transition: all .1s ease;
			-o-transition: all .1s ease;
			transition: all .1s ease;

			width: 100px;
			height: 50px;
			position:relative;
			top: 430px;
			left: 400px;
			float: left;
		}
		.start:active{
			-webkit-box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
    		-moz-box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
    		box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
    		position: relative;
    		top: 436px;
    		left: 400px;
		}
		.go{
			color: rgba(255,255,255,1);
			text-decoration: none;
			background-color: rgba(219,87,5,1);
			font-family: 'Yanone Kaffeesatz';
			font-weight: 700;
			font-size: 3em;
			display: block;
			padding: 4px;
			-webkit-border-radius: 8px;
			-moz-border-radius: 8px;
			border-radius: 8px;
			-webkit-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
			-moz-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
			box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
			text-align: center;
			-webkit-transition: all .1s ease;
			-moz-transition: all .1s ease;
			-ms-transition: all .1s ease;
			-o-transition: all .1s ease;
			transition: all .1s ease;

			width: 100px;
			height: 50px;
			position:relative;
			right:  30px;
			bottom: 100px;
			/*left: 400px;*/
			float: right;
		}
		.go:active{
			-webkit-box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
    		-moz-box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
    		box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
    		position: relative;

			bottom: 100px;
		}
		img{
			height: 100px;
			width: 100px;
		}
		img:hover{
			top:10px;
		}
		.chack{
			background-color: #E0E0E0;
		}
		.back{
			color: rgba(255,255,255,1);
			text-decoration: none;
			background-color: rgba(219,87,5,1);
			font-family: 'Yanone Kaffeesatz';
			font-weight: 700;
			font-size: 3em;
			display: block;
			padding: 4px;
			-webkit-border-radius: 8px;
			-moz-border-radius: 8px;
			border-radius: 8px;
			-webkit-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
			-moz-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
			box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
			text-align: center;
			-webkit-transition: all .1s ease;
			-moz-transition: all .1s ease;
			-ms-transition: all .1s ease;
			-o-transition: all .1s ease;
			transition: all .1s ease;

			width: 100px;
			height: 50px;
			position:relative;
			left: 50px;
			bottom: 100px;
			float: left;
		}
		.back:active{
			-webkit-box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
    		-moz-box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
    		box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
    		position: relative;
			bottom: 100px;
		}
	</style>
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<script
  src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<body>
	<div class="gametable">  
		<div class="start">發牌</div>
		<div class="up"></div>
		<div class="right"></div>
		<div class="left"></div>
		<div class="down"></div>
		<div class="go">比牌</div>
		<div class="back">取消</div>
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
			var c = '';
			if(chk4pass(w,x,y,z)){
				c = "4pass";
			}
			if(c == ''){
				//13等於兩張
				if(chkpass(w,x)){ a = "pass"; }
				if(chkpass(y,z)){ b = "pass"; }
				//12等於兩張大於10
				if(chklong(w,x)){ a = "long"; }
				if(chklong(y,z)){ b = "long"; }

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
				// $('.back').click();
			}
			a = ''; b = ''; 
			

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


		function calculate(w,x,y,z) {
			
		}


		$('.start').click(function () {
			open = new Array();
			poker.sort(function(){return Math.random()>0.5?-1:1;});

			// $('.up').html('<img src="img/'+poker[0]+'.svg" />'+'<img src="img/'+poker[1]+'.svg" />'+'<img src="img/'+poker[2]+'.svg" />'+'<img src="img/'+poker[3]+'.svg" />');
			// $('.right').html('<img src="img/'+poker[4]+'.svg" />'+'<img src="img/'+poker[5]+'.svg" />'+'<img src="img/'+poker[6]+'.svg" />'+'<img src="img/'+poker[7]+'.svg" />');
			// $('.left').html('<img src="img/'+poker[8]+'.svg" />'+'<img src="img/'+poker[9]+'.svg" />'+'<img src="img/'+poker[10]+'.svg" />'+'<img src="img/'+poker[11]+'.svg" />');

			$('.up').html('<img src="img/bg.jpg" />'+'<img src="img/bg.jpg" />'+'<img src="img/bg.jpg" />'+'<img src="img/bg.jpg" />');
			$('.right').html('<img src="img/bg.jpg" />'+'<img src="img/bg.jpg" />'+'<img src="img/bg.jpg" />'+'<img src="img/bg.jpg" />');
			$('.left').html('<img src="img/bg.jpg" />'+'<img src="img/bg.jpg" />'+'<img src="img/bg.jpg" />'+'<img src="img/bg.jpg" />');
			$('.down').html('<img data="'+poker[12]+'" src="img/'+poker[12]+'.svg" />'+'<img data="'+poker[13]+'" src="img/'+poker[13]+'.svg" />'+'<img data="'+poker[14]+'" src="img/'+poker[14]+'.svg" />'+'<img data="'+poker[15]+'" src="img/'+poker[15]+'.svg" />');
			$('img').click(function (){
				var c = $(this).attr('data');
				c = parseInt(c);

				if($(this).hasClass('chack')){
					$(this).removeClass('chack');
					open.pop(c);
				}else{
					$(this).addClass('chack');
					open.push(c);
				}
			});
			$(function() {
  			  $( ".down" ).sortable();
  			  $( ".down" ).disableSelection();
  			});
			// $('.start').hide();
		});
		$('.back').click(function (){
				$('.chack').removeClass('chack');
				open = new Array();
				game = new Array();
			});

		$('.go').click(function (){

				for(i=0;i<poker.length;i++){
					pokeropen[i] = parseInt(pokeropen[i]);
					pokeropen[i] = poker[i]%13;
					if(pokeropen[i] == 0){pokeropen[i] = 13;}
				}
				calculate(pokeropen[0],pokeropen[1],pokeropen[2],pokeropen[3]);
				calculate(pokeropen[4],pokeropen[5],pokeropen[6],pokeropen[7]);
				calculate(pokeropen[8],pokeropen[9],pokeropen[10],pokeropen[11]);

				if(open.length != 4){alert("請選擇4張牌"); return false;}

				for(i=0;i<open.length;i++){
					game[i] = parseInt(game[i]);
					game[i] = open[i]%13;
					if(game[i] == 0){game[i] = 13;}
				}
				chkcant(game[0],game[1],game[2],game[3]);
			});

	</script>
</body>
</html>