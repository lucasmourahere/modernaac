<?php
require("system/system.php");
auth();
$db = new database();
$return = array();
$sql = $db->query("SELECT `name`, `level`, `world_id` FROM `players` WHERE `online` = '1'");
	while($cmd = $sql->fetch_array()) {
		$return[] = array("name"=>$cmd['name'], "level"=>$cmd['level'], "world_id"=>$cmd['world_id']);
	}
echo json_encode($return);