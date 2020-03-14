<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

class Cats extends SQLite3
{
    function __construct()
    {
        $this->open('../../../../config/cats.sqlite');
    }
}

$db_cats = new Cats();
$result = $db_cats->query('
SELECT "table".*, "gen".*
FROM "table" INNER JOIN "gen"
ON "table".stored_id = "gen".stored_id;');
$data = array();
while ($res = $result->fetchArray(1)){array_push($data, $res);}
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);