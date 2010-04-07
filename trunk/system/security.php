<?php 

@mysql_connect(HOSTNAME, USERNAME, PASSWORD);
@mysql_select_db(DATABASE);
	foreach($_POST as $key=>$value) {
		$_POST[$key] = mysql_real_escape_string($value);
	}
	foreach($_GET as $key=>$value) {
		$_GET[$key] = mysql_real_escape_string($value);
	}
	foreach($_REQUEST as $key=>$value) {
		$_REQUEST[$key] = mysql_real_escape_string($value);
	}

?>