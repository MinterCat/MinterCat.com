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
// $db_gen = new dbGen();
class dbGen extends SQLite3
{
    function __construct()
    {
        $this->open(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/gen.sqlite');
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
function header_lol($url)
{
	echo "<script>window.location.href='".$url."'</script>";
	exit;
}