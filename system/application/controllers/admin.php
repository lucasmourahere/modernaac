<?php 

class Admin extends Controller {
	
	public function index() {
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
			if($news == false)
				$ide->redirect(WEBSITE."/index.php/admin/news");
			else {
				$this->admin_model->deleteNews($id);
				success("News has been deleted.");
				$ide->redirect(WEBSITE."/index.php/admin/news", 2);
			}
	}
}

?>