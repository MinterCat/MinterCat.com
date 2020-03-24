<?php
// $db_cats = new Cats();
class Cats extends SQLite3
{
    function __construct()
    {
        $this->open('../../config/cats.sqlite');
    }
}
// $db_rss = new RSS();
class RSS extends SQLite3
{
    function __construct()
    {
        $this->open('../../config/rss.sqlite');
    }
}
// $db_users = new Users();
class Users extends SQLite3
{
    function __construct()
    {
        $this->open('../../config/users.sqlite');
    }
}
// $db_api = new db_api();
class db_api extends SQLite3
{
    function __construct()
    {
        $this->open('../../config/api.sqlite');
    }
}
// $json_api = JSON($site.'api');
function JSON ($url)
{
	$data = file_get_contents($url);
    $jsonCalled = json_decode($data);
    return $jsonCalled;
}

// $Language = Language('Russian');
function Language ($lang)
{
	$url = 'https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_'.$lang.'.json';
	$data = file_get_contents($url);
    $jsonCalled = json_decode($data);
    return $jsonCalled;
}
// $CheckHash = CheckHash($api, $hash, $check);
function CheckHash ($api, $hash, $check)
{
    $api = new MinterAPI($api);
    if ($check == true)
		{
			$payload = $api->getTransaction($hash)->result->payload;
			$payload = base64_decode($payload); // {'type':1,'img':1,'hash':'0xBCAEC4A920F1EFB5B6D163D57660EF50A7630AB3B20A4B797C8EACC33BFCF055'}
			return json_decode($payload);
		}	
	else
		{
			return $api->getTransaction($hash);
		}
}