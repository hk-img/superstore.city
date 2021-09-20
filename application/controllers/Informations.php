<?php
class Informations extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('query');
		$this->load->database();
	}
	function legalDocument() {	
		$this->session->set_userdata('tabmenu','legalDocument');
		$this->load->view('common/headerall');
		$this->load->view('informations/legal_document');
		$this->load->view('common/footer');
	}
	function Contact_us() {	
		$this->session->set_userdata('tabmenu','contact_us');
		$this->load->view('common/headerall');
		$this->load->view('informations/contact_us');
		$this->load->view('common/footer');
	}
 
}
?>