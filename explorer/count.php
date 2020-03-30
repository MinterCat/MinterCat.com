<?php
include('../../config/config.php');
//-----------------------
$base = "session.txt";
include('online.php');
//-----------------------
$database = new SQLite3('../../config/users.sqlite');
$data = $database->query('SELECT COUNT(*) FROM "table"')->fetchArray(1);
$count = $data['COUNT(*)'];

$database2 = new SQLite3('../../config/cats.sqlite');
$data2 = $database2->query('SELECT COUNT(*) FROM "table"')->fetchArray(1);
$count2 = $data2['COUNT(*)'];

$data3 = $database2->query('SELECT COUNT(*) FROM "table" WHERE sale="1"')->fetchArray(1);
$count3 = $data3['COUNT(*)'];

function JSON ($url)
	{
		$data = file_get_contents($url);
		$jsonCalled = json_decode($data);
		return $jsonCalled;
	}
$json_api = JSON('https://api.mintercat.com/coin');
$count4 = number_format($json_api->estimate,4);

echo "
<div class='cat_content_none' style='margin-top: 30px;'>
<div class='explorer_content'>
<div class='explorer_block_icons'>
<picture>
<source srcset='".$site."static/img/icons/people.webp' type='image/webp' width='100' height='100'>
<img src='".$site."png2.php?png=people&type=icons' width='100' height='100'>
</picture><br>
Users registered: <b>$count</b>
</div><div class='explorer_block_icons'>
<picture>
<source srcset='".$site."static/img/icons/Cats.webp' type='image/webp' width='100' height='100'>
<img src='".$site."png2.php?png=Cats&type=icons' width='100' height='100'>
</picture><br>
Сats were born: <b>$count2</b>
</div><div class='explorer_block_icons'>
<picture>
<source srcset='".$site."static/img/icons/Shope.webp' type='image/webp' width='100' height='100'>
<img src='".$site."png2.php?png=Shope&type=icons' width='100' height='100'>
</picture><br>
Cats in the store: <b>$count3</b>
</div><div class='explorer_block_icons'>
<picture>
<source srcset='".$site."static/img/icons/online.webp' type='image/webp' width='100' height='100'>
<img src='".$site."png2.php?png=online&type=icons' width='100' height='100'>
</picture><br>
Online: <b>". $online_check ."</b>
</div>
<div class='explorer_block_icons'>
<picture>
<source srcset='".$site."static/img/icons/Shope.webp' type='image/webp' width='100' height='100'>
<img src='".$site."png2.php?png=Shope&type=icons' width='100' height='100'>
</picture><br>
The rate of the MINTERCAT coin: <b>$count4</b> BIP
</div>
</div></div>";
