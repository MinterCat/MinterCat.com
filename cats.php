<?php
echo '<link rel="stylesheet" href="'.$site.'css/lk.css">';
$json4 = file_get_contents($site.'api');
$payloads4 = json_decode($json4,true);
$count4 = $payloads4['count'];
$cats = $payloads4['cats'];
echo "<center><h4>" . $language['Total_number_of_cats'] . " $count4</h4></center>";
$result = count($cats);
$countq = ceil(($result)/12);
echo '<div class="cat_content_none"><div class="cat_content">';

$id = $_POST['id'];
if ($id==''){$id=1;}
$q = ($id-1)*12; if ($q<0){$q=0;}
$result=($id*12)-1;
for ($y = $q; $y <= $result; $y++)
{
	$series = $cats[$y]['series'];
	$rarity = $cats[$y]['rarity'];
	$rarity = $rarity * 100;
	$price = $cats[$y]['price'];
	$name = $cats[$y]['name'];
	$count = $cats[$y]['count'];
	$img = $cats[$y]['img'];
	$gender = $cats[$y]['gender'];
										
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

if ($img != '') {
if ($gender == 0) {$gender='';}

echo "
	<div class='cat_block' style='background: $u'>
		<div class='cat_img'>
			<picture>
			<source srcset='".$site."img/Cat$img.webp' type='image/webp'>
			<img src='".$site."png.php?png=$img'>
			</picture>
		</div>
		<div class='cat_text'>
			<b>$name</b> $gender
			<hr>
			" . $language['Number_of_cats_of_this_breed'] . " <b>$count</b><br>
			" . $language['Chance_of_falling_out'] . ": <b>$rarity%</b><br>
			<b>$price</b> $coin
			<br>
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
<br>
<div class='pagination' style='background-color: #9584de'>
<a href='#'>$id " . $language['page_of'] . " $countq</a>
</div>
";
echo '
<div class="pagination">
<form method="post">
<a href="#" onclick="parentNode.submit();">«</a>
<input name="id" type="hidden" value="'.$idm1.'">
</form>
</div>
';
  for ($p = 1; $p <= $countq; $p++)
  {
	  if (($p == $id) || ($p == $idm1) || ($p == $idm2) || ($p == $idp1) || ($p == $idp2)) {
		echo '
		<div class="pagination">
		<form method="post">
		<a href="#" onclick="parentNode.submit();">'.$p.'</a>
		<input name="id" type="hidden" value="'.$p.'">
		</form>
		</div>
		';
	  }
  }
echo '
<div class="pagination">
<form method="post">
<a href="#" onclick="parentNode.submit();">»</a>
<input name="id" type="hidden" value="'.$idp1.'">
</form>
</div>
</div>
<br><br><br><br>
';