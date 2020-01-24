<?php
// This script uses the GD library to draw a glass half full of tea
header("Content-type: image/png");

$width = 350;
$height = 350;

$img = ImageCreateTrueColor($width, $height);

$white = ImageColorAllocate($img, 255, 255, 255);
ImageFillToBorder($img, 0, 0, $white, $white);

$black = imagecolorallocate($img, 0, 0, 0);
$brown = imagecolorallocate($img,90, 50, 50);
$brownish = imagecolorallocate($img,100,80,80);

ImageEllipse($img, 180, 100, 100, 20, $black);
imageline($img, 130,100, 130,300,$black);
imageline($img,230,100,230,300,$black);
imagefilledrectangle($img,130,200,230,300,$brown);
imagefilledellipse($img,180,200,100,20,$brownish);

imagefilledellipse($img,180,300,100,20,$brown);

ImagePNG($img);

ImageDestroy($img);
?>