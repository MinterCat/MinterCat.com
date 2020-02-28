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
//========================================
if ($address != '')
{
$api_node = new MinterAPI($api2);

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

$private_key = $decript['private_key'];

$db_cats = new Cats();
$db_rss = new RSS();

$nonce = $api_node->getNonce($address);
$response = $api_node->getBalance($address);
$balance = intval(($response->result->balance->$coin)/10**18);
if ($balance == '') {$balance = 0;}
$nick = $data['nick'];
//-------------------------------
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo "<title>MinterCat | $nick</title>";
$titles = '';
$menu = "
<ul id='menu'>
    <li><a href='".$site."' class='nav-top__link '>" . $language['Home'] . "</a></li>
    <li><a href='".$site."profile' class='nav-top__link active'>" . $language['Profile'] . "</a>
      <ul>
        <li><a href='".$site."wallet' class='nav-top__link '>" . $language['My_wallet'] . "</a></li>
		<li><a href='".$site."settings' class='nav-top__link '>Settings</a></li>
		<li><a href='".$site."crossing' class='nav-top__link'>" . $language['Crossing'] . "</a></li>
	<li><a href='".$site."shop' class='nav-top__link'>" . $language['Shop'] . "</a></li>
      </ul>
    </li>
	<li><a href='#' class='nav-top__link '>" . $language['event'] . "</a></li>
	<li><a href='".$site."language' class='nav-top__link'>Language</a>
	<ul>
		<li><a href='".$site."language?language=Russian&url=$url' class='nav-top__link'>РУССКИЙ</a></li>
		<li><a href='".$site."language?language=English&url=$url' class='nav-top__link'>ENGLISH</a></li>
		<li><a href='".$site."language?language=French&url=$url' class='nav-top__link'>FRANÇAIS</a></li>
	</ul>
	</li>
	<li><a href='".$site."explorer' class='nav-top__link'>Explorer</a>
	<ul>
		<li><a href='".$site."cats' class='nav-top__link '>" . $language['Kitty'] . "</a></li>
		<li><a href='".$site."rss' class='nav-top__link'>RSS</a></li>
	</ul>
	</li>
	<li><a href='".$site."exit.php' class='nav-top__link'>" . $language['Exit'] . "</a></li>
</ul>
";
include('../header3.php');
//-------------------------------
$id = $_GET['id'];
$result = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id);
$payloads1 = $result->fetchArray(1);

$addr = $payloads1['addr'];

if ($address == '') {header('Location: '.$site.'profile'); exit;}
$img = $payloads1['img'];

$json4 = file_get_contents($site.'api?img='.$img);
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

$db_gen = new Gen();
$result2 = $db_gen->query('SELECT * FROM "table" WHERE stored_id=' . $id);
$payloadsID = $result2->fetchArray(1);	

$fishtail = $payloadsID['fishtail'];
$tentacles = $payloadsID['tentacles'];
$horns = $payloadsID['horns'];

$json2 = file_get_contents($api2."/block?height=$id");
$payloads2 = json_decode($json2,true);

$data = $payloads2['result']['time'];

$nd = explode('T', $data)[0];
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
			<source srcset='".$site."img/Cat$img.webp' type='image/webp' width='350' height='350'>
			<img src='".$site."png.php?png=$img' width='350' height='350'>
			</picture><br>
	</div>
			#$id<br>
			<b>$name</b>
			<hr>
			" . $language['Cat_created'] . " <b>$nd</b>, " . $language['in_block'] . " <b>#$id</b> <br>
