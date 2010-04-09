<?php 

class Forum_model extends Model {
	public function getBoards() {
		$ide = new IDE;
		$access = ($ide->isLogged()) ? $_SESSION['access'] : 0;
		$logged = ($ide->isLogged()) ? "" : "AND `requireLogin` != '1'";
			$this->load->database();
		return $this->db->query("SELECT `b`.`id`, `b`.`name`, `b`.`description`, `b`.`closed`, `b`.`moderators`, `u`.`name` AS `author`, `p`.`thread_id`, `t`.`name` AS `thread_title`, `p`.`time` FROM `forums` AS `b` LEFT JOIN (SELECT `time`, `thread_id`, `board_id`, `author` FROM `posts` ORDER BY `time` DESC) AS `p` ON `p`.`board_id` = `b`.`id` LEFT JOIN `players` AS `u` ON `u`.`id` = `p`.`author` LEFT JOIN `threads` AS `t` ON `t`.`id` = `p`.`thread_id` WHERE `b`.`access` <= '".$access."' ".$logged." GROUP BY `b`.`id` ORDER BY `b`.`order` ASC;")->result_array();
	}
	
	public function getBoardInfo($id) {
		$this->load->database();
		return @$this->db->query("SELECT `name`, `description`, `id`, `closed`, `moderators`, `requireLogin`, `access` FROM `forums` WHERE `id` = ".$id)->result_array();
	}
	
