<?php

class Guilds_Model extends Model {
	public function getGuildsList($world_id = null) {
		$this->load->database();
		$ext = (!empty($world_id)) ? "WHERE `world_id` = '$world_id'": "";
		$guilds = array();
		$sql = $this->db->query("SELECT `id`, `world_id`, `name`, `motd` FROM `guilds` $ext")->result();
			foreach($sql as $cmd) {
				$guilds[] = array("id"=>$cmd->id, "world_id"=>$cmd->world_id, "name"=>$cmd->name, "motd"=>$cmd->motd);
			}
		return $guilds;
	}
	
	
}

?>