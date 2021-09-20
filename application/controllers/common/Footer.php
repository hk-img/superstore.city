<?php
class Footer extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('query');
		$this->load->database();
	}
	function index() {	
		$this->load->view('common/footer');
	}
}
?>