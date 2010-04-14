<?php

class Account_model extends Model {

	function __construct() {
		parent::__construct();
	}

	function check_login() {
		require("config.php");
		$this->load->database();
		$sql = $this->db->query("SELECT `id`, page_access FROM `accounts` WHERE `name` = '".$_POST['name']."' AND `password` = '".$_POST['pass']."'");
		$row = $sql->row_array();
			if(!empty($row)) {
			$_SESSION['account_id'] = $row['id'];
			$_SESSION['access'] = $row['page_access'];
				if($row['page_access'] >= $config['adminAccess'])
					$_SESSION['admin'] = 1;
				else
					$_SESSION['admin'] = 0;
			}
		if($sql->num_rows == 0) return false; else return true;
	}
	
	function getRecoveryKey($name) {
		$this->load->database();
		$sql = $this->db->query("SELECT `key` FROM `accounts` WHERE `name` = '$name'")->row_array();
		return $sql['key'];
	}
	
	function generateKey($name) {
		$this->load->database();
		$key = rand(1000,9999).'-'.rand(1000,9999).'-'.rand(1000,9999).'-'.rand(1000,9999);
		$this->db->query("UPDATE `accounts` SET `key` = '$key' WHERE `name` = '$name'");
		return $key;
	}
	
	public function getAccountID() {
		$this->load->database();
		$sql = $this->db->query("SELECT `id` FROM `accounts` WHERE `name` = '".$_SESSION['name']."'")->row_array();
		return (int)$sql['id'];
	}
	
	public function getCharacters() {
		$this->load->database();
		 return $this->db->query("SELECT `id`, `name`, `level` FROM `players` WHERE `account_id` = '".$_SESSION['account_id']."'")->result();
	}
}

?>