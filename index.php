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
		<?php 
			for ($i=1; $i < 8; $i++) { 
				echo '<div class="user'.$i.'"></div>';		
			}
		?>
	</div>
	<div class="button">
		<!-- <div class="porker"><div class="porkeropen"></div></div> -->
		<div class="check"></div>
		<div class="raise">加碼</div>
		<div class="call">買牌</div>
		<div class="yes">確定</div>
		<div class="flod">棄牌</div>
		<div class="call">跟牌</div>
		<div class="web"></div>
	</div>
	<div class="online"></div>
	<script src="js/main.js?version=<?php echo rand()?>"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css?version=<?php echo rand()?>">
	<div id='body'>
		<textarea id='log' name='log' readonly='readonly'></textarea><br/>
		<input type='text' id='message' name='message' />
	</div>
</body>
</html>