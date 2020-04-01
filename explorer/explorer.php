<?php
echo "
<script type='text/javascript' src='".$site."static/js/jquery-3.4.1.min.js'></script>
<div id='content'></div>
	<script>
		function show()
		{
			$.ajax({
				url: 'count.php',
				cache: false,
				success: function(html){
					$('#content').html(html);
				}
			});
		}



		$(document).ready(function(){
			show();
			setInterval('show()',1000);
		});
	</script>

<div class='cat_content_none'>
<div class='explorer_content'>
<div class='explorer_block'>
<div class='explorer_block_header'><a href='transaction' style='text-decoration: none; color: black;'>Transaction</a></div>
<div class='explorer_block_content' style='overflow: auto;'>
";
include('transaction/content.php');
echo '</div></div>';
//-----------------------------------
echo '
<div class="explorer_block">
<div class="explorer_block_header">Users</div>
<div class="explorer_block_content">
';
$db_users = new Users();
$arr = array('Russian', 'Ukrainian', 'Bulgarian', 'Chinese', 'English', 'French', 'Hebrew', 'Igbo', 'Indonesian', 'Spanish', 'Yoruba');
$push='';
$summ=0;
//-----------------------------------
$data = $db_users->query('SELECT COUNT(*) FROM "table"')->fetchArray(1);
$Total = $data['COUNT(*)'];
//-----------------------------------
$countarr = count($arr)-1;
for ($i = 0; $i <= $countarr; $i++)
{
	$Lng = $arr[$i];
	$data = $db_users->query('SELECT COUNT(*) FROM "table" WHERE language="'.$Lng.'"')->fetchArray(1);
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
