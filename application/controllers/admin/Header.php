<?php	class Header extends CI_Controller {		function __construct() {			parent::__construct();			$this->load->helper('form');			$this->load->library('session'); 		}
	public function index() {		$this->load->view('admin/header');	}
}
?>