<html>
<head>

	<meta charset="UTF-8">
	<title>四支刀</title>
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  
	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

	<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
	
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