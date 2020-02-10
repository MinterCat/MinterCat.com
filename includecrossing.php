<?php
$db_cats = new Cats();

echo "
<link rel='stylesheet' href='".$site."css/slider_style.css'>
<script src='".$site."js/slider_jquery-1.12.4.js'></script>
<script src='".$site."js/slider_jquery-ui.js'></script>
<script src='".$site."js/slider_jquery.ui.touch-punch.min.js'></script>
";

$json_api = JSON($site.'api');

if (isset($_GET['cat1'])) {
		$id1 = $_GET['cat1'];
		if ($id1 != '') {			
		
		$results = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id1);
		$data = $results->fetchArray(1);
		$img1 = $data['img'];
		
		$t1 = "<picture>
  <source srcset='".$site."img/Cat".$img1.".webp' type='image/webp' width='200' height='190'>
  <img src='".$site."img/Cat".$img1.".webp' width='200' height='190'>
</picture>";
}}
 
if (isset($_GET['cat2'])) {
		$id2 = $_GET['cat2'];
		if ($id2 != '') {	
		
		$results = $db_cats->query('SELECT * FROM "table" WHERE stored_id=' . $id2);
		$data = $results->fetchArray(1);
		$img2 = $data['img'];
		
		$t2 = "<picture>
  <source srcset='img/Cat".$img2.".webp' type='image/webp' width='200' height='190'>
  <img src='img/Cat".$img2.".webp' width='200' height='190'>
</picture>";
}}

if ($t1 == '') {
	$t1 = '<h1>♂</h1>';
}

if ($t2 == '') {
	$t2 = '<h1>♀</h1>';
}

$jsonID1 = file_get_contents("https://mintercat.com/gen/id.php?id=$id1");
$payloadsID1 = json_decode($jsonID1,true);

$fishtail1 = $payloadsID1[0]['fishtail'];
$tentacles1 = $payloadsID1[0]['tentacles'];
$horns1 = $payloadsID1[0]['horns'];

$jsonID2 = file_get_contents("https://mintercat.com/gen/id.php?id=$id2");
$payloadsID2 = json_decode($jsonID2,true);

$fishtail2 = $payloadsID2[0]['fishtail'];
$tentacles2 = $payloadsID2[0]['tentacles'];
$horns2 = $payloadsID2[0]['horns'];

echo $text='
<center>
<h1>' . $language['Crossing'] . '</h1><br>
<form action="cross.php">
';

echo $text='
<div id="conteiner">
	<div class="calс_tab calс_tab_1">
		<div class="calс_tab_p_1">
			<div class="calс_tab_p_txt">' . $language['Number_of_hours_for_egg_maturation'] . '</div>
			<div class="calс_tab_p_input"><input id="kolvo" name="kolvo" type="text" class="calс_tab_p_input_val calc_1_val_type_1" value="1"/></div>
		</div><!--calс_tab_p_1-->
		<div class="calс_tab_p_2">
			<div class="calс_tab_slider" data-min="0" data-val="24" data-step="1" data-max="24"></div>
			<div class="calс_tab_slider_grad">
				<div class="calс_tab_slider_num calс_tab_slider_num_1">240 MINTERCAT</div>
				<div class="calс_tab_slider_num calс_tab_slider_num_25">180 MINTERCAT</div>
				<div class="calс_tab_slider_num calс_tab_slider_num_50">120 MINTERCAT</div>
				<div class="calс_tab_slider_num calс_tab_slider_num_75">60 MINTERCAT</div>
				<div class="calс_tab_slider_num calс_tab_slider_num_100">1 MINTERCAT</div>
			</div><!--frontBox_n8_calk_polz_tabl-->
		</div><!--calс_tab_p_2-->
	</div><!--calс_tab_1-->
