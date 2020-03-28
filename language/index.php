<?php
ob_start();
//========================================
include('../../config/config.php');
include('../function.php');
//-----------------------
$base = "../explorer/session.txt";
include('../explorer/online.php');
//-----------------------
$session_language = $_SESSION['session_language'];
$cript_mnemonic = $_SESSION['cript_mnemonic'];

if ($cript_mnemonic != '') {
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];

$db_users = new Users();

$result = $db_users->query('SELECT * FROM "table" WHERE address="'.$address.'"');
$data = $result->fetchArray(1);
$check_language = $data['language'];
}
if ($check_language != '') 
	{$lang = $check_language; $lang_site = $site.'profile';} 
else 
	{
		$lang_site = $site;
		if ($session_language != '') {$lang = $session_language;} else {$lang = 'English';}
	}

$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$lang.json");
$language = json_decode($jsonlanguage,true);
//========================================
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo "<title>MinterCat | Language</title>";
$titles = 'Language';
$m = 5; include('../menu.php');
//-------------------------------
include('../header2.php');
//-------------------------------
echo "<center><br>
	<form method='POST'>
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
</center><br><br>";
//-------------------------------
include('../footer.php');
//-------------------------------

if (isset($_POST['language']))
	{
		$link = $_POST['link'];
		$language = $_POST['language'];
		if ($language == 'language')
			{
				header('Location: https://poeditor.com/join/project/4zQZx6tHPM'); exit;												
			}
		else
			{
				$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$language.json");
				$cript_mnemonic = $_SESSION['cript_mnemonic'];
				$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
				$decript = json_decode($decript_text,true);

				$address = $decript['address'];
				if ($address!='')
					{
						$db_users->query('UPDATE "table" SET language = "'. $language .'" WHERE address = "'. $address .'"');
					}
				$_SESSION['session_language'] = $language;
				header("Location: $lang_site"); exit;												
			}
	}

if (isset($_GET['language']))
	{
		$language = $_GET['language'];
		$url = $_GET['url'];
		$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$language.json");
		$cript_mnemonic = $_SESSION['cript_mnemonic'];
		$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
		$decript = json_decode($decript_text,true);

		$address = $decript['address'];
		if ($address!='')
			{
				$db_users->query('UPDATE "table" SET language = "'. $language .'" WHERE address = "'. $address .'"');
			}
		$_SESSION['session_language'] = $language;
		header("Location: $url"); exit;							
	}

$g = ob_get_contents();
ob_end_clean();

echo $g;