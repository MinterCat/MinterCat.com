<?php
declare(strict_types=1);
require_once('../config/minterapi/vendor/autoload.php');
use Minter\MinterAPI;
use Minter\SDK\MinterWallet;

include('../config/config.php');

$api = new MinterAPI($api);
$mnemonic = $_POST['mnemonic'];
$seed = MinterWallet::mnemonicToSeed($mnemonic);
$privateKey = MinterWallet::seedToPrivateKey($seed);
$publicKey = MinterWallet::privateToPublic($privateKey);
$address = MinterWallet::getAddressFromPublicKey($publicKey);

$arr = array(
			'mnemonic' => $mnemonic,
			'address' => $address,
			'private_key' => $privateKey
);


$json = json_encode($arr, JSON_UNESCAPED_UNICODE);

$cript_mnemonic = openssl_encrypt($json,$crypt_method,$crypt_key,$crypt_options,$crypt_iv);
session_start();
$_SESSION['cript_mnemonic'] = $cript_mnemonic;
//------------------------------
class Users extends SQLite3
{
    function __construct()
    {
        $this->open('../config/users.sqlite');
    }
}

$db_users = new Users();
$result = $db_users->query('SELECT address FROM "table" WHERE address="'.$address.'"');
$data = $result->fetchArray(1);

if ($data)
	{
		header("Location: $site/profile"); exit;
	}
else
	{
		$db_users->exec('CREATE TABLE IF NOT EXISTS "table" (
			"id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			"address" VARCHAR,
			"nick" VARCHAR,
			"language" VARCHAR
		)');
		$db_users->exec('INSERT INTO "table" ("address", "nick", "language")
			VALUES ("'.$address.'", "", "")');
		$result = $db_users->query('SELECT id FROM "table" WHERE address="'.$address.'"');
		$data = $result->fetchArray(1);
		$id = $data['id'];
		$nick = "ID$id";
		$db_users->exec('UPDATE "table" SET nick = "'. $nick .'" WHERE address = "'. $address .'"');
		
		header("Location: $site/profile"); exit;
	}