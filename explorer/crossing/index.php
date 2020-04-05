<?php
//========================================
echo "<title>MinterCat | Explorer</title>";
$titles = 'Explorer';
$m = 6;
//-------------------------------

echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8'>
  <title>MinterCat | Explorer</title>
  <link rel='shortcut icon' href='".$site."static/img/icons/Cats.webp'>
  <link rel='stylesheet' href='".$site."static/css/styles.min.css'>
  <link rel='stylesheet' href='".$site."static/css/style_header.css'>
  <link rel='stylesheet' href='".$site."static/css/style_menu.css'>
  <link rel='stylesheet' href='".$site."static/css/pagination.css'>
  <link rel='stylesheet' href='".$site."static/css/lk.css'>
  <link rel='stylesheet' href='".$site."static/css/normalize.css'>
  <link rel='stylesheet' href='".$site."static/css/dragndrop_main.css'>
  <link rel='stylesheet' href='".$site."static/css/dragndrop_scale.css'>
  <script src='".$site."static/js/dragndrop/ba3a0add07.js' crossorigin='anonymous'></script>
  <script src='".$site."static/js/dragndrop/jquery-3.4.1.min.js'></script>
  <script src='".$site."static/js/dragndrop/jquery-ui.min.js'></script>
  <script src='".$site."static/js/dragndrop/popper.min.js'></script>
  <script src='".$site."static/js/dragndrop/tippy-bundle.iife.min.js'></script>
  <script src='".$site."static/js/dragndrop/jquery.ui.touch-punch.min.js'></script>
  <link rel='stylesheet' href='".$site."static/css/social.css'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
  <div class='cat_header'>
	<div class='header'>
		<div class='logo_float'>
			<div class='logo_cat'>
				<a href='#'>
					<div class='logo__img'></div>
					<span class='logo__text'><div class='logo_text'>Minter</div>
					<span class='logo__text-dark'><div class='logo_text_2'>Cat Explorer</div></span></span>
				</a>
			</div>
			<div class='head_menu'>
$menu
			</div>
		</div>
	</div>

      <form method='post'>
        <div class='drop-areas'>
          <div class='drop-area-container'>
            <div class='drop-area' id='drop-area-1'>
              <h1 class='gender-logo'>♀</h1>
            </div>
            <input type='text' class='drop-area-info' id='drop-area-1-input' name='cat-1' value='' readonly='readonly' required style='border: none;'>
          </div>
          <div class='heart'>
            <button type='submit' class='heart-button' id='heart-btn' name='button' data-tippy-content='Отлично! Нажми сюда, чтобы скрестить!' disabled style='border: none;'>
            <i class='fas fa-heart'></i></button>
          </div>
          <div class='drop-area-container'>
            <div class='drop-area' id='drop-area-2'>
              <h1 class='gender-logo'>♂</h1>
            </div>
            <input type='text' class='drop-area-info' id='drop-area-2-input' name='cat-2' value='' readonly='readonly' required style='border: none;'>
          </div>
        </div>
	  </form>
";

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
	$name = $kity['name'];
	$count = $kity['count'];
	$img = $kity['img'];
	$gender = $kity['gender'];
	$color = $kity['color'];

if ($img != '') {
if ($gender == '♀') {$gender_number = 1;}
if ($gender == '♂') {$gender_number = 0;}
echo "
	<div class='cat_block' style='background: $color'>
		<div class='cat_img' data-id='$name' data-gender='$gender_number'>
			<picture>
			<source srcset='".$site."static/img/Cat$img.webp' type='image/webp'>
			<img src='".$site."png.php?png=$img'>
			</picture>
		</div>
		<div class='cat_text'>
			<b>$name ($gender)</b>
			<hr>
			" . $language['Number_of_cats_of_this_breed'] . " <b>$count</b><br>
			" . $language['Chance_of_falling_out'] . ": <b>$rarity%</b><br>
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
					1 ". $language['page_of'] ." ". $countq."
				</div>
				<button type='button' id='next-page-btn'>»</button>
			</div>
		</div>
		<br><br><br><br>
";
echo "
<script type='text/javascript'>
  var tooltip = tippy(document.getElementById('heart-btn'));
  var droppedMale;
  var droppedFemale;
  var draggableItems = document.getElementsByClassName('cat_img');
  for (var i = 0; i < draggableItems.length; i++) {
    $(draggableItems[i]).draggable();
  }
  $('#drop-area-1').droppable({
    drop: function(event, ui) {
      let droppedItem = ui.draggable[0];
      if ($(droppedItem).attr('data-gender') != '1') {
          droppedItem.style.cssText = 'position: relative; left: 0px; top: 0px;'
      } else {
          if (droppedMale && droppedMale != droppedItem) {
            droppedMale.style.cssText = 'position: relative; left: 0px; top: 0px;'
          }
          droppedMale = droppedItem;
          $('#drop-area-1-input').val($(droppedItem).attr('data-id'));
      }
      showToolTip();
    }
  });
  $('#drop-area-2').droppable({
    drop: function(event, ui) {
      let droppedItem = ui.draggable[0];
      if ($(droppedItem).attr('data-gender') != '0') {
          droppedItem.style.cssText = 'position: relative; left: 0px; top: 0px;'
      } else {
          if (droppedFemale && droppedFemale != droppedItem) {
            droppedFemale.style.cssText = 'position: relative; left: 0px; top: 0px;'
          }
          droppedFemale = droppedItem;
          $('#drop-area-2-input').val($(droppedItem).attr('data-id'));
      }
      if (droppedMale && droppedFemale) {
        $('#heart-btn').attr('disabled', false);
      }
      showToolTip();
    }
  });
  function showToolTip() {
    if (droppedMale && droppedFemale) {
      $('#heart-btn').attr('disabled', false);
      tooltip.show();
    }
  }
</script>
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
//-------------------------------
include('../../footer.php');