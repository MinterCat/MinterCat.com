<?php
echo "
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta http-equiv='X-UA-Compatible' content='ie=edge'>
<link rel='shortcut icon' href='".$site."static/img/icons/Cats.webp'>
<link rel='stylesheet' href='".$site."static/css/styles.min.css'>
<link rel='stylesheet' href='".$site."static/css/style_header.css'>
<link rel='stylesheet' href='".$site."static/css/style_menu.css'>
<link rel='stylesheet' href='".$site."static/css/pagination.css'>
<link rel='stylesheet' href='".$site."static/css/lk.css'>
<link rel='stylesheet' href='".$site."static/css/social.css'>

<link rel='stylesheet' href='".$site."static/css/normalize.css'>
";

echo "
<div class='header'>
		<div class='logo_float'>
			<div class='logo_cat'>
				<a href='#'>
					<div class='logo__img'></div>
					<span class='logo__text'><div class='logo_text'>Minter</div>
					<span class='logo__text-dark'><div class='logo_text_2'>Cat $titles</div></span></span>
				</a>
			</div>
			<div class='head_menu'>
				$menu
			</div>
		</div>
	</div>
";
