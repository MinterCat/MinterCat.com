<?php
declare(strict_types=1);
require_once('../../config/minterapi/vendor/autoload.php');
use Minter\MinterAPI;
use Minter\SDK\MinterTx;
use Minter\SDK\MinterCoins\MinterMultiSendTx;
//========================================
$version = explode('public_html', $_SERVER['DOCUMENT_ROOT'])[1];
if ($version == 'testnet') {require_once($_SERVER['DOCUMENT_ROOT'] . 'config/config.php');}
else {require_once(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/config.php');}
require_once('../function.php');
//-----------------------
$base = $_SERVER['DOCUMENT_ROOT'] . '/explorer/session.txt';
include($_SERVER['DOCUMENT_ROOT'] . '/explorer/online.php');
//-----------------------	
$session_language = $_SESSION['session_language'];
$cript_mnemonic = $_SESSION['cript_mnemonic'];

if ($cript_mnemonic != '') {
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text);

$address = $decript->address;

$check_language = User::Address($address)->language;
}
if ($check_language != '') {$Language = Language($check_language);}
elseif ($session_language != '') {$Language = Language($session_language);}
else {$Language = Language('English');}	
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
//========================================
if ($address != '')
{
$nick = User::Address($address)->nick;
$api_node = new MinterAPI($api2);

function TransactoinSendDebug ($api2,$transaction)
{
    $api = new MinterAPI($api2);
    return $api->send($transaction);
}

$private_key = $decript->private_key;

$db_cats = new dbCats();
$db_rss = new RSS();

$nonce = $api_node->getNonce($address);
$balance = CoinBalance($address, 'MINTERCAT');
//-------------------------------
echo "<title>MinterCat | $nick</title>";
$titles = '';
$m = 2;
include('../header2.php');
//-------------------------------
$block = $_GET['id'];
$check_id = Cats::StoredId($block)->id;
$addr = Cats::StoredId($block)->addr;

if ($address == '') {header('Location: '.$site.'profile'); exit;}

$hash = Cats::StoredId($block)->hash;
if ($hash != null) {
$block = checkHash::getHash($api2,$hash)->height;
$TypeHash = checkHash::getCat($api2,$hash)->type;
$ImgHash = checkHash::getCat($api2,$hash)->img;
} else {
$ImgHash = Cats::StoredId($block)->img;
$TypeHash = 'NULL';
}
$pricebd = Cats::StoredId($block)->price;

$json4 = file_get_contents($site.'api?img='.$ImgHash);
$payloads4 = json_decode($json4,true);
$cats = $payloads4['cats'];

$series = $cats[0]['series'];
$rarity = ($cats[0]['rarity'])*100;
$price = $cats[0]['value'];
$name1 = $cats[0]['name'];
$count = $cats[0]['count'];
$gender = $cats[0]['gender'];
$color = $cats[0]['color'];

$name2 = Cats::StoredId($block)->name;
if (($name2 != '') or ($name2 != null)) {$name = $name2;} else {$name = $name1;}

$payloadsID = $db_cats->query('SELECT * FROM "gen" WHERE stored_id=' . $block)->fetchArray(1);

$fishtail = $payloadsID['fishtail'];
$tentacles = $payloadsID['tentacles'];
$horns = $payloadsID['horns'];

$json_api = JSON($api3."/block?height=$block");
$data = $json_api->result->time;

$nd = date('d.m.Y', strtotime(explode('T', $data)[0]));

if ($gender == '♂') {$gender_p = "$Language->Male ($gender)";}
elseif ($gender == '♀') {$gender_p = "$Language->Female ($gender)";}
else {$gender_p = $Language->Undefined;}

if ($pricebd == '') {$bgimg = ''; $pr = $price;} else {$bgimg = '<font color="red"><b>(Sale)</b></font>'; $pr = $pricebd;}
if($addr == $address){
$sale = Cats::StoredId($block)->sale;
echo "
<center>
	<div style='background: $color' width='100%' height='300'>
			<picture>
			<source srcset='".$site."static/img/Cat$ImgHash.webp' type='image/webp' width='350' height='350'>
			<img src='".$site."png.php?png=$ImgHash' width='350' height='350'>
			</picture><br>
	</div>
			#$block<br>
			<b>$name</b>
			<hr>
$Language->Cat_created <b>$nd</b>, $Language->in_block <b>#$block</b> <br>
$Language->Chance_of_falling_out <b>$rarity%</b><br>
$Language->gender : $gender_p<br>
$Language->Number_of_cats_of_this_breed <b>$count</b><br>
<br>
Hash create: $hash<br>
";

if ($pricebd != '') {echo "Price in shop: <b>$pr</b> $coin<br><br>";}
echo "$Language->Approximate_cost <b>$price</b> $coin<br><br>
";

if ($hash != null) {

if ($gender != '0')
{
if (isset($_POST['send2']))
	{
		echo "
		<form method='post'>
		<input id='nick' name='nick' type='text' value='' placeholder='NickName' maxlength='15' size='12'>
		<input id='send' name='send' type='submit' value='$Language->Send'>
		<input id='img' name='img' type='hidden' value='$ImgHash'>
		<input id='hash' name='hash' type='hidden' value='$hash'>
		<input id='back' name='back' type='submit' value='$Language->Cancel'>
		</form>
		";
	}
elseif (isset($_POST['sale']))
					{
						echo "
						<form method='post'>
						<p>
						<input id='price' name='price' type='number' value='".$_POST['price']."' placeholder='Price' maxlength='7' size='12'>
						<input id='sendprice' name='sendprice' type='submit' value='$Language->Send'>
						<input id='img' name='img' type='hidden' value='$ImgHash'>
						<input id='hash' name='hash' type='hidden' value='$hash'>
						<input id='back' name='back' type='submit' value='$Language->Cancel'>
						</p>
						</form>
						";
					}
				elseif ($sale == 1)
							{
								echo "
								<form method='post'>
								<input id='send2' name='send2' type='submit' value='$Language->Send'>
								<input id='nosale' name='nosale' type='submit' value='$Language->Not_sell'>
								<input id='hash' name='hash' type='hidden' value='$hash'>
								</form>
								";
							}
						else
							{
								echo "
								<form method='post'>
								<input id='send2' name='send2' type='submit' value='$Language->Send'>
								<input id='sale' name='sale' type='submit' value='$Language->Sell'>
								<input id='price' name='price' type='hidden' value='$price'>
								</form>
								";
							}
}elseif ($TypeHash == 0)
		{
			echo "
					<br>
					<form method='post'>
					<input id='in2' name='in2' type='submit' value='$Language->Hatching_egg'>
					<input id='hash' name='hash' type='hidden' value='$hash'>
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
					<input id='in' name='in' type='submit' value='$Language->Hatching_egg'>
					<input id='hash' name='hash' type='hidden' value='$hash'>
					</form>
					";
				}
		}

}else{
echo "
	<br>
	<form method='post'>
	<input id='gethash' name='gethash' type='submit' value='Get Hash'>
	<input id='img' name='img' type='hidden' value='$ImgHash'>
	</form>
	";
}}else{
		echo "
<center>
	<div style='background: $color' width='100%' height='300'>
			<picture>
			<source srcset='".$site."static/img/Cat$ImgHash.webp' type='image/webp' width='350' height='350'>
			<img src='".$site."png.php?png=$ImgHash' width='350' height='350'>
			</picture><br>
	</div>
			#$block<br>
			$name $gender
			<hr>
$Language->Cat_created <b>$nd</b>, $Language->in_block <b>#$block</b> <br>
$Language->Chance_of_falling_out <b>$rarity%</b><br>
$Language->gender : $gender_p<br>
$Language->Number_of_cats_of_this_breed <b>$count</b><br>
<br>
Hash create: $hash<br>
$Language->Approximate_cost <b>$pr</b> $coin<br><br>
";
if (($sale == 1)and($balance > $pricebd))
	{
		echo "
		<form method='post'>
			<input id='buy' name='buy' type='submit' value='$Language->Buy'>
			<input id='price' name='price' type='hidden' value='$pricebd'>
			<input id='hash' name='hash' type='hidden' value='$hash'>
			<input id='img' name='img' type='hidden' value='$ImgHash'>
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
				$tx_array = array(
									array(
										'coin' => $coin,
										'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
										'value' => 0
									)
								);
				
				$transaction = TransactionSend($api,$address,$privat_key,$chainId,$coin,$text,$tx_array);
				$code = $transaction->code;
				if ($code == 0) 
					{
						$hash = $transaction->hash;
						sleep(6);
						$block = $api->getTransaction($hash)->result->height;
						$db_cats->query('UPDATE "table" SET sale = "1" WHERE stored_id = "'.$block .'"');
						$db_cats->query('UPDATE "table" SET price = "'. $price .'" WHERE stored_id = "'.$block .'"');
						header('Location: '.$site.'profile'); exit;
					}
				else
					{
						$a=7; $_SESSION['a'] = $a;
						header('Location: '.$site.'profile');
						exit;
					}
			}
	}
//-----------------------------------
if (isset($_POST['nosale']))
	{
		$hash = $_POST['hash'];
		$a=4; $_SESSION['a'] = $a;
		
		$text = '{"type":6,"hash":"'.$hash.'","price":0}';

		$tx_array = array(
							array(
								'coin' => $coin,
								'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
								'value' => 0
							)
						);
				
		$transaction = TransactionSend($api,$address,$privat_key,$chainId,$coin,$text,$tx_array);
		$code = $transaction->code;
		if ($code == 0) 
			{
				$db_cats->query('UPDATE "table" SET sale = "0" WHERE stored_id = "'. $block .'"');
				$db_cats->query('UPDATE "table" SET price = "0" WHERE stored_id = "'. $block .'"');
				header('Location: '.$site.'profile'); exit;
			}
		else
			{
				$a=7; $_SESSION['a'] = $a;
				header('Location: '.$site.'profile');
				exit;
			}
	}
//-----------------------------------
if (isset($_POST['in']))
	{
		$hash = $_POST['hash'];
		$a=5; $_SESSION['a'] = $a;
		include('../egg_hatching.php');
		$text = '{"type":1,"img":'.$img.',"hash":"'.$hash.'"}';
		//-----------------------------------
		$tx_array = array(
						array(
							'coin' => $coin,
							'to' => $address,
							'value' => 0
						)
					);
			
		$transaction = TransactionSend($api,'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',$privat_key_mintercat,$chainId,$coin,$text,$tx_array);
		$code = $transaction->code;
		if ($code == 0) 
			{
				$hash = $transaction->hash;
				sleep(6);
				$block2 = checkHash::getHash($api,$hash)->height;
				$ImgHash = checkHash::getCat($api,$hash)->img;
				//-----------------------------------
				$db_cats->query('UPDATE "table" SET img = "'. $ImgHash .'" WHERE id = "'. $check_id .'"');
				$db_cats->query('UPDATE "table" SET stored_id = "'. $block2 .'" WHERE id = "'. $check_id .'"');
				$db_cats->query('UPDATE "table" SET hash = "'. $hash .'" WHERE id = "'. $check_id .'"');
				header('Location: '.$site.'cat?id='.$block2); exit;
			}
		else
			{
				$a=7; $_SESSION['a'] = $a;
				header('Location: '.$site.'profile');
				exit;
			}
	}
//-----------------------------------
if (isset($_POST['in2']))
	{
		$hash = $_POST['hash'];
		$a=5; $_SESSION['a'] = $a;
		include('../imgcat.php');
		$text = '{"type":1,"img":'.$img.',"hash":"'.$hash.'"}';
		//-----------------------------------
		$tx_array = array(
						array(
							'coin' => $coin,
							'to' => $address,
							'value' => 0
						)
				);
			
		$transaction = TransactionSend($api,'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',$privat_key_mintercat,$chainId,$coin,$text,$tx_array);
		$code = $transaction->code;
		if ($code == 0) 
			{
				$hash = $transaction->hash;
				sleep(6);
				$block2 = checkHash::getHash($api2,$hash)->height;
				$ImgHash = checkHash::getCat($api2,$hash)->img;
				//-----------------------------------
				$db_cats->query('UPDATE "table" SET img = "'. $ImgHash .'" WHERE id = "'. $check_id .'"');
				$db_cats->query('UPDATE "table" SET stored_id = "'. $block2 .'" WHERE id = "'. $check_id .'"');
				$db_cats->query('UPDATE "table" SET hash = "'. $hash .'" WHERE id = "'. $check_id .'"');
				header('Location: '.$site.'cat?id='.$block2); exit;
			}
		else
			{
				$a=7; $_SESSION['a'] = $a;
				header('Location: '.$site.'profile');
				exit;
			}
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
				$kamil = $komsa/4; //25%
				$fond = $komsa - $kamil;
				$tx_array = array(
								array(
									'coin' => $coin,
									'to' => $addr,
									'value' => $Amount
								),
								array(
									'coin' => $coin,
									'to' => 'Mxf7c5a1a3f174a1c15f4671c1651d42377351b5b5',
									'value' => $kamil
								),
								array(
									'coin' => $coin,
									'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
									'value' => $fond
								)
							);
				$transaction = TransactionSend($api,$address,$privat_key,$chainId,$coin,$text,$tx_array);
				$code = $transaction->code;
				if ($code == 0) 
					{
						$db_cats->query('UPDATE "table" SET addr = "'. $address .'" WHERE stored_id = "'.$block .'"');
						$db_cats->query('UPDATE "table" SET sale = "0" WHERE stored_id = "'.$block .'"');
						$db_cats->query('UPDATE "table" SET price = "0" WHERE stored_id = "'.$block .'"');
						header('Location: '.$site.'profile'); exit;
					}
				else
					{
						$a=7; $_SESSION['a'] = $a;
						header('Location: '.$site.'profile');
						exit;
					}
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
				$tx_array = array(
								array(
									'coin' => $coin,
									'to' => $nick_address,
									'value' => 0
								),
								array(
									'coin' => $coin,
									'to' => 'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',
									'value' => 0
								)
							);
				$transaction = TransactionSend($api,$address,$privat_key,$chainId,$coin,$text,$tx_array);
				$code = $transaction->code;
				if ($code == 0) 
					{
						$db_cats->query('UPDATE "table" SET addr = "'. $nick_address .'" WHERE stored_id = "'. $block .'"');
						$db_cats->query('UPDATE "table" SET sale = "0" WHERE stored_id = "'. $block .'"');
						$db_cats->query('UPDATE "table" SET price = "0" WHERE stored_id = "'. $block .'"');
						
						$a=2; $_SESSION['a'] = $a;
						header('Location: '.$site.'profile'); 
						exit;
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
				$a=1; $_SESSION['a'] = $a; 
				header('Location: '.$site.'profile'); 
				exit;
			}

	}
//-----------------------------------
if (isset($_POST['gethash']))
	{
		$img = $_POST['img'];
		$text = '{"type":1,"img":'.$img.'}';
			//-----------------------------------
		$tx_array = array(
							array(
								'coin' => $coin,
								'to' => $address,
								'value' => 0
							)
					);
			
		$transaction = TransactionSend($api,'Mx836a597ef7e869058ecbcc124fae29cd3e2b4444',$privat_key_mintercat,$chainId,$coin,$text,$tx_array);
		$code = $transaction->code;
		if ($code == 0) 
			{
				$hash = $transaction->hash;
				sleep(6);
				$block2 = checkHash::getHash($api2,$hash)->height;
				$ImgHash = checkHash::getCat($api2,$hash)->img;
				//-----------------------------------
				$db_cats->query('UPDATE "table" SET img = "'. $ImgHash .'" WHERE id = "'. $check_id .'"');
				$db_cats->query('UPDATE "table" SET stored_id = "'. $block2 .'" WHERE id = "'. $check_id .'"');
				$db_cats->query('UPDATE "table" SET hash = "'. $hash .'" WHERE id = "'. $check_id .'"');
				header('Location: '.$site.'cat?id='.$block2); exit;
			}
		else
			{
				$a=7; $_SESSION['a'] = $a;
				header('Location: '.$site.'profile');
				exit;
			}
	}
//-----------------------------------
if (isset($_POST['back']))
	{
		header('Location: '.$site.'profile'); 
		exit;
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
$m = 6;
//-------------------------------
include('../header2.php');
//-------------------------------
include('../id.php');
}
//-------------------------------
echo '<br><br><br>';
include('../footer.php');
