<?php
$active = 1;
include('../header.php');
//-------------------------------
$mnemonic = $decript['mnemonic'];
echo "
		<center>
		<br><br>
		address: <b><a href='https://minterscan.net/address/$address' target='_blank'>$address</a> (MinterScan.net)</b>
		<br><br>
		mnemonic: <b>$mnemonic</b>
		<br><br>
		private key: <b>$private_key</b>
		<br><br>
		</center>
		";
//-------------------------------
include('../footer.php');