<?php
$Language = Language('Russian');

$address = User::Nick($nick)->address;
$array_cats = Cats::Address($address);

$result = (count($array_cats)-1);
$countq = ceil(($result+1)/12);

echo "<center><h2><b>$nick</b></h2></center><hr>";
foreach ($array_cats as $value => $kity) {
	$value++;
	if ($value == 1) {
	$id = 1;
	echo '<div class="cat_content_none"><div class="cat_content" id="page-'.$id.'">';
	}

	$img = $kity->img;
	$cat = Cats::Img($img);
	
	$series = $cat->series;
	$rarity = ($cat->rarity)*100;
	$price = $cat->value;
	$name1 = $cat->name;
	$count = $cat->count;
	$gender = $cat->gender;
	$color = $cat->color;
	
	$name2 = $kity->name;
	if (($name2 != '') and ($name2 != null)) {$name = $name2;} else {$name = $name1;}
	if ($pricebd == '') {$bgimg = ''; $prr = $price;} else {$bgimg = '<font color="red"><b>(Sale)</b></font>'; $prr = "<font color='red'><b>$pricebd</b></font>";}
		if ($gender == '0') {$gender = '';}
	
	echo "
	<div class='cat_block' style='background: $color'>
		<div class='cat_img'>
			<picture>
			<source srcset='$cat->webp' type='image/webp'>
			<img src='$cat->png'>
			</picture>
		</div>
		<div class='cat_text'>
			<b>$name</b> $gender
			<hr>
			$Language->Number_of_cats_of_this_breed <b>$count</b><br>
			$Language->Chance_of_falling_out : <b>$rarity%</b><br>
			<b>$price</b> MINTERCAT
			<br>
		</div>
	</div>";
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
					1 ". $language['page_of'] ." ". $countq."
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

					$('#page-counter').html(currentPage + ' ". $language['page_of'] ." ' + maxPage);

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

					$('#page-counter').html(currentPage + ' ". $language['page_of'] ." ' + maxPage);

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