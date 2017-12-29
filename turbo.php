<?php
	$width=10;
	$leng =10;
	$c=$width*$leng;
	$d=['x'=>[0,1],'y'=>[0,-1]];
	$m = ['x'=>$width,'y'=>$leng];//√‰∂Z
	$_d = ['x','y'];
	$arr = [];
	//if($('#direct').val()==0){
	//	d.x[1]*=-1;
	//	d.y[1]*=-1;
	//	_d.reverse();
	//}
	for($y = 0;$y<$m['y'];$y++){
		$arr[$y]=[];
		for($x = 0;$x<=$m['x'];$x++){
			$arr[$y][$x]="";
		}
	}

	//ΩΩ§˚
	ob_start();
	for($i=1;$i<=$c;$i++){
		$arr[$d['y'][0]][$d['x'][0]] = $i;
		$d[$_d[0]][0]+=$d[$_d[0]][1];
		if($d[$_d[0]][0] >= $m[$_d[0]] || $d[$_d[0]][0] < 0||$arr[$d['y'][0]][$d['x'][0]]!=""){
			$d[$_d[0]][0]-=$d[$_d[0]][1];
			$_d = array_reverse($_d);
			$d[$_d[0]][1]*=(-1);
			$d[$_d[0]][0]+=$d[$_d[0]][1];
		}
		for($y=0;$y<$leng;$y++){
			for($x=0;$x<$width;$x++){
				echo str_pad($arr[$y][$x],strlen($c)," ",STR_PAD_LEFT)." ";
			}
			echo PHP_EOL;
			ob_flush();
	                flush();

		}
		if($i<$c)system('clear');
		usleep(15000);
	}
//	exit;

?>
