<?php
$db_cats = new Cats();

$json4 = file_get_contents($site.'api');
$payloads4 = json_decode($json4,true);

$a = $_SESSION['a'];
if ($a==0) {$text = ""; $a=0; $_SESSION['a'] = $a;}
if ($a==1) {echo $text = "<center><blockquote>" . $language['The_user_with_such_a_nickname_is_not_found'] . "</blockquote></center><br>"; $a=0; $_SESSION['a'] = $a;}
if ($a==2) {echo $text = "<center><blockquote>" . $language['Cat_sent'] . "</blockquote></center><br>"; $a=0; $_SESSION['a'] = $a;}
if ($a==3) {echo $text = "<center><blockquote>" . $language['Cat_is_for_sale'] . "</blockquote></center><br>"; $a=0; $_SESSION['a'] = $a;}
if ($a==4) {echo $text = "<center><blockquote>" . $language['Removed_the_cat_from_sale'] . "</blockquote></center><br>"; $a=0; $_SESSION['a'] = $a;}
if ($a==5) {echo $text = "<center><blockquote>" . $language['From_the_egg_hatched_a_kitty'] . "</blockquote></center><br>"; $a=0; $_SESSION['a'] = $a;}
if ($a==6) {echo $text = "<center><blockquote>" . $language['There_are_not_enough_funds_on_your_balance'] . "</blockquote></center><br>"; $a=0; $_SESSION['a'] = $a;}
if ($a==7) {echo $text = "<center><blockquote>" . $language['Operation_is_not_possible'] . "</blockquote></center><br>"; $a=0; $_SESSION['a'] = $a;}
if ($a==8) {echo $text = "<center><blockquote>Before starting the game, do not forget to <a href='".$site."wallet'>save your mnemonic phrase.</a><br>It will replace your login and password to enter the game. </blockquote></center><br>"; $a=0; $_SESSION['a'] = $a;}

$key = $_GET['key'];
if ($_GET['key']=='')
{
	$key=1;
}//коты
if (isset($_GET['submit']))
{
	$key=2;
}//яйца
if (isset($_GET['submit2']))
{
	$key=1;
}
if ($key == 2)
{
	$results = $db_cats->query('SELECT * FROM "table" WHERE addr="' . $address . '" AND img>"9000"');
}
if ($key == 1)
{
	$results = $db_cats->query('SELECT * FROM "table" WHERE addr="'.$address.'"');
}

$payloads1 = array();
while ($res = $results->fetchArray(1)){array_push($payloads1, $res);}
$result = (count($payloads1)-1);

$countq = ceil(($result+1)/12);
if ($countq != 0) {
echo '<div class="cat_content_none"><div class="cat_content">';
$id = $_GET['id'];
if ($id==''){$id=1;}
$q = ($id-1)*12; if ($q<0){$q=0;}
$result=($id*12)-1;

$cats = $payloads4['cats'];

$ccount = (count($cats))-1;

for ($i = $q; $i <= $result; $i++)
{
	$pricebd = $payloads1[$i]['price'];
	$img = $payloads1[$i]['img'];
	$block = $payloads1[$i]['stored_id'];
	for ($y = 0; $y<=$ccount; $y++)
		{
			$catimg = $cats[$y]['img'];
			if ($catimg == $img)
				{
					$series = $cats[$y]['series'];
					$rarity = $cats[$y]['rarity'];
					$rarity = $rarity * 100;
					$price = $cats[$y]['price'];
					$name1 = $cats[$y]['name'];
					$count = $cats[$y]['count'];
					$gender = $cats[$y]['gender'];
				}
		}
	$name2 = $payloads1[$i]['name'];
	if (($name2 != '') and ($name2 != null)) {$name = $name2;} else {$name = $name1;}
	if ($pricebd == '') {$bgimg = ''; $prr = $price;} else {$bgimg = '<font color="red"><b>(Продается)</b></font>'; $prr = "<font color='red'><b>$pricebd</b></font>";}
		if ($gender == '0') {$gender = '';}

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
				echo "
					<div class='cat_block' style='background: $u'>
						<div class='cat_img'>
							<a href='".$site."cat?id=$block'>
								<picture>
									<source srcset='../img/Cat$img.webp' type='image/webp'>
									<img src='../png.php?png=$img'>
								</picture>
							</a>
						</div>
						<div class='cat_text'>
							#$block $bgimg<br>
							<hr>
							$name $gender<br>
							$prr MINTERCAT<br>
						</div>
					</div>";
}
echo "</div></div>";
}
echo "<br><div class='cat_form'>";
if ($key == 2)
{
	echo "	
				<form>
				<input id='submit2' name='submit2' type='submit' value='" . $language['Cats'] . "'>
				<input id='key' name='key' type='hidden' value='$key'>
				</form>
				";
}
if ($key == 1)
{
	echo "	
				<form>
				<input id='submit' name='submit' type='submit' value='" . $language['Eggs'] . "'>
				<input id='key' name='key' type='hidden' value='$key'>
				</form>
				";
}

$ppm1 = $id - 1;
$ppm2 = $id - 2;
$ppp1 = $id + 1;
$ppp2 = $id + 2;
echo "
<ul class='pagination'>
	<li><a href='#'>$id " . $language['page_of'] . " $countq</a></li>
  <li><a href='?id=$ppm1&key=$key'>«</a></li>
  ";
  for ($p = 1; $p <= $countq; $p++)
  {
	  if (($p == $id) || ($p == $ppm1) || ($p == $ppm2) || ($p == $ppp1) || ($p == $ppp2)) {
	  echo "<li><a href='?id=$p&key=$key'>$p</a></li>";}
  }
echo "
<li><a href='?id=$ppp1&key=$key'>»</a></li>
</ul>
</div>
";