<?php
$active = 'active';
switch ($m)
{
	case 2: {$a2 = $active; break;} //Profile
	case 3: {$a3 = $active; break;} //event
	case 4: {$a4 = $active; break;} //Developers
	case 5: {$a5 = $active; break;} //Language
	case 6: {$a6 = $active; break;} //Explorer
}

$menu = "
<ul id='menu'>
	<li><a href='".$site."' class='nav-top__link'>" . $language['Home'] . "</a></li>
";
if ($m == 2)
	{
		$menu .= "
		<li><a href='".$site."profile' class='nav-top__link $a2'>" . $language['Profile'] . "</a>
			<ul>
				<li><a href='".$site."wallet' class='nav-top__link '>" . $language['My_wallet'] . "</a></li>
				<li><a href='".$site."settings' class='nav-top__link '>Settings</a></li>
				<li><a href='".$site."crossing' class='nav-top__link'>" . $language['Crossing'] . "</a></li>
				<li><a href='".$site."shop' class='nav-top__link'>" . $language['Shop'] . "</a></li>
			</ul>
		</li>
		";
	}
else
{
	$menu .= "
		<li><a href='".$site."profile' class='nav-top__link'>" . $language['Profile'] . "</a></li>
		";
}
$menu .= "
	<li><a href='#' class='nav-top__link $a3'>" . $language['event'] . "</a></li>
	<li><a href='".$site."dev' class='nav-top__link $a4'>" . $language['Developers'] . "</a></li>
	<li><a href='".$site."language' class='nav-top__link $a5'>Language</a>
		<ul>
			<li><a href='".$site."language?language=Russian&url=$url' class='nav-top__link'>РУССКИЙ</a></li>
			<li><a href='".$site."language?language=English&url=$url' class='nav-top__link'>ENGLISH</a></li>
			<li><a href='".$site."language?language=French&url=$url' class='nav-top__link'>FRANÇAIS</a></li>
		</ul>
	</li>
	<li><a href='".$site."explorer' class='nav-top__link $a6'>Explorer</a>
		<ul>
			<li><a href='".$site."cats' class='nav-top__link'>" . $language['Kitty'] . "</a></li>
			<li><a href='".$site."explorer/transaction' class='nav-top__link'>Transaction</a></li>
			<li><a href='".$site."rss' class='nav-top__link'>RSS</a></li>
		</ul>
	</li>
";
if ($m == 2)
	{
		$menu .= "
		<li><a href='".$site."exit.php' class='nav-top__link'>" . $language['Exit'] . "</a></li>
		";
	}
if ($m == 6)
	{
		$menu .= "
		<li>
		  <form action='../explorer'>
			  <input type='text' placeholder='Search...' name='nick'>
			  <button type='submit'><i class='fa fa-search'></i></button>
		  </form>
		</li>
		";
	}
$menu .= "
</ul>
";