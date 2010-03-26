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

}
?>