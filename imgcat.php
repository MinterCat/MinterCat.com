<?php
/*
$wls = 3;
for ($i = 3; $i <= $part; $i++)
{
	$wls = $wls + ($i*2);
}

switch($p) { //sl - слоты в определенной партии
case 1: $sl = $p; $k = 1; break; // в первой партии 1 слот
case 2: $sl = $p; $k = 1; break;// во второй партии 2 слота
default:$sl = $p*2; $k = mt_rand(1,2); break;// в четвертой партии 8 слот и тд
}
*/


$part = 4; //сколько всего партий
$p = mt_rand(1,$part);//выбираем партию
$r = mt_rand(1,100);//Проценты
//================================================
if (($r <= 30) and ($r >= 1))
	{
		$pr = 30;
		switch($p)
		{
			case 1: {
						$array = array(1,101,102,103,104,105);
						$rnd = array_rand($array);
						$q = $array[$rnd];
						break;
					}
			case 2: {
						$array = array(6,61,62,63,64);
						$rnd = array_rand($array);
						$q = $array[$rnd];
						break;
					}
			case 3: {
						if ($k==1)
						{
							$array = array(11,111,112);
							$rnd = array_rand($array);
							$q = $array[$rnd];
						}
						else
						{
							$array = array(12,121,122,123,124);
							$rnd = array_rand($array);
							$q = $array[$rnd];
						}
					break;
					}
			case 4: {
						if ($k==1)
						{
							$q = 21;
						}
						else
						{
							$array = array(24,25);
							$rnd = array_rand($array);
							$q = $array[$rnd];
						}
					break;
					}
		}
	}
//================================================
if (($r <= 60) and ($r >= 31))
	{
		$pr = 30;
		switch($p)
		{
			case 1: {
						$q = 2;
					break;
					}
			case 2: {
						$q = 7;
					break;
					}
			case 3: {
						if ($k==1)
						{
							$q = 13;
						}
						else
						{
							$array = array(14,141);
							$rnd = array_rand($array);
							$q = $array[$rnd];
						}
					break;
					}
			case 4: {
						if ($k==1)
						{
							$q = 26;
						}
						else
						{
							$q = 34;
						}
					break;
					}
		}
	}
//================================================
if (($r <= 90) and ($r >= 61))
	{
		$pr = 30;
		switch($p)
		{
			case 1: {
						$q = 3;
					break;
					}
			case 2: {
						$array = array(8,81,82,83,84);
						$rnd = array_rand($array);
						$q = $array[$rnd];
					break;
					}
			case 3: {
						if ($k==1)
						{
							$array = array(15,151);
							$rnd = array_rand($array);
							$q = $array[$rnd];
						}
						else
						{
							$q = 16;
						}
					break;
					}
			case 4: {
						if ($k==1)
						{
							$array = array(32,33);
							$rnd = array_rand($array);
							$q = $array[$rnd];
						}
						else
						{
							$array = array(27,28,29);
							$rnd = array_rand($array);
							$q = $array[$rnd];
						}
					break;
					}
		}
	}
//================================================
if (($r <= 99) and ($r >= 91))
	{
		$pr = 9;
		switch($p)
		{
			case 1: {
						$array = array(4,41,42,43,44);
						$rnd = array_rand($array);
						$q = $array[$rnd];
					break;
					}
			case 2: {
						$q = 9;
					break;
					}
			case 3: {
						if ($k==1)
						{
							$q = 17;
						}
						else
						{
							$q = 18;
						}
					break;
					}
			case 4: {
						if ($k==1)
						{
							$q = 30;
						}
						else
						{
							$q = 31;
						}
					break;
					}
		}
	}
//================================================
if ($r == 100)
	{
		$pr = 1;
		switch($p)
		{
			case 1: {
						$q = 5;
					break;
					}
			case 2: {
						$q = 10;
					break;
					}
			case 3: {
						if ($k==1)
						{
							$q = 19;
						}
						else
						{
							$q = 20;
						}
					break;
					}
			case 4: {
						if ($k==1)
						{
							$q = 23;
						}
						else
						{
							$array = array(22,60);
							$rnd = array_rand($array);
							$q = $array[$rnd];
						}
					break;
					}
		}
	}
//================================================
/*
if ($rnd == '') {$rnd = 1;}

$sh = ($pr * (1/$rnd) * ($p/$wls)); //rarity - формула шанса выпадения
*/
$json_data = array('static/img'=>$q);
echo json_encode($json_data);
