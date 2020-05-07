<?php
include('../config/config.php');
include('old_function.php');
	session_start();
	session_unset();
	session_destroy();
	header_lol($site);