<?php 
class IDE{
	public function requireLogin() {
		requireLogin();
	}
	
	public function redirect($link, $time = null) {
		if(empty($time))
		header('Location: '.$link.'');
		else 
		echo '<meta http-equiv="refresh" content="'.$time.';url='.$link.'" />';
	}
	
	public function isLogged() {
		if(@$_SESSION['logged'] == 1) return true; else return false;
	}
	
	public function dir_list($d){ 
       foreach(array_diff(scandir($d),array('.','..')) as $f)
			if(is_dir($d.'/'.$f))$l[]=$f; 
			return @$l; 
	} 
	
	public function isAdmin() {
		if(@$_SESSION['admin'] != 1) return false; else return true;
	}
	
	public function loadInjections($name) {
		if(is_dir("injections/$name")) {
			$folders = $this->dir_list("injections/$name");
			if(count($folders) != 0) {
				foreach($folders as $injection) {
					if(!file_exists("injections/$name/$injection/injection.php"))
						continue;
					else
						include("injections/$name/$injection/injection.php");
				}
			}
				else return false;
			}
		else
			throw new exception("Could not load injections! Injection Folder not found. (".$name.") ErrCode: 172610032010");
	}
	
	public function requireAdmin() {
		if($_SESSION['admin'] != 1)
			$this->redirect(WEBSITE."/index.php/account/login");
		else
			return true;
	}
	
	public function system_stop() {
		DEFINE("SYSTEM_STOP", 1);
	}
	
	public function criticalRedirect($url) {
		echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
		exit;
	}
	
}
?>