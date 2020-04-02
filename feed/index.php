<?php
//========================================
echo "<title>MinterCat | Feed</title>";
$titles = 'Feed';
$m = 0;
//-------------------------------
include('../header2.php');
echo '<br>';
function TG()
{
	$data = file_get_contents('https://api.telegram.org/'.$token_feed_bot.'/getUpdates');
    $tg_array = json_decode($data)->result;
	return array_reverse($tg_array);
}

echo '
<div class="cat_content_none">
<div class="explorer_content">
';
$i=1;
foreach (TG() as $value => $test) {
	$value++;
	$id = $test->channel_post->chat->id;
	if ($id == '-1001304129205')
	{
		$i++;
		echo '
		<div class="feed_block">
		<div class="explorer_block_header">MinterCat</div>
		<div class="explorer_block_content">
		<br>
		';
		echo $text = $test->channel_post->text;
		echo '</div></div>';
		if ($i > 5) {break;}
	}
}
//-------------------------------
echo '</div></div><br><br><br>';
include('../footer.php');