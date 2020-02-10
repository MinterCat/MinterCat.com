<?php
declare(strict_types=1);
require_once('../config/minterapi/vendor/autoload.php');
use Minter\MinterAPI;
use Minter\SDK\MinterWallet;

include('../config/config.php');

				$api = new MinterAPI($api);

				$wallet = MinterWallet::create();
				$mnemonic = $wallet['mnemonic'];
				$address = $wallet['address'];
				$privateKey = $wallet['private_key'];

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

				class Cats extends SQLite3
				{
					function __construct()
					{
						$this->open('../config/cats.sqlite');
					}
				}

				$db = new Users();

				$db->exec('CREATE TABLE IF NOT EXISTS "table" (
					"id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
					"address" VARCHAR,
					"nick" VARCHAR,
					"language" VARCHAR
				)');
				$db->exec('INSERT INTO "table" ("address", "nick", "language")
					VALUES ("'.$address.'", "", "")');

				$result = $db->query('SELECT id FROM "table" WHERE address="'.$address.'"');
				$data = $result->fetchArray();
				$id = $data['id'];
				$nick = "ID$id";
				$db->exec('UPDATE "table" SET nick = "'. $nick .'" WHERE address = "'. $address .'"');
				//------------------------------		
				$input = array(1001, 1003, 1004, 1005, 1006);
				$rand_keys = array_rand($input, 1);
				$img = $input[$rand_keys[0]];

				$input = array(1002, 1007, 1008, 1009, 1010);
				$rand_keys = array_rand($input, 1);
				$img2 = $input[$rand_keys[0]];
					
				$status = 'https://explorer-api.minter.network/api/v1/status'; //status blocks
				$statuspayload = json_decode($status,true);
				$latestBlockHeight = $statuspayload['data']['latestBlockHeight'];
				$block = $latestBlockHeight + 1;
				//------------------------------
				$cats_db = new Cats();

				$cats_db->exec('CREATE TABLE IF NOT EXISTS "table" (
					"id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
					"stored_id" INTEGER,
					"addr" VARCHAR,
					"img" INTEGER,
					"price" INTEGER,
					"sale" INTEGER
						)');
				$cats_db->exec('INSERT INTO "table" ("stored_id", "addr", "img", "price", "sale")
					VALUES ("'.$latestBlockHeight.'", "'.$address.'", "'.$img.'", "0", "0")');
				$cats_db->exec('INSERT INTO "table" ("stored_id", "addr", "img", "price", "sale")
					VALUES ("'.$block.'", "'.$address.'", "'.$img2.'", "0", "0")');
				//------------------------------
				sleep(1);
				$a=8; $_SESSION['a'] = $a;		
				//------------------------------		
				header("Location: $site/profile"); exit;