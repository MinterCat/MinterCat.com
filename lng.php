<?php
include('../../config/config.php');
include('../function.php');
$link = $_GET['link'];
$language = $_GET['language'];
if (isset($language))
	{
		session_start();
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
						$db_users = new Users();
						$db_users->query('UPDATE "table" SET language = "'.$language .'" WHERE address = "'. $address .'"');
					}
				header("Location: $link"); exit;												
			}
	}