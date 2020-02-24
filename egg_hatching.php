<?php
$arr2[] = "1001";
$arr2[] = "1002";
$arr2[] = "1003";
$arr2[] = "1004";
$arr2[] = "1005";
$arr2[] = "1006";
$arr2[] = "1007";
$arr2[] = "1008";
$arr2[] = "1009";
$arr2[] = "1010";

$q = array_rand($arr2);
$arr[] = $arr2[$q];
	
	
if ($fishtail >= 1)
{
	$arr[] = "35";
	$arr[] = "36";
	$arr[] = "37";
	$arr[] = "38";
}

if ($tentacles >= 1)
{
	$arr[] = "55";
	$arr[] = "56";
}

if ($horns >= 1)
{
	$arr[] = "57";
	$arr[] = "58";
	$arr[] = "59";
	$arr[] = "60";
	$arr[] = "65";
	$arr[] = "66";
	$arr[] = "67";
	$arr[] = "68";
	$arr[] = "69";
}

if ($fishtail >= 2)
{
	$arr[] = "3";
	$arr[] = "3";
}

if ($tentacles >= 2)
{
	$arr[] = "4";
	$arr[] = "41";
	$arr[] = "42";
	$arr[] = "43";
	$arr[] = "44";
	$arr[] = "4";
	$arr[] = "41";
	$arr[] = "42";
	$arr[] = "43";
	$arr[] = "44";
}

if ($horns >= 2)
{
	$arr[] = "22";
	$arr[] = "22";
}

if (($fishtail >= 1) and ($tentacles >= 1))
{
	$arr[] = "49";
}

if (($fishtail >= 1) and ($horns >= 1))
{
	$arr[] = "50";
}

if (($tentacles >= 1) and ($horns >= 1))
{
	$arr[] = "51";
	$arr[] = "52";
	$arr[] = "53";
	$arr[] = "54";
}

if (($tentacles >= 1) and ($horns >= 1) and ($fishtail >= 1))
{
	$arr[] = "45";
	$arr[] = "46";
	$arr[] = "47";
	$arr[] = "48";
}

if (($fishtail == 4) and ($tentacles == 9) and ($horns == 1))
{
	$arr[] = "5";
}

if (($fishtail == 0) and ($tentacles == 4) and ($horns == 3))
{
	$arr[] = "30";
}

$a = array_rand($arr);
$img = $arr[$a];
