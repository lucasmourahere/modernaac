<?php
require("config.php");
$ide = new IDE;
try {$ide->loadInjections("latest_deaths");} catch(Exception $e) {error($e->getMessage()); }
echo form_open('latest_deaths');
	if(count($config['worlds']) > 1) {
		echo "<b>World</b>&nbsp;&nbsp;";
		echo "<select name='world'>";
		foreach($config['worlds'] as $id=>$name) {
			echo "<option value='$id'>$name</option>";
		}
		echo "</select>";
	}

	echo "<br />Latest deaths<br />";

?>