<?php 
require("config.php");
foreach($news['news'] as $value) {
	echo "<div class='news'>";
	echo "<div class='newsTitle'>".$value['title']."</div>";
	echo "<div class='newsBody'>".$value['body']."</div>";
	echo "<div class='newsFooter'>Posted on: ".UNIX_TimeStamp($value['time'])."</div>";
	echo "</div>";
}


	echo "<div class='readArchive'><a href='".WEBSITE."/index.php/home/archive'>Go to archive posts</a></div>";
?>