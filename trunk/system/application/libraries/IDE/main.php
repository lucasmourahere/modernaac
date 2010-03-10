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
	
	public function loadInjections($name) {
		if(is_dir("injections/$name"))
			foreach (glob("injections/$name/*.php") as $injection) {
				include_once($injection);
			}
		else
			throw new exception("Could not load injections! Event Folder not found. ErrCode: 172610032010");
	}
	
}
?>