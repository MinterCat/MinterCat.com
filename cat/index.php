<?php
declare(strict_types=1);
require_once('../../config/minterapi/vendor/autoload.php');
use Minter\MinterAPI;
use Minter\SDK\MinterTx;
use Minter\SDK\MinterCoins\MinterMultiSendTx;
//========================================
include('../../config/config.php');
include('../function.php');
//-----------------------
$base = "../explorer/session.txt";
include('../explorer/online.php');
//-----------------------
$session_language = $_SESSION['session_language'];
$cript_mnemonic = $_SESSION['cript_mnemonic'];

if ($cript_mnemonic != '') {
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];

$db_users = new Users();

$result = $db_users->query('SELECT * FROM "table" WHERE address="'.$address.'"');
$data = $result->fetchArray(1);
$check_language = $data['language'];
}
if ($check_language != '')
	{$lang = $check_language;}
else
	{
		if ($session_language != '') {$lang = $session_language;} else {$lang = 'English';}
	}

$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$lang.json");
$language = json_decode($jsonlanguage,true);
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//========================================
if ($address != '')
{
$api_node = new MinterAPI($api2);

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

$private_key = $decript['private_key'];

$db_cats = new Cats();
$db_rss = new RSS();

$nonce = $api_node->getNonce($address);
$response = $api_node->getBalance($address);
$balance = intval(($response->result->balance->$coin)/10**18);
if ($balance == '') {$balance = 0;}
$nick = $data['nick'];
//-------------------------------
echo "<title>MinterCat | $nick</title>";
$titles = '';
$m = 2; include('../menu.php');
include('../header3.php');
//-------------------------------
$id = $_GET['id'];
$result = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id);
$payloads1 = $result->fetchArray(1);

$check_id = $payloads1['id'];
$addr = $payloads1['addr'];

if ($address == '') {header('Location: '.$site.'profile'); exit;}

$hash = $payloads1['hash'];
$block = getBlockByHash($api2,$hash)->result->height;
$payload = getBlockByHash($api2,$hash)->result->payload;

$payload = base64_decode($payload);

$decode_payload_hash = json_decode($payload,true);
$TypeHash = $decode_payload_hash['type'];

$ImgHash = $decode_payload_hash['img'];

$json4 = file_get_contents($site.'api?img='.$ImgHash);
$payloads4 = json_decode($json4,true);

$pricebd = $payloads1['price'];

$cats = $payloads4['cats'];

$series = $cats[0]['series'];
$rarity = ($cats[0]['rarity'])*100;
$price = $cats[0]['price'];
$name1 = $cats[0]['name'];
$count = $cats[0]['count'];
$gender = $cats[0]['gender'];

$name2 = $payloads1['name'];
if (($name2 != '') or ($name2 != null)) {$name = $name2;} else {$name = $name1;}

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

$result2 = $db_cats->query('SELECT * FROM "gen" WHERE stored_id=' . $block);
$payloadsID = $result2->fetchArray(1);

$fishtail = $payloadsID['fishtail'];
$tentacles = $payloadsID['tentacles'];
$horns = $payloadsID['horns'];

$json_api = JSON($api3."/block?height=$block");
$data = $json_api->result->time;

$timestamp2 = date('Y-m-d',strtotime(explode('T', $data)[0]));

$unixD = strtotime($timestamp2);
$nd = date('d.m.Y', $unixD);

