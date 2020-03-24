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

function getBlockByHash ($api2,$hash)
{
    $api = new MinterAPI($api2);
    return $api->getTransaction($hash);
}

function TransactoinSendDebug ($api2,$transaction)
{
    $api = new MinterAPI($api2);
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

$data = $db_users->query('SELECT * FROM "table" WHERE address="'.$address.'"')->fetchArray(1);

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
            <input type='text' class='drop-area-info' id='drop-area-1-input' name='cat-1' value='' readonly='readonly' required style='border: none;'>
          </div>
          <div class='heart'>
            <button type='submit' class='heart-button' id='heart-btn' name='button' data-tippy-content='Отлично! Нажми сюда, чтобы скрестить!' disabled style='border: none;'>
            <i class='fas fa-heart'></i></button>
          </div>
          <div class='drop-area-container'>
            <div class='drop-area' id='drop-area-2'>
              <h1 class='gender-logo'>♂</h1>
            </div>
            <input type='text' class='drop-area-info' id='drop-area-2-input' name='cat-2' value='' readonly='readonly' required style='border: none;'>
          </div>
        </div>
	<div class='calс_tab calс_tab_1'>
		<div class='calс_tab_p_1'>
			<div class='calс_tab_p_txt'>" . $language['Number_of_hours_for_egg_maturation'] . "</div>
			<div class='calс_tab_p_input'><input id='kolvo' name='kolvo' type='text' class='calс_tab_p_input_val calc_1_val_type_1' value='1' style='border: none;' readonly='readonly' required></div>
		</div>
		<div class='calс_tab_p_2'>
			<div class='calс_tab_slider' data-min='0' data-val='24' data-step='1' data-max='24'></div>
			<div class='calс_tab_slider_grad'>
				<div class='calс_tab_slider_num calс_tab_slider_num_1'>240 MINTERCAT</div>
				<div class='calс_tab_slider_num calс_tab_slider_num_25'>180 MINTERCAT</div>
				<div class='calс_tab_slider_num calс_tab_slider_num_50'>120 MINTERCAT</div>
				<div class='calс_tab_slider_num calс_tab_slider_num_75'>60 MINTERCAT</div>
				<div class='calс_tab_slider_num calс_tab_slider_num_100'>1 MINTERCAT</div>
			</div>
		</div>
	</div>
</div>
<script type='text/javascript'>
(function($){
$(document).ready(function(){
	$('.calс_tab_slider').each(function(){
		var insert_val=$(this).closest('.calс_tab').find('.calс_tab_p_input_val');
		var curr_slide=$(this).slider({
			min:parseInt($(this).attr('data-min')),
			max:parseInt($(this).attr('data-max')),
			step:parseFloat($(this).attr('data-step')),
			value:parseInt($(this).attr('data-val')),
			stop: function(event, ui) {
				insert_val.val(curr_slide.slider('value'));
			},
			slide: function(event, ui){
				setTimeout(function(){
					insert_val.val(curr_slide.slider('value'));
				},30);
			}
		});
		insert_val.on('change',function(){
			var this_val=$(this).val();
			var tmp_1=curr_slide.slider('value');
			var tmp_2=this_val;
			if(tmp_1!=tmp_2){
				curr_slide.slider('value',tmp_2);
			}
		});
		insert_val.val($(this).attr('data-val')).trigger('change');
	});
});
})(jQuery);
</script>
	  </form>
		";

$json4 = file_get_contents($site.'api');
$payloads4 = json_decode($json4,true);

$cats = $payloads4['cats'];
$ccount = (count($cats))-1;

$results = $db_cats->query('SELECT * FROM "table" WHERE addr="'.$address.'"');
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
					$price = $cats[$y]['price'];
					$name1 = $cats[$y]['name'];
					$count = $cats[$y]['count'];
					$gender = $cats[$y]['gender'];
				}
		}
		if ($gender == '♀') {$gender_number = 1;}
		if ($gender == '♂') {$gender_number = 0;}
	$name2 = $kity['name'];
	if (($name2 != '') and ($name2 != null)) {$name = $name2;} else {$name = $name1;}

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
		if ($gender != '0') {
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


if (isset($_POST['button']))
	{
		$id1 = $_POST['cat-1'];
		$id2 = $_POST['cat-2'];

		if ($id1 == $id2)
			{
				$a=7; $_SESSION['a'] = $a;
				header('Location: '.$site.'profile');
				exit;
			}
		else
			{
				$json_block = JSON($api.'/status');
				$block = $json_block->result->latest_block_height;
				$block = $block+1;

				$data_gen1 = $db_cats->query('SELECT * FROM "gen" WHERE stored_id=' . $id1)->fetchArray(1);
				$ok1 = $data_gen1['block'];

				$data_gen2 = $db_cats->query('SELECT * FROM "gen" WHERE stored_id=' . $id2)->fetchArray(1);
				$ok2 = $data_gen2['block'];

				if ((($block >= $ok1) or ($ok1 == '')) and (($block >= $ok2) or ($ok2 == '')))
					{
$data = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id1)->fetchArray(1);
$addr1 = $data['addr'];
$hash_addr1 = $data['hash'];

$data = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id2)->fetchArray(1);
$addr2 = $data['addr'];
$hash_addr2 = $data['hash'];

if (($addr1 == $address) and ($addr2 == $address)) {
//------------------------------------------------------------
$fishtail1 = $data_gen1['fishtail'];
$tentacles1 = $data_gen1['tentacles'];
$horns1 = $data_gen1['horns'];
//------------------------------------------------------------
$fishtail2 = $data_gen2['fishtail'];
$tentacles2 = $data_gen2['tentacles'];
$horns2 = $data_gen2['horns'];
//------------------------------------------------------------
	if (($fishtail1 >= 1) and ($fishtail2 >= 1)) {$goldengen = 2;} else {$goldengen = 1;}
	if (($tentacles1 >= 1) and ($tentacles2 >= 1)) {$goldengen = 2;} else {$goldengen = 1;}
	if (($horns1 >= 1) and ($horns2 >= 1)) {$goldengen = 2;} else {$goldengen = 1;}
//------------------------------------------------------------

	$fish = floor(($fishtail1 + $fishtail2)*3/4); if (($fish>0) and ($fish<=1)) {$fish=1;} if ($fish>=30) {$fish=30;}
	$tentacl = floor(($tentacles1 + $tentacles2)*3/4); if (($tentacl>0) and ($tentacl<=1)) {$tentacl=1;} if ($tentacl>=30) {$tentacl=30;}
	$horn = floor(($horns1 + $horns2)*3/4); if (($horn>0) and ($horn<=1)) {$horn=1;} if ($horn>=30) {$horn=30;}
//------------------------------------------------------------
		$kolvo = $_POST['kolvo'];
		$blockq = $block + (720*$kolvo);

$komsa = 240 - ($kolvo * 10);

if ($balance > $komsa)
	{
		$img = rand(9990,9999);
		$data = $db_cats->query('SELECT id FROM "table" WHERE id = "'.$block.'"')->fetchArray(1);

		if ($data)
			{
				$a=7; $_SESSION['a'] = $a;
				header('Location: '.$site.'profile');
				exit;
			}

		$stored = array($id1,$id2,$block);
		for ($i = 0; $i <= 2; $i++)
		{
			$stored_id = $stored[$i];
			$data = $db_cats->query('SELECT stored_id FROM "table" WHERE stored_id="'.$stored_id.'"')->fetchArray(1);

			if ($data)
				{
					$db_cats->query('UPDATE "table" SET stored = "'.$blockq.'" WHERE stored_id = "'.$stored_id.'"');
				}
		}

		$db_cats->query('CREATE TABLE IF NOT EXISTS "gen" (
			"id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			"stored_id" INTEGER,
			"fishtail" INTEGER,
			"tentacles" INTEGER,
			"horns" INTEGER
		)');

		$db_cats->exec('INSERT INTO "gen" ("stored_id", "fishtail", "tentacles", "horns")
			VALUES ("'.$block.'", "'.$fish.'", "'.$tentacl.'", "'.$horn.'")');


		$text = '{"type":3,"img":'.$img.',"mom":"'.$hash_addr1.'","dad":"'.$hash_addr2.'"}';

		$fond = $komsa/2; //50% in found MinterCat
		$me = $fond/2; //25%
		$kamil = $fond/2; //25%

		$api_node = new MinterAPI($api3);

				if ($test != 'testnet')
					{
						$tx = new MinterTx([
									'nonce' => $api_node->getNonce($address),
									'chainId' => MinterTx::MAINNET_CHAIN_ID,
									'gasPrice' => 1,
									'gasCoin' => $coin,
									'type' => MinterMultiSendTx::TYPE,
									'data' => [
										'list' => [
											[
												'coin' => $coin,
												'to' => 'Mxaa9a68f11241eb18deff762eac316e2ccac22a03',
												'value' => $me
											], [
												'coin' => $coin,
												'to' => 'Mxf7c5a1a3f174a1c15f4671c1651d42377351b5b5',
												'value' => $kamil
											],	[
												'coin' => $coin,
												'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
												'value' => $fond
											]
										]
									],
									'payload' => $text,
									'serviceData' => '',
									'signatureType' => MinterTx::SIGNATURE_SINGLE_TYPE
								]);
					}
				else
					{
						$tx = new MinterTx([
									'nonce' => $api_node->getNonce($address),
									'chainId' => MinterTx::TESTNET_CHAIN_ID,
									'gasPrice' => 1,
									'gasCoin' => $coin,
									'type' => MinterMultiSendTx::TYPE,
									'data' => [
										'list' => [
											[
												'coin' => $coin,
												'to' => 'Mxaa9a68f11241eb18deff762eac316e2ccac22a03',
												'value' => $me
											], [
												'coin' => $coin,
												'to' => 'Mxf7c5a1a3f174a1c15f4671c1651d42377351b5b5',
												'value' => $kamil
											],	[
												'coin' => $coin,
												'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
												'value' => $fond
											]
										]
									],
									'payload' => $text,
									'serviceData' => '',
									'signatureType' => MinterTx::SIGNATURE_SINGLE_TYPE
								]);
					}

				$transaction = $tx->sign($private_key);
				$get_hesh = TransactoinSendDebug($api2,$transaction);
				$hash = "0x".$get_hesh->result->hash;
				sleep(6);
				$block = getBlockByHash($api2,$hash)->result->height;
				//------------------------------
				$db_cats->exec('CREATE TABLE IF NOT EXISTS "table" (
					"id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
					"stored_id" INTEGER,
					"addr" VARCHAR,
					"img" INTEGER,
					"price" INTEGER,
					"sale" INTEGER,
					"name" VARCHAR,
					"hash" VARCHAR,
					"stored" INTEGER
						)');
				$db_cats->exec('INSERT INTO "table" ("stored_id", "addr", "img", "price", "sale", "name", "hash", "stored")
					VALUES ("'.$block.'", "'.$address.'", "'.$img.'", "0", "0", "","'.$hash.'", "'.$stored_id.'")');

				$a=9; $_SESSION['a'] = $a;
				//------------------------------
				header('Location: '.$site.'profile'); exit;
	}
else
	{
		$a=6; $_SESSION['a'] = $a;
		header('Location: '.$site.'profile');
		exit;
	}
}
else
{
	$a=7; $_SESSION['a'] = $a;
	header('Location: '.$site.'profile');
	exit;
}
	}
	else
	{
	$a=7; $_SESSION['a'] = $a;
	header('Location: '.$site.'profile');
	exit;
}
	}}
