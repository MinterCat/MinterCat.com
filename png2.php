<?php
$png = $_GET['png'];
$type = $_GET['type'];
$src = __DIR__ . "/static/img/$type/$png.webp";
$info = pathinfo($src);

$img = imageCreatefromWebp($src);
imagePng($img, $info['dirname'] . '/' . $info['filename'] . '.png');

header('Content-Type: image/x-png');
imagePng($img);
