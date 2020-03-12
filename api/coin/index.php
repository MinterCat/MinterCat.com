<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include('../../../config/config.php');

$json = file_get_contents($coin_api);

$response = json_decode($json,true);
$will_get = $response['result']['will_get'];
$will_get = $will_get / 10 ** 18;

$array = array("estimate" => $will_get);
echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);