<?php

function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}

function error($string) {
	if(!empty($string)) {
	$string = str_replace("<p>", "", $string);
	$string = str_replace("</p>", "<br>", $string);
	echo '<div class="ui-widget">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em; font-size: 12px;"> 
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
				<strong>Error:</strong><br>'.$string.'</p>
			</div>
		</div>';
		}
}

function alert($string) {
	if(!empty($string)) {
	$string = str_replace("<p>", "", $string);
	$string = str_replace("</p>", "<br>", $string);
	echo '<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em; font-size: 12px;"> 
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				<strong>Alert:</strong><br>'.$string.'</p>
			</div>
		</div>';
	}
}

function success($string) {
	if(!empty($string)) {
	$string = str_replace("<p>", "", $string);
	$string = str_replace("</p>", "<br>", $string);
	echo '<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em; font-size: 12px; border-color: green; background: #ecfde8;"> 
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				<strong>Success:</strong><br>'.$string.'</p>
			</div>
		</div>';
	}
}

function alertBox($string) {
	echo "<script>alert('$string');</script>";
}

function requireLogin() {
	if(empty($_SESSION['logged'])) header('Location: account/login');
}

function UNIX_TimeStamp($time) {
	return date("Y-m-d H:i:s",$time);
}

function loadConfig($file) {
	require_once(APPPATH."config/$file.php");
}

function connection() {
	loadConfig('database');
	return array('host' => HOSTNAME, 'user' => USERNAME, 'database' => DATABASE, 'password' => PASSWORD);
}
require('IDE/main.php');
?>