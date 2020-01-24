<?php
$levels = array(8,5,6,9,3,8,2,4,6,10,8,5,6,1,7,10,5,3,7,6);
echo sizeof($levels);
echo "<br />";

sort($levels);

foreach ($levels as $level) {
  echo $level. "  ";
}

unset($level);

$teamA = array();
$teamB = array();

function isEven ($num) {
  if ($num % 2 == 0) {
    return true;
  } else {
    return false;
  }
}

function add($ar){
  $sum = 0;
  foreach($ar as $value) {
    $sum += $value;
  }
  return $sum;
}

for ($i = 0; $i < 20; $i++) {
  $a = array_shift($levels);
  $b = array_pop($levels);
  if (isEven($i)) {
    array_push($teamA, $a,$b);
  } else {
    array_push($teamB, $a,$b);
  }
}

echo "<br />";
foreach($teamA as $playera){
  echo $playera." ";
}
echo " "."=".add($teamA);

echo "<br />";
foreach($teamB as $playerb) {
  echo $playerb." ";
}
echo " "."=".add($teamB);


echo "<br />";
echo phpinfo();
?>