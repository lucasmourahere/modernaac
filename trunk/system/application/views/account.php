<?php 
	echo "<h2>Hello $loggedUser</h2>";
	echo "<a href='".WEBSITE."/index.php/character/create_character'>Create character</a><br />";
	echo "<a href='".WEBSITE."/index.php/account/logout'>Logout</a>";
	echo "<table width='100%'>";
	echo "<tr><td><center><b>Name</b></center></td><td><center><b>Level</b></center></td></tr>";
	foreach($characters as $row) {
	
		echo "<tr><td><center><a href='character/view/$row->name'>$row->name</a></center></td><td><center>$row->level</center></td></tr>";
	
	}
	echo "</table>";
?>