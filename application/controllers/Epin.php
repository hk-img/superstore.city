<?php
class Epin extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Form_model');
		if($this->Form_model->checkLogin()==false)
		{
			header("location:".base_url('login'));
			$this->session->set_userdata('storesucmsg','Please First Login.');
			die;
		}
	} 
	
	 public function index()
	 {
		 
	}
	 
	 
	 public function allPin()
	 {
		$data['title']='All Pin';
		$result['result']=$this->db->where('assign_userid',$this->session->userdata('userlogin'))->get('str_pinlist')->result();
		 $this->load->view('common/dashboard-header',$data); 
		 $this->load->view('epin/allPin',$result); 
		 $this->load->view('common/dashboard-footer'); 
	 }
	 
	 	 
	 public function usedEpin()
	 {
		$data['title']='All Used Pin';
		$result['result']=$this->db->where(array('assign_userid'=>$this->session->userdata('userlogin'),'used_status'=>'1'))->get('str_pinlist')->result();
		 $this->load->view('common/dashboard-header',$data); 
		 $this->load->view('epin/allPin',$result); 
		 $this->load->view('common/dashboard-footer'); 
	 }
	 
	 	 
	 public function unusedEpin()
	 {
		$data['title']='All Unused Pin';
		$result['result']=$this->db->where(array('assign_userid'=>$this->session->userdata('userlogin'),'used_status'=>'0'))->get('str_pinlist')->result();
		 $this->load->view('common/dashboard-header',$data); 
		 $this->load->view('epin/allPin',$result); 
		 $this->load->view('common/dashboard-footer'); 
	 }
}
?>