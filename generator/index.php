<?php
$input = array('#4DFF77', '#4D7DFF', '#FFF44D', '#D2BE58', '#FF583F', '#9069bf', '#FFCCCC', '#C2F252', '#CC9966', '#949494');
$inputkey = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
$rand_keys = array_rand($inputkey,2);

$bg = 1;
if ($bg == 1){
$eyes = rand(0,11);
$spot = rand(0,8);

$bg2color = $input[$rand_keys[0]];
$spotcolor = $input[$rand_keys[1]];
}
$arr = array(
  'eyes' => $eyes, //глаза
  'bg1' => $bg, //Белый фон
  'bg2' => $bg, //Черный фон
  'bg2color' => $bg2color, //Черный фон (цвет)
  'circuit' => $bg, //Контур
  'spot' => $spot, //Пятна
  'spotcolor' => $spotcolor //Пятна (цвет)
);

function IMG($dest, $src)
{
imagecolortransparent($src, imagecolorat($src, 0, 0));
$src_x = imagesx($src);
$src_y = imagesy($src);
imagecopy($dest, $src, 0, 0, 0, 0, $src_x, $src_y);
return $dest;
}

function hex($img,$color)
{
	imageSaveAlpha($img, true);
	list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
	imagefilter($img, IMG_FILTER_COLORIZE, $r, $g, $b);
	return $img;
}

$generator = 'https://mintercat.com/generator/';

$dest = imagecreatefromWebp($generator . 'bg1/'.$arr['bg1'].'.webp');
$src = imagecreatefromWebp($generator . 'bg2/'.$arr['bg2'].'.webp');

$img = hex($src,$arr['bg2color']);
$dest = IMG($dest,$src);
//------------------------------------------
$img = imagecreatefromWebp($generator . 'spot/'.$arr['spot'].'.webp');

$img = hex($img,$arr['spotcolor']);

$dest = IMG($dest,$img);
//------------------------------------------
$src = imagecreatefromWebp($generator . 'circuit/'.$arr['circuit'].'.webp');
$dest = IMG($dest,$src);
//------------------------------------------ 
$src = imagecreatefromWebp($generator . 'eyes/'.$arr['eyes'].'.webp');
$dest = IMG($dest,$src);
//------------------------------------------

$q = 'Cat' . $bg .'-'. $rand_keys[0] .'-'. $spot .'-'. $rand_keys[1] .'-'. $eyes . '.webp';
imageWebp($dest, $q);

echo "
<title>Generator</title>
<center><table><tr>
<td align='center'>
<img src='".$generator."circuit/$bg.webp' width='150' height='150'><br>$bg
</td>
<td align='center'>
<img src='".$generator."bg2/$bg.webp' width='150' height='150'><br>$rand_keys[0] &rarr; $bg2color
</td>
<td align='center'>
<img src='".$generator."eyes/$eyes.webp' width='150' height='150'><br>$eyes
</td>
<td align='center'>
<img src='".$generator."spot/$spot.webp' width='150' height='150'><br>$spot<br>($rand_keys[1] &rarr; $spotcolor)
</td></tr></table>
<table><tr><td>
<img src='$q'>
</td><td>
circuit: $bg <br>
bg color: $rand_keys[0] &rarr; $bg2color <br>
spot: $spot <br>
spot color: $rand_keys[1] &rarr; $spotcolor <br>
eyes: $eyes <br>
<a href='$q' target='_blank'>$q</a>
</td></tr></table></center>
";