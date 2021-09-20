<?php
class Language extends CI_Controller {
function __construct() {
parent::__construct();
$this->load->helper('form');
$this->load->library('session');
$this->load->helper('query');
$this->load->database();
$this->load->model("Front_model");
}
	function index($lang=""){
		$this->session->set_userdata('language',$this->input->post('value'));
		if($this->session->userdata('language')!=""){
			$lang=$this->session->userdata('language');
		}else{
			$lang="english";
		}
		$this->lang->load('content',$lang);
		$this->load->view('common/language');
	}
}
?>