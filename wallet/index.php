<?php
include('../header.php');
//-------------------------------
$mnemonic = $decript['mnemonic'];
echo "
<div class='cat_content_none'><div class='cat_content'>
		address: <b><a href='https://minterscan.net/address/$address' target='_blank'>$address</a> (MinterScan.net)</b>
		<br>
		mnemonic: <b>$mnemonic</b>
		<br>
		private key: <b>$private_key</b>
		<br>
		<br>
		<br>
		<br>
</div></div>
		";
//-------------------------------
include('../footer.php');