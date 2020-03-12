<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

$array = array(
"php" => "v7.1.3",
"github.com/MinterCat/MinterCat.com" => "v0.1.0-Beta2",
"api" => "v0.1.0",
"blockchain" => "Minter",
"github.com/MinterTeam/minter-go-node" => "v1.1.3",
"github.com/MinterTeam/minter-php-sdk" => "v2.2.0",
);

echo json_encode($array, JSON_UNESCAPED_UNICODE);