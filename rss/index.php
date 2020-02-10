<?php
include('../../config/config.php');
include('../function.php');
$db_rss = new RSS();
header("content-type: application/rss+xml");
echo '<?xml version="1.0" encoding="UTF-8"?>
          <rss version="2.0" xmlns:dc="'.$site.'rss">
          <channel>
          <title>MinterCat Explorer</title>
          <link>'.$site.'explorer</link>
          <description>MinterCat | Explorer</description>';
$result = $db_rss->query('SELECT * FROM "table" ORDER BY id DESC LIMIT 50');
$data = array();
while ($res = $result->fetchArray(1)){array_push($data, $res);}

$i = 0;  
    while ($res = $result->fetchArray(1))
   {
	 $id=$data[$i]['id'];
     $title=$data[$i]['title'];
     $text=$data[$i]['text'];
     $date=$data[$i]['date'];
     $author=$data[$i]['author'];
	 
     echo "<item>
            <title>$title</title>
            <link>$site</link>
            <description>$text</description>
            <author>$author</author>
            <pubDate>$date</pubDate>
            <guid>$site</guid>
         </item>";
    $i += 1;
   }
   echo '</channel>
   </rss>';