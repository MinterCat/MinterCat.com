<?php
declare(strict_types=1);
require_once('../../../config/minterapi/vendor/autoload.php');
use Minter\MinterAPI;
use Minter\SDK\MinterTx;
use Minter\SDK\MinterCoins\MinterMultiSendTx;

function getBlockByHash ($hash)
{
    include('../../../config/config.php');
	$api = new MinterAPI($api2);
    return $api->getTransaction($hash);
}

$hash = $_GET['hash'];
$img = $_GET['img'];

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

if ($img == 'true')
	{
		$payload = getBlockByHash($hash)->result->payload;
		$payload = base64_decode($payload); // {'type':1,'img':1,'hash':'0xBCAEC4A920F1EFB5B6D163D57660EF50A7630AB3B20A4B797C8EACC33BFCF055'}
		echo json_encode(json_decode($payload), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
else
	{
		$json = getBlockByHash($hash);
		echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}