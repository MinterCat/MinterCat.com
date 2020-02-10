<?php
$png = $_GET['png'];
$src = __DIR__ . "/img/gen/$png.webp";
$info = pathinfo($src);
 
$img = imageCreatefromWebp($src);
imagePng($img, $info['dirname'] . '/' . $info['filename'] . '.png');

header('Content-Type: image/x-png');
imagePng($img);