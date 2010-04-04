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
	echo "<table width=100%><tr><h1>Latest deaths on ".$config['server_name']."</h1></tr><tr>";
	echo "<td width=30%>Date</td>";
	echo "<td width=70%>Info:</td>";
	echo "</tr>";
	foreach ($deaths as $print)
	{
				echo "<tr><td>".date("j.m.Y, G:i:s",$print['date'])."</td>";
				echo $print['players_rows']."</tr>";
	}
	echo "</table>"; 
?>