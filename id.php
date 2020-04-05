<?php
$id = $_GET['id'];
$db_cats = new dbCats();
$payloads1 = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id)->fetchArray(1);

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
$color = $cats[0]['color'];

$name2 = $payloads1[0]['name'];
if (($name2 != '') and ($name2 != null)) {$name = $name2;} else {$name = $name1;}

$payloadsID = $db_cats->query('SELECT * FROM "gen" WHERE stored_id=' . $id)->fetchArray(1);

$fishtail = $payloadsID[0]['fishtail'];
$tentacles = $payloadsID[0]['tentacles'];
$horns = $payloadsID[0]['horns'];

$json_api = JSON($api3."/block?height=$id");
$data = $json_api->result->time;

$nd = date('d.m.Y', strtotime(explode('T', $data)[0]));

if ($gender == '♂') {
	$gender_p = $language['Male'] . " ($gender)";
}
if ($gender == '♀') {
	$gender_p = $language['Female'] . " ($gender)";
}
if ($gender == '0') {
	$gender_p = $language['Undefined'];
}
if ($pricebd == '') {$bgimg = ''; $pr = $price;} else {$bgimg = '<font color="red"><b>(Sale)</b></font>'; $pr = $pricebd;}
echo "
<center>
	<div style='background: $color' width='100%' height='300'>
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