if ($gender == '♂') {
	$gender_p = $language['Male'] . " ($gender)";
}
if ($gender == '♀') {
	$gender_p = $language['Female'] . " ($gender)";
}
if ($gender == '0') {
	$gender_p = $language['Undefined'];
}
if ($pricebd == '') {$bgimg = ''; $pr = $price;} else {$bgimg = '<font color="red"><b>(Продается)</b></font>'; $pr = $pricebd;}
if($addr == $address){
echo "
<center>
	<div style='background: $u' width='100%' height='300'>
			<picture>
			<source srcset='".$site."static/img/Cat$ImgHash.webp' type='image/webp' width='350' height='350'>
			<img src='".$site."png.php?png=$ImgHash' width='350' height='350'>
			</picture><br>
	</div>
			#$block<br>
			<b>$name</b>
			<hr>
			" . $language['Cat_created'] . " <b>$nd</b>, " . $language['in_block'] . " <b>#$block</b> <br>
" . $language['Chance_of_falling_out'] . " <b>$rarity%</b><br>
" . $language['gender'] . ": $gender_p<br>
" . $language['Number_of_cats_of_this_breed'] . " <b>$count</b><br>
<br>
Hash create: $hash<br>
";

if ($pricebd != '') {echo "Price in shop: <b>$pr</b> $coin<br><br>";}
echo $language['Approximate_cost'] . " <b>$price</b> $coin<br><br>
";

if ($gender != '0')
{
if (isset($_POST['send2']))
	{
		echo "
		<form method='post'>
		<input id='nick' name='nick' type='text' value='' placeholder='NickName' maxlength='15' size='12'>
		<input id='send' name='send' type='submit' value='" . $language['Send'] . "'>
		<input id='img' name='img' type='hidden' value='" . $ImgHash . "'>
		<input id='hash' name='hash' type='hidden' value='" . $hash . "'>
		<input id='back' name='back' type='submit' value='" . $language['Cancel'] . "'>
		</form>
		";
	}
else
	{
		if (isset($_POST['sale']))
					{
						echo "
						<form method='post'>
						<p>
						<input id='price' name='price' type='number' value='".$_POST['price']."' placeholder='Price' maxlength='7' size='12'>
						<input id='sendprice' name='sendprice' type='submit' value='" . $language['Send'] . "'>
						<input id='img' name='img' type='hidden' value='" . $ImgHash . "'>
						<input id='hash' name='hash' type='hidden' value='" . $hash . "'>
						<input id='back' name='back' type='submit' value='" . $language['Cancel'] . "'>
						</p>
						</form>
						";
					}
				else
					{
						$sale = $payloads1['sale'];
						if ($sale == 1)
							{
								echo "
								<form method='post'>
								<input id='send2' name='send2' type='submit' value='" . $language['Send'] . "'>
								<input id='nosale' name='nosale' type='submit' value='" . $language['Not_sell'] . "'>
								<input id='hash' name='hash' type='hidden' value='" . $hash . "'>
								</form>
								";
							}
						else
							{
								echo "
								<form method='post'>
								<input id='send2' name='send2' type='submit' value='" . $language['Send'] . "'>
								<input id='sale' name='sale' type='submit' value='" . $language['Sell'] . "'>
								<input id='price' name='price' type='hidden' value='" . $price . "'>
								</form>
								";
							}
					}
	}
}elseif ($TypeHash == 0)
		{
			echo "
					<br>
					<form method='post'>
					<input id='in2' name='in2' type='submit' value='" . $language['Hatching_egg'] . "'>
					<input id='hash' name='hash' type='hidden' value='" . $hash . "'>
					</form>
					";
		}
	else
		{
			$json_api = JSON($api2 . 'status');
			$latestBlockHeight = $json_api->result->latest_block_height;
			$eggblock = $latestBlockHeight - $block;
			if ($eggblock >= 17280)
				{
					echo "
					<br>
					<form method='post'>
					<input id='in' name='in' type='submit' value='" . $language['Hatching_egg'] . "'>
					<input id='hash' name='hash' type='hidden' value='" . $hash . "'>
					</form>
					";
				}
		}

}else{
	$sale = $payloads1['sale'];
		echo "
<center>
	<div style='background: $u' width='100%' height='300'>
			<picture>
			<source srcset='".$site."static/img/Cat$ImgHash.webp' type='image/webp' width='350' height='350'>
			<img src='".$site."png.php?png=$ImgHash' width='350' height='350'>
			</picture><br>
	</div>
			#$block<br>
			$name $gender
			<hr>
			" . $language['Cat_created'] . " <b>$nd</b>, " . $language['in_block'] . " <b>#$block</b> <br>
" . $language['Chance_of_falling_out'] . " <b>$rarity%</b><br>
" . $language['gender'] . ": $gender_p<br>
" . $language['Number_of_cats_of_this_breed'] . " <b>$count</b><br>
<br>
Hash create: $hash<br>
" . $language['Approximate_cost'] . " <b>$pr</b> $coin<br><br>
";
if (($sale == 1)and($balance > $pricebd))
	{
		echo "
		<form method='post'>
			<input id='buy' name='buy' type='submit' value='" . $language['Buy'] . "'>
			<input id='price' name='price' type='hidden' value='" . $pricebd . "'>
			<input id='hash' name='hash' type='hidden' value='" . $hash . "'>
			<input id='img' name='img' type='hidden' value='" . $ImgHash . "'>
		</form>
		";
	}
}
//-----------------------------------
if (isset($_POST['sendprice']))
	{
		$price = $_POST['price'];
		$img = $_POST['img'];
		$hash = $_POST['hash'];
		$a=3; $_SESSION['a'] = $a;

		if ($price > 0)
			{
				$text = '{"type":4,"img":'.$img.',"hash":"'.$hash.'","price":'.$price.'}';

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
												'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
												'value' => 0
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
												'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
												'value' => 0
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
				
				//------------------------------
				
				$db_cats->query('UPDATE "table" SET sale = "1" WHERE stored_id = "'.$id .'"');
				$db_cats->query('UPDATE "table" SET price = "'.$price .'" WHERE stored_id = "'.$id .'"');
				header('Location: '.$site.'profile'); exit; // !!!
			}
	}
