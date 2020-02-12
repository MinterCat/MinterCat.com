<?php
echo '
<link rel="stylesheet" href="../css/pagination.css">
<link rel="stylesheet" href="../css/style6.css">
<link rel="stylesheet" href="../css/lk.css">
';

include('../function.php');
$json_api = JSON($site.'api');

echo "<center>	
				<form>
				<p>" . $language['Sort'] . ":</p>
				<input id='submit5' name='submit5' type='submit' value='My cats'>
				<input id='submit' name='submit' type='submit' value='" . $language['The_cheapest'] . "'>
				<input id='submit2' name='submit2' type='submit' value='" . $language['Most_expensive'] . "'>
				<input id='submit3' name='submit3' type='submit' value='" . $language['The_oldest'] . "'>
				<input id='submit4' name='submit4' type='submit' value='" . $language['on_breeds'] . "'>
				</form>
		</center>
				";	

$key = $_GET['key'];
$id = $_GET['id'];
$select = $_GET['select'];
$ttt = '';
if ($_GET['key']=='')
{if ($select=='') {$key=1;}else{if ($select=='On breeds') {$key=5;}else{$key=6;}}}
if (isset($_GET['submit2']))
{$key=2;}
if (isset($_GET['submit3']))
{$key=3;}
if (isset($_GET['submit']))
{$key=1;}
if (isset($_GET['submit4']))
{$key=4;}
if ((isset($_GET['submit5'])) or ($select=='On breeds'))
	{
		$key=5;
		$ttt = '
		<center><br>
		<form>
		<select name="select">
			<option selected id="submit5" name="submit5">On breeds</option>
			<option id="submit6" name="submit6">The cheapest</option>
		</select>
		<input type="submit" value="Ok">
		</form>
		</center>
		';
	}
if ((isset($_GET['submit6'])) or ($select=='The cheapest'))
	{
		$key=6;
		$ttt = '
		<center><br>
		<form>
		<select name="select">
			<option id="submit5" name="submit5">On breeds</option>
			<option selected id="submit6" name="submit6">The cheapest</option>
		</select>
		<input type="submit" value="Ok">
		</form>
		</center>
		';
	}
echo $ttt;

$db_cats = new Cats();
//-------------------------------
	if ($key == 1) 
	{
			$results = $db_cats->query('SELECT price,
			stored_id,
			addr,
			sale,
			img FROM "table" WHERE sale="1" ORDER BY price');
	}
//-------------------------------
	if ($key == 2) 
	{
			$results = $db_cats->query('SELECT price,
			stored_id,
			addr,
			sale,
			img FROM "table" WHERE sale="1" ORDER BY price DESC');
	}
//-------------------------------
	if ($key == 3) 
	{
			$results = $db_cats->query('SELECT stored_id,
			price,
			addr,
			sale,
			img FROM "table" WHERE sale="1"');
	}
//-------------------------------
	if ($key == 4) 
	{
			$results = $db_cats->query('SELECT price,
			img,
			stored_id,
			addr,
			sale FROM "table" WHERE sale="1" ORDER BY img, price');
	}
//-------------------------------
	if ($key == 5) 
	{
			$results = $db_cats->query('SELECT id,
			stored_id,
			addr,
			sale,
			price,
			img FROM "table" WHERE sale="1" AND addr="' . $addr . '" ORDER BY img, price');
	}
//-------------------------------
	if ($key == 6) 
	{
			$results = $db_cats->query('SELECT id,
			stored_id,
			addr,
			sale,
			price,
			img FROM "table" WHERE sale="1" AND addr="' . $addr . '" ORDER BY price');
	}
//-------------------------------
$data = array();
while ($res = $results->fetchArray(1)){array_push($data, $res);}
$payloads = json_encode($data);
$result = (count($payloads)-1);
$countq = ceil(($result+1)/12);
echo '<div class="cat_content_none"><div class="cat_content">';
if ($id==""){$id=1;}
$q = ($id-1)*12; if ($q<0){$q=0;}
$result=($id*12)-1;
for ($i = $q; $i <= $result; $i++)
{
		$pricebd = $payloads[$i]['price'];
		$img = $payloads[$i]['img'];
		$id = $payloads[$i]['stored_id'];
		$addr = $payloads[$i]['addr'];
		if ($addr == $address) {$bgimg = '<font color="red"><b>(Ваш)</b></font>';} else {$bgimg = '';}
		
		$cats = $json_api->cats;
		$ccount = (count($cats))-1;
		for ($y = 0; $y<=$ccount;$y++)
			{
				$catimg = $cats[$y]['img'];
				if ($catimg == $img)
					{
						$series = $cats[$y]['series'];
						$rarity = $cats[$y]['rarity'];
						$rarity = $rarity * 100;
						$name1 = $cats[$y]['name'];
						$count = $cats[$y]['count'];
						$gender = $cats[$y]['gender'];
					
					}
			}
$name2 = $payloads[$i]['name'];
if (($name2 != '') and ($name2 != null)) {$name = $name2;} else {$name = $name1;}
if ($cats != '') {
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
			<a href='cat?id=$id'>
				<picture>
					<source srcset='../img/Cat$img.webp' type='image/webp'>
					<img src='../png.php?png=$img'>
				</picture>
			</a>
		</div>
		<div class='cat_text'>
			#$id $bgimg<br>
			$name $gender
			<hr>
			$pricebd $coin
		</div>
	</div>";
}
}
echo "</div></div><div class='cat_form'>";
$idm1 = $id - 1;
$idm2 = $id - 2;
$idp1 = $id + 1;
$idp2 = $id + 2;
echo "
<ul class='pagination'>
	<li><a href='#'>$id " . $language['page_of'] . " $countq</a></li>
  <li><a href='?id=$idm1&key=$key'>«</a></li>
  ";
  for ($p = 1; $p <= $countq; $p++)
  {
	  if (($p == $id) || ($p == $idm1) || ($p == $idm2) || ($p == $idp1) || ($p == $idp2)) {
	  echo "<li><a href='?id=$p&key=$key'>$p</a></li>";}
  }
echo "
  <li><a href='?id=$idp1&key=$key'>»</a></li>
</ul>
</div>
";