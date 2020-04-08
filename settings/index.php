<?php
//-----------------------
$base = $_SERVER['DOCUMENT_ROOT'] . '/explorer/session.txt';
include($_SERVER['DOCUMENT_ROOT'] . '/explorer/online.php');
//-----------------------
$session_language = $_SESSION['session_language'];
$version = explode('public_html', $_SERVER['DOCUMENT_ROOT'])[1];
if ($version == 'testnet') {include($_SERVER['DOCUMENT_ROOT'] . 'config/config.php');}
else {include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/config.php');}
require_once($_SERVER['DOCUMENT_ROOT'] . '/function.php');

$cript_mnemonic = $_SESSION['cript_mnemonic'];
if ($cript_mnemonic != '') {
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];
$private_key = $decript['private_key'];

$db_users = new Users();

$nick = User::Address($address)->nick;
$check_language = User::Address($address)->language;
}
if ($check_language != '') {$Language = Language($check_language);}
elseif ($session_language != '') {$Language = Language($session_language);} 
else {$Language = Language('English');}
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo "
<!DOCTYPE html>
<html lang='en'>

<head>
 <meta charset='utf-8'>
  <title>MinterCat | $nick</title>
  <link rel='icon' href='".$site."static/img/favicon.png'>
  <link rel='stylesheet' href='".$site."static/css/normalize.css'>
  <link rel='stylesheet' href='".$site."static/css/styles.min.css'>
  <link rel='stylesheet' href='".$site."static/css/style_header.css'>
  <link rel='stylesheet' href='".$site."static/css/style_menu.css'>
  <link rel='stylesheet' href='".$site."static/css/pagination.css'>
  <link rel='stylesheet' href='".$site."static/css/lk.css'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body>

<div class='header'>
		<div class='logo_float'>
			<div class='logo_cat'>
				<a href='#'>
					<div class='logo__img'></div>
					<span class='logo__text'><div class='logo_text'>Minter</div>
					<span class='logo__text-dark'><div class='logo_text_2'>Cat</div></span></span>
				</a>
			</div>
			<div class='head_menu'>";
				$m = 2; include('../menu.php');
			echo "$menu
			</div>
		</div>
	</div>
<div class='header_window'>
";
$d = "onkeyup=". '"' . "var yratext=/['_','\s']/; if(yratext.test(this.value)) alert('Введены запрещенные символы')".'"';
echo "
<div class='logo_float'>
	<div class='avatar_user'>
		<div class='avatar profile-section__avatar'>
			<img src='https://my.minter.network/api/v1/avatar/by/address/".$address."' class='avatar__img img-responsive'>
		</div>
	</div>
	<div class='position_left'>$Language->My_nickname :
				<form>
						  <input id='login' name='login' value='$nick' maxlength='15' minlength='5' $d>
						  <input type='submit' id='save' name='save' value='$Language->Save'>
				</form>


	</div>
	<div class='position_left'>$Language->My_wallet :
                <input type='text' value='$address' id='myInput'>
				  <div class='tooltip'>
					<button onclick='myFunction()' onmouseout='outFunc()'>
					  <span class='tooltiptext' id='myTooltip'>Copy to clipboard</span>
					  $Language->Copy 
					  </button>

<script>
function myFunction() {
  var copyText = document.getElementById('myInput');
  copyText.select();
  document.execCommand('copy');

  var tooltip = document.getElementById('myTooltip');
  tooltip.innerHTML = 'Copied: ' + copyText.value;
}

function outFunc() {
  var tooltip = document.getElementById('myTooltip');
  tooltip.innerHTML = 'Copy to clipboard';
}
</script>

				</div>
	</div>
</div>
</div>
";
