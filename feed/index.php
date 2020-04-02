<?php
//========================================
echo "<title>MinterCat | Feed</title>";
$titles = 'Feed';
$m = 0;
//-------------------------------
include('../header2.php');
echo '<br>';

function TGgetUpdates()
{
	include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/config.php');
	$data = file_get_contents('https://api.telegram.org/bot'.$token_feed_bot.'/getUpdates');
    $tg_array = json_decode($data)->result;
	return array_reverse($tg_array);
}
function TGgetFile($photo)
{
	include(explode('public_html', $_SERVER['DOCUMENT_ROOT'])[0] . 'config/config.php');
	$file_path = json_decode(file_get_contents('https://api.telegram.org/bot'.$token_feed_bot.'/getFile?file_id='. $photo))->result->file_path;
	$data = 'https://api.telegram.org/file/bot'.$token_feed_bot.'/'. $file_path;
	return $data;
}

echo '
<div class="cat_content_none">
<div class="explorer_content">
';
$i=1;
foreach (TGgetUpdates() as $value => $test) {
	$value++;
	$text = $test->channel_post->text;
	
	$photo = json_decode(json_encode($test->channel_post->photo),true);
	if ($photo != '') {
		$caption = $test->channel_post->caption;
		$file_id = $photo[0]['file_id'];
		$data = TGgetFile($file_id);
		$width = $photo[0]['width'];
		$height = $photo[0]['height'];
	}
	
	$id = $test->channel_post->chat->id;
	//if ($id == '-1001304129205')
	if ($id == '-1001482536175')
	{
		$i++;
		echo '
		<div class="feed_block">
		<div class="explorer_block_header">MinterCat</div>
		<div class="explorer_block_content">
		<br>
		';
		if ($photo != '') {
			echo "<img src='".$data."' width='".$width."' height='".$height."'><br>";
			echo $caption;		
			}
			else {
				echo $text;
			}
		
		echo '</div></div>';
		if ($i > 5) {break;}
	}
}
//-------------------------------
echo '</div></div><br><br><br>';
include('../footer.php');