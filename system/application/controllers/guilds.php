<?php
class Guilds extends Controller {

	public function index() {
		$this->load->helper("form");
		$this->load->model("guilds_model");
		require_once("system/application/config/create_character.php");
		$data = array();
		$data['config'] = $config;
		$data['guilds'] = @$this->guilds_model->getGuildsList((int)$_REQUEST['world_id']);
		$this->load->view("guilds", $data);
	}
	
	public function view($id = null) {
		$ide = new IDE;
		if(empty($id)) $ide->redirect('../');
		$ots = POT::getInstance();
		$ots->connect(POT::DB_MYSQL, connection());
		$guild = $ots->createObject('Guild');
		$guild->load($id);
		if(!$guild->isLoaded()) error("Could not find guild.");
		$data['guild'] = $guild;
		$this->load->view("view_guild", $data);
	
	}
	
	public function _checkPlayer($id) {
		$this->load->model("guilds_model");
		if($this->guilds_model->checkPlayerCreatingGuild($id)) {
			return true;
		}
		else {
			$this->form_validation->set_message('_checkPlayer', 'Could not find character.');
			return false;
		}
	}
	
	public function _checkGuildName($name){
		$this->load->model("guilds_model");
		if($this->guilds_model->checkGuildName($name)) {
			return true;
		}
		else {
			$this->form_validation->set_message('_checkGuildName', 'Guild name is already taken.');
			return false;
		}
	}
	
	public function create() {
		$ide = new IDE;
		$ide->requireLogin();
		$this->load->helper("form");
		$this->load->model("guilds_model");
		require_once("system/application/config/create_character.php");
		$this->load->library("form_validation");
		if(isset($_POST['submit'])) {
			$this->form_validation->set_rules('character', 'Character', 'required|numeric|callback__checkPlayer');
			$this->form_validation->set_rules('name', 'Guild Name', 'required|callback__checkGuildName');
		}
		if($this->form_validation->run() == true) {
			$this->guilds_model->createGuild($_POST['name'], $_POST['character']);
		}
		$data = array();
		$data['characters'] = $this->guilds_model->getCharactersAllowedToCreateGuild($config['levelToCreateGuild']);
		$data['config'] = $config;
		$this->load->view("create_guild", $data);
		
	}

}
?>