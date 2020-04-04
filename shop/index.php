<?php
include('../header.php');
//-------------------------------
$json4 = file_get_contents($site.'api');
$payloads4 = json_decode($json4,true);
$cats = $payloads4['cats'];
$ccount = (count($cats))-1;

echo "<center>	
				<form method='post'>
				<p>" . $language['Sort'] . ":</p>
				<input id='key5' name='key5' type='submit' value='My cats'>
				<input id='key1' name='key1' type='submit' value='" . $language['The_cheapest'] . "'>
				<input id='key2' name='key2' type='submit' value='" . $language['Most_expensive'] . "'>
				<input id='key3' name='key3' type='submit' value='" . $language['The_oldest'] . "'>
				<input id='key4' name='key4' type='submit' value='" . $language['on_breeds'] . "'>
				</form>
		</center>";	

$key = $_POST['key'];
$select = $_POST['select'];
$ttt = '';
if ($key == '')
	{
		if (($select=='') or (isset($_POST['key1'])))
			{
				$key=1;
			}
		if ((isset($_POST['key5'])) or ($select=='On breeds'))
					{
						$key=5;
						$ttt = '
						<center><br>
						<form method="post">
						<select name="select">
							<option selected id="key5" name="key5">On breeds</option>
							<option id="key6" name="key6">The cheapest</option>
						</select>
						<input type="submit" value="Ok">
						</form>
						</center>
						';
					}
				if ((isset($_POST['key6'])) or ($select=='The cheapest'))
					{
						$key=6;
						$ttt = '
						<center><br>
						<form method="post">
						<select name="select">
							<option id="key5" name="key5">On breeds</option>
							<option selected id="key6" name="key6">The cheapest</option>
						</select>
						<input type="submit" value="Ok">
						</form>
						</center>
						';
					}
	}
if (isset($_POST['key2']))
{$key=2;}
if (isset($_POST['key3']))
{$key=3;}
if (isset($_POST['key4']))
{$key=4;}

echo $ttt;
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
			img FROM "table" WHERE sale="1" AND addr="' . $address . '" ORDER BY img, price');
	}
//-------------------------------
	if ($key == 6) 
	{
			$results = $db_cats->query('SELECT id,
			stored_id,
			addr,
			sale,
			price,
			img FROM "table" WHERE sale="1" AND addr="' . $address . '" ORDER BY price');
	}
//-------------------------------
$payloads1 = array();
while ($res = $results->fetchArray(1)){array_push($payloads1, $res);}
$result = (count($payloads1)-1);
$countq = ceil(($result+1)/12);
foreach ($payloads1 as $value => $kity) {
	$value++;
	if ($value == 1) {
	$id = 1;
	echo '<div class="cat_content_none"><div class="cat_content" id="page-'.$id.'">';
	}
	//-------------------------------------------------
	$pricebd = $kity['price'];
	$img = $kity['img'];
	$block = $kity['stored_id'];
	$addr = $kity['addr'];
	if ($addr == $address) {$bgimg = '<font color="red"><b>(Ваш)</b></font>';} else {$bgimg = '';}
	for ($y = 0; $y<=$ccount; $y++)
		{	
		$catimg = $cats[$y]['img'];
			if ($catimg == $img)
				{
					$series = $cats[$y]['series'];
					$rarity = ($cats[$y]['rarity'])*100;
					$price = $cats[$y]['value'];
					$name1 = $cats[$y]['name'];
					$count = $cats[$y]['count'];
					$gender = $cats[$y]['gender'];
				}
		}
$name2 = $kity['name'];
if (($name2 != '') and ($name2 != null)) {$name = $name2;} else {$name = $name1;}
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
if ($img != '') {
echo "
	<div class='cat_block' style='background: $u'>
		<div class='cat_img'>
			<a href='".$site."cat?id=$block'>
				<picture>
					<source srcset='".$site."static/img/Cat$img.webp' type='image/webp'>
					<img src='".$site."png.php?png=$img'>
				</picture>
			</a>
		</div>
		<div class='cat_text'>
			#$block $bgimg<br>
			$name $gender
			<hr>
			$pricebd $coin
		</div>
	</div>";
}//-------------------------------------------------
if ($value % 12 == 0) {
	echo "</div></div>";
	$id++;
	echo '<div class="cat_content_none"><div class="cat_content" id="page-'.$id.'" style="display: none;">';
	}
}
echo "</div></div>";

echo "<br><div class='cat_form'>
			<div class='pagination'>
				<button type='button' id='prev-page-btn' disabled>«</button>
				<div id='page-counter' style='display: inline-block'>
					1 ". $language['page_of'] ." ". $countq."
				</div>
				<button type='button' id='next-page-btn'>»</button>
			</div>
		</div>
		<br><br><br><br>
";
echo "
<script type='text/javascript'>
			var maxPage = ".$countq.";
			var currentPage = 1;

			$(document).ready(function() {
				console.log('hi');
				if (currentPage == maxPage) {
					$('#next-page-btn').prop('disabled', true);
				}
				$('#prev-page-btn').click(function() {
					$('#page-' + currentPage).hide();
					console.log(currentPage);
					currentPage--;
					if (currentPage < 1) currentPage = 1;
					$('#page-' + currentPage).show();

					$('#page-counter').html(currentPage + ' ". $language['page_of'] ." ' + maxPage);

					if (currentPage == 1) {
						$('#prev-page-btn').prop('disabled', true);
					}
					if (currentPage < maxPage) {
						$('#next-page-btn').prop('disabled', false);
					}
				});
				$('#next-page-btn').click(function() {
					$('#page-' + currentPage).hide();
					currentPage++;
					if (currentPage > maxPage) currentPage = maxPage;
					$('#page-' + currentPage).show();

					$('#page-counter').html(currentPage + ' ". $language['page_of'] ." ' + maxPage);

					if (currentPage == maxPage) {
						$('#next-page-btn').prop('disabled', true);
					}
					if (currentPage > 1) {
						$('#prev-page-btn').prop('disabled', false);
					}
				});
			})
		</script>
";
//-------------------------------
include('../footer.php');