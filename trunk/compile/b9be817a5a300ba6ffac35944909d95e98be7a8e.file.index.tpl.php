<?php /* Smarty version Smarty3-b7, created on 2010-04-06 22:22:52
         compiled from "templates/default\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178634bbba62c4b16f5-79796987%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9be817a5a300ba6ffac35944909d95e98be7a8e' => 
    array (
      0 => 'templates/default\\index.tpl',
      1 => 1270588971,
    ),
  ),
  'nocache_hash' => '178634bbba62c4b16f5-79796987',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erwin Aligam - ealigam@gmail.com" />
<meta name="Robots" content="index,follow" />

<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('path')->value;?>
/templates/default/images/Refresh.css" type="text/css" />
<?php echo $_smarty_tpl->getVariable('head')->value;?>


<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>
	
</head>

<body>

<!-- wrap starts here -->
<div id="wrap">
		<!--header -->
		<div id="header">			
				
			<h1 id="logo-text">Mo<span class="gray">dernAAC</span></h1>		
			<h2 id="slogan">Powered by IDE Engine</h2>
				
			<form class="search" method="post" action="#">
				<p>
	  			<input class="textbox" type="text" name="search_query" value="" />
	 			<input class="button" type="submit" name="Submit" value="Search" />
				</p>
			</form>			
				
		</div>
		
		<!-- menu -->	
		<div  id="menu">
		
			<ul>
				<li id="current"><a href="<?php echo $_smarty_tpl->getVariable('path')->value;?>
">Home</a></li>
				<?php if ($_smarty_tpl->getVariable('logged')->value==1){?>
					<li><a href="<?php echo $_smarty_tpl->getVariable('path')->value;?>
/index.php/account">Account</a></li>
				<?php }else{ ?>
					<li><a href="<?php echo $_smarty_tpl->getVariable('path')->value;?>
/index.php/account/create">Create Account</a></li>
					<li><a href="<?php echo $_smarty_tpl->getVariable('path')->value;?>
/index.php/account/login">Login</a></li>
				<?php }?>
				<li><a href="<?php echo $_smarty_tpl->getVariable('path')->value;?>
/index.php/character/view">Characters</a></li>
				<li><a href="<?php echo $_smarty_tpl->getVariable('path')->value;?>
/index.php/character/online">Who is Online</a></li>
				<li><a href="<?php echo $_smarty_tpl->getVariable('path')->value;?>
/index.php/guilds">Guilds</a></li>
				<li><a href="<?php echo $_smarty_tpl->getVariable('path')->value;?>
/index.php/highscores">Highscores</a></li>		
			</ul>
		</div>					
			
		<!-- content-wrap starts here -->
		<div id="content-wrap">
				
			<div id="sidebar">
				<?php echo $_smarty_tpl->getVariable('online')->value;?>

				<h1>Sidebar Menu</h1>
				<div class="left-box">
					<ul class="sidemenu">				
						<?php if ($_smarty_tpl->getVariable('logged')->value==1){?>
						<li><a href="?p=account">Account</a></li>
						<?php }else{ ?>
						<li><a href="?p=account&s=create">Create Account</a></li>
						<li><a href="?p=account&s=login">Login</a></li>
						<?php }?>
						<li><a href="?p=character">Characters</a></li>
						<li><a href="?p=guilds">Guilds</a></li>
					</ul>	
				</div>
			
				
				
				
				
			</div>
				
			<div id="main" style='padding-top: 10px;'>
				<?php echo $_smarty_tpl->getVariable('main')->value;?>

			</div>
		
		<!-- content-wrap ends here -->	
		</div>
					
		<!--footer starts here-->
		<div id="footer">
				Page rendered in: <?php echo $_smarty_tpl->getVariable('renderTime')->value;?>

		</div>	

<!-- wrap ends here -->
</div>

</body>
</html>
