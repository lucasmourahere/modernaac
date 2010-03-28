<?php

$config = array();
$config['server_name'] = "Server Name";
$config['cities'] = array(1=>'Main City');
$config['vocations'] = array(1=>"Sorcerer", 2=>"Druid", 3=>"Paladin", 4=>"Knight");
$config['restricted_names'] = array("gamemaster", "admin", "account manager");
$config['worlds'] = array(0=>"World Name", 1=>"Second World");
$config['groups'] = array(0=>"Player", 2=>"Tutor", 3=>"Senior Tutor", 4=>"Gamemaster", 5=>"Community Manager", 6=>"God");
$config['server_vocations'] = array(1=>"Sorcerer", 2=>"Druid", 3=>"Paladin", 4=>"Knight", 5=>"Master Sorcerer", 6=>"Elder Druid", 7=>"Royal Paladin", 8=>"Elite Knight");
$config['newchar_vocations'][1][0] = "Rook Sample";
$config['newchar_vocations'][1][1] = "Sorcerer Sample";
$config['newchar_vocations'][1][2] = "Druid Sample";
$config['newchar_vocations'][1][3] = "Paladin Sample";
$config['newchar_vocations'][1][4] = "Knight Sample";
$config['levelToCreateGuild'] = 50;
$config['database']['host'] = "localhost";
$config['database']['login'] = "root";
$config['database']['password'] = "kubus00";
$config['database']['database'] = "acc";
$config['layout'] = "default";
$config['website'] = "http://127.0.0.1/ide_aac";
$config['title'] = "Modern AAC - Powered by IDE Engine";
$config['premDays'] = 30;
$startPos['x'] = 1000;
$startPos['y'] = 1000;
$startPos['z'] = 7;

#DON'T TOUCH!
@DEFINE('LEVELTOCREATEGUILD', $config['levelToCreateGuild']);
@DEFINE('PREMDAYS', $config['premDays']);
@DEFINE('HOSTNAME', $config['database']['hostname']);
@DEFINE('USERNAME', $config['database']['login']);
@DEFINE('PASSWORD', $config['database']['password']);
@DEFINE('DATABASE', $config['database']['database']);
@DEFINE('WEBSITE', $config['website']);
?>