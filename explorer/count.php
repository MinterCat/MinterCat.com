<?php
//-----------------------
$base = "session.txt";
include('online.php');
//-----------------------
$database = new SQLite3('../../config/users.sqlite');
$result = $database->query('SELECT COUNT(*) FROM "table"');
$data = $result->fetchArray(1);
$count = $data['COUNT(*)'];

$database2 = new SQLite3('../../config/cats.sqlite');
$result2 = $database2->query('SELECT COUNT(*) FROM "table"');
$data2 = $result2->fetchArray(1);
$count2 = $data2['COUNT(*)'];

$result2 = $database2->query('SELECT COUNT(*) FROM "table" WHERE sale="1"');
$data3 = $result2->fetchArray(1);
$count3 = $data3['COUNT(*)'];

echo "Users registered: <b>$count</b>
<br>
Сats were born: <b>$count2</b>
<br>
Cats in the store: <b>$count3</b>
<br>
";
echo "Сейчас на сайте: <b>". $online_check ."</b>";