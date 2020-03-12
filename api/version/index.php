<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

$array = array(
"php" => "v7.1.3",
"master" => "v0.1.0-Beta2",
"api" => "v0.1.0",
"blockchain" => "Minter v1.1.3",
"minter-php-sdk" => "v2.2.0",
);

echo json_encode($array, JSON_UNESCAPED_UNICODE);