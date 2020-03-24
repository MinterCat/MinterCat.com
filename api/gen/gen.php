<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

class Gen extends SQLite3
{
    function __construct()
    {
        $this->open('../../../config/gen.sqlite');
    }
}

$db_gen = new Gen();
$result = $db_gen->query('SELECT * FROM "table"');
$data = array();
while ($res = $result->fetchArray(1)){array_push($data, $res);}
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);