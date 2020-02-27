<?php
declare(strict_types=1);
require_once('../config/minterapi/vendor/autoload.php');
use Minter\MinterAPI;
use Minter\SDK\MinterTx;
use Minter\SDK\MinterCoins\MinterMultiSendTx;

include('../../config/config.php');
include('../function.php');

$cript_mnemonic = $_SESSION['cript_mnemonic'];
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];
$private_key = $decript['private_key'];

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

//-----------------------
$base = "../explorer/session.txt";
include('../explorer/online.php');
//-----------------------
$db_cats = new Cats();
$db_gen = new Gen();
$db_rss = new RSS();
$db_stored = new Stored();

if (isset($_GET['crossing'])) 
	{
		$id1 = $_GET['cat1'];
		$id2 = $_GET['cat2'];
	
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
				
				$result = $db_gen->query('SELECT * FROM "table" WHERE stored_id=' . $id1);
				$data = $result->fetchArray(1);	
				$ok1 = $data['block'];
				
				$result = $db_gen->query('SELECT * FROM "table" WHERE stored_id=' . $id2);
				$data = $result->fetchArray(1);
				$ok2 = $data['block'];
				
				if ((($block >= $ok1) or ($ok1 == '')) and (($block >= $ok2) or ($ok2 == '')))
					{
$result = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id1);
$data = $result->fetchArray(1);
$addr1 = $data['addr'];

$result = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id2);
$data = $result->fetchArray(1);
$addr2 = $data['addr'];

if (($addr1 == $address) and ($addr2 == $address)) {
$result = $db_gen->query('SELECT * FROM "table" WHERE stored_id=' . $id1);
$data = $result->fetchArray(1);

$fishtail1 = $data['fishtail'];
$tentacles1 = $data['tentacles'];
$horns1 = $data['horns'];
//------------------------------------------------------------	
$result = $db_gen->query('SELECT * FROM "table" WHERE stored_id=' . $id2);
$data = $result->fetchArray(1);

$fishtail2 = $data['fishtail'];
$tentacles2 = $data['tentacles'];
$horns2 = $data['horns'];
//------------------------------------------------------------	
	if (($fishtail1 >= 1) and ($fishtail2 >= 1)) {$goldengen = 2;} else {$goldengen = 1;}
	if (($tentacles1 >= 1) and ($tentacles2 >= 1)) {$goldengen = 2;} else {$goldengen = 1;}
	if (($horns1 >= 1) and ($horns2 >= 1)) {$goldengen = 2;} else {$goldengen = 1;}
//------------------------------------------------------------		
	
	$fish = floor(($fishtail1 + $fishtail2)*3/4); if (($fish>0) and ($fish<=1)) {$fish=1;} if ($fish>=30) {$fish=30;}
	$tentacl = floor(($tentacles1 + $tentacles2)*3/4); if (($tentacl>0) and ($tentacl<=1)) {$tentacl=1;} if ($tentacl>=30) {$tentacl=30;}
	$horn = floor(($horns1 + $horns2)*3/4); if (($horn>0) and ($horn<=1)) {$horn=1;} if ($horn>=30) {$horn=30;}
//------------------------------------------------------------		
		$kolvo = $_GET['kolvo'];
		$blockq = $block + (720*$kolvo);

$komsa = 240 - ($kolvo * 10);
if ($komsa == 0) {$komsa = 0;}

if ($balance > $komsa) 
	{
		$img = rand(9990,9999);
		$result = $db_cats->query('SELECT id FROM "table" WHERE id = "'.$block.'"');
		$data = $result->fetchArray(1);

		if ($data)
			{
				echo 'Уже существует!';
			}
		else
			{
				$db_cats->query('CREATE TABLE IF NOT EXISTS "table" (
					"id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
					"stored_id" INTEGER,
					"addr" VARCHAR,
					"img" INTEGER,
					"price" INTEGER,
					"sale" INTEGER
				)');
				$db_cats->exec('INSERT INTO "table" ("stored_id", "addr", "img", "price", "sale")
					VALUES ("'.$block.'", "'.$address.'", "'.$img.'", "0", "0")');
			}

		$stored = array($id1,$id2,$block);
		for ($i = 0; $i <= 2; $i++)
		{
			$stored_id = $stored[$i];
			$result = $db_stored->query('SELECT stored_id FROM "table" WHERE stored_id="'.$stored_id.'"');
			$data = $result->fetchArray(1);

			if ($data)
				{
					$db_stored->query('UPDATE "table" SET block = "'.$blockq.'" WHERE stored_id = "'.$stored_id.'"');
				}
			else
				{
					$db_stored->query('CREATE TABLE IF NOT EXISTS "table" (
						"id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
						"stored_id" INTEGER,
						"block" INTEGER
					)');
					$db_stored->exec('INSERT INTO "table" ("stored_id", "block")
						VALUES ("'.$stored_id.'", "'.$blockq.'")');
				}
		}

		$db_gen->query('CREATE TABLE IF NOT EXISTS "table" (
			"id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			"stored_id" INTEGER,
			"fishtail" INTEGER,
			"tentacles" INTEGER,
			"horns" INTEGER
		)');

		$db_gen->exec('INSERT INTO "table" ("stored_id", "fishtail", "tentacles", "horns")
			VALUES ("'.$block.'", "'.$fish.'", "'.$tentacl.'", "'.$horn.'")');


		$text = '{"type":3,"img":'.$img.',"mom":"0x888...","dad":"0x777..."}';

		$fond = $komsa/2; //50% in found MinterCat
		$me = $fond/2; //25%
		$kamil = $fond/2; //25%
		
		$api_node = new MinterAPI($api);
		
		if ($test != 'TESTNET')
			{
				$chainId = MinterTx::MAINNET_CHAIN_ID;
			}
		else
			{
				$chainId = MinterTx::TESTNET_CHAIN_ID;
			}
		$tx = new MinterTx([
							'nonce' => $api_node->getNonce($address),
							'chainId' => $chainId,
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

		$transaction = $tx->sign($private_key); 
		echo $transaction;
		$get_hesh = TransactoinSendDebug($api,$transaction);
		$hash = "0x".$get_hesh->result->hash;
		
		header('Location: '.$site.'crossing');
		exit;
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
	}else
{
	$a=7; $_SESSION['a'] = $a; 
	header('Location: '.$site.'profile');
	exit;
}	
	}}