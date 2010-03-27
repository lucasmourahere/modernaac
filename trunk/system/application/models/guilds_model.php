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
	
	public function getCharactersAllowedToCreateGuild($level = 0) {
		$this->load->database();
		$characters = array();
		$sql = $this->db->query("SELECT `id`, `name`, `level` FROM `players` WHERE `rank_id` = '0' AND `level` >= '{$level}' AND `account_id` = '{$_SESSION['account_id']}'")->result();
		foreach($sql as $cmd) {
			$characters[] = array('id'=>$cmd->id, 'name'=>$cmd->name,'level'=>$cmd->level);
		}
		return $characters;
	}
	
	public function checkPlayerCreatingGuild($id) {
		require_once("system/application/config/create_character.php");
		$this->load->database();
		$sql = $this->db->query("SELECT `id` FROM `players` WHERE `id` = '$id' AND `level` >= '".LEVELTOCREATEGUILD."' AND `account_id` = '{$_SESSION['account_id']}'")->row_array();
		if(count($sql) == 0) return false; else return true;
	}
	
	public function checkGuildName($name) {
		$this->load->database();
		$name = $this->db->escape($name);
		$sql = $this->db->query('SELECT `id` FROM `guilds` WHERE `name` = "'.$name.'"')->row_array();
		if(count($sql) == 0) return true; else return false;
	
	}
	
	public function createGuild($name, $character) {
		$ots = POT::getInstance();
		$ots->connect(POT::DB_MYSQL, connection());
		$player = new OTS_Player();
		$player->load($character);
		$new_guild = new OTS_Guild();
		$new_guild->setCreationData(time());
		$new_guild->setName($name);
		$new_guild->setOwner($player);
		$new_guild->save();
		$new_guild->setCustomField('motd', 'New guild. Leader must edit this text :)');
		$new_guild->setCustomField('creationdata', time());
		$new_guild->setCustomField('world_id', $player->getWorld());
		$ranks = $new_guild->getGuildRanksList();
		$ranks->orderBy('level', POT::ORDER_DESC);
		foreach($ranks as $rank)
			if($rank->getLevel() == 3)
			{
				$player->setRank($rank);
				$player->save();
			}
		$ide = new IDE;
		$ide->redirect(WEBSITE."/index.php/guilds/view/".$new_guild->getId());
		success("$name has been created.");
	}
	
	
}

?>