<?php
include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/config.php');
include($_SERVER['DOCUMENT_ROOT'] . '/function.php');
//-----------------------
$base = 'session.txt';
include('online.php');
//-----------------------
$count = count(Users());

$count2 = Cats::Counts();

$count3 = Shop::Counts;

$count4 = number_format(JSON('https://api.mintercat.com/coin')->estimateCoinSell,4);

echo "
<div class='cat_content_none' style='margin-top: 30px;'>
<div class='explorer_content'>
<div class='explorer_block_icons'>
<picture>
<source srcset='https://mintercat.com/static/img/icons/people.webp' type='image/webp' width='100' height='100'>
<img src='https://mintercat.com/png2.php?png=people&type=icons' width='100' height='100'>
</picture><br>
Users registered: <b>$count</b>
</div><div class='explorer_block_icons'>
<picture>
<source srcset='https://mintercat.com/static/img/icons/Cats.webp' type='image/webp' width='100' height='100'>
<img src='https://mintercat.com/png2.php?png=Cats&type=icons' width='100' height='100'>
</picture><br>
Сats were born: <b>$count2</b>
</div><div class='explorer_block_icons'>
<picture>
<source srcset='https://mintercat.com/static/img/icons/Shope.webp' type='image/webp' width='100' height='100'>
<img src='https://mintercat.com/png2.php?png=Shope&type=icons' width='100' height='100'>
</picture><br>
Cats in the store: <b>$count3</b>
</div><div class='explorer_block_icons'>
<picture>
<source srcset='https://mintercat.com/static/img/icons/online.webp' type='image/webp' width='100' height='100'>
<img src='https://mintercat.com/png2.php?png=online&type=icons' width='100' height='100'>
</picture><br>
Online: <b>". $online_check ."</b>
</div>
<div class='explorer_block_icons'>
<picture>
<source srcset='https://mintercat.com/static/img/icons/Shope.webp' type='image/webp' width='100' height='100'>
<img src='https://mintercat.com/png2.php?png=Shope&type=icons' width='100' height='100'>
</picture><br>
The rate of the MINTERCAT coin: <b>$count4</b> BIP
</div>
</div></div>";
