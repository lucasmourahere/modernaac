<?php 

class Admin extends Controller {
	
	public function index() {
		$this->output->enable_profiler(TRUE);
		$ide = new IDE;
		$ide->requireAdmin();
		$this->load->view("admin_menu");
		$this->load->view("admin");
	}
	
	public function scaffolding() {
		require("config.php");
		$ide = new IDE;
		$ide->requireAdmin();
		$this->load->helper("form_helper");
		$this->load->model("admin_model");
		$data = array();
		$data['tables'] = $this->admin_model->getDatabaseTables();
			if($_POST) {
				if(empty($_POST['table']))
					error("Please select database name.");	
				else {
					$_SESSION['scaffolding'] = $_POST['table'];
					$ide->redirect(WEBSITE."/index.php/load_scaffolding/".$config['scaffolding_trigger']);
				}
			}
		$this->load->view("admin_menu");
		$this->load->view("scaffolding", $data);
	}
	
	public function news() {
		require("config.php");
		$ide = new IDE;
		$ide->requireAdmin();
		$data = array();
		$this->load->model("admin_model");
		$data['news'] = $this->admin_model->getNewsList();
		$this->load->library('pagination');
		$config['base_url'] = WEBSITE.'/index.php/admin/news/';
		$config['total_rows'] = $this->admin_model->getNewsAmount();
		$config['per_page'] = $config['newsLimit'];
		$this->pagination->initialize($config); 
		$data['pages'] = $this->pagination->create_links();
		$this->load->view("admin_menu");
		$this->load->view("admin_news_show", $data);
	}
	
	public function add_news() {
		$ide = new IDE;
		$ide->requireAdmin();
		$this->load->helper("form_helper");
		$this->load->library("form_validation");
			if($_POST) {
				$this->form_validation->set_rules('title', 'Title', 'required|min_length[2]|max_length[64]');
				$this->form_validation->set_rules('body', 'Body', 'required');
				if($this->form_validation->run() == true) {
					$body = $_POST['body'];
					$body = str_replace('/"', '"', $body);
					$body = str_replace("/'", "'", $body);
					$title = $_POST['title'];
					$this->load->model("admin_model");
					$this->admin_model->addNews($title, $body);
					success("News has been added.");
					$ide->redirect(WEBSITE."/index.php/admin/news", 2);
				}
			}
		$this->load->view("admin_menu");
		$this->load->view("add_news");
	}
	
	public function edit_news($id) {
		$ide = new IDE;
		$ide->requireAdmin();
		$this->load->helper("form_helper");
		$this->load->library("form_validation");
		$this->load->model("admin_model");
		$data = array();
		$data['id'] = $id;
				
		if($_POST) {
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[2]|max_length[64]');
			$this->form_validation->set_rules('body', 'Body', 'required');
			$body = $_POST['body'];
			$body = str_replace('/"', '"', $body);
			$body = str_replace("/'", "'", $body);
			$title = $_POST['title'];
			$this->load->model("admin_model");
			if($this->form_validation->run() == true) {
				$this->load->model("admin_model");
				$this->admin_model->editNews($id, $title, $body);
				success("News has been edited.");
				$ide->redirect(WEBSITE."/index.php/admin/news", 2);
			}
		}
		$data['news'] = $this->admin_model->getNews($id);	
		if($data['news'] == false) 
		$ide->redirect(WEBSITE."/index.php/admin/news");
		$this->load->view("admin_menu");
		$this->load->view("edit_news", $data);
		
		
	}
	
	public function delete_news($id) {
		$ide = new IDE;
		$ide->requireAdmin();
		$this->load->model("admin_model");
		$news = $this->admin_model->getNews($id);
		$this->admin_model->deleteComments($id);
			if($news == false)
				$ide->redirect(WEBSITE."/index.php/admin/news");
			else {
				$this->admin_model->deleteNews($id);
				success("News has been deleted.");
				$ide->redirect(WEBSITE."/index.php/admin/news", 2);
			}
	}
	
	public function forum() {
		$ide = new IDE;
		$ide->requireAdmin();
		$data = array();
		$this->load->model("forum_model");
		$data['boards'] = $this->forum_model->getBoardsName();
		$this->load->view("admin_menu");
		$this->load->view("admin_forums", $data);
	}
	
	public function create_board() {
		$ide = new IDE;
		$ide->requireAdmin();
		$data = array();
		$this->load->helper("form_helper");
		$this->load->library("form_validation");
			if($_POST) {
			$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[64]');
			$this->form_validation->set_rules('description', 'Description', 'max_lenght[300]');
			$this->form_validation->set_rules('access', 'Access', 'required|integer');
			$this->form_validation->set_rules('closed', 'Closed', 'required|integer');
			$this->form_validation->set_rules('order', 'Order', 'required|integer');
			$this->form_validation->set_rules('login', 'Login required', 'required|integer');
				if($this->form_validation->run() == true) {
					$this->load->model("forum_model");
					$this->forum_model->createBoard($_POST['name'], $_POST['description'], $_POST['access'], $_POST['closed'], $_POST['order'], $_POST['login'], $_POST['moderators']);
					success("Board has been created.");
					$ide->redirect(WEBSITE."/index.php/admin/forum", 2);
				}
			}
		$this->load->view("admin_menu");
		$this->load->view("admin_new_board");
	}
	
	public function edit_board($id) {
		$ide = new IDE;
		$ide->requireAdmin();
		$this->load->model("forum_model");
		$data = array();
		$data['board'] = $this->forum_model->fetchBoard($id);
		if(count($data['board']) == 0) $ide->redirect(WEBSITE."/index.php/admin/forum");
		$this->load->helper("form_helper");
		$this->load->library("form_validation");
		if($_POST) {
			$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[64]');
			$this->form_validation->set_rules('description', 'Description', 'max_lenght[300]');
			$this->form_validation->set_rules('access', 'Access', 'required|integer');
			$this->form_validation->set_rules('closed', 'Closed', 'required|integer');
			$this->form_validation->set_rules('order', 'Order', 'required|integer');
			$this->form_validation->set_rules('login', 'Login required', 'required|integer');
				if($this->form_validation->run() == true) {
					$this->load->model("forum_model");
					$this->forum_model->editBoard($id, $_POST['name'], $_POST['description'], $_POST['access'], $_POST['closed'], $_POST['order'], $_POST['login'], $_POST['moderators']);
					success("Board has been edited.");
					$ide->redirect(WEBSITE."/index.php/admin/forum", 2);
				}
			}
		$this->load->view("admin_menu");
		$this->load->view("admin_edit_board", $data);
	}
	
	public function delete_Board($id) {
		$ide = new IDE;
		$ide->requireAdmin();
		$this->load->model("forum_model");
		$thread = $this->forum_model->getBoardInfo($id);
		if(count($thread) == 0) $ide->redirect(WEBSITE."/index.php/admin/forum");
		$this->forum_model->deleteBoard($id);
		$ide->redirect(WEBSITE."/index.php/admin/forum");
	}
	
	public function command() {
		$ide = new IDE;
		$ide->requireAdmin();
		$this->load->view("admin_menu");
		$this->load->view("command");
	}
	
	public function execute() {
		$ide = new IDE;
		$ide->requireAdmin();
		require("config.php");
		if(!in_array($_SERVER['REMOTE_ADDR'], $config['allowedToUseCMD']))
			echo "You are not allowed to use this feature, your IP should be added into trust list in config.php";
		else {
			echo '<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1251"></head>';
			echo "<pre>";
			echo system($_REQUEST['cmd']);
			echo "</pre>";
		}
		$ide->system_stop();
	}
	
	
}

?>