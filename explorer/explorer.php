<?php
echo "
<div class='cat_content_none'>
<div class='explorer_content'>
<div class='explorer_block'>
<div class='explorer_block_header'>Transaction</div>
<div class='explorer_block_content' style='overflow: auto;'>
";
$db_rss = new RSS();
$result = $db_rss->query('SELECT * FROM "table" ORDER BY id DESC LIMIT 10');
$data = array();
while ($res = $result->fetchArray(1)){array_push($data, $res);}
$i = 0;
echo '<br>';
    while ($result->fetchArray(1))
   {
	 $id=$data[$i]['id'];
     $title=$data[$i]['title'];
     $text=$data[$i]['text'];
     $date=$data[$i]['date'];
     $author=$data[$i]['author'];
     $additionally=$data[$i]['additionally'];
     $c1=$data[$i]['c1'];
     $c2=$data[$i]['c2'];
     $c3=$data[$i]['c3'];
	 
	if ($title == 'Transfer')
		{
			echo "
			<a href='".$site."explorer?nick=$author' target='_blank'>$author</a> -> <a href='".$site."explorer?nick=$additionally' target='_blank'>$additionally</a> $title Cat <a href='".$site."cat/?id=$c1' target='_blank'>$c1</a>
			";
		}
	if ($title == 'Create')
		{
			echo "
			<a href='".$site."explorer?nick=$author' target='_blank'>$author</a> $title Cat <a href='".$site."cat/?id=$c1' target='_blank'>$c1</a>
			";
		}
	if ($title == 'Crossed')
		{
			echo "
			<a href='".$site."explorer?nick=$author' target='_blank'>$author</a> $title <a href='".$site."cat/?id=$c2' target='_blank'>$c2</a> with <a href='".$site."cat/?id=$c3' target='_blank'>$c3</a> Cat <a href='".$site."cat/?id=$c1' target='_blank'>$c1</a>
			";
		}
	if ($title == 'Crafted')
		{
			echo "
			<a href='".$site."explorer?nick=$author' target='_blank'>$author</a> $title Cat <a href='".$site."cat/?id=$c1' target='_blank'>$c1</a>
			";
		}
	if ($title == 'Bought')
		{
			echo "
			SHOP -> <a href='".$site."explorer?nick=$author' target='_blank'>$author</a> $title Cat <a href='".$site."cat/?id=$c1' target='_blank'>$c1</a>
			";
		}
   echo "<br><br><hr><br>";
   $i += 1;
   }
echo '</div></div><div class="explorer_block">
<div class="explorer_block_header">Users</div>
<div class="explorer_block_content">
';
//-----------------------------------
$db_users = new Users();
$arr = array('Russian', 'Ukrainian', 'Bulgarian', 'Chinese', 'English', 'French', 'Hebrew', 'Igbo', 'Indonesian', 'Spanish', 'Yoruba');
$push='';
$summ=0;
//-----------------------------------
$result = $db_users->query('SELECT COUNT(*) FROM "table"');
$data = $result->fetchArray(1);
$Total = $data['COUNT(*)'];
//-----------------------------------
$countarr = count($arr)-1;
for ($i = 0; $i <= $countarr; $i++)
{
	$Lng = $arr[$i];
	$result = $db_users->query('SELECT COUNT(*) FROM "table" WHERE language="'.$Lng.'"');
	$data = $result->fetchArray(1);
	$Language = $data['COUNT(*)'];
	$push .= "['".$Lng."', ".$Language."],";
	$summ += $Language;
}
//-----------------------------------
$Uncertain = $Total - $summ;
//-----------------------------------
echo "
<script src='https://www.google.com/jsapi'></script>
  <script>
   google.load('visualization', '1', {packages:['corechart']});
   google.setOnLoadCallback(drawChart);
   function drawChart() {
    var data = google.visualization.arrayToDataTable([
     ['Язык', 'Кол-во пользователей'],
     $push
	 ['Uncertain',    ".$Uncertain."]
    ]);
    var options = {
     title: 'Users',
     is3D: true,
     pieResidueSliceLabel: 'Uncertain'
    };
    var chart = new google.visualization.PieChart(document.getElementById('users'));
     chart.draw(data, options);
   }
  </script>

  <div id='users' style='width: 460px; height: 400px;'></div>
";
echo '</div></div></div></div></div><br><br><br>';