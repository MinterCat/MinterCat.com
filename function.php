<?php
// $db_cats = new dbCats();
class dbCats extends SQLite3
{
    function __construct()
    {
        $this->open(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/cats.sqlite');
    }
}
// $db_rss = new RSS();
class RSS extends SQLite3
{
    function __construct()
    {
        $this->open(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/rss.sqlite');
    }
}
// $db_users = new Users();
class Users extends SQLite3
{
    function __construct()
    {
        $this->open(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/users.sqlite');
    }
}
// $db_api = new db_api();
class db_api extends SQLite3
{
    function __construct()
    {
        $this->open(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/api.sqlite');
    }
}
function JSON ($url)
	{
		$data = file_get_contents($url);
		return json_decode($data);
	}
function Language ($lang)
	{
		$url = 'https://api.mintercat.com/language?lang=' . $lang;
		$data = file_get_contents($url);
		return json_decode($data);
	}
function Languages ()
	{
		$url = 'https://api.mintercat.com/language';
		$data = file_get_contents($url);
		return json_decode($data);
	}
class checkHash
	{
		public $api;
		public $hash;
		
		public static function getHash($api, $hash)
			{
				$data = file_get_contents($api . '/transaction?hash=' . $hash);
				$jsonCalled = json_decode($data);
				return $jsonCalled->result;
			}
		public static function getCat($api, $hash)
			{
				$data = file_get_contents($api . '/transaction?hash=' . $hash);
				$jsonCalled = json_decode($data)->result->payload;
				$payload = base64_decode($jsonCalled);
				return json_decode($payload);
			}
	}
function GetStatusPage()
	{
		$data = file_get_contents('https://explorer-api.minter.network/api/v1/status-page');
		$jsonCalled = json_decode($data);
		return $jsonCalled->data;
	}
function GetBlocks()
	{
		$data = file_get_contents('https://explorer-api.minter.network/api/v1/blocks');
		$json = json_decode($data,true)['data'][0];
		return json_decode(json_encode($json));
	}

function Coin()
	{
		$data = file_get_contents('https://api.mintercat.com/coin');
		return json_decode($data);
	}
function Users()
	{
		$data = file_get_contents('https://api.mintercat.com/users');
		$json = json_decode($data,true);
		return json_decode(json_encode($json));
	}
class User
	{
		public $id;
		public $name;
		public $address;
		
		public static function ID($id)
			{
				$id -= 1;
				$data = file_get_contents('https://api.mintercat.com/users');
				$json = json_decode($data,true)[$id];
				return json_decode(json_encode($json));
			}
		public static function Address($address)
			{
				$data = file_get_contents('https://api.mintercat.com/users');
				$json = json_decode($data,true);
				foreach ($json as $value => $users) {
					$user = $users['address'];
					if ($user == $address) {$id = $users['id'];break;}
				}
				$id -= 1;
				$json = json_decode($data,true)[$id];
				return json_decode(json_encode($json));
			}
		public static function Nick($nick)
			{
				$data = file_get_contents('https://api.mintercat.com/users');
				$json = json_decode($data,true);
				foreach ($json as $value => $users) {
					$user = $users['nick'];
					if ($user == $nick) {$id = $users['id'];break;}
				}
				$id -= 1;
				$json = json_decode($data,true)[$id];
				return json_decode(json_encode($json));
			}
	}
class Cats
	{
		public $img;
		public $address;
		public $stored_id;
		
		public static function Img($img)
			{
				$data = file_get_contents('https://api.mintercat.com');
				$json = json_decode($data,true)['cats'];
				foreach ($json as $value => $cats) {
					$cat = $cats['img'];
					if ($cat == $img) {$cat = $cats;break;}
				}
				return json_decode(json_encode($cat));
			}
		public static function Counts()
			{
				$data = file_get_contents('https://api.mintercat.com');
				return json_decode($data)->count;
			}
		public static function Address($address)
			{
				$data = file_get_contents('https://api.mintercat.com/cats?addr=' . $address);
				$data = json_decode($data,true);
				return json_decode(json_encode($data));
			}
		public static function StoredId($stored_id)
			{
				$data = file_get_contents('https://api.mintercat.com/cats?id=' . $stored_id);
				return json_decode($data);
			}
	}