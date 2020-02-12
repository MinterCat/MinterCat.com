<?php
$id = $_GET['id'];
$db_cats = new Cats();
$result = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id);
$payloads1 = $result->fetchArray(1);

$addr = $payloads1['addr'];

if ($addr == '') {header('Location: '.$site.'profile'); exit;}
$img = $payloads1['img'];

$json4 = file_get_contents($site.'api?img='.$img);
$payloads4 = json_decode($json4,true);

	$pricebd = $payloads1['price'];

	$cats = $payloads4['cats'];
			
	$series = $cats[0]['series'];
	$rarity = $cats[0]['rarity'];
	$rarity = $rarity * 100;
	$price = $cats[0]['price'];
	$name1 = $cats[0]['name'];
	$count = $cats[0]['count'];
	$gender = $cats[0]['gender'];

$name2 = $payloads1['name'];
if (($name2 != '') or ($name2 != null)) {$name = $name2;} else {$name = $name1;}

switch ($series) 
{
	case 0: {$u = '#C1B5FF'; break;}
	case 1: {$u = '#FFF6B5'; break;}
	case 2: {$u = '#FFB5B5'; break;}
	case 3: {$u = '#C7F66F'; break;}
	case 4: {$u = '#FFC873'; break;}
	case 5: {$u = '#6AF2D7'; break;}
	case 999: {$u = '#9BF5DA'; break;}
}
/*
$db_gen = new Gen();
$result2 = $db_gen->query('SELECT * FROM "table" WHERE stored_id=' . $id);
$payloadsID = $result2->fetchArray(1);	

$fishtail = $payloadsID['fishtail'];
$tentacles = $payloadsID['tentacles'];
$horns = $payloadsID['horns'];


$json2 = file_get_contents($api."/block?height=$id");
$payloads2 = json_decode($json2,true);

$data = $payloads2['result']['time'];

$nd = explode('T', $data)[0];
$timestamp2 = date('Y-m-d',strtotime(explode('T', $data)[0]));
		
$unixD = strtotime($timestamp2);
$nd = date('d.m.Y', $unixD);
*/
if ($gender == '♂') {
	$gender_p = $language['Male'] . " ($gender)";
}
if ($gender == '♀') {
	$gender_p = $language['Female'] . " ($gender)";
}
if ($gender == '0') {
	$gender_p = $language['Undefined'];
}
if ($pricebd == '') {$bgimg = ''; $pr = $price;} else {$bgimg = '<font color="red"><b>(Продается)</b></font>'; $pr = $pricebd;}
//if($addr == $address){
echo "
<center>
	<div style='background: $u' width='100%' height='300'>
			<picture>
			<source srcset='".$site."img/Cat$img.webp' type='image/webp' width='350' height='350'>
			<img src='".$site."png.php?png=$img' width='350' height='350'>
			</picture><br>
	</div>
			#$id<br>
			<b>$name</b>
			<hr>
			" . $language['Cat_created'] . " <b>$nd</b>, " . $language['in_block'] . " <b>#$id</b> <br>
" . $language['Chance_of_falling_out'] . " <b>$rarity%</b><br>
" . $language['gender'] . ": $gender_p<br>
" . $language['Number_of_cats_of_this_breed'] . " <b>$count</b><br>
<br>
"; 