</div><!--conteiner-->
<script type="text/javascript">
(function($){
$(document).ready(function(){
	$(".calс_tab_slider").each(function(){
		var insert_val=$(this).closest(".calс_tab").find(".calс_tab_p_input_val");
		
		var curr_slide=$(this).slider({
			min:parseInt($(this).attr("data-min")),
			max:parseInt($(this).attr("data-max")),
			step:parseFloat($(this).attr("data-step")),
			value:parseInt($(this).attr("data-val")),
			stop: function(event, ui) {
				insert_val.val(curr_slide.slider("value"));
				//calc(); можно подключить функцию обработки/расчета если надо
			},
			slide: function(event, ui){
				setTimeout(function(){
					insert_val.val(curr_slide.slider("value"));
					//calc(); можно подключить функцию обработки/расчета если надо
				},30);
			}
		});
		
		insert_val.on("change",function(){
			var this_val=$(this).val();
			
			var tmp_1=curr_slide.slider("value");
			var tmp_2=this_val;
		
			if(tmp_1!=tmp_2){
				curr_slide.slider("value",tmp_2);
				//calc(); можно подключить функцию обработки/расчета если надо
			}
		});
		
		insert_val.val($(this).attr("data-val")).trigger("change");
		
	});
});
})(jQuery);
</script>
';

echo $text="
<table><tr>
<td width='240' height='240' bgcolor='#D3EDF6' valign='center' align='center'>
$t1
</td>
<td align='center'>

<picture>
  <source srcset='".$site."img/heart.webp' type='image/webp'>
  <img src='".$site."img/heart.webp'>
</picture>

</td>
<td width='240' height='240' bgcolor='#D3EDF6' valign='center' align='center'>
$t2
</td>
</tr>
<tr>
<td align='center'>
";
if ($t1 != '<h1>♂</h1>') {
	echo "
1
<picture>
  <source srcset='".$site."img/gen/Normal.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Normal' width='25' height='25'>
</picture>
";
}
if ($fishtail1 != 0) {
echo "	
$fishtail1
<picture>
  <source srcset='".$site."img/gen/Fish.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Fish' width='25' height='25'>
</picture>
";
}
if ($tentacles1 != 0) {
echo "	
$tentacles1
<picture>
  <source srcset='".$site."img/gen/Sprut.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Sprut' width='25' height='25'>
</picture>
";
}
if ($horns1 != 0) {
echo "	
$horns1
<picture>
  <source srcset='".$site."img/gen/Horns.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Horns' width='25' height='25'>
</picture>
";
}
echo "
</td>
<td></td>
<td align='center'>
";
if ($t2 != '<h1>♀</h1>') {
	echo "
1
<picture>
  <source srcset='".$site."img/gen/Normal.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Normal' width='25' height='25'>
</picture>
";
}
if ($fishtail2 != 0) {
echo "	
$fishtail2
<picture>
  <source srcset='".$site."img/gen/Fish.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Fish' width='25' height='25'>
</picture>
";
}
if ($tentacles2 != 0) {
echo "	
$tentacles2
<picture>
  <source srcset='".$site."img/gen/Sprut.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Sprut' width='25' height='25'>
</picture>
";
}
if ($horns2 != 0) {
echo "	
$horns2
<picture>
  <source srcset='".$site."img/gen/Horns.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Horns' width='25' height='25'>
</picture>
";
}
echo "
</td>
</tr>
<tr><td align='center'>
<input id='cat1' name='cat1' type='text' value='$id1' readonly class='input'>
</td><td align='center'>
";

if (($t2 != '<h1>♀</h1>') and ($t1 != '<h1>♂</h1>'))
{
	echo $text="
	<input id='crossing' name='crossing' type='submit' value='" . $language['Crossing'] . "' class='input'>
	";
}

echo $text="
   </td><td align='center'>
   <input id='cat2' name='cat2' type='text' value='$id2' readonly class='input'>
   </td>
   </tr>
 </form>
 
 </td></tr></table>
</center>
<br>
";

//------------------------------------------- 

$json1 = file_get_contents("https://mintercat.com/kron/crossing.php?addr=$address");
$payloads1 = json_decode($json1,true);

