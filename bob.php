<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style type="text/css">
    tr td{
        border-style:solid;
    }
</style>
</head>
<body>
    <table>
      <form action="" method="get">
        <p>行: <input type="text" name="row" pattern="^[0-9]*$" required="required"/></p>
        <p>列: <input type="text" name="col" pattern="^[0-9]*$" required="required"/></p>
        <p>方向:<select name="direction"><option value ="0">逆時針</option><option value ="1">順時針</option></select></p>
        <input type="submit" value="Submit" />
      </form>

    </table>
    
</body>
</html>




<?php

$num = array();
@$n = $_GET['row'];
@$m = $_GET['col'];


if(!$_GET['direction']){
  for ($i = 0; $i < $m; $i++) {
    for ($j = 0; $j < $n; $j++) {
      $num[$j][$i] = '';
    }
  }
}else{
  for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $m; $j++) {
      $num[$i][$j] = '';
    }
  }
}

$count = 1;
$x = 0;
$y = 0;
$dx = 1;
$dy = 0;


while ($count <= $n*$m) {

  $num[$x][$y] = $count;
  $x += $dx;
  $y += $dy;
  if ($dx == 1 && ($x >= $n-1 || $num[$x+1][$y] != 0 )) {
    $dx = 0;
    $dy = 1;
  }
  else if($dy == 1 && ($y >= $m-1 || $num[$x][$y+1] != 0)){
    $dx = -1;
    $dy = 0;
  }
  else if($dx == -1 && ($x <= 0 || $num[$x-1][$y] != 0)){
    $dx = 0;
    $dy = -1;
  }
  else if($dy == -1 && ($y <= 0 || $num[$x][$y-1] != 0)){
    $dx = 1;
    $dy = 0;
  }
  $count++;
}



echo "<table>";
if(!$_GET['direction']){
  for ($i = 0; $i < $m; $i++) {
      echo "<tr>";  

    for ($j = 0; $j < $n; $j++) {
      echo "<td>";  
      echo $num[$j][$i];
    }
  }
}else{
  for ($i = 0; $i < $n; $i++) {
      echo "<tr>";  

    for ($j = 0; $j < $m; $j++) {
      echo "<td>";  
      echo $num[$i][$j];
    }
  }
}

echo "</table>";

?>