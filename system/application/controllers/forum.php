<?php 

class Forum extends Controller {
	
	public function index() {
		$ide = new IDE;
		$ide->redirect(WEBSITE."/index.php/forum/view");
	}
	
	public function view($action = null) {
		if($action == 1) alert("You need to be logged in to access this forum.");
		if($action == 2) alert("You don't have right priviliges to view this forum.");
		$this->load->model("forum_model");
		$data = array();
		$data['boards'] = $this->forum_model->getBoards();
		$this->load->view("forum_main", $data);
	}
	
	public function board($id = null) {
		require("config.php");
		$ide = new IDE;
		if($id == null) $ide->criticalRedirect(WEBSITE."/index.php/forum");
		$this->load->model("forum_model");
		$data = array();
		$this->load->library('pagination');
		$config['base_url'] = WEBSITE.'/index.php/forum/board/'.$id.'/';
		$config['total_rows'] = $this->forum_model->getThreadsAmount($id);
		$config['per_page'] = $config['threadsLimit'];
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config); 
		$data['pages'] = $this->pagination->create_links();
		$data['board'] = $this->forum_model->getBoardInfo($id);
			if($data['board'][0]['requireLogin'] == 1 and $ide->isLogged() == false) $ide->redirect(WEBSITE."/index.php/forum/view/1");
			if($data['board'][0]['access'] > @$_SESSION['access'] and $ide->isLogged() == true) $ide->redirect(WEBSITE."/index.php/forum/view/2");
			if($data['board'][0]['access'] > 0 and $ide->isLogged() == false) $ide->redirect(WEBSITE."/index.php/forum/view/2");
		$data['threads'] = $this->forum_model->getThreads($id);
		
		
		$this->load->view("forum_board_view", $data);
	}
	
	public function thread($id = null) {
		require("config.php");
		$ide = new IDE;
		if(empty($id)) $ide->CriticalRedirect(WEBSITE."/index.php/forum");
		$this->load->model("forum_model");
		$data = array();
		$data['thread'] = $this->forum_model->getThreadInfo($id);
		$data['board'] = $this->forum_model->getBoardInfo($data['thread'][0]['board_id']);
		$this->load->library('pagination');
		$config['base_url'] = WEBSITE.'/index.php/forum/thread/'.$id.'/';
		$config['total_rows'] = $this->forum_model->getPostsAmount($id);
		$config['per_page'] = $config['postsLimit'];
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config); 
		$data['id'] = $id;
		$data['pages'] = $this->pagination->create_links();
		$data['posts'] = $this->forum_model->getPosts($id);
		if($ide->isLogged()) {
			$data['characters'] = $this->forum_model->getCharacters();
			$data['isModerator'] = $this->forum_model->isModerator($data['board'][0]['moderators'], $data['characters']);
		}
		$this->load->view("forum_view_thread", $data);
	}
	
	public function _checkCharacter($id) {
		$this->load->model("forum_model");
		if($this->forum_model->characterExistsOnAccount($id))
			return true;
		else {
			$this->form_validation->set_message('_checkCharacter', 'This character does not belongs to you.');
			return false;
		}
	}
	
	public function _checkTimer() {
		require("config.php");
		$time = time();
			if(empty($_SESSION['lastPost']))
				return true;
			else {
				$difference = $time-$_SESSION['lastPost'];
				if ($difference < $config['timeBetweenPosts'])
				{
					$this->form_validation->set_message('_checkTimer', 'You are doing it too fast, please wait another '.($config['timeBetweenPosts']-$difference).' seconds');
					return false;
				}
				else {
					return true;
				}
			}
	}
	
	public function new_thread($id = null) {
		$ide = new IDE;
		$ide->requireLogin();
		if(empty($id)) $ide->criticalRedirect(WEBSITE."/index.php/forum");
		$this->load->model("forum_model");
		$this->load->library("form_validation");
		$data = array();
		$data['board'] = $this->forum_model->getBoardInfo($id);
			if(count($data['board']) == 0) $ide->redirect(WEBSITE."/index.php/forum");
			if($data['board'][0]['closed'] == 1) {
				if(!$ide->isAdmin()) {
					$ide->redirect(WEBSITE."/index.php/forum/board/".$data['board']['id']);
				}
			}
			if($data['board'][0]['access'] > $_SESSION['access'] && $ide->isAdmin() == false)
				$ide->redirect(WEBSITE."/index.php/forum/board/".$data['board']['id']);	
		if($_POST) {
			$this->form_validation->set_rules('character', 'Character', 'required|callback__checkCharacter');
			$this->form_validation->set_rules('title', 'Title', 'required|min_lenght[3]|max_lenght[64]|callback__checkTimer');
			$this->form_validation->set_rules('post', 'Post', 'required|min_lenght[3]|max_lenght[3000]');
			if($this->form_validation->run() == true) {
				$_SESSION['lastPost'] = time();
				$this->forum_model->postThread($id, $_POST['character'], $_POST['title'], $_POST['post']);
				$ide->redirect(WEBSITE."/index.php/forum/thread/".$board['0']['id']);
			}
		}
		

		$data['id'] = $id;
		$data['characters'] = $this->forum_model->getCharacters();
		$this->load->helper("form_helper");
		$this->load->view("forum_new_thread", $data);
	}
	
	public function reply($id) {
		$ide = new IDE;
		$this->load->model("forum_model");
		$data = array();
		$data['thread'] = $this->forum_model->getThreadInfo($id);
			if(count($data['thread']) == 0) $ide->redirect(WEBSITE."/index.php/forum");
		$data['board'] = $this->forum_model->getBoardInfo($data['thread'][0]['board_id']);
			if($data['thread'][0]['closed'] == 1 && $ide->isAdmin() == false) $ide->redirect(WEBSITE."/index.php/forum");
			if($data['board'][0]['closed'] == 1 && $ide->isAdmin() == false) $ide->redirect(WEBSITE."/index.php/forum");
			if($data['board'][0]['access'] > $_SESSION['access'] && $ide->isAdmin() == false) $ide->redirect(WEBSITE."/index.php/forum");
		$this->load->helper("form_helper");
		$data['id'] = $id;
		$data['characters'] = $this->forum_model->getCharacters();
			$this->load->library("form_validation");
			if(isset($_POST['submit'])) {
				$this->form_validation->set_rules('character', 'Character', 'required|callback__checkCharacter');
				$this->form_validation->set_rules('title', 'Title', 'required|callback__checkTimer');
				$this->form_validation->set_rules('post', 'Post', 'required|min_lenght[3]|max_lenght[3000]');
				if($this->form_validation->run() == true) {
					$_SESSION['lastPost'] = time();
					$this->forum_model->postReply($data['thread'][0]['board_id'], $id, $_POST['character'], $_POST['title'], $_POST['post']);
					$ide->redirect(WEBSITE."/index.php/forum/thread/".$data['thread'][0]['id']);
				}
			}
		$this->load->view("forum_reply", $data);		
	}
	
	public function edit($id) {
		$ide = new IDE;
		$ide->requireLogin();
		$data = array();
		$this->load->model("forum_model");
		$data['post'] = $this->forum_model->getPostInfo($id);
		$data['characters'] = $this->forum_model->getCharacters();
		$data['board'] = $this->forum_model->getBoardInfo($data['post'][0]['board_id']);
		$data['thread'] = $this->forum_model->getThreadInfo($data['post'][0]['thread_id']);
		$data['isModerator'] = $this->forum_model->isModerator($data['board'][0]['moderators'], $data['characters']);
			if(count($data['post']) == 0) $ide->redirect(WEBSITE."/index.php/forum");
			if(!$this->forum_model->isAuthor($data['post'][0]['author'])) $ide->redirect(WEBSITE."/index.php/forum");
			if($data['board'][0]['closed'] == 1 and $data['isModerator'] == false and $ide->isAdmin() == false) $ide->redirect(WEBSITE."/index.php/forum");
			if($data['board'][0]['access'] > $_SESSION['access'] and $data['isModerator'] == false and $ide->isAdmin() == false) $ide->redirect(WEBSITE."/index.php/forum");
			if($data['thread'][0]['closed'] == 1 and $data['isModerator'] == false and $ide->isAdmin() == false) $ide->redirect(WEBSITE."/index.php/forum");
		$data['id'] = $id;
		$this->load->helper("form_helper");
		if($_POST) {
		$this->load->library("form_validation");
			$this->form_validation->set_rules('title', 'Title', 'required|callback__checkTimer');
			$this->form_validation->set_rules('post', 'Post', 'required|min_lenght[3]|max_lenght[3000]');
			if($this->form_validation->run() == true) {
				$_SESSION['lastPost'] = time();
				$this->forum_model->editPost($id, $_POST['title'], $_POST['post']);
				$ide->redirect(WEBSITE."/index.php/forum/thread/".$data['thread'][0]['id']);
			}
		}
		$this->load->view("edit_post", $data);
	}
	
	public function delete_post($id) {
		$ide = new IDE;
		$ide->requireLogin();
		$this->load->model("forum_model");
		$data['post'] = $this->forum_model->getPostInfo($id);
		$data['characters'] = $this->forum_model->getCharacters();
		$data['board'] = $this->forum_model->getBoardInfo($data['post'][0]['board_id']);
		$data['thread'] = $this->forum_model->getThreadInfo($data['post'][0]['thread_id']);
		$data['isModerator'] = $this->forum_model->isModerator($data['board'][0]['moderators'], $data['characters']);
		if(count($data['post']) == 0) $ide->redirect(WEBSITE."/index.php/forum");
		if(!$this->forum_model->isAuthor($data['post'][0]['author'])) $ide->redirect(WEBSITE."/index.php/forum");
		if($data['board'][0]['closed'] == 1 and $data['isModerator'] == false and $ide->isAdmin() == false) $ide->redirect(WEBSITE."/index.php/forum");
		if($data['board'][0]['access'] > $_SESSION['access'] and $data['isModerator'] == false and $ide->isAdmin() == false) $ide->redirect(WEBSITE."/index.php/forum");
		if($data['thread'][0]['closed'] == 1 and $data['isModerator'] == false and $ide->isAdmin() == false) $ide->redirect(WEBSITE."/index.php/forum");
		$this->forum_model->deletePost($id);
		$ide->redirect(WEBSITE."/index.php/forum/board/".$data['board'][0]['id']);
	}
	
	public function delete_thread($id) {
		$ide = new IDE;
		$ide->requireLogin();
		$this->load->model("forum_model");
		$data['thread'] = $this->forum_model->getThreadInfo($id);
		$data['characters'] = $this->forum_model->getCharacters();
		$data['board'] = $this->forum_model->getBoardInfo($data['thread'][0]['board_id']);
		$data['isModerator'] = $this->forum_model->isModerator($data['board'][0]['moderators'], $data['characters']);
		if($data['isModerator'] == false and $ide->isAdmin() == false) $ide->redirect(WEBSITE."/index.php/forum");
		$this->forum_model->deleteThread($id);
		$ide->redirect(WEBSITE."/index.php/forum/board/".$data['thread'][0]['board_id']);
	}
}

?>