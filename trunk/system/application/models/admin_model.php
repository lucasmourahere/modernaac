<?php 

class Admin_model extends Model {
	
	public function getDatabaseTables() {
		$this->load->database();
		return $sql = $this->db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".DATABASE."'")->result_array();
	}
	
	public function getNewsList() {
		$this->load->helper("url");
		$page = $this->uri->segment(3);
			if(empty($page))
				$page = "0";
		$this->load->database();
		return $this->db->query("SELECT `id`, `title`, `time` FROM `news` LIMIT $page, 10")->result_array();
		
	}
	
	public function getNewsAmount() {
		$this->load->database();
		return $this->db->query("SELECT `id` FROM `news`")->num_rows;
	}
	
	public function addNews($title, $body) {
		$this->load->database();
		$time = time();
		$this->db->query("INSERT INTO `news` (`id`, `title`, `body`, `time`) VALUES ('', '".$title."', '".$body."', '".$time."');");
	}
	
	public function getNews($id) {
		$this->load->database();
			$sql = $this->db->query("SELECT `title`, `body` FROM `news` WHERE `id` = '{$id}'");
		if($sql->num_rows == 0)
			return false;
		else
			return $sql->result_array();
	}
	
	public function editNews($id, $title, $body) {
		$this->load->database();
		$this->db->query("UPDATE `news` SET `title` = '".$title."', `body` = '".$body."' WHERE `id` = '".$id."'");
	}
	
	public function deleteNews($id) {
		$this->load->database();
		$this->db->query("DELETE FROM `news` WHERE `id` = '".$id."'");
	}
	
	public function deleteComments($id) {
		$this->load->database();
		$this->db->query("DELETE FROM `comments` WHERE `news_id` = '".$id."'");
	}
	
}

?>