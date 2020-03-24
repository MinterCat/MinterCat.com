<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

class Users extends SQLite3
{
    function __construct()
    {
        $this->open('../../../config/users.sqlite');
    }
}

$db_users = new Users();
$result = $db_users->query('SELECT * FROM "table"');
$data = array();
while ($res = $result->fetchArray(1)){array_push($data, $res);}
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);