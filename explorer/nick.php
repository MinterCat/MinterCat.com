<?php
echo '<link rel="stylesheet" href="'.$site.'css/lk.css">';
$results = $db_users->query('SELECT * FROM "table" WHERE nick="' . $nick . '"');
$data = array();
while ($res = $results->fetchArray(1)){array_push($data, $res);}

$address = $data[0]['address'];
$get = file_get_contents($site."api/cats?addr=$address");
$payloads1 = json_decode($get,true);
echo "<center><h2><b>$nick</b></h2></center><hr>";

$json4 = file_get_contents($site.'api');
$payloads4 = json_decode($json4,true);

$result = (count($payloads1)-1);
$countq = ceil(($result+1)/12);
if ($countq != 0)
{
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
	for ($y = 0; $y<=$ccount;$y++)
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
							$prr $coin<br>
						</div>
					</div>";
}
echo "</div></div>";
}
echo "<div class='cat_form'>";

$idm1 = $id - 1;
$idm2 = $id - 2;
$idp1 = $id + 1;
$idp2 = $id + 2;
echo "
<ul class='pagination'>
	<li><a href='#'>$id " . $language['page_of'] . " $countq</a></li>
  <li><a href='?nick=$nick&id=$idm1'>«</a></li>
  ";
  for ($p = 1; $p <= $countq; $p++)
  {
	  if (($p == $id) || ($p == $idm1) || ($p == $idm2) || ($p == $idp1) || ($p == $idp2)) {
	  echo "<li><a href='?nick=$nick&id=$p'>$p</a></li>";}
  }
echo "
<li><a href='?nick=$nick&id=$idp1'>»</a></li>
</ul>
</div>
";