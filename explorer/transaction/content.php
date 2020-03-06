<?php
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