<?php
//========================================
echo "<title>MinterCat | Explorer</title>";
$titles = 'Explorer';
$m = 6;
//-------------------------------
include('../header2.php');
//-------------------------------
$nick = $_GET['nick'];
if ($nick == '') 
{
	$nick = $_POST['nick'];
}
//-------------------------------
if ($nick ==''){include('explorer.php');} 
elseif(mb_stripos($nick,"#") !== false)
	{
	  $id = explode("#", $nick)[1];
	  header_lol($site.'cat?id='.$id);
	  die();
	} 
else {include('nick.php');}
//-------------------------------
include('../footer.php');