<?php
session_start();
ob_start();
$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$start = $time; 
/*
|---------------------------------------------------------------
| PHP ERROR REPORTING LEVEL
|---------------------------------------------------------------
|
| By default CI & IDE runs with error reporting set to ALL.  For security
| reasons you are encouraged to change this when your site goes live.
| For more info visit:  http://www.php.net/error_reporting
|
*/
	error_reporting(E_ALL);

/*
|---------------------------------------------------------------
| SYSTEM FOLDER NAME
|---------------------------------------------------------------
|
| This variable must contain the name of your "system" folder.
| Include the path if the folder is not in the same  directory
| as this file.
|
| NO TRAILING SLASH!
|
*/
	$system_folder = "system";

/*
|---------------------------------------------------------------
| APPLICATION FOLDER NAME
|---------------------------------------------------------------
|
| If you want this front controller to use a different "application"
| folder then the default one you can set its name here. The folder 
| can also be renamed or relocated anywhere on your server.
|
|
| NO TRAILING SLASH!
|
*/
	$application_folder = "application";
/* 	
| Define template name
 */
	$template = "default";
	
/* Full website address including HTTP:// Without slash at the end! */
	$website = "http://127.0.0.1/ide";
	
/* Default time zone for the server must be set here. */
	date_default_timezone_set("Europe/London");

/* Set the default title of a website. */
	$title = "Modern AAC - Powered by IDE Engine";
/*
|===============================================================
| END OF USER CONFIGURABLE SETTINGS
|===============================================================
*/


/*
|---------------------------------------------------------------
| SET THE SERVER PATH
|---------------------------------------------------------------
|
| Let's attempt to determine the full-server path to the "system"
| folder in order to reduce the possibility of path problems.
| Note: We only attempt this if the user hasn't specified a 
| full server path.
|
*/
if (strpos($system_folder, '/') === FALSE)
{
	if (function_exists('realpath') AND @realpath(dirname(__FILE__)) !== FALSE)
	{
		$system_folder = realpath(dirname(__FILE__)).'/'.$system_folder;
	}
}
else
{
	// Swap directory separators to Unix style for consistency
	$system_folder = str_replace("\\", "/", $system_folder); 
}

if(!file_exists("templates/$template/index.tpl")) {
	echo "Template could not be loaded."; exit;
}

/*
|---------------------------------------------------------------
| DEFINE APPLICATION CONSTANTS
|---------------------------------------------------------------
|
| EXT		- The file extension.  Typically ".php"
| SELF		- The name of THIS file (typically "index.php")
| FCPATH	- The full server path to THIS file
| BASEPATH	- The full server path to the "system" folder
| APPPATH	- The full server path to the "application" folder
|
*/
define('EXT', '.php');
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('FCPATH', str_replace(SELF, '', __FILE__));
define('BASEPATH', $system_folder.'/');
if (is_dir($application_folder))
{
	define('APPPATH', $application_folder.'/');
}
else
{
	if ($application_folder == '')
	{
		$application_folder = 'application';
	}
	define('APPPATH', BASEPATH.$application_folder.'/');
}

/*
|---------------------------------------------------------------
| LOAD THE FRONT CONTROLLER
|---------------------------------------------------------------
|
| And away we go...
|
*/
require_once(APPPATH.'/libraries/system.php');
require(APPPATH."libraries/POT/OTS.php");
require_once BASEPATH.'codeigniter/CodeIgniter'.EXT;
require_once(APPPATH.'/libraries/Smarty.class.php');
$contents = ob_get_contents();
ob_end_clean();
require_once(APPPATH.'config/database.php');
/* Some basic actions */
if(empty($_SESSION['logged'])) $_SESSION['logged'] = 0;
$smarty = new Smarty;
$smarty->template_dir = "templates/$template";
$smarty->config_dir = ' configs';
$smarty->cache_dir = 'cache';
$smarty->compile_dir = 'compile';
@$logged = ($_SESSION['logged'] == 1) ? 1 : 0;
$head = '<link type="text/css" href="'.$website.'/public/css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" /><script type="text/javascript" src="'.$website.'public/js/jquery-1.3.2.min.js"></script><script type="text/javascript" src="public/js/jquery-ui-1.7.2.custom.min.js"></script>';
$smarty->assign('head', $head);
$smarty->assign('path', $website);
$smarty->assign('logged', $logged);
$smarty->assign('main', $contents);
$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$finish = $time; 
$totaltime = round(($finish - $start), 4); 
$smarty->assign('renderTime', $totaltime);
$smarty->assign('title', $title);
$smarty->display('index.tpl');
/* End of file index.php */
/* Location: ./index.php */