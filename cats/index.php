<?php
ob_start();
//========================================
echo "<title>MinterCat | Explorer</title>";
$titles = 'Explorer';
$m = 6;
//-------------------------------
include('../header2.php');
//-------------------------------
$json4 = file_get_contents($site.'api');
$payloads4 = json_decode($json4,true);
$cats = $payloads4['cats'];
$result = (count($cats)-1);
$countq = ceil(($result+1)/12);

foreach ($cats as $value => $kity) {
	$value++;
	if ($value == 1) {
	$id = 1;
	echo '<div class="cat_content_none"><div class="cat_content" id="page-'.$id.'">';
	}
	//-------------------------------------------------

	$series = $kity['series'];
	$rarity = ($kity['rarity'])*100;
	$price = $kity['value'];
	$name = $kity['name'];
	$count = $kity['count'];
	$img = $kity['img'];
	$gender = $kity['gender'];
	$color = $kity['color'];

if ($img != '') {

echo "
	<div class='cat_block' style='background: $color'>
		<div class='cat_img'>
			<picture>
			<source srcset='".$site."static/img/Cat$img.webp' type='image/webp'>
			<img src='".$site."png.php?png=$img'>
			</picture>
		</div>
		<div class='cat_text'>
			<b>$name</b> $gender
			<hr>
			" . $Language->Number_of_cats_of_this_breed . " <b>$count</b><br>
			" . $Language->Chance_of_falling_out . ": <b>$rarity%</b><br>
			<b>$price</b> $coin
			<br>
		</div>
	</div>";
}
   //-------------------------------------------------
if ($value % 12 == 0) {
	echo "</div></div>";
	$id++;
	echo '<div class="cat_content_none"><div class="cat_content" id="page-'.$id.'" style="display: none;">';
	}
}
echo "</div></div>";
echo "<br><div class='cat_form'>
			<div class='pagination'>
				<button type='button' id='prev-page-btn' disabled>«</button>
				<div id='page-counter' style='display: inline-block'>
					1 ". $Language->page_of ." ". $countq."
				</div>
				<button type='button' id='next-page-btn'>»</button>
			</div>
		</div>
		<br><br><br><br>
";
echo "
<script type='text/javascript'>
			var maxPage = ".$countq.";
			var currentPage = 1;

			$(document).ready(function() {
				console.log('hi');
				if (currentPage == maxPage) {
					$('#next-page-btn').prop('disabled', true);
				}
				$('#prev-page-btn').click(function() {
					$('#page-' + currentPage).hide();
					console.log(currentPage);
					currentPage--;
					if (currentPage < 1) currentPage = 1;
					$('#page-' + currentPage).show();

					$('#page-counter').html(currentPage + ' ". $Language->page_of ." ' + maxPage);

					if (currentPage == 1) {
						$('#prev-page-btn').prop('disabled', true);
					}
					if (currentPage < maxPage) {
						$('#next-page-btn').prop('disabled', false);
					}
				});
				$('#next-page-btn').click(function() {
					$('#page-' + currentPage).hide();
					currentPage++;
					if (currentPage > maxPage) currentPage = maxPage;
					$('#page-' + currentPage).show();

					$('#page-counter').html(currentPage + ' ". $Language->page_of ." ' + maxPage);

					if (currentPage == maxPage) {
						$('#next-page-btn').prop('disabled', true);
					}
					if (currentPage > 1) {
						$('#prev-page-btn').prop('disabled', false);
					}
				});
			})
		</script>
";
//-------------------------------
include('../footer.php');