<?php 

class home_model extends Model {
	
	public function getAllNews() {
		require("config.php");
		$this->load->database();
		$sql = $this->db->query("SELECT `id`, `title`, `body`, `time` FROM `news` ORDER BY id DESC LIMIT ".$config['newsLimit']."");
		$ret['amount'] = $sql->num_rows;
		$ret['news'] = $sql->result_array();
		return $ret;
	}
	
	public function getArchiveNews() {
		require("config.php");
		$this->load->helper("url");
		$page = $this->uri->segment(3);
			$page = (empty($page)) ? 0 : $page;
		$this->load->database();
		$sql = $this->db->query("SELECT `id`, `title`, `body`, `time` FROM `news` ORDER BY id DESC LIMIT ".$page.", ".$config['newsLimit']."");
		$ret['amount'] = $sql->num_rows;
		$ret['news'] = $sql->result_array();
		return $ret;
	}
	
	public function getNewsAmount() {
		$this->load->database();
		return $this->db->query("SELECT `id` FROM `news`")->num_rows;
	}
	
	public function loadNews($id) {
		$this->load->database();
		$sql = $this->db->query("SELECT `title`, `body`, `time` FROM `news` WHERE `id` = '".$id."'");
			if($sql->num_rows == 0)
				return false;
			else
				return $sql->result_array();
	}
	
	public function getComments($id) {
		require("config.php");
		$this->load->database();
		$this->load->helper("url");
		$page = $this->uri->segment(4);
		$page = (empty($page)) ? 0 : $page;
		return $this->db->query("SELECT `id`, `body`, `time`, `author` FROM `comments` WHERE `news_id` = '".$id."' ORDER BY id DESC LIMIT ".$page.", ".$config['commentLimit'])->result_array();
	}
	
	public function getCommentsAmount($id) {
		$this->load->database();
		return $this->db->query("SELECT `id` FROM `comments` WHERE `news_id` = ".$id)->num_rows;
	}
	
	public function getCharacters() {
		$this->load->database();
		return @$this->db->query("SELECT `name` FROM `players` WHERE `account_id` = '".$_SESSION['account_id']."'")->result_array();
	}
	
	public function playerExistsOnAccount($name) {
		$this->load->database();
		if($this->db->query("SELECT `id` FROM `players` WHERE `name` = '".$name."' AND `account_id` = '".$_SESSION['account_id']."'")->num_rows == 0) return false; else return true;
	}
	
	public function addComment($id, $character, $body) {
		$this->load->database();
		$this->db->query("INSERT INTO `comments` (`id`, `news_id`, `body`, `time`, `author`) VALUES ('', '".$id."', '".$body."', '".time()."', '".$character."')");
	}
	
	public function getComment($id) {
		$this->load->database();
		return $this->db->query("SELECT `body`, `author`, `time`, `news_id` FROM `comments` WHERE `id` = '".$id."'")->result_array();
	}
	
	public function deleteComment($id) {
		$this->load->database();
		$this->db->query("DELETE FROM `comments` WHERE `id` = '".$id."'");
	}
	

	
}

?>