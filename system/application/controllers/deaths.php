<?php 
// Controller for latestdeaths.
class Deaths extends Controller {
	public function index() {
		/*Todo - This function must be done.*/
		$this->load->helper("form");
		$this->load->view("deaths");
	}
}
?>