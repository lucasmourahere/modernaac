<?php 
class IDE{
	public function requireLogin() {
		requireLogin();
	}
	
	public function redirect($link) {
		header('Location: '.$link.'');
	}
	
	public function isLogged() {
		if($_SESSION['logged'] == 1) return true; else return false;
	}
	
	public function dir_list($d){ 
       foreach(array_diff(scandir($d),array('.','..')) as $f)
			if(is_dir($d.'/'.$f))$l[]=$f; 
			return $l; 
	} 
	
	public function loadInjections($name) {
		if(is_dir("injections/$name")) {
				foreach($this->dir_list("injections/$name") as $injection) {
					if(!file_exists("injections/$name/$injection/injection.php"))
						continue;
					else
						include("injections/$name/$injection/injection.php");
				}
			}
		else
			throw new exception("Could not load injections! Event Folder not found. ErrCode: 172610032010");
	}
	
}
?>