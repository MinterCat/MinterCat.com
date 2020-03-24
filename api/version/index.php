<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include('../../../config/config.php');

$github = array(
"MinterCat/MinterCat.com" => "v0.1.0-Beta2",
"MinterCat/API" => "v0.1.0",
"MinterTeam/minter-go-node" => "v1.1.4",
"MinterTeam/minter-php-sdk" => "v2.2.0"
);

$array = array(
"php" => "v7.3.13",
"blockchain" => "Minter",
"branch" => $version,
"site" => $test,
"version_node" => $node,
"github" => $github
);

echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);