if ($pricebd != '') {echo "Price in shop: <b>$pr</b> $coin<br><br>";}
echo $language['Approximate_cost'] . " <b>$price</b> $coin<br><br>
";
echo '<br><br><br><br><br><br><br>';
	/*
if ($gender != '0') {
if (isset($_GET['send2']))
	{
		echo "
		<form>
		<p>
		<input id='nik' name='nik' type='text' value='' placeholder='NickName' maxlength='15' size='12'>
		<input id='send' name='send' type='submit' value='" . $language['Send'] . "'>
		<input id='back' name='back' type='submit' value='" . $language['Cancel'] . "'>
		<input id='id' name='id' type='hidden' value='$id'>
		</p>
		</form>
		";
	}
else
	{
		if (isset($_GET['sale']))
					{
						echo "
						<form'>
						<p>
						<input id='price' name='price' type='number' value='' placeholder='Price' maxlength='7' size='12'>
						<input id='sendprice' name='sendprice' type='submit' value='" . $language['Send'] . "'>
						<input id='back' name='back' type='submit' value='" . $language['Cancel'] . "'>
						<input id='id' name='id' type='hidden' value='$id'>
						</p>
						</form>
						";
					}
				else
					{			$id = $_GET['id'];
								$json10 = file_get_contents("https://mintercat.com/kron/id.php?id=$id");
								$payloads10 = json_decode($json10,true);
								$sale = $payloads10[0]['sale'];
										if ($sale == 1)
											{
												echo "
												<form>
												<input id='send2' name='send2' type='submit' value='" . $language['Send'] . "'>
												<input id='nosale' name='nosale' type='submit' value='" . $language['Not_sell'] . "'>
												<input id='id' name='id' type='hidden' value='$id'>
												</form>
												";
											}
										else
											{
												echo "
												<form>
												<input id='send2' name='send2' type='submit' value='" . $language['Send'] . "'>
												<input id='sale' name='sale' type='submit' value='" . $language['Sell'] . "'>
												<input id='id' name='id' type='hidden' value='$id'>
												</form>
												";
											}
					}
					if (isset($_GET['back']))
						{
							header("Location: $site/profile"); exit;
						}		
				
	}
}else{
$jsonblock = file_get_contents($api.'/status');
$status = json_decode($jsonblock,true);
$blocks = $status['result']['latest_block_height'];
$block = $block+1;
$eggblock = $blocks - $id;
										if ($eggblock >= 17280)
											{
												echo "
												<br>
												<form action=''>
												<input id='in' name='in' type='submit' value='" . $language['Hatching_egg'] . "'>
												<input id='id' name='id' type='hidden' value='$id'>
												";
												if (($fishtail == 4) and ($tentacles == 9) and ($horns == 1))
												{
												echo "
												<input id='craft' name='craft' type='submit' value='" . $language['Craft'] . "'>
												<p>" . $language['Attention_The_cost_of_crafting'] . " <b>500</b> $coin.</p>
												";
												}
												if (($fishtail == 0) and ($tentacles == 4) and ($horns == 3))
												{
												echo "
												<input id='craft' name='craft' type='submit' value='" . $language['Craft'] . "'>
												<p>" . $language['Attention_The_cost_of_crafting'] . " <b>500</b> $coin.</p>
												";
												}
												echo "
												</form>
												";
											}
}

}else{
	$sale = $payloads1['sale'];
		echo "
<center>
	<div style='background: $u' width='100%' height='300'>
			<picture>
			<source srcset='../img/Cat$img.webp' type='image/webp' width='350' height='350'>
			<img src='../png.php?png=$img' width='350' height='350'>
			</picture><br>
	</div>
			#$id<br>
			$name $gender
			<hr>
			" . $language['Cat_created'] . " <b>$nd</b>, " . $language['in_block'] . " <b>#$id</b> <br>
" . $language['Chance_of_falling_out'] . " <b>$rarity%</b><br>
" . $language['gender'] . ": $gender_p<br>
" . $language['Number_of_cats_of_this_breed'] . " <b>$count</b><br>
<br>
" . $language['Approximate_cost'] . " <b>$pr</b> $coin<br><br>
";
if ($sale == 1)
	{
if ($balance > $pricebd) {
echo "
<form'>
   <input id='buy' name='buy' type='submit' value='" . $language['Buy'] . "'>
   <input id='id' name='id' type='hidden' value='$id'>
   <input id='addr' name='addr' type='hidden' value='$addr'>
   <input id='pricebd' name='pricebd' type='hidden' value='$pricebd'>
 </form>
  ";
 }	
	}
}

	echo '<br><br><br><br><br><br><br>
	</center>';
*/