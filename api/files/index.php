<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
include('../../../config/config.php'); 
//https://api.github.com/repos/MinterCat/MinterCat.com/contents/
//https://api.github.com/repos/MinterCat/MinterCat.com/git/trees/c7a98d85e78a02cba8e477160e95bbdac60c6c2d
//https://api.github.com/repos/MinterCat/MinterCat.com/git/commits/d91df7f125ecc57e3ff3cb7e01c4722a62587c7b
//https://api.github.com/repos/MinterCat/MinterCat.com/events
//https://api.github.com/repos/MinterCat/MinterCat.com/branches/master
$trees = $_GET['trees'];
$commits = $_GET['commits'];

$ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://api.github.com/repos/MinterCat/MinterCat.com/branches/$version",
        CURLOPT_HTTPHEADER => [
            "Accept: application/vnd.github.v3+json",
            "Content-Type: text/plain",
            "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 YaBrowser/16.3.0.7146 Yowser/2.5 Safari/537.36"
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true
    ]);
$response = curl_exec($ch);
curl_close($ch);
print($response);