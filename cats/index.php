<?php
ob_start();
//========================================
include('../../config/config.php');
include('../function.php');
//-----------------------
$base = "../explorer/session.txt";
include('../explorer/online.php');
//-----------------------
$session_language = $_SESSION['session_language'];
$cript_mnemonic = $_SESSION['cript_mnemonic'];
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];

$db_users = new Users();

$data = $db_users->query('SELECT * FROM "table" WHERE address="'.$address.'"')->fetchArray(1);
$check_language = $data['language'];

if ($check_language != '') {$lang = $check_language;}
elseif ($session_language != '') {$lang = $session_language;} else {$lang = 'English';}

$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$lang.json");
$language = json_decode($jsonlanguage,true);
//========================================
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo "<title>MinterCat | Explorer</title>";
$titles = 'Explorer';
$m = 6; include('../menu.php');
//-------------------------------
include('../header2.php');
//-------------------------------
$json4 = file_get_contents($site.'api');
$payloads4 = json_decode($json4,true);
$cats = $payloads4['cats'];
$result = (count($cats)-1);
$countq = ceil(($result+1)/12);

foreach ($cats as $value => $kity) {
	$value++;
	if ($value == 1) {
	$id = 1;
	echo '<div class="cat_content_none"><div class="cat_content" id="page-'.$id.'">';
	}
	//-------------------------------------------------

	$series = $kity['series'];
	$rarity = ($kity['rarity'])*100;
	$price = $kity['price'];
	$name = $kity['name'];
	$count = $kity['count'];
	$img = $kity['img'];
	$gender = $kity['gender'];


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
			<picture>
			<source srcset='".$site."static/img/Cat$img.webp' type='image/webp'>
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
   //-------------------------------------------------
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