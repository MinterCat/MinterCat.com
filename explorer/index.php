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
$menu = "
<ul id='menu'>
	<li><a href='".$site."' class='nav-top__link'>" . $language['Home'] . "</a></li>
	<li><a href='".$site."profile' class='nav-top__link'>" . $language['Profile'] . "</a></li>
	<li><a href='#' class='nav-top__link'>" . $language['event'] . "</a></li>
	<li><a href='".$site."dev' class='nav-top__link'>" . $language['Developers'] . "</a></li>
	<li><a href='".$site."language' class='nav-top__link'>Language</a>
	<ul>
		<li><a href='".$site."language?language=Russian&url=$url' class='nav-top__link'>РУССКИЙ</a></li>
		<li><a href='".$site."language?language=English&url=$url' class='nav-top__link'>ENGLISH</a></li>
		<li><a href='".$site."language?language=French&url=$url' class='nav-top__link'>FRANÇAIS</a></li>
	</ul>
	</li>
	<li><a href='".$site."explorer' class='nav-top__link active'>Explorer</a>
	<ul>
		<li><a href='".$site."cats' class='nav-top__link '>" . $language['Kitty'] . "</a></li>
		<li><a href='".$site."rss' class='nav-top__link'>RSS</a></li>
	</ul></li>
</ul>
";
//-------------------------------
include('../header3.php');
//-------------------------------
$nick = $_GET['nick'];
if ($nick == '') 
{
	$nick = $_POST['nick'];
}
//-------------------------------
if ($nick!='') {include('nick.php');} else {include('explorer.php');}
//-------------------------------
include('../footer.php');