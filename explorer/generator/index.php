<?php
//========================================
include('../../../config/config.php');
class Users extends SQLite3
{
    function __construct()
    {
        $this->open('../../../config/users.sqlite');
    }
}
//-----------------------
$base = "../session.txt";
include('../online.php');
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
echo "<title>MinterCat | Explorer</title>";
$titles = 'Explorer';
$m = 6; include('../../menu.php');
//-------------------------------
include('../../header2.php');
//-------------------------------
echo '<div class="cat_content_none"><div class="cat_content">';
include('../../generator/index.php');
echo '</div></div>';
//-------------------------------
include('../../footer.php');