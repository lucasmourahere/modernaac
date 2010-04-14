<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erwin Aligam - ealigam@gmail.com" />
<meta name="Robots" content="index,follow" />

<link rel="stylesheet" href="{$path}/templates/default/images/Refresh.css" type="text/css" />
{$head}

<title>{$title}</title>
	
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
				<li id="current"><a href="{$path}">Home</a></li>
				{if $logged == 1}
					<li><a href="{$path}/index.php/account">Account</a></li>
				{else}
					<li><a href="{$path}/index.php/account/create">Create Account</a></li>
					<li><a href="{$path}/index.php/account/login">Login</a></li>
				{/if}
				<li><a href="{$path}/index.php/character/view">Characters</a></li>
				<li><a href="{$path}/index.php/character/online">Who is Online</a></li>
				<li><a href="{$path}/index.php/guilds">Guilds</a></li>
				<li><a href="{$path}/index.php/highscores">Highscores</a></li>	
				<li><a href="{$path}/index.php/forum">Forum</a></li>		
				<li><a href="{$path}/index.php/bugtracker">Bug Tracker</a></li>	
			</ul>
		</div>					
			
		<!-- content-wrap starts here -->
		<div id="content-wrap">
				
			<div id="sidebar">
				{$online}
				<h1>Sidebar Menu</h1>
				<div class="left-box">
					<ul class="sidemenu">				
						{if $logged == 1}
						<li><a href="?p=account">Account</a></li>
						{else}
						<li><a href="?p=account&s=create">Create Account</a></li>
						<li><a href="?p=account&s=login">Login</a></li>
						{/if}
						<li><a href="?p=character">Characters</a></li>
						<li><a href="?p=guilds">Guilds</a></li>
					</ul>	
				</div>
			
				
				
				
				
			</div>
				
			<div id="main" style='padding-top: 10px;'>
				{$main}
			</div>
		
		<!-- content-wrap ends here -->	
		</div>
					
		<!--footer starts here-->
		<div id="footer">
				Page rendered in: {$renderTime}
		</div>	

<!-- wrap ends here -->
</div>

</body>
</html>
