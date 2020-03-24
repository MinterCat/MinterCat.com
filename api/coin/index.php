<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include('../../../config/config.php');

function JSON ($url)
{
	$data = file_get_contents($url);
    $jsonCalled = json_decode($data);
    return $jsonCalled;
}

$json_api = JSON($coin_api);
$estimate = $json_api->result->will_get/10 ** 18;

$json_api = JSON('https://api.mscan.dev/'.$mscan.'/node/coin_info?symbol=MINTERCAT');
$symbol = $json_api->result;

$array = array("estimate" => $estimate, "symbol" => $symbol);
echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);