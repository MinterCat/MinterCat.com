<?php
include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/config.php');
include($_SERVER['DOCUMENT_ROOT'] . '/function.php');
//========================================
$base = $_SERVER['DOCUMENT_ROOT'] . '/explorer/session.txt';
include($_SERVER['DOCUMENT_ROOT'] . '/explorer/online.php');
//-----------------------
$session_language = $_SESSION['session_language'];
$cript_mnemonic = $_SESSION['cript_mnemonic'];
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];

$db_users = new Users();

$data = $db_users->query('SELECT * FROM "table" WHERE address="'.$address.'"')->fetchArray(1);
$check_language = $data['language'];

if ($check_language != '') {$lang = $check_language;}
elseif ($session_language != '') {$lang = $session_language;} else {$lang = 'English';}

$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$lang.json");
$language = json_decode($jsonlanguage,true);
//========================================
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
include($_SERVER['DOCUMENT_ROOT'] . 'menu.php');
echo "
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta http-equiv='X-UA-Compatible' content='ie=edge'>
<link rel='shortcut icon' href='".$site."static/img/icons/Cats.webp'>
<link rel='stylesheet' href='".$site."static/css/styles.min.css'>
<link rel='stylesheet' href='".$site."static/css/style_header.css'>
<link rel='stylesheet' href='".$site."static/css/style_menu.css'>
<link rel='stylesheet' href='".$site."static/css/pagination.css'>
<link rel='stylesheet' href='".$site."static/css/lk.css'>
<link rel='stylesheet' href='".$site."static/css/social.css'>
<script src='".$site."static/js/dragndrop/jquery-3.4.1.min.js'></script>
<link rel='stylesheet' href='".$site."static/css/normalize.css'>
";

echo "
<div class='header'>
		<div class='logo_float'>
			<div class='logo_cat'>
				<a href='#'>
					<div class='logo__img'></div>
					<span class='logo__text'><div class='logo_text'>Minter</div>
					<span class='logo__text-dark'><div class='logo_text_2'>Cat $titles</div></span></span>
				</a>
			</div>
			<div class='head_menu'>
				$menu
			</div>
		</div>
	</div>
";
