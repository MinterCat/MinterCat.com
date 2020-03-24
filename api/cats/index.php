<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

class Cats extends SQLite3
{
    function __construct()
    {
        $this->open('../../../config/cats.sqlite');
    }
}

$db_cats = new Cats();

if (isset($_GET['addr']))
	{
		$key = $_GET['addr'];
		$result = $db_cats->query('SELECT * FROM "table" WHERE addr="' . $key . '"');
	}

if (isset($_GET['id']))
	{
		$key = $_GET['id'];
		$result = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $key);
		
	}
$data = array();
while ($res = $result->fetchArray(1)){array_push($data, $res);}
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);