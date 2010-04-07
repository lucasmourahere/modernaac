<?php 

class home_model extends Model {
	
	public function getAllNews() {
		require("config.php");
		$this->load->database();
		$sql = $this->db->query("SELECT `id`, `title`, `body`, `time` FROM `news` LIMIT ".$config['newsLimit']."");
		$ret['amount'] = $sql->num_rows;
		$ret['news'] = $sql->result_array();
		return $ret;
	}
	
	
}

?>