	public function getThreads($id) {
		require("config.php");
		$this->load->helper("url");
		$page = $this->uri->segment(4);
			$page = (empty($page)) ? 0 : $page;
		$this->load->database();
		return @$this->db->query("SELECT `t`.`id`, `t`.`name`, `t`.`sticked`, `t`.`closed`, `u`.`name` AS `author`, `p`.`time` AS `post_time`, `p`.`author` AS `post_author`
FROM `threads` AS `t`
LEFT JOIN (SELECT `time`, `thread_id`, (SELECT `name` FROM `players` WHERE `id` = `author`) AS `author` FROM `posts` ORDER BY `time` DESC) AS `p` ON `p`.`thread_id` = `t`.`id`
LEFT JOIN `players` AS `u` ON `u`.`id` = `t`.`author`
WHERE `t`.`board_id` = ".$id." GROUP BY `t`.`id` ORDER BY `t`.`sticked` DESC, `post_time` DESC LIMIT ".$page.", ".$config['threadsLimit'].";")->result_array();
	}
	
	public function getThreadsAmount($id) {
		$this->load->database();
		return @$this->db->query("SELECT `id` FROM `threads` WHERE `board_id` = '".$id."'")->num_rows;
	}
	
	public function getPosts($id) {
		require("config.php");
		$this->load->helper("url");
		$page = $this->uri->segment(4);
			$page = (empty($page)) ? 0 : $page;
		$this->load->database();
		return @$this->db->query("SELECT `p`.`title`, `p`.`text`, `p`.`time`, `u`.`name` AS `author`, `p`.`board_id`, `p`.`id` FROM `posts` AS `p` LEFT JOIN `players` AS `u` ON `u`.`id` = `p`.`author` WHERE `p`.`thread_id` = ".$id." ORDER BY `p`.`id` ASC LIMIT ".$page.", ".$config['postsLimit'])->result_array();
	}
	
	public function getPostsAmount($id) {
		$this->load->database();
		return @$this->db->query("SELECT `id` FROM `posts` WHERE `thread_id` = '".$id."'")->num_rows;
	}
	
	public function getThreadInfo($id) {
		$this->load->database();
		return $this->db->query("SELECT `id`, `name`, `sticked`, `closed`, `author`, `time`, `board_id` FROM `threads` WHERE `id` = ".$id)->result_array();
	}
	
	public function getCharacters() {
		$this->load->database();
		return $this->db->query("SELECT `id`, `name` FROM `players` WHERE `account_id` = '".$_SESSION['account_id']."'")->result_array();
	}
	
	public function characterExistsOnAccount($id) {
		$this->load->database();
		if($this->db->query("SELECT `id` FROM `players` WHERE `id` = '".$id."' AND `account_id` = '".$_SESSION['account_id']."'")->num_rows == 0) return false; else return true;
	}
	
	public function postThread($board, $character, $title, $body) {
		$this->load->database();
		$time = time();
		$sql = $this->db->query("INSERT INTO `threads` (`id`, `name`, `sticked`, `closed`, `author`, `time`, `board_id`) VALUES('', '".$title."', '0', '0', '".$character."', '".$time."', '".$board."')");
		$this->db->query("INSERT INTO `posts` (`id`, `title`, `text`, `time`, `author`, `board_id`, `thread_id`) VALUES('', '".$title."', '".$body."', '".$time."', '".$character."', '".$board."', LAST_INSERT_ID())");
	}
	
	public function postReply($board, $thread, $character, $title, $body) {
		$this->load->database();
		$time = time();
		$this->db->query("INSERT INTO `posts` (`id`, `title`, `text`, `time`, `author`, `board_id`, `thread_id`) VALUES('', '".$title."', '".$body."', '".$time."', '".$character."', '".$board."', '".$thread."')");
		$this->db->query("UPDATE `threads` SET `time` = '".$time."' WHERE `id` = '".$thread."'");	
	}
	
	public function isModerator($list, $characters) {
		$moderators = explode(",", $list);
		return (in_array($moderators[0], $characters[0])) ? true : false;
	}
	
	public function getPostInfo($id) {
		$this->load->database();
		return $this->db->query("SELECT `id`, `title`, `text`, `time`, `author`, `board_id`, `thread_id` FROM `posts` WHERE `id` = '".$id."'")->result_array();
	}
	
	public function isAuthor($id) {
		$this->load->database();
		return ($this->db->query("SELECT `id` FROM `players` WHERE `id` = '".$id."' AND `account_id` = '".$_SESSION['account_id']."'")->num_rows == 0) ? false : true;
	}
	
	public function editPost($id, $title, $body) {
		$this->load->database();
		$this->db->query("UPDATE `posts` SET `title` = '".$title."', `text` = '".$body."' WHERE `id` = '".$id."'");
	}
	
	public function deletePost($id) {
		$post = $this->getPostInfo($id);
		$thread = $this->db->query("SELECT `id` FROM `posts` WHERE `thread_id` = '".$post[0]['thread_id']."'")->num_rows;
			if($thread <= 1)
				$this->db->query("DELETE FROM `threads` WHERE `id` = '".$post[0]['thread_id']."'");
		$this->db->query("DELETE FROM `posts` WHERE `id` = '".$id."'");
	}
	
	public function deleteThread($id) {
		$this->load->database();
		$this->db->query("DELETE FROM `posts` WHERE `thread_id` = '".$id."'");
		$this->db->query("DELETE FROM `threads` WHERE `id` = '".$id."'");
	}
	
	public function getBoardsName() {
		$this->load->database();
		return $this->db->query("SELECT `id`, `name` FROM `forums`")->result_array();
	}
	
	public function createBoard($name, $description, $access, $closed, $order, $login, $moderators) {
		$this->load->database();
		$this->db->query("INSERT INTO `forums` (`id`, `name`, `description`, `access`, `closed`, `moderators`, `order`, `requireLogin`) VALUES('', '".$name."','".$description."','".$access."','".$closed."', '".$moderators."', '".$order."', '".$login."')");
	}
	
	public function fetchBoard($id) {
		$this->load->database();
		return $this->db->query("SELECT * FROM `forums` WHERE `id` = '".$id."'")->result_array();
	}
	
	public function editBoard($id, $name, $description, $access, $closed, $order, $login, $moderators) {
		$this->load->database();
		$this->db->query("UPDATE `forums` SET `name` = '".$name."', `description` = '".$description."', `access` = '".$access."', `closed` = '".$closed."', `order` = '".$order."', `requireLogin` = '".$login."', `moderators` = '".$moderators."' WHERE `id` = '".$id."'");
	}
	
	public function deleteBoard($id) {
		$this->load->database();
		$this->db->query("DELETE FROM `posts` WHERE `board_id` = '".$id."'");
		$this->db->query("DELETE FROM `threads` WHERE `board_id` = '".$id."'");
		$this->db->query("DELETE FROM `forums` WHERE `id` = '".$id."'");
	}
}

?>