<?php
session_start();
$session_language = $_SESSION['session_language'];
include('../../config/config.php');
include('../function.php');

$cript_mnemonic = $_SESSION['cript_mnemonic'];
if ($cript_mnemonic != '') {
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];
$private_key = $decript['private_key'];

$db_users = new Users();

$result = $db_users->query('SELECT * FROM "table" WHERE address="'.$address.'"');
$data = $result->fetchArray(1);

$nick = $data['nick'];
$check_language = $data['language'];
}
if ($check_language != '') 
	{$lang = $check_language;} 
else 
	{
		if ($session_language != '') {$lang = $session_language;} else {$lang = 'English';}
	}
$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$lang.json");
$language = json_decode($jsonlanguage,true);

echo "
<!DOCTYPE html>
<html lang='en'>

<head>
 <meta charset='utf-8'>
  <title>MinterCat | $nick</title>
  <link rel='icon' href='".$site."img/favicon.png'>
  <link rel='stylesheet' href='".$site."css/normalize.css'>
  <link rel='stylesheet' href='".$site."css/styles.min.css'>
  <link rel='stylesheet' href='".$site."css/style_header.css'>
  <link rel='stylesheet' href='".$site."css/style_menu.css'>
  <link rel='stylesheet' href='".$site."css/pagination.css'>
  <link rel='stylesheet' href='".$site."css/lk.css'>
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
			<div class='head_menu'>
				<ul id='menu'>
    <li><a href='".$site."' class='nav-top__link '>" . $language['Home'] . "</a></li>
    <li><a href='".$site."profile' class='nav-top__link active'>" . $language['Profile'] . "</a>
      <ul>
        <li><a href='".$site."wallet' class='nav-top__link'>" . $language['My_wallet'] . "</a></li>
		<li><a href='".$site."settings' class='nav-top__link '>Settings</a></li>
		<li><a href='".$site."crossing' class='nav-top__link'>" . $language['Crossing'] . "</a></li>
	<li><a href='".$site."shop' class='nav-top__link'>" . $language['Shop'] . "</a></li>
      </ul>
    </li>
	<li><a href='#' class='nav-top__link '>" . $language['event'] . "</a></li>
	<li><a href='".$site."language' class='nav-top__link'>Language</a>
	<ul>
		<li><a href='".$site."language?language=Russian' class='nav-top__link'>РУССКИЙ</a></li>
		<li><a href='".$site."language?language=English' class='nav-top__link'>ENGLISH</a></li>
		<li><a href='".$site."language?language=French' class='nav-top__link'>FRANÇAIS</a></li>
	</ul>
	</li>
	<li><a href='".$site."explorer' class='nav-top__link'>Explorer</a>
	<ul>
		<li><a href='".$site."cats' class='nav-top__link '>" . $language['Kitty'] . "</a></li>
		<li><a href='".$site."rss' class='nav-top__link'>RSS</a></li>
	</ul>
	</li>
	<li><a href='".$site."exit.php' class='nav-top__link'>" . $language['Exit'] . "</a></li>
</ul>
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
	<div class='position_left'>" . $language['My_nickname'] . ":               
				<form>
						  <input id='login' name='login' value='$nick' maxlength='15' minlength='5' $d>
						  <input type='submit' id='save' name='save' value='" . $language['Save'] . "'>
				</form> 

		
	</div>
	<div class='position_left'>" . $language['My_wallet'] . ":
                <input type='text' value='$address' id='myInput'>  
				  <div class='tooltip'>
					<button onclick='myFunction()' onmouseout='outFunc()'>
					  <span class='tooltiptext' id='myTooltip'>Copy to clipboard</span>
					  " . $language['Copy'] . "
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