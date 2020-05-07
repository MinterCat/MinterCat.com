<?php
$a1 = '';$a2 = '';$a3 = '';$a4 = '';$a5 = '';$a6 = '';
$active = 'active';
switch ($m)
{
	case 1: {$a1 = $active; break;} //Home
	case 2: {$a2 = $active; break;} //Profile
	case 3: {$a3 = $active; break;} //event
	case 4: {$a4 = $active; break;} //Developers
	case 5: {$a5 = $active; break;} //Language
	case 6: {$a6 = $active; break;} //Explorer
}

$menu = "
<ul id='menu'>
	<li><a href='".$site."' class='nav-top__link $a1'>" . $Language->Home . "</a></li>
";
if ($m == 2)
	{
		$menu .= "
		<li><a href='".$site."profile' class='nav-top__link $a2'>" . $Language->Profile . "</a>
			<ul>
				<li><a href='".$site."wallet' class='nav-top__link '>" . $Language->My_wallet . "</a></li>
				<li><a href='".$site."settings' class='nav-top__link '>Settings</a></li>
				<li><a href='".$site."crossing' class='nav-top__link'>" . $Language->Crossing . "</a></li>
				<li><a href='".$site."shop' class='nav-top__link'>" . $Language->Shop . "</a></li>
			</ul>
		</li>
		";
	}
else
{
	$menu .= "
		<li><a href='".$site."profile' class='nav-top__link'>" . $Language->Profile . "</a></li>
		";
}
$menu .= "
	<li><a href='".$site."refund' class='nav-top__link $a3'>" . $Language->event . "</a></li>
	<li><a href='".$site."feed' class='nav-top__link $a4'>Feed</a></li>
	<li><a href='".$site."language' class='nav-top__link $a5'>Language</a>
		<ul>
			<li><a href='".$site."language?language=Russian&url=$url' class='nav-top__link'>РУССКИЙ</a></li>
			<li><a href='".$site."language?language=English&url=$url' class='nav-top__link'>ENGLISH</a></li>
			<li><a href='".$site."language?language=French&url=$url' class='nav-top__link'>FRANÇAIS</a></li>
		</ul>
	</li>
	<li><a href='".$site."explorer' class='nav-top__link $a6'>Explorer</a>
		<ul>
			<li><a href='".$site."cats' class='nav-top__link'>" . $Language->Kitty . "</a></li>
			<li><a href='".$site."explorer/transaction' class='nav-top__link'>Transaction</a></li>
			<li><a href='".$site."explorer/generator' class='nav-top__link'>Generator</a></li>
			<li><a href='".$site."rss' class='nav-top__link'>RSS</a></li>
		</ul>
	</li>
";
if ($m == 2)
	{
		$menu .= "
		<li><a href='".$site."exit.php' class='nav-top__link'>" . $Language->Exit . "</a></li>
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