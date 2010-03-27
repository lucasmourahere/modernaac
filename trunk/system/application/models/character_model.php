<?php

class Character_model extends Model {
	public function getAccountID() {
		$this->load->database();
		$sql = $this->db->query("SELECT `id` FROM `accounts` WHERE `name` = '".$_SESSION['name']."'")->row_array();
		return (int)$sql['id'];
	}
	
	public function getPlayersOnline() {
		$this->load->database();
		@$world = (int)$_REQUEST['world'];
		@$order = $_REQUEST['sort'];
		if(!empty($world))
			$w = "AND `world_id` = '$world'";	
		if(!empty($order)) 
			$o = "ORDER BY `$order` DESC";
		return @$this->db->query("SELECT `name`, `vocation`, `world_id`, `level` FROM `players` WHERE `online` = '1' $w $o")->result();
	}
	
	
	
}

?>