//-----------------------------------
if (isset($_POST['nosale']))
	{
		$hash = $_POST['hash'];
		$a=4; $_SESSION['a'] = $a;
		
				$text = '{"type":6,"hash":"'.$hash.'","price":0}';

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
												'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
												'value' => 0
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
												'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
												'value' => 0
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
				
				//------------------------------
				
				$db_cats->query('UPDATE "table" SET sale = "0" WHERE stored_id = "'. $id .'"');
				$db_cats->query('UPDATE "table" SET price = "0" WHERE stored_id = "'. $id .'"');
				
				header('Location: '.$site.'profile'); exit; // !!!
	}
//-----------------------------------
if (isset($_POST['in']))
		{
			$hash = $_POST['hash'];
			$a=5; $_SESSION['a'] = $a;
			include('../egg_hatching.php');
			$text = '{"type":1,"img":'.$img.',"hash":"'.$hash.'"}';
			//-----------------------------------
			if ($test != 'testnet')
					{
						$tx = new MinterTx([
							'nonce' => $api_node->getNonce('Mx836a597ef7e869058ecbcc124fae29cd3e2b4444'),
							'chainId' => MinterTx::MAINNET_CHAIN_ID,
							'gasPrice' => 1,
							'gasCoin' => $coin,
							'type' => MinterMultiSendTx::TYPE,
							'data' => [
								'list' => [
									[
										'coin' => $coin,
										'to' => $address,
										'value' => 0
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
							'nonce' => $api_node->getNonce('Mx836a597ef7e869058ecbcc124fae29cd3e2b4444'),
							'chainId' => MinterTx::TESTNET_CHAIN_ID,
							'gasPrice' => 1,
							'gasCoin' => $coin,
							'type' => MinterMultiSendTx::TYPE,
							'data' => [
								'list' => [
									[
										'coin' => $coin,
										'to' => $address,
										'value' => 0
									]
								]
							],
							'payload' => $text,
							'serviceData' => '',
							'signatureType' => MinterTx::SIGNATURE_SINGLE_TYPE
						]);
					}
					$transaction = $tx->sign($privat_key_mintercat);
					
					$get_hesh = TransactoinSendDebug($api2,$transaction);
					$hash = "0x".$get_hesh->result->hash;
					sleep(7);
					$block2 = getBlockByHash($api2,$hash)->result->height;
					
					$payload = getBlockByHash($api2,$hash)->result->payload;

					// {"type":0,"img":5,"hash":"0xBCAEC4A920F1EFB5B6D163D57660EF50A7630AB3B20A4B797C8EACC33BFCF055"}

					$payload = base64_decode($payload);
					$decode_payload_hash = json_decode($payload,true);

					$ImgHash = $decode_payload_hash['img'];
			//-----------------------------------
			$db_cats->query('UPDATE "table" SET img = "'. $ImgHash .'" WHERE id = "'. $check_id .'"');
			$db_cats->query('UPDATE "table" SET stored_id = "'. $block2 .'" WHERE id = "'. $check_id .'"');
			$db_cats->query('UPDATE "table" SET hash = "'. $hash .'" WHERE id = "'. $check_id .'"');
			header('Location: '.$site.'profile'); exit; // !!! header('Location: '.$site.'cat?id='.$block2); exit;
		}
//-----------------------------------
if (isset($_POST['in2']))
		{
			$hash = $_POST['hash'];
			$a=5; $_SESSION['a'] = $a;
			include('../imgcat.php');
			$text = '{"type":1,"img":'.$img.',"hash":"'.$hash.'"}';
			//-----------------------------------
			if ($test != 'testnet')
					{
						$tx = new MinterTx([
							'nonce' => $api_node->getNonce('Mx836a597ef7e869058ecbcc124fae29cd3e2b4444'),
							'chainId' => MinterTx::MAINNET_CHAIN_ID,
							'gasPrice' => 1,
							'gasCoin' => $coin,
							'type' => MinterMultiSendTx::TYPE,
							'data' => [
								'list' => [
									[
										'coin' => $coin,
										'to' => $address,
										'value' => 0
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
							'nonce' => $api_node->getNonce('Mx836a597ef7e869058ecbcc124fae29cd3e2b4444'),
							'chainId' => MinterTx::TESTNET_CHAIN_ID,
							'gasPrice' => 1,
							'gasCoin' => $coin,
							'type' => MinterMultiSendTx::TYPE,
							'data' => [
								'list' => [
									[
										'coin' => $coin,
										'to' => $address,
										'value' => 0
									]
								]
							],
							'payload' => $text,
							'serviceData' => '',
							'signatureType' => MinterTx::SIGNATURE_SINGLE_TYPE
						]);
					}
					$transaction = $tx->sign($privat_key_mintercat);
					
					$get_hesh = TransactoinSendDebug($api2,$transaction);
					$hash = "0x".$get_hesh->result->hash;
					sleep(7);
					$block2 = getBlockByHash($api2,$hash)->result->height;
					
					$payload = getBlockByHash($api2,$hash)->result->payload;

					// {"type":0,"img":5,"hash":"0xBCAEC4A920F1EFB5B6D163D57660EF50A7630AB3B20A4B797C8EACC33BFCF055"}

					$payload = base64_decode($payload);
					$decode_payload_hash = json_decode($payload,true);

					$ImgHash = $decode_payload_hash['img'];
			//-----------------------------------
			$db_cats->query('UPDATE "table" SET img = "'. $ImgHash .'" WHERE id = "'. $check_id .'"');
			$db_cats->query('UPDATE "table" SET stored_id = "'. $block2 .'" WHERE id = "'. $check_id .'"');
			$db_cats->query('UPDATE "table" SET hash = "'. $hash .'" WHERE id = "'. $check_id .'"');
			header('Location: '.$site.'profile'); exit; // !!! header('Location: '.$site.'cat?id='.$block2); exit;
		}
//-----------------------------------
if (isset($_POST['buy']))
	{
		$img = $_POST['img'];
		$hash = $_POST['hash'];
		$price = $_POST['price'];
		$Amount = ($price - ($price * 0.03));
		$fond = $pricebd - $Amount;
		if ($Amount != 0)
			{
				$text = '{"type":5,"img":'.$img.',"hash":"'.$hash.'","price":'.$price.'}';
				//---------------------
				$fond = 50/2; //50% in found MinterCat
				$me = $fond/2; //25%
				$kamil = $fond/2; //25%

				if ($test != 'testnet')
					{
						$tx = new MinterTx([
							'nonce' => $api_node->getNonce('Mx836a597ef7e869058ecbcc124fae29cd3e2b4444'),
							'chainId' => MinterTx::MAINNET_CHAIN_ID,
							'gasPrice' => 1,
							'gasCoin' => $coin,
							'type' => MinterMultiSendTx::TYPE,
							'data' =>
									[
										'list' =>
										[
											[
												'coin' => 'MINTERCAT',
												'to' => $addr,
												'value' => $Amount
											], [
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
							'nonce' => $api_node->getNonce('Mx836a597ef7e869058ecbcc124fae29cd3e2b4444'),
							'chainId' => MinterTx::TESTNET_CHAIN_ID,
							'gasPrice' => 1,
							'gasCoin' => $coin,
							'type' => MinterMultiSendTx::TYPE,
							'data' =>
									[
										'list' =>
										[
											[
												'coin' => 'MINTERCAT',
												'to' => $addr,
												'value' => $Amount
											], [
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
				//---------------------
				$db_cats->query('UPDATE "table" SET addr = "'. $address .'" WHERE stored_id = "'.$id .'"');
				$db_cats->query('UPDATE "table" SET sale = "0" WHERE stored_id = "'.$id .'"');
				$db_cats->query('UPDATE "table" SET price = "0" WHERE stored_id = "'.$id .'"');
				header('Location: '.$site.'profile'); exit;
			}
	}
//-----------------------------------
if (isset($_POST['send']))
	{
		$img = $_POST['img'];
		$hash = $_POST['hash'];
		$nick = $_POST['nick'];
		$result = $db_users->query('SELECT * FROM "table" WHERE nick = "'. $nick .'"')->fetchArray(1);
		$logins = $result['nick'];
		$nick_address = $result['address'];

		if ($logins != '')
				{
					$text = '{"type":2,"img":'.$img.',"hash":"'.$hash.'","price":0}';
					//---------------------
					if ($test != 'testnet')
					{
						$tx = new MinterTx([
							'nonce' => $nonce,
							'chainId' => MinterTx::MAINNET_CHAIN_ID,
							'gasPrice' => 1,
							'gasCoin' => $coin,
							'type' => MinterMultiSendTx::TYPE,
							'data' => [
								'list' => [
									[
										'coin' => $coin,
										'to' => $nick_address,
										'value' => 0
									],
									[
										'coin' => $coin,
										'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
										'value' => 0
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
							'nonce' => $nonce,
							'chainId' => MinterTx::TESTNET_CHAIN_ID,
							'gasPrice' => 1,
							'gasCoin' => $coin,
							'type' => MinterMultiSendTx::TYPE,
							'data' => [
								'list' => [
									[
										'coin' => $coin,
										'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
										'value' => 0
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
					//---------------------

					$a=2; $_SESSION['a'] = $a;

					$db_cats->query('UPDATE "table" SET addr = "'. $nick_address .'" WHERE stored_id = "'. $id .'"');
					$db_cats->query('UPDATE "table" SET sale = "0" WHERE stored_id = "'. $id .'"');
					$db_cats->query('UPDATE "table" SET price = "0" WHERE stored_id = "'. $id .'"');

					header('Location: '.$site.'profile'); exit;
				}
				else
				{
					$a=1; $_SESSION['a'] = $a; header('Location: '.$site.'profile'); exit;
				}

	}
//-----------------------------------
if (isset($_POST['back']))
	{
		header('Location: '.$site.'profile'); exit;
	}
//-----------------------------------
echo '<br><br>
	</center>';
//-------------------------------
}
else
{
//========================================
echo "<title>MinterCat | Explorer</title>";
$titles = 'Explorer';
$m = 6; include('../menu.php');
//-------------------------------
include('../header2.php');
//-------------------------------
include('../id.php');
}
//-------------------------------
echo '<br><br><br><br><br>';
include('../footer.php');
