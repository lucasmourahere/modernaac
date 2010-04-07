<?php

class Home extends Controller {

	public function index() {
		require("config.php");
		$this->load->model("home_model");
		$data = array();
		$data['news'] = $this->home_model->getAllNews();
		$this->load->view("home", $data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */