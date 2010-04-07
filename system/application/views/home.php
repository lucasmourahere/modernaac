<?php 
require("config.php");
$ide = new IDE;
try { $ide->loadInjections("home"); }catch(Exception $e) { error($e->getMessage());}
foreach($news['news'] as $value) {
	echo "<div class='news'>";
	echo "<div class='newsTitle'>".$value['title']."</div>";
	echo "<div class='newsBody'>".$value['body']."</div>";
	echo "<div class='newsFooter'>Posted on: ".UNIX_TimeStamp($value['time'])." </div>";
	echo "<div class='viewComments'><a href='".WEBSITE."/index.php/home/view/".$value['id']."'>View comments</a></div>";
	echo "</div>";
}


	echo "<div class='readArchive'><a href='".WEBSITE."/index.php/home/archive'>Go to archive posts</a></div>";
?>