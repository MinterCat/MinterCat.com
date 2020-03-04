<?php
declare(strict_types=1);
require_once('../../config/minterapi/vendor/autoload.php');
use Minter\MinterAPI;
use Minter\SDK\MinterTx;
use Minter\SDK\MinterCoins\MinterMultiSendTx;

//-----------------------
$base = "../explorer/session.txt";
include('../explorer/online.php');
//-----------------------
$session_language = $_SESSION['session_language'];
include('../../config/config.php');
include('../function.php');

function getBlockByHash ($api,$hash)
{
    $api = new MinterAPI($api);
    return $api->getTransaction($hash);
}

function TransactoinSendDebug ($api,$transaction)
{
    $api = new MinterAPI($api);
    return $api->send($transaction);
}

$api_node = new MinterAPI($api2);

$cript_mnemonic = $_SESSION['cript_mnemonic'];
if ($cript_mnemonic != '') {
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];
$private_key = $decript['private_key'];

$db_cats = new Cats();
$db_rss = new RSS();
$db_users = new Users();

$result = $db_users->query('SELECT * FROM "table" WHERE address="'.$address.'"');
$data = $result->fetchArray(1);

$nick = $data['nick'];
$check_language = $data['language'];
if ($check_language != '')
	{$lang = $check_language;}
else
	{
		if ($session_language != '') {$lang = $session_language;} else {$lang = 'English';}
	}
$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$lang.json");
$language = json_decode($jsonlanguage,true);

$nonce = $api_node->getNonce($address);
$response = $api_node->getBalance($address);
$balance = intval(($response->result->balance->$coin)/10**18);
if ($balance == '') {$balance = 0;}
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}else{header('Location: '.$site.'exit.php'); exit;}
echo "
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <title>MinterCat | $nick</title>
  <link rel='shortcut icon' href='".$site."static/img/icons/Cats.webp'>
  <link rel='stylesheet' href='".$site."static/css/styles.min.css'>
  <link rel='stylesheet' href='".$site."static/css/style_header.css'>
  <link rel='stylesheet' href='".$site."static/css/style_menu.css'>
  <link rel='stylesheet' href='".$site."static/css/pagination.css'>
  <link rel='stylesheet' href='".$site."static/css/lk.css'>

  <link rel='stylesheet' href='".$site."static/css/normalize.css'>

  <link rel='stylesheet' href='".$site."static/css/dragndrop_main.css'>
  <link rel='stylesheet' href='".$site."static/css/dragndrop_scale.css'>
  <script src='".$site."static/js/dragndrop/ba3a0add07.js' crossorigin='anonymous'></script>
  <script src='".$site."static/js/dragndrop/jquery-3.4.1.min.js'></script>
  <script src='".$site."static/js/dragndrop/jquery-ui.min.js'></script>
  <script src='".$site."static/js/dragndrop/popper.min.js'></script>
  <script src='".$site."static/js/dragndrop/tippy-bundle.iife.min.js'></script>
  <script src='".$site."static/js/dragndrop/jquery.ui.touch-punch.min.js'></script>

  <link rel='stylesheet' href='".$site."static/css/slider_style.css'>
  <script src='".$site."static/js/slider_jquery-1.12.4.js'></script>
  <script src='".$site."static/js/slider_jquery-ui.js'></script>
  <script src='".$site."static/js/slider_jquery.ui.touch-punch.min.js'></script>

  <link rel='stylesheet' href='".$site."static/css/social.css'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body>
  <div class='cat_header'>

	<div class='header'>
		<div class='logo_float'>
			<div class='logo_cat'>
				<a href='#'>
					<div class='logo__img'></div>
					<span class='logo__text'><div class='logo_text'>Minter</div>
					<span class='logo__text-dark'><div class='logo_text_2'>Cat</div></span></span>
				</a>
			</div>
			<div class='head_menu'>
";
$m = 2; include('../menu.php');
echo "$menu
			</div>
		</div>
	</div>

<center><blockquote>
Balance: ".$balance." ".$coin."
</blockquote></center>

      <form method='post'>
        <div class='drop-areas'>
          <div class='drop-area-container'>
            <div class='drop-area' id='drop-area-1'>
              <h1 class='gender-logo'>♀</h1>
            </div>
            <input type='text' class='drop-area-info' id='drop-area-1-input' name='cat-1' value='' required disabled>
          </div>
          <div class='heart'>
            <button type='submit' class='heart-button' id='heart-btn' name='button' data-tippy-content='Отлично! Нажми сюда, чтобы скрестить!' disabled>
            <i class='fas fa-heart'></i></button>
          </div>
          <div class='drop-area-container'>
            <div class='drop-area' id='drop-area-2'>
              <h1 class='gender-logo'>♂</h1>
            </div>
            <input type='text' class='drop-area-info' id='drop-area-2-input' name='cat-2' value='' required disabled>
          </div>
        </div>
      </form>
		";


