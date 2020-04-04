<?php
include('../header.php');
//-------------------------------
$json4 = file_get_contents($site.'api');
$payloads4 = json_decode($json4,true);

$cats = $payloads4['cats'];
$ccount = (count($cats))-1;

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
if ($a==9) {echo $text = "<center><blockquote>Done!</blockquote></center><br>"; $a=0; $_SESSION['a'] = $a;}


$key = $_POST['key'];
if ($key == 2)
{
	$results = $db_cats->query('SELECT * FROM "table" WHERE addr="' . $address . '" AND img>"9000"');
}
else
{
	$key = 1;
	$results = $db_cats->query('SELECT * FROM "table" WHERE addr="'.$address.'"');
}

$payloads1 = array();
while ($res = $results->fetchArray(1)){array_push($payloads1, $res);}
$result = (count($payloads1)-1);
$countq = ceil(($result+1)/12);
if ($countq != 0) {

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
							<hr>
							$name $gender<br>
							$prr $coin<br>
						</div>
					</div>";

		}
   //-------------------------------------------------
if ($value % 12 == 0) {
	echo "</div></div>";
	$id++;
	echo '<div class="cat_content_none"><div class="cat_content" id="page-'.$id.'" style="display: none;">';
	}
}
echo "</div></div>";
}
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