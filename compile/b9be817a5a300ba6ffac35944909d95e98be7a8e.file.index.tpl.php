<?php /* Smarty version Smarty3-b7, created on 2010-03-05 19:23:09
         compiled from "templates/default\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104874b915a1d11a1d5-28651053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9be817a5a300ba6ffac35944909d95e98be7a8e' => 
    array (
      0 => 'templates/default\\index.tpl',
      1 => 1267816987,
    ),
  ),
  'nocache_hash' => '104874b915a1d11a1d5-28651053',
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
				
			<h1 id="logo-text">re<span class="gray">fresh</span></h1>		
			<h2 id="slogan">put your site slogan here...</h2>
				
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
				<li><a href="guilds">Guilds</a></li>
				<li><a href="index.html">About</a></li>		
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
			
				<h1>Site Partners</h1>
				<div class="left-box">
					<ul class="sidemenu">
   					<li><a href="http://www.dreamhost.com/r.cgi?287326">Dreamhost</a></li>
						<li><a href="http://www.4templates.com/?aff=ealigam">4templates</a></li>
						<li><a href="http://store.templatemonster.com/?aff=ealigam">TemplateMonster</a></li>	
						<li><a href="http://www.fotolia.com/partner/114283">Fotolia.com</a></li>									
						<li><a href="http://www.text-link-ads.com/?ref=40025">Text Link Ads</a></li>
  					</ul>	
				</div>
				
				<h1>Wise Words</h1>
				<div class="left-box">
					<p>&quot;To be concious that you are ignorant of the
					facts is a great step to knowledge&quot; </p>
					
					<p class="align-right">- Benjamin Disraeli</p>
				</div>	
				
				<h1>Support Styleshout</h1>
				<div class="left-box">
					<p>If you are interested in supporting my work and would like to contribute, you are
					welcome to make a small donation through the 
					<a href="http://www.styleshout.com/">donate link</a> on my website - it will 
					be a great help and will surely be appreciated.</p>
				</div>
							
				
			</div>
				
			<div id="main" style='padding-top: 10px;'>
				<?php echo $_smarty_tpl->getVariable('main')->value;?>

			</div>
		
		<!-- content-wrap ends here -->	
		</div>
					
		<!--footer starts here-->
		<div id="footer">
			
			<p>
			&copy; 2006 <strong>Your Company</strong> | 
			Design by: <a href="http://www.styleshout.com/">styleshout</a> | 
			Valid <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | 
			<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
			
   		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			<a href="index.html">Home</a>&nbsp;|&nbsp;
   		<a href="index.html">Sitemap</a>&nbsp;|&nbsp;
	   	<a href="index.html">RSS Feed</a>
   		</p>
				Page rendered in: <?php echo $_smarty_tpl->getVariable('renderTime')->value;?>

		</div>	

<!-- wrap ends here -->
</div>

</body>
</html>
