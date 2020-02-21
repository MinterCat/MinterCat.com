<?php
ob_start();
//========================================
include('../../config/config.php');
include('../function.php');
session_start();
$session_language = $_SESSION['session_language'];
$cript_mnemonic = $_SESSION['cript_mnemonic'];
$decript_text = openssl_decrypt($cript_mnemonic, $crypt_method, $crypt_key, $crypt_options, $crypt_iv);
$decript = json_decode($decript_text,true);

$address = $decript['address'];

$db_users = new Users();

$result = $db_users->query('SELECT * FROM "table" WHERE address="'.$address.'"');
$data = $result->fetchArray(1);
$check_language = $data['language'];

if ($check_language != '') 
	{$lang = $check_language;} 
else 
	{
		if ($session_language != '') {$lang = $session_language;} else {$lang = 'English';}
	}

$jsonlanguage = file_get_contents("https://raw.githubusercontent.com/MinterCat/Language/master/MinterCat_$lang.json");
$language = json_decode($jsonlanguage,true);
//========================================
echo "<title>MinterCat | PCO</title>";
$titles = 'PCO';
$menu = "
<a href='".$site."' class='nav-top__link'>" . $language['Home'] . "</a>
<a href='".$site."profile' class='nav-top__link'>" . $language['Profile'] . "</a>
<a href='#' class='nav-top__link'>" . $language['event'] . "</a>
<a href='".$site."dev' class='nav-top__link'>" . $language['Developers'] . "</a>
<a href='".$site."language' class='nav-top__link'>Language</a>
<a href='".$site."explorer' class='nav-top__link'>Explorer</a>
";
include('../header3.php');
//-------------------------------
echo "
<p>
<b>🐈 MINTERCAT</b><br>
MINTERCAT — " . $language['official_coin_of_the_MinterCat_project'] . "<br>
<br>
<a href='https://minterscan.net/coin/MINTERCAT' target='_blank' class='nav-top__link'>" . $language['Coin'] . " MINTERCAT</a><br>
<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $language['Characteristics_of_coin'] . ":</b><br>
 • " . $language['Symbol'] . " MINTERCAT <br>
 • CRR 75%<br>
 • " . $language['Initial_reserve'] . " 1 000 BIP<br>
 • " . $language['Initial_price'] . " 0.1 BIP<br>
 • " . $language['Initial_emission'] . " 10 000 MINTERCAT<br>
<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $language['At_the_time_of_writing'] . ":</b><br>
• " . $language['Reserve'] . " 150 000 BIP<br>
• " . $language['Price'] . " 0,4668 BIP<br>
• " . $language['Delegated'] . " 95%<br>
• " . $language['Emission'] . " 430 000 MINTERCAT<br>
<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $language['Coin_creation_transaction'] . "</b><br>
<br>
<a href='https://minterscan.net/tx/Mtec393388520e9d231c01f3756f173ac38e4c00df5959943dea7f54472fd40678' target='_blank' class='nav-top__link'>" . $language['The_link_to_the_transaction'] . "</a><br>
</p>
<p style='text-indent: 25px;'>
<b>" . $language['The_purpose_of_the_coins'] . "</b><br>
 • " . $language['Development_Fund'] . "<br>
 • " . $language['Cost_coverage'] . "<br>
 • " . $language['Bonuses'] . ": <br>
" . $language['get_people_for_daily'] . " <br>
" . $language['is_received_by_people'] . "<br> 
 • " . $language['Promotions_large_delegates'] . "<br>
 • " . $language['for_use_in_the_game'] . " <br>
</p>
<p style='text-indent: 25px;'>
" . $language['We_emphasize_that_the_game'] . " <br>
" . $language['The_game_is_shareware.'] . "<br>
<br>
" . $language['The_minimum_withdrawal'] . "<br>
" . $language['These_costs_are_covered_by_the'] . "<br>
<br>
" . $language['Paid_will_be_additional'] . "<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $language['The_delegation_coins'] . "</b><br>
" . $language['initial_issue_delegated_per_year'] . " - 
<a href='https://minterscan.net/validator/Mp629b5528f09d1c74a83d18414f2e4263e14850c47a3fac3f855f200111111111' target='_blank' class='nav-top__link'>«1%»</a>.<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $language['Initial_issue_delegation_transaction'] . ":</b><br><br>
<a href='https://minterscan.net/tx/Mt81284fef01a3f4923e49765a3ea48e67c60d99362e7ff268105b462c37ff290d' target='_blank' class='nav-top__link'>" . $language['The_link_to_the_transaction'] . "</a><br>
</p>
<p style='text-indent: 25px;'>
" . $language['Every_time_there'] . "<br>
" . $language['The_post_will_include'] . "<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $language['Burning_coins'] . "</b><br>
 • " . $language['of_the_profits_from_the_game_project'] . " ( Mx836a597ef7e869058ecbcc124fae29cd3e2b4444 ), " . $language['and_will_be_used_for_the_needs'] . "; <br>
" . $language['time_payment_for_services'] . " <br>
" . $language['Payments_to_players_for_daily'] . "<br>
 • " . $language['is_distributed_among_all_project_developers'] . "<br>
</p>
";
//-------------------------------
include('../footer.php');