<?php
$id = $_GET['id'];
$db_cats = new Cats();
$result = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id);
$payloads1 = $result->fetchArray(1);

$img = $payloads1['img'];

$json4 = file_get_contents($site.'api?img='.$img);
$payloads4 = json_decode($json4,true);

$pricebd = $payloads1['price'];

$cats = $payloads4['cats'];

$series = $cats[0]['series'];
$rarity = ($cats[0]['rarity'])*100;
$price = $cats[0]['price'];
$name1 = $cats[0]['name'];
$count = $cats[0]['count'];
$gender = $cats[0]['gender'];

$name2 = $payloads1[0]['name'];
if (($name2 != '') and ($name2 != null)) {$name = $name2;} else {$name = $name1;}

switch ($series)
{
	case 0: {$u = '#C1B5FF'; break;}
	case 1: {$u = '#FFF6B5'; break;}
	case 2: {$u = '#FFB5B5'; break;}
	case 3: {$u = '#C7F66F'; break;}
	case 4: {$u = '#FFC873'; break;}
	case 5: {$u = '#6AF2D7'; break;}
	case 999: {$u = '#9BF5DA'; break;}
}

$db_gen = new Gen();
$result2 = $db_gen->query('SELECT * FROM "table" WHERE stored_id=' . $id);
$payloadsID = $result2->fetchArray(1);

$fishtail = $payloadsID[0]['fishtail'];
$tentacles = $payloadsID[0]['tentacles'];
$horns = $payloadsID[0]['horns'];

$json2 = file_get_contents($api3."/block?height=$id");
$payloads2 = json_decode($json2,true);

$data = $payloads2['result']['time'];
$timestamp2 = date('Y-m-d',strtotime(explode('T', $data)[0]));

$unixD = strtotime($timestamp2);
$nd = date('d.m.Y', $unixD);

if ($gender == '♂') {
	$gender_p = $language['Male'] . " ($gender)";
}
if ($gender == '♀') {
	$gender_p = $language['Female'] . " ($gender)";
}
if ($gender == '0') {
	$gender_p = $language['Undefined'];
}
if ($pricebd == '') {$bgimg = ''; $pr = $price;} else {$bgimg = '<font color="red"><b>(Продается)</b></font>'; $pr = $pricebd;}
echo "
<center>
	<div style='background: $u' width='100%' height='300'>
			<picture>
			<source srcset='".$site."static/img/Cat$img.webp' type='image/webp' width='350' height='350'>
			<img src='".$site."png.php?png=$img' width='350' height='350'>
			</picture><br>
	</div>
			#$id<br>
			$name
			<hr>
			" . $language['Cat_created'] . " <b>$nd</b>, " . $language['in_block'] . " <b>#$id</b> <br>
" . $language['Chance_of_falling_out'] . " <b>$rarity%</b><br>
" . $language['gender'] . ": $gender_p<br>
" . $language['Number_of_cats_of_this_breed'] . " <b>$count</b><br>
<br>
";
if ($pricebd != '') {echo "Price in shop: <b>$pr</b> $coin<br><br>";}
echo $language['Approximate_cost'] . " <b>$price</b> $coin<br><br>
";

echo "
<br>
1
<picture>
  <source srcset='".$site."static/img/gen/Normal.webp' type='image/webp' width='40' height='40'>
  <img src='".$site."png2.php?png=Normal' width='40' height='40'>
</picture>
";
if ($fishtail != 0) {
echo "
$fishtail
<picture>
  <source srcset='".$site."static/img/gen/Fish.webp' type='image/webp' width='40' height='40'>
  <img src='".$site."png2.php?png=Fish' width='40' height='40'>
</picture>
";
}
if ($tentacles != 0) {
echo "
$tentacles
<picture>
  <source srcset='".$site."static/img/gen/Sprut.webp' type='image/webp' width='40' height='40'>
  <img src='".$site."png2.php?png=Sprut' width='40' height='40'>
</picture>
";
}
if ($horns != 0) {
echo "
$horns
<picture>
  <source srcset='".$site."static/img/gen/Horns.webp' type='image/webp' width='40' height='40'>
  <img src='".$site."png2.php?png=Horns' width='40' height='40'>
</picture>
";
}
	echo '<br><br><br><br><br><br><br>
	</center>';
