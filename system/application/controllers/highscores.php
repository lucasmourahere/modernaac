<?php
/*This controller will not use model for basic DB access for gathering information about stastitics, the database access will be made within thin controller!
There is no point of using model for such simple DB access.*/

class Highscores extends Controller {

	public function index() {
		require("config.php");
		$this->load->database();
		if(@$_REQUEST['world'] == 0) $world = 0;
		else $world = (int)@$_REQUEST['world'];	
		$skill = (int)@$_REQUEST['skill'];
		$ide = new IDE;
		$data = array();
		$data['players'] = array();
		$data['world'] = $world;
			switch(@$_REQUEST['skill']) {
				case 1:
					$sql = $this->db->query('SELECT name,online,level,experience,vocation,promotion, world_id FROM players WHERE players.world_id LIKE "'.$world.'" AND players.deleted = 0 AND players.group_id < '.$config['players_group_id_block'].' AND name != "Account Manager" ORDER BY level DESC, experience DESC LIMIT 50')->result();
					foreach($sql as $cmd){ $data['players'][] = array("name"=>$cmd->name,"online"=>$cmd->online,"level"=>$cmd->level,"experience"=>$cmd->experience,"vocation"=>$cmd->vocation,"promotion"=>$cmd->promotion, "world_id"=>$cmd->world_id); }
					$data['type'] = "Experience";
				break;
				case 2:
					$sql = $this->db->query('SELECT name,online,value,level,vocation,promotion FROM players,player_skills WHERE players.world_id = '.$world.' AND players.deleted = 0 AND players.group_id < '.$config['players_group_id_block'].' AND players.id = player_skills.player_id AND player_skills.skillid = 0 ORDER BY value DESC, count DESC LIMIT 50')->result();
					foreach($sql as $cmd){ $data['players'][] = array("name"=>$cmd->name,"online"=>$cmd->online,"value"=>$cmd->value,"level"=>$cmd->level,"vocation"=>$cmd->vocation,"promotion"=>$cmd->promotion); }
					$data['type'] = "Fist Fighting";
				break;
				case 3:
					$sql = $this->db->query('SELECT name,online,value,level,vocation,promotion FROM players,player_skills WHERE players.world_id = '.$world.' AND players.deleted = 0 AND players.group_id < '.$config['players_group_id_block'].' AND players.id = player_skills.player_id AND player_skills.skillid = 1 ORDER BY value DESC, count DESC LIMIT 50')->result();
					foreach($sql as $cmd){ $data['players'][] = array("name"=>$cmd->name,"online"=>$cmd->online,"value"=>$cmd->value,"level"=>$cmd->level,"vocation"=>$cmd->vocation,"promotion"=>$cmd->promotion); }
					$data['type'] = "Club Fighting";
				break;
				case 4:
					$sql = $this->db->query('SELECT name,online,value,level,vocation,promotion FROM players,player_skills WHERE players.world_id = '.$world.' AND players.deleted = 0 AND players.group_id < '.$config['players_group_id_block'].' AND players.id = player_skills.player_id AND player_skills.skillid = 2 ORDER BY value DESC, count DESC LIMIT 50')->result();
					foreach($sql as $cmd){ $data['players'][] = array("name"=>$cmd->name,"online"=>$cmd->online,"value"=>$cmd->value,"level"=>$cmd->level,"vocation"=>$cmd->vocation,"promotion"=>$cmd->promotion); }
					$data['type'] = "Sword Fighting";
				break;
				case 5:
					$sql = $this->db->query('SELECT name,online,value,level,vocation,promotion FROM players,player_skills WHERE players.world_id = '.$world.' AND players.deleted = 0 AND players.group_id < '.$config['players_group_id_block'].' AND players.id = player_skills.player_id AND player_skills.skillid = 3 ORDER BY value DESC, count DESC LIMIT 50')->result();
					foreach($sql as $cmd){ $data['players'][] = array("name"=>$cmd->name,"online"=>$cmd->online,"value"=>$cmd->value,"level"=>$cmd->level,"vocation"=>$cmd->vocation,"promotion"=>$cmd->promotion); }
					$data['type'] = "Axe Fighting";
				break;
				case 6:
					$sql = $this->db->query('SELECT name,online,value,level,vocation,promotion FROM players,player_skills WHERE players.world_id = '.$world.' AND players.deleted = 0 AND players.group_id < '.$config['players_group_id_block'].' AND players.id = player_skills.player_id AND player_skills.skillid = 4 ORDER BY value DESC, count DESC LIMIT 50')->result();
					foreach($sql as $cmd){ $data['players'][] = array("name"=>$cmd->name,"online"=>$cmd->online,"value"=>$cmd->value,"level"=>$cmd->level,"vocation"=>$cmd->vocation,"promotion"=>$cmd->promotion); }
					$data['type'] = "Distance Fighting";
				break;
				case 7:
					$sql = $this->db->query('SELECT name,online,value,level,vocation,promotion FROM players,player_skills WHERE players.world_id = '.$world.' AND players.deleted = 0 AND players.group_id < '.$config['players_group_id_block'].' AND players.id = player_skills.player_id AND player_skills.skillid = 5 ORDER BY value DESC, count DESC LIMIT 50')->result();
					foreach($sql as $cmd){ $data['players'][] = array("name"=>$cmd->name,"online"=>$cmd->online,"value"=>$cmd->value,"level"=>$cmd->level,"vocation"=>$cmd->vocation,"promotion"=>$cmd->promotion); }
					$data['type'] = "Shielding";
				break;
				case 8:
					$sql = $this->db->query('SELECT name,online,value,level,vocation,promotion FROM players,player_skills WHERE players.world_id = '.$world.' AND players.deleted = 0 AND players.group_id < '.$config['players_group_id_block'].' AND players.id = player_skills.player_id AND player_skills.skillid = 6 ORDER BY value DESC, count DESC LIMIT 50')->result();
					foreach($sql as $cmd){ $data['players'][] = array("name"=>$cmd->name,"online"=>$cmd->online,"value"=>$cmd->value,"level"=>$cmd->level,"vocation"=>$cmd->vocation,"promotion"=>$cmd->promotion); }
					$data['type'] = "Fishing";
				break;
				case 9:
					$sql = $this->db->query('SELECT name,online,maglevel,level,vocation,promotion FROM players WHERE players.world_id = '.$world.' AND players.deleted = 0 AND players.group_id < '.$config['players_group_id_block'].' AND name != "Account Manager" ORDER BY maglevel DESC, manaspent DESC LIMIT 50')->result();
					foreach($sql as $cmd){ $data['players'][] = array("name"=>$cmd->name,"online"=>$cmd->online,"maglevel"=>$cmd->maglevel,"level"=>$cmd->level,"vocation"=>$cmd->vocation,"promotion"=>$cmd->promotion); }
					$data['type'] = "Magic level";
				break;
				default:
					$sql = $this->db->query('SELECT name,online,level,experience,vocation,promotion, world_id FROM players WHERE players.world_id LIKE "'.$world.'" AND players.deleted = 0 AND players.group_id < '.$config['players_group_id_block'].' AND name != "Account Manager" ORDER BY level DESC, experience DESC LIMIT 50')->result();
					foreach($sql as $cmd){ $data['players'][] = array("name"=>$cmd->name,"online"=>$cmd->online,"level"=>$cmd->level,"experience"=>$cmd->experience,"vocation"=>$cmd->vocation,"promotion"=>$cmd->promotion, "world_id"=>$cmd->world_id); }
					$data['type'] = "Experience";
				break;
			}
		
			
		$this->load->helper("form");
		$this->load->view("highscores", $data);
	}
}