<?php
//========================================
include('../../config/config.php');
include('../function.php');
//-----------------------
$base = "session.txt";
include('online.php');
//-----------------------
$session_language = $_SESSION['session_language'];
$cript_mnemonic = $_SESSION['cript_mnemonic'];
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];

$db_users = new Users();

$result = $db_users->query('SELECT * FROM "table" WHERE address="'.$address.'"');
$data = $result->fetchArray(1);
$check_language = $data['language'];

if ($check_language != '') 
	{$lang = $check_language;} 
else 
	{
		if ($session_language != '') {$lang = $session_language;} else {$lang = 'English';}
	}

$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$lang.json");
$language = json_decode($jsonlanguage,true);
//========================================
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo "<title>MinterCat | Explorer</title>";
$titles = 'Explorer';
$m = 6; include('../menu.php');
//-------------------------------
include('../header3.php');
//-------------------------------
$nick = $_GET['nick'];
if ($nick == '') 
{
	$nick = $_POST['nick'];
}
//-------------------------------
if ($nick =='')  
{include('explorer.php');} 
else 
{
	if(mb_stripos($nick,"#") !== false)
  {
	  $id = explode("#", $nick)[1];
	  header('Location: '.$site.'cat?id='.$id); exit;} else {include('nick.php');}
}
//-------------------------------
include('../footer.php');