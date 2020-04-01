<?php
echo '<br>';
$db_rss = new RSS();
$result = $db_rss->query('SELECT * FROM "table" ORDER BY id DESC LIMIT 10');
$i = 0;
while ($data = $result->fetchArray(1))
{
	 $id=$data['id'];
     $title=$data['title'];
     $text=$data['text'];
     $date=$data['date'];
     $author=$data['author'];
     $additionally=$data['additionally'];
     $c1=$data['c1'];
     $c2=$data['c2'];
     $c3=$data['c3'];

	if ($title == 'Transfer')
		{
			echo "
			<a href='".$site."explorer?nick=$author' target='_blank'>$author</a> -> <a href='".$site."explorer?nick=$additionally' target='_blank'>$additionally</a> $title Cat <a href='".$site."cat/?id=$c1' target='_blank'>$c1</a>
			";
		}
	elseif ($title == 'Create')
		{
			echo "
			<a href='".$site."explorer?nick=$author' target='_blank'>$author</a> $title Cat <a href='".$site."cat/?id=$c1' target='_blank'>$c1</a>
			";
		}
	elseif ($title == 'Crossed')
		{
			echo "
			<a href='".$site."explorer?nick=$author' target='_blank'>$author</a> $title <a href='".$site."cat/?id=$c2' target='_blank'>$c2</a> with <a href='".$site."cat/?id=$c3' target='_blank'>$c3</a> Cat <a href='".$site."cat/?id=$c1' target='_blank'>$c1</a>
			";
		}
	elseif ($title == 'Crafted')
		{
			echo "
			<a href='".$site."explorer?nick=$author' target='_blank'>$author</a> $title Cat <a href='".$site."cat/?id=$c1' target='_blank'>$c1</a>
			";
		}
	else //($title == 'Bought')
		{
			echo "
			SHOP -> <a href='".$site."explorer?nick=$author' target='_blank'>$author</a> $title Cat <a href='".$site."cat/?id=$c1' target='_blank'>$c1</a>
			";
		}
   echo "<br><br><hr><br>";
   $i += 1;
}