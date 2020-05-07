<?php
declare(strict_types=1);
require_once('../../config/minterapi/vendor/autoload.php');
use Minter\MinterAPI;
use Minter\SDK\MinterTx;

function estimate($coin)
	{
		$api = new MinterAPI('https://api.minter.one');
		return $api->estimateCoinSell($coin, '1000000000000000000', 'BIP', null)->result->will_get/10 ** 18;			
	}