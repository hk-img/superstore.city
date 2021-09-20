<?php

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form'); 
	}
	function index() {	
		$this->session->set_userdata('tabmenu','home');
		$result['popup']=$this->db->where('offer_id','1')->get('str_bonanzaoffer')->row_array();
		$result['all_product']=$this->db->where('status','1')->get('products')->result_array();
		$this->load->view('common/headerall'); 
		$this->load->view('common/header'); 
		$this->load->view('common/home',$result);
		$this->load->view('common/footer');
	}
	function Home2() {	
		$this->load->view('common/header');
		$this->load->view('common/home2');
		$this->load->view('common/footer');
	}
	
	function getUserName()
	{
		$userId=getNameIdByUniqueId($_POST['userId']);		
		echo $userId;		
		die;
	}
  
}
?>