<?php
echo "
<meta charset='utf-8'>
<link rel='icon' href='".$site."img/favicon.png'>
<link rel='stylesheet' href='".$site."css/styles.min.css'>
<link rel='stylesheet' href='".$site."css/style_header.css'>
<link rel='stylesheet' href='".$site."css/style_menu.css'>
<link rel='stylesheet' href='".$site."css/pagination.css'>
<link rel='stylesheet' href='".$site."css/lk.css'>
<link rel='stylesheet' href='".$site."css/social.css'>
  
<link rel='stylesheet' href='".$site."css/normalize.css'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
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