<?php
declare(strict_types=1);
require_once('../../config/minterapi/vendor/autoload.php');
use Minter\MinterAPI;
use Minter\SDK\MinterTx;
use Minter\SDK\MinterCoins\MinterMultiSendTx;
//========================================
include('../../config/config.php');
include('../function.php');
session_start();
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
$login = $data['id'];
}
if ($check_language != '') 
	{$lang = $check_language;} 
else 
	{
		if ($session_language != '') {$lang = $session_language;} else {$lang = 'English';}
	}

$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$lang.json");
$language = json_decode($jsonlanguage,true);
//========================================
if ($login != '')
{
function getBlockByHash ($api,$hash)
{
    $api = new MinterAPI($api);
    return $api->getTransaction($hash);
}

function TransactoinSendDebug ($api,$transaction)
{
    $api = new MinterAPI($api);
    return $api->send($transaction);
}

$api_node = new MinterAPI($api.'/');

$private_key = $decript['private_key'];

$db_cats = new Cats();
$db_rss = new RSS();

$nonce = $api_node->getNonce($address);
$response = $api_node->getBalance($address);
$balance = intval(($response->result->balance->$coin)/10**18);
if ($balance == '') {$balance = 0;}
$nick = $data['nick'];
$active = 1;
include('../header4.php');
//-------------------------------
include('../id.php');
//-------------------------------
include('../footer.php');
}else{
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
		<li><a href='".$site."language?language=Russian' class='nav-top__link'>РУССКИЙ</a></li>
		<li><a href='".$site."language?language=English' class='nav-top__link'>ENGLISH</a></li>
		<li><a href='".$site."language?language=French' class='nav-top__link'>FRANÇAIS</a></li>
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
include('../id2.php');
//-------------------------------
include('../footer.php');
}