$json4 = file_get_contents($site.'api');
$payloads4 = json_decode($json4,true);

$results = $db_cats->query('SELECT * FROM "table" WHERE addr="'.$address.'"');
$payloads1 = array();
while ($res = $results->fetchArray(1)){array_push($payloads1, $res);}
$result = (count($payloads1)-1);

$countq = ceil(($result+1)/12);
if ($countq != 0) {
echo '<div class="cats_div"><div class="cat_content">';
$id = $_POST['id'];
if ($id==''){$id=1;}
$q = ($id-1)*12; if ($q<0){$q=0;}
$result=($id*12)-1;

$cats = $payloads4['cats'];

$ccount = (count($cats))-1;


for ($i = $q; $i <= $result; $i++)
{
	$img = $payloads1[$i]['img'];
	$block = $payloads1[$i]['stored_id'];
	for ($y = 0; $y<=$ccount; $y++)
		{
			$catimg = $cats[$y]['img'];
			if ($catimg == $img)
				{
					$series = $cats[$y]['series'];
					$rarity = ($cats[$y]['rarity'])*100;
					$name1 = $cats[$y]['name'];
					$count = $cats[$y]['count'];
					$gender = $cats[$y]['gender'];
				}
		}
		if ($gender == '♀') {$gender_number = 1;}
		if ($gender == '♂') {$gender_number = 0;}
	$name2 = $payloads1[$i]['name'];
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
		if ($gender != '') {
				echo "
					<div class='cat_block' style='background: $u'>
						<div class='cat_img' data-id='$block' data-gender='$gender_number'>
								<picture>
									<source srcset='".$site."static/img/Cat$img.webp' type='image/webp'>
									<img src='".$site."png.php?png=$img'>
								</picture>
						</div>
						<div class='cat_text'>
							#$block $bgimg<br>
							<hr>
							$name $gender<br>
						</div>
					</div>";

		}}
echo "</div></div>";
}
echo "<br><div class='cat_form'>";

$idm1 = $id - 1;
$idm2 = $id - 2;
$idp1 = $id + 1;
$idp2 = $id + 2;

echo "
<br>
<div class='pagination' style='background-color: #9584de'>
<a href='#' style='color: white'>$id " . $language['page_of'] . " $countq</a>
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
';

echo "
<script type='text/javascript'>
  var tooltip = tippy(document.getElementById('heart-btn'));
  var droppedMale;
  var droppedFemale;
  var draggableItems = document.getElementsByClassName('cat_img');
  for (var i = 0; i < draggableItems.length; i++) {
    $(draggableItems[i]).draggable();
  }
  $('#drop-area-1').droppable({
    drop: function(event, ui) {
      let droppedItem = ui.draggable[0];
      if ($(droppedItem).attr('data-gender') != '1') {
          droppedItem.style.cssText = 'position: relative; left: 0px; top: 0px;'
      } else {
          if (droppedMale && droppedMale != droppedItem) {
            droppedMale.style.cssText = 'position: relative; left: 0px; top: 0px;'
          }
          droppedMale = droppedItem;
          $('#drop-area-1-input').val($(droppedItem).attr('data-id'));
      }
      showToolTip();
    }
  });
  $('#drop-area-2').droppable({
    drop: function(event, ui) {
      let droppedItem = ui.draggable[0];
      if ($(droppedItem).attr('data-gender') != '0') {
          droppedItem.style.cssText = 'position: relative; left: 0px; top: 0px;'
      } else {
          if (droppedFemale && droppedFemale != droppedItem) {
            droppedFemale.style.cssText = 'position: relative; left: 0px; top: 0px;'
          }
          droppedFemale = droppedItem;
          $('#drop-area-2-input').val($(droppedItem).attr('data-id'));
      }
      if (droppedMale && droppedFemale) {
        $('#heart-btn').attr('disabled', false);
      }
      showToolTip();
    }
  });

  function showToolTip() {
    if (droppedMale && droppedFemale) {
      $('#heart-btn').attr('disabled', false);
      tooltip.show();
    }
  }
</script>
";
//-------------------------------
include('../footer.php');
