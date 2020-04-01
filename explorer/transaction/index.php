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
class RSS extends SQLite3
{
    function __construct()
    {
        $this->open('../../../config/rss.sqlite');
    }
}
//-----------------------
echo "<title>MinterCat | Explorer</title>";
$titles = 'Explorer';
$m = 6;
//-------------------------------
include('../../header2.php');
//-------------------------------
echo '<center>';
include('content.php');
echo '</center>';
//-------------------------------
include('../../footer.php');