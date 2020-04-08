<?php
//========================================
echo "<title>MinterCat | PCO</title>";
$titles = 'PCO';
$m = 0;
include('../header2.php');
//-------------------------------
echo "
<div class='cat_content' style='text-align: left; float: none;'>
<p>
<b><img src='".$site."static/img/favicon.png' width='20' height='20'> MINTERCAT</b><br>
MINTERCAT — " . $Language->official_coin_of_the_MinterCat_project . "<br>
<br>
<a href='https://minterscan.net/coin/MINTERCAT' target='_blank' class='nav-top__link'>" . $Language->Coin . " MINTERCAT</a><br>
<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $Language->Characteristics_of_coin . ":</b><br>
 • " . $Language->Symbol . " MINTERCAT <br>
 • CRR 75%<br>
 • " . $Language->Initial_reserve . " 1 000 BIP<br>
 • " . $Language->Initial_price . " 0.1 BIP<br>
 • " . $Language->Initial_emission . " 10 000 MINTERCAT<br>
<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $Language->At_the_time_of_writing . ":</b><br>
• " . $Language->Reserve . " 150 000 BIP<br>
• " . $Language->Price . " 0,4668 BIP<br>
• " . $Language->Delegated . " 95%<br>
• " . $Language->Emission . " 430 000 MINTERCAT<br>
<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $Language->Coin_creation_transaction . "</b><br>
<br>
<a href='https://minterscan.net/tx/Mtec393388520e9d231c01f3756f173ac38e4c00df5959943dea7f54472fd40678' target='_blank' class='nav-top__link'>" . $Language->The_link_to_the_transaction . "</a><br>
</p>
<p style='text-indent: 25px;'>
<b>" . $Language->The_purpose_of_the_coins . "</b><br>
 • " . $Language->Development_Fund . "<br>
 • " . $Language->Cost_coverage . "<br>
 • " . $Language->Bonuses . ": <br>
" . $Language->get_people_for_daily . " <br>
" . $Language->is_received_by_people . "<br>
 • " . $Language->Promotions_large_delegates . "<br>
 • " . $Language->for_use_in_the_game . " <br>
</p>
<p style='text-indent: 25px;'>
" . $Language->We_emphasize_that_the_game . " <br>
" . $Language->The_game_is_shareware. . "<br>
<br>
" . $Language->The_minimum_withdrawal . "<br>
" . $Language->These_costs_are_covered_by_the . "<br>
<br>
" . $Language->Paid_will_be_additional . "<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $Language->The_delegation_coins . "</b><br>
" . $Language->initial_issue_delegated_per_year . " -
<a href='https://minterscan.net/validator/Mp629b5528f09d1c74a83d18414f2e4263e14850c47a3fac3f855f200111111111' target='_blank' class='nav-top__link'>«1%»</a>.<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $Language->Initial_issue_delegation_transaction . ":</b><br><br>
<a href='https://minterscan.net/tx/Mt81284fef01a3f4923e49765a3ea48e67c60d99362e7ff268105b462c37ff290d' target='_blank' class='nav-top__link'>" . $Language->The_link_to_the_transaction . "</a><br>
</p>
<p style='text-indent: 25px;'>
" . $Language->Every_time_there . "<br>
" . $Language->The_post_will_include . "<br>
</p>
<p style='text-indent: 25px;'>
<b>" . $Language->Burning_coins . "</b><br>
 • " . $Language->of_the_profits_from_the_game_project . " ( Mx836a597ef7e869058ecbcc124fae29cd3e2b4444 ), " . $Language->and_will_be_used_for_the_needs . "; <br>
" . $Language->time_payment_for_services . " <br>
" . $Language->Payments_to_players_for_daily . "<br>
 • " . $Language->is_distributed_among_all_project_developers . "<br>
</p>
</div>
";
//-------------------------------
include('../footer.php');