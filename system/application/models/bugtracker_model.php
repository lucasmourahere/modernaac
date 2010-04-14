<?php 

class bugtracker_model extends Model {
	
	public function getBugs() {
		require("config.php");
		$this->load->helper("url");
		$page = $this->uri->segment(3);
			$page = (empty($page)) ? 0 : $page;
		$this->load->database();
		return $this->db->query("SELECT bugtracker.id, bugtracker.category, bugtracker.time, bugtracker.title, bugtracker.done, bugtracker.priority, bugtracker.closed, players.name FROM bugtracker LEFT JOIN players ON players.id = bugtracker.author ORDER BY priority DESC LIMIT ".$page.", ".$config['bugtrackerPageLimit']." ")->result_array();
	}
	
	public function getBugsAmount() {
		$this->load->database();
		return $this->db->query("SELECT `id` FROM `bugtracker`")->num_rows;
	}
	
	public function getBug($id) {
	$this->load->database();
		return $this->db->query("SELECT bugtracker.id, bugtracker.text, bugtracker.category, bugtracker.time, bugtracker.title, bugtracker.done, bugtracker.priority, bugtracker.closed, players.name FROM bugtracker LEFT JOIN players ON players.id = bugtracker.author WHERE bugtracker.id = '".$id."'")->result_array();
	}
}

?>