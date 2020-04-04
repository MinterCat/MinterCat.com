<?php
//========================================
echo "<title>MinterCat | Feed</title>";
$titles = 'Feed';
$m = 4;
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
$message_id_none = '';
foreach (TGgetUpdates() as $value => $test) {
	$value++;
	
	$edited = $test->edited_channel_post;
	if ($edited) {$channel = $test->edited_channel_post;} else  {$channel = $test->channel_post;}
	
	$message_id = $channel->message_id;
	if ($message_id_none!=$message_id)
	{
	$message_id_none = $message_id;
	$text = $channel->text;
	$text = str_replace("\n", "<br>", $text);
	$photo = json_decode(json_encode($channel->photo),true);
	if ($photo != '') {
		$caption = $channel->caption;
		$caption = str_replace("\n", "<br>", $caption);
		$file_id = $photo[0]['file_id'];
		$data = TGgetFile($file_id);
		$width = $photo[0]['width'];
		$height = $photo[0]['height'];
	}
	
	$id = $channel->chat->id;
	if ($id == '-1001304129205')
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
}
//-------------------------------
echo '</div></div><br><br><br>';
include('../footer.php');