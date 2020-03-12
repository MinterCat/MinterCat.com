<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

$github = array(
"MinterCat/MinterCat.com" => "v0.1.0-Beta2",
"MinterCat/api" => "v0.1.0",
"MinterTeam/minter-go-node" => "v1.1.3",
"MinterTeam/minter-php-sdk" => "v2.2.0",
);

$array = array(
"php" => "v7.1.3",
"blockchain" => "Minter",
"github" => $github
);

echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);