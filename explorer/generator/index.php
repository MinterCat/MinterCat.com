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
echo "<title>MinterCat | Explorer</title>";
$titles = 'Explorer';
$m = 6;
//-------------------------------
include('../../header2.php');
//-------------------------------
echo '<div class="cat_content_none"><div class="cat_content">';
include('../../generator/index.php');
echo '</div></div>';
//-------------------------------
include('../../footer.php');