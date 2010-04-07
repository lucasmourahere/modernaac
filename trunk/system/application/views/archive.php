<?php 
echo "<h1>News Archive</h1>";
echo "<center>".$pages."</center>";
foreach($news['news'] as $value) {
	echo "<div class='news'>";
	echo "<div class='newsTitle'>".$value['title']."</div>";
	echo "<div class='newsBody'>".$value['body']."</div>";
	echo "<div class='newsFooter'>Posted on: ".UNIX_TimeStamp($value['time'])."</div>";
	echo "</div>";
}
echo "<center>".$pages."</center>";
?>