$result = (count($payloads1)-1);
$countq = ceil(($result+1)/12);
echo '<center><table cellspacing="10"><tr>';
$qid = $_GET['id'];
if ($qid==""){$qid=1;}
$q = ($qid-1)*12; if ($q<0){$q=0;}
$result=($qid*12)-1;
for ($i = $q; $i <= $result; $i++)
{
		$pricebd = $payloads1[$i]['price'];
		$img = $payloads1[$i]['img'];
		$id = $payloads1[$i]['stored_id'];
		
		$cats = $json_api->cats;
		$ccount = (count($cats))-1;
		for ($y = 0; $y<=$ccount;$y++)
			{
				$catimg = $cats[$y]['img'];
				if ($catimg == $img)
					{
						$series = $cats[$y]['series'];
						$rarity = $cats[$y]['rarity'];
						$rarity = $rarity * 100;
						$price = $cats[$y]['price'];
						$name1 = $cats[$y]['name'];
						$count = $cats[$y]['count'];
						$gender = $cats[$y]['gender'];
						
						$name2 = $payloads1[$i]['name'];
						if (($name2 != '') and ($name2 != null)) {$name = $name2;} else {$name = $name1;}
					}
			}		

$json2 = file_get_contents($api."/block?height=$id");
$payloads2 = json_decode($json2,true);

$data = $payloads2['result']['time'];
$nd = explode("T", $data)[0];

$timestamp2 = date('Y-m-d',strtotime("$nd"));
		
$unixDate = strtotime("$timestamp2");
$normalDate = date('d', $unixDate);
		
$unixD = strtotime($timestamp2);
$nd = date('d.m.Y', $unixD);

$jsonID = file_get_contents("https://mintercat.com/gen/id.php?id=$id");
$payloadsID = json_decode($jsonID,true);

$fishtail = $payloadsID[0]['fishtail'];
$tentacles = $payloadsID[0]['tentacles'];
$horns = $payloadsID[0]['horns'];

if ($cats != '') {

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
if ($img != '') {
//-------------------------
	echo "
	<td><div style='background: $u' width='240' height='240'>
		<center>
		";
if ($gender == '♀')
{
	echo "<a href='?id=$qid&cat1=".$_GET['cat1']."&cat2=$id'>";
}
if ($gender == '♂')
{
	echo "<a href='?id=$qid&cat1=$id&cat2=".$_GET['cat2']."'>";
}
echo "<picture>
			<source srcset='img/Cat$img.webp' type='image/webp' width='200' height='190'>
			<img src='png.php?png=$img' width='200' height='190'>
			</picture><br>
		</a>
			#$id<br>
			$name $gender
			<hr>";
echo "
1
<picture>
  <source srcset='".$site."img/gen/Normal.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Normal' width='25' height='25'>
</picture>
";
if ($fishtail != 0) {
echo "	
$fishtail
<picture>
  <source srcset='".$site."img/gen/Fish.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Fish' width='25' height='25'>
</picture>
";
}
if ($tentacles != 0) {
echo "	
$tentacles
<picture>
  <source srcset='".$site."img/gen/Sprut.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Sprut' width='25' height='25'>
</picture>
";
}
if ($horns != 0) {
echo "	
$horns
<picture>
  <source srcset='".$site."img/gen/Horns.webp' type='image/webp' width='25' height='25'>
  <img src='".$site."png2.php?png=Horns' width='25' height='25'>
</picture>
";
}

echo '		<br></center>
		</div>
	</td>';
}
	if ((($i+1) % 4) == 0) {echo '</tr><tr>';}
}}
echo '</tr></table>';
$qidd = $qid-1;
$qiid = $qid+1;

$pp = $_GET['id'];
if ($pp == '') {$pp = 1;}
$ppm1 = $pp - 1;
$ppm2 = $pp - 2;
$ppp1 = $pp + 1;
$ppp2 = $pp + 2;
echo "
<ul class='pagination'>
	<li><a href='#'>$pp " . $language['page_of'] . " $countq</a></li>
  <li><a href='?id=$qidd&cat1=$id1&cat2=$id2'>«</a></li>
  ";
  for ($p = 1; $p <= $countq; $p++)
  {
	  if (($p == $pp) || ($p == $ppm1) || ($p == $ppm2) || ($p == $ppp1) || ($p == $ppp2)) {
	  echo "<li><a href='?id=$p&cat1=$id1&cat2=$id2'>$p</a></li>";}
  }
echo "
<li><a href='?id=$qiid&cat1=$id1&cat2=$id2'>»</a></li>
</ul>
</center>
<br><br><br><br><br><br><br><br><br><br>
";