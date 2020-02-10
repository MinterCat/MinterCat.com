<?php
ob_start();
//========================================
include('../../config/config.php');
include('../function.php');
session_start();
$cript_mnemonic = $_SESSION['cript_mnemonic'];
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];

$db_users = new Users();

$result = $db_users->query('SELECT * FROM "table" WHERE address="'.$address.'"');
$data = $result->fetchArray(1);
$check_language = $data['language'];

if ($check_language != '') {$lang = $check_language; $lang_site = $site.'profile';} else {$lang = 'English'; $lang_site = $site;}

$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$lang.json");
$language = json_decode($jsonlanguage,true);
//========================================
$header = "<center>
	<div class='footer__logo'>Langu<span class='footer__logo-dark'>age</span></div>
	<form action='../lng.php'>
		<p>
		<button id='language' name='language' value='Russian'>РУССКИЙ</button>
		<button id='language' name='language' value='English'>ENGLISH</button>
		<button id='language' name='language' value='French'>FRANÇAIS</button>
		<button id='language' name='language' value='Bulgarian'>БЪЛГАРСКИ</button>
		<button id='language' name='language' value='Ukrainian'>УКРАЇНСЬКА</button>
		<button id='language' name='language' value='Hebrew'>עברית</button>
		<button id='language' name='language' value='Indonesian'>INDONESIAN</button>
		<button id='language' name='language' value='Yoruba'>YORUBA</button>
		<button id='language' name='language' value='Igbo'>IGBO</button>
		<input id='link' name='link' type='hidden' value='".$lang_site."'>
		</p>
		<br>
		<button id='language' name='language' value='language'>MY LANGUAGE</button>
		</form>
</center>";
$title = "<title>MinterCat | Language</title>";
$menu = "
<a href='".$site."' class='nav-top__link'>" . $language['Home'] . "</a>
<a href='".$site."profile' class='nav-top__link'>" . $language['Profile'] . "</a>
<a href='#' class='nav-top__link'>" . $language['event'] . "</a>
<a href='".$site."dev' class='nav-top__link'>" . $language['Developers'] . "</a>
<a href='#' class='nav-top__link active'>Language</a>
<a href='".$site."explorer' class='nav-top__link'>Explorer</a>
";
include('../header3.php');
echo "<div class='about main__about'>";
//-------------------------------
echo '</div>';
include('../footer3.php');
//-------------------------------
$g = ob_get_contents();
ob_end_clean();

echo $g;