" . $language['Chance_of_falling_out'] . " <b>$rarity%</b><br>
" . $language['gender'] . ": $gender_p<br>
" . $language['Number_of_cats_of_this_breed'] . " <b>$count</b><br>
<br>
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
		<input id='nik' name='nik' type='text' value='' placeholder='NickName' maxlength='15' size='12'>
		<input id='send' name='send' type='submit' value='" . $language['Send'] . "'>
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
						<input id='price' name='price' type='number' value='' placeholder='Price' maxlength='7' size='12'>
						<input id='sendprice' name='sendprice' type='submit' value='" . $language['Send'] . "'>
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
								</form>
								";
							}
						else
							{
								echo "
								<form method='post'>
								<input id='send2' name='send2' type='submit' value='" . $language['Send'] . "'>
								<input id='sale' name='sale' type='submit' value='" . $language['Sell'] . "'>
								</form>
								";
							}
					}		
	}
}else{
$status = 'https://explorer-api.minter.network/api/v1/status';
$statuspayload = json_decode($status,true);
$latestBlockHeight = $statuspayload['data']['latestBlockHeight'];
$eggblock = $latestBlockHeight - $id;
	if ($eggblock >= 17280)
		{
			echo "
			<br>
			<form method='post'>
			<input id='in' name='in' type='submit' value='" . $language['Hatching_egg'] . "'>
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
			<source srcset='".$site."img/Cat$img.webp' type='image/webp' width='350' height='350'>
			<img src='".$site."png.php?png=$img' width='350' height='350'>
			</picture><br>
	</div>
			#$id<br>
			$name $gender
			<hr>
			" . $language['Cat_created'] . " <b>$nd</b>, " . $language['in_block'] . " <b>#$id</b> <br>
" . $language['Chance_of_falling_out'] . " <b>$rarity%</b><br>
" . $language['gender'] . ": $gender_p<br>
" . $language['Number_of_cats_of_this_breed'] . " <b>$count</b><br>
<br>
" . $language['Approximate_cost'] . " <b>$pr</b> $coin<br><br>
";
if ($sale == 1)
	{
		if ($balance > $pricebd) 
			{
				echo "
				<form method='post'>
				   <input id='buy' name='buy' type='submit' value='" . $language['Buy'] . "'>
				 </form>
				  ";
			 }
	}
}
//-----------------------------------
if (isset($_POST['nosale']))
	{
		$a=4; $_SESSION['a'] = $a;
		$db_cats->query('UPDATE "table" SET sale = "0" WHERE stored_id = "'.$id .'"');
		$db_cats->query('UPDATE "table" SET price = "0" WHERE stored_id = "'.$id .'"');
		header('Location: '.$site.'profile'); exit;										
	}
//-----------------------------------
if (isset($_POST['sendprice']))
	{
		$price = $_POST['price'];
		$a=3; $_SESSION['a'] = $a;
		
		if ($price > 0)
			{
				$db_cats->query('UPDATE "table" SET sale = "1" WHERE stored_id = "'.$id .'"');
				$db_cats->query('UPDATE "table" SET price = "'.$price .'" WHERE stored_id = "'.$id .'"');
			}
		else
			{
				$db_cats->query('UPDATE "table" SET sale = "0" WHERE stored_id = "'.$id .'"');
				$db_cats->query('UPDATE "table" SET price = "0" WHERE stored_id = "'.$id .'"');
			}
		header('Location: '.$site.'profile'); exit;
	}
//-----------------------------------	
if (isset($_POST['in']))
		{
			$a=5; $_SESSION['a'] = $a;
			include('../egg_hatching.php');
			$db_cats->query('UPDATE "table" SET img = "'. $img .'" WHERE stored_id = "'.$id .'"');
			header('Location: '.$site.'cat?id='.$id); exit;
		}
//-----------------------------------
if (isset($_POST['buy']))
	{
		$db_cats->query('UPDATE "table" SET addr = "'. $address .'" WHERE stored_id = "'.$id .'"');
		$db_cats->query('UPDATE "table" SET sale = "0" WHERE stored_id = "'.$id .'"');
		$db_cats->query('UPDATE "table" SET price = "0" WHERE stored_id = "'.$id .'"');
		
		$Amount = ($pricebd - ($pricebd * 0.03));
		$fond = $pricebd - $Amount;
		if ($Amount != 0)
			{
				$text = "SHOP -> $nick Cat $id";
				//---------------------
				$fond = 50/2; //50% in found MinterCat
				$me = $fond/2; //25%
				$kamil = $fond/2; //25%
				
				$tx = new MinterTx([
									'nonce' => $nonce,
									'chainId' => $chainId,
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

				$transaction = $tx->sign($private_key);
				echo $transaction;
				$get_hesh = TransactoinSendDebug($api,$transaction);
				$hash = "0x".$get_hesh->result->hash;
				//---------------------
				
				header('Location: '.$site.'profile'); exit;
			}
	}
//-----------------------------------	
if (isset($_POST['send']))
	{
		$nik = $_POST['nik'];
		$result = $db_users->query('SELECT * FROM "table" WHERE nick = "'. $nik .'"');
		$payjsn = $result->fetchArray(1);
		$logins = $payjsn['nick'];

		if ($logins != '')
				{
					$text = "$nick -> $logins Transfer Cat $id";
					//---------------------
					if ($test != 'TESTNET') 
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
					echo $transaction;
					$get_hesh = TransactoinSendDebug($api2,$transaction);
					//$hash = "0x".$get_hesh->result->hash;
					//---------------------
						
					$a=2; $_SESSION['a'] = $a;
					$addrs = $payjsn[$i]['address'];
						
					$db_cats->query('UPDATE "table" SET addr = "'. $addrs .'" WHERE stored_id = "'.$id .'"');
					$db_cats->query('UPDATE "table" SET sale = "0" WHERE stored_id = "'.$id .'"');
					$db_cats->query('UPDATE "table" SET price = "0" WHERE stored_id = "'.$id .'"');
						
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
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo "<title>MinterCat | Explorer</title>";
$titles = 'Explorer';
$menu = "
<ul id='menu'>
	<li><a href='".$site."' class='nav-top__link'>" . $language['Home'] . "</a></li>
	<li><a href='".$site."profile' class='nav-top__link'>" . $language['Profile'] . "</a></li>
	<li><a href='#' class='nav-top__link'>" . $language['event'] . "</a></li>
	<li><a href='".$site."dev' class='nav-top__link'>" . $language['Developers'] . "</a></li>
	<li><a href='".$site."language' class='nav-top__link'>Language</a>
	<ul>
		<li><a href='".$site."language?language=Russian&url=$url' class='nav-top__link'>РУССКИЙ</a></li>
		<li><a href='".$site."language?language=English&url=$url' class='nav-top__link'>ENGLISH</a></li>
		<li><a href='".$site."language?language=French&url=$url' class='nav-top__link'>FRANÇAIS</a></li>
	</ul>
	</li>
	<li><a href='".$site."explorer' class='nav-top__link active'>Explorer</a>
	<ul>
		<li><a href='".$site."cats' class='nav-top__link '>" . $language['Kitty'] . "</a></li>
		<li><a href='".$site."rss' class='nav-top__link'>RSS</a></li>
	</ul></li>
<li>
  <form action='../explorer'>
      <input type='text' placeholder='Поиск..' name='nick'>
      <button type='submit'><i class='fa fa-search'></i></button>
  </form>
</div>
</li></ul>
";
//-------------------------------
include('../header3.php');
//-------------------------------
include('../id2.php');
}
//-------------------------------
include('../footer.php');