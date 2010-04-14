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
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em; color:black;"></span> 
				<strong>Error:</strong><br>'.$string.'</p>
			</div>
		</div><br />';
		}
}

function alert($string) {
	if(!empty($string)) {
	$string = str_replace("<p>", "", $string);
	$string = str_replace("</p>", "<br>", $string);
	echo '<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em; font-size: 12px;"> 
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em; color:black;"></span>
				<strong>Alert:</strong><br>'.$string.'</p>
			</div>
		</div><br />';
	}
}

function success($string) {
	if(!empty($string)) {
	$string = str_replace("<p>", "", $string);
	$string = str_replace("</p>", "<br>", $string);
	echo '<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em; font-size: 12px; border-color: green; background: #ecfde8;"> 
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em; color:black;"></span>
				<strong>Success:</strong><br>'.$string.'</p>
			</div>
		</div><br />';
	}
}

function truncateString($text, $nbrChar, $append='...') {
     if(strlen($text) > $nbrChar) {
          $text = substr($text, 0, $nbrChar);
          $text .= $append;
     }
     return $text;
}

function ago( $timestamp )
		{
			if ( $timestamp <= 0 )
			{
				return 'a while ago';
			}
			
			if ( $timestamp > time( ) )
			{
				return 'in the future';
			}

			$current = time( );
			$difference = $current - $timestamp;

			if ( $difference < 60 )
				$interval = 's';
			elseif ( $difference >= 60 and $difference < 60 * 60 )
				$interval = 'n';
			elseif ( $difference >= 60 * 60 and $difference < 60 * 60 * 24 )
				$interval = 'h';
			elseif ( $difference >= 60 * 60 * 24 and $difference < 60 * 60 * 24 * 7 )
				$interval = 'd';
			elseif ( $difference >= 60 * 60 * 24 * 7 and $difference < 60 * 60 * 24 * 30 )
				$interval = 'w';
			elseif ( $difference >= 60 * 60 * 24 * 30 and $difference < 60 * 60 * 24 * 365 )
				$interval = 'm';
			elseif ( $difference >= 60 * 60 * 24 * 365 )
				$interval = 'y';

			switch ( $interval )
			{
				case 'm':
					$months_difference = floor( $difference / 60 / 60 / 24 / 29 );
					while ( mktime( 
						date( 'H', $timestamp ), 
						date( 'i', $timestamp ), 
						date( 's', $timestamp ),
						date( 'n', $timestamp ) + $months_difference,
						date( 'j', $current ),
						date( 'Y', $timestamp )
					) < $current )
					{
						$months_difference++;
					}
					$amount = $months_difference;

					if ( $amount == 12 )
					{
						$amount--;
					}

					return $amount.' month'.( $amount != 1 ? 's' : null ).' ago';
					break;

				case 'y':
					$amount = floor( $difference / 60 / 60 / 24 / 365 );
					return $amount.' year'.( $amount != 1 ? 's' : null ).' ago';
					break;

				case 'd':
					$amount = floor( $difference / 60 / 60 / 24 );
					return $amount.' day'.( $amount != 1 ? 's' : null ).' ago';
					break;

				case 'w':
					$amount = floor( $difference / 60 / 60 / 24 / 7 );
					return $amount.' week'.( $amount != 1 ? 's' : null ).' ago';
					break;

				case 'h':
					$amount = floor( $difference / 60 / 60 );
					return $amount.' hour'.( $amount != 1 ? 's' : null ).' ago';
					break;

				case 'n':
					$amount = floor( $difference / 60 );
					return $amount.' minute'.( $amount != 1 ? 's' : null ).' ago';
					break;

				case 's':
					return $difference.' second'.( $difference != 1 ? 's' : null ).' ago';
					break;
			}
		}

function alertBox($string) {
	echo "<script>alert('$string');</script>";
}

function requireLogin() {
	if(!empty($_SERVER["HTTP_REFERER"]))
		 $_SESSION['forward'] = $_SERVER["HTTP_REFERER"];
	if(empty($_SESSION['logged'])) header('Location: '.WEBSITE.'/index.php/account/login');
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

function bugtracker_getPriority($id) {
	$priority = array(1=>"Low", 2=>"Medium", 3=>"High", 4=>"Urgent");
		if(array_key_exists($id, $priority))
			return $priority[$id];
		else
			return "Error";
}

function bugtracker_getCategory($id) {
	$category = array(1=>"Bugs", 2=>"Ideas", 3=>"Problems");
		if(array_key_exists($id, $category))
			return $category[$id];
		else
			return "Error";
}

function bugtracker_getPriorityImage($id) {
	if($id == 1)
		return "<img src='".WEBSITE."/public/images/bugtracker/low.gif'>";
	else if($id == 2)
		return "<img src='".WEBSITE."/public/images/bugtracker/medium.gif'>";
	else if($id == 3 or $id == 4)
		return "<img src='".WEBSITE."/public/images/bugtracker/high.gif'>";
}
require('IDE/main.php');
?>