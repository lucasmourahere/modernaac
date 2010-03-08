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
	
}
?>