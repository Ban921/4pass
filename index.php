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
	<title>四支刀</title>
	<script type="text/javascript">
		if(!name){
			var name = prompt("請輸入遊戲名稱");
		}
		
	</script>
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="js/websocket.js?version=<?php echo rand()?>"></script>
</head>

<body>
  <div class="heard">
    <div class="money">1000</div>
  </div>
  
	<div class="gametable">  
		<div class="tablemoney"></div>
		<div class="start">開始</div>
		<div class="gitporker"></div>
		<div class="user1"></div>
		<div class="user2"></div>
		<div class="user3"></div>
		<div class="user4"></div>
		<div class="user5"></div>
		<div class="user6"></div>
		<div class="user7"></div>
		<div class="user8"></div>
	</div>
	<div class="button">
		<div class="check">比牌</div>
		<div class="raise">加碼</div>
		<div class="call">過/跟牌</div>
		<div class="flod">棄牌</div>
		<div class="web">連線</div>
	</div>
	
	<script src="js/main.js?version=<?php echo rand()?>"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css?version=<?php echo rand()?>">
	<div id='body'>
		<textarea id='log' name='log' readonly='readonly'></textarea><br/>
		<input type='text' id='message' name='message' />
	</div>
</body>
</html>