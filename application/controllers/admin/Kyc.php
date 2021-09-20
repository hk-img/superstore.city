<?php
class Kyc extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Form_model');
	} 
	 public function index()
	 {
	     $data['title']="All Kyc Detail";
	     $result['result']=$this->db->order_by('member_id','desc')->get('str_member')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/kyc/kyclist',$result);
		$this->load->view('admin/footer');
	}
	
	public function singleKyc($id)
	{
		$data['title']="User Kyc Detail";
		$result['result']=$this->db->where('member_id',$id)->get('str_member')->row();
		if(!empty($result['result']))
		{
			$this->load->view('admin/header',$data);
			$this->load->view('admin/kyc/singlekyc',$result);
			$this->load->view('admin/footer');
		}
		else
		{
			header("location:".base_url("admin/show-kyc"));
		}
	}
	
	public function statuschange($userId,$status)
	{
		$this->db->where('member_id',$userId)->update('str_member',array('kyc_upadte'=>$status));
		$mobileNO='';
		foreach(SelectQuery('mobile','str_member','member_id',$userId) as $raa) $mobileNO=$raa->mobile; 			 	
		$txtmsg="Your Kyc has been Approved Successfully. Thank you.Regrads ayrgroup.in";
		$this->Form_model->sendMsg($mobileNO,$txtmsg); 
		$this->session->set_userdata('digitalcashadminmessageTrue',"Kyc Denied Successfully.");
		header("location:".base_url('admin/show-kyc')); 
		die;
	}
	
	function Kycdenied()
	{
	  $member_id=$this->input->post('member_id'); 
	  $status=$this->input->post('status');
	  $reason=$this->input->post('reason');   
		$data=array(
			'kyc_upadte'=>$status,
			'kyc_reason'=>$reason,
		);	
		$this->db->where('member_id',$member_id)->update('str_member',$data); 
		 
		foreach(SelectQuery('id_proof','str_member','member_id',$member_id) as $rasaa1) { $id_proof=$rasaa1->id_proof; }
		if($id_proof!="")
		{
			if(file_exists("./web_root/images/kyc_details/".$id_proof)){
				unlink('./web_root/images/kyc_details/'.$id_proof);
			}
		} 
		foreach(SelectQuery('pan_card','str_member','member_id',$member_id) as $rasaa1) { $pan_card=$rasaa1->pan_card; }
		if($pan_card!="")
		{
			if(file_exists("./web_root/images/kyc_details/".$pan_card)){
				unlink('./web_root/images/kyc_details/'.$pan_card);
			}
		} 
		foreach(SelectQuery('bank_detail','str_member','member_id',$member_id) as $rasaa1) { $bank_detail=$rasaa1->bank_detail; }
		if($bank_detail!="")
		{
			if(file_exists("./web_root/images/kyc_details/".$bank_detail)){
				unlink('./web_root/images/kyc_details/'.$bank_detail);
			}
		} 		
		$mobileNO='';
		foreach(SelectQuery('mobile','str_member','member_id',$member_id) as $raa) $mobileNO=$raa->mobile; 			 	
		$txtmsg="Your Kyc has been denied by admin side because ".$data['kyc_reason'].". Thank you.Regrads ayrgroup.in.in";
		$this->Form_model->sendMsg($mobileNO,$txtmsg); 
		$this->session->set_userdata('digitalcashadminmessageTrue',"Kyc Denied Successfully.");
		header("location:".base_url('admin/show-kyc')); 
		die;
	}
	
	
}
?>