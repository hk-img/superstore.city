<?php
class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Form_model');
	} 
	
	function index() {
		
		if(!empty($this->input->post()) && $this->input->post('login')=='login')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('unique_id', 'Member ID', 'trim|required',
				array(
					'required'  => '%s Can not be empty.',   
				) 
			);
		
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required',
				array(
					'required'  => '%s Can not be empty.',   
				) 
			);
			
			if ($this->form_validation->run() == true)
			{
				 
				$result=json_decode($this->_checkLogin($this->input->post('unique_id'),$this->input->post('password')));
				 
				if($result->status=='0')
				{
					$this->session->set_userdata('storefailmsg',$result->msg); 
					header("location:".base_url('login')); 
					die;
				}
				else
				{
					$this->session->set_userdata('userlogin',$result->id);
					$this->session->set_userdata('storesucmsg',$result->msg);
					header("location:".base_url('my-profile')); 
					die;
				}
			}
		}			
		$this->load->view('common/headerall');
		$this->load->view('login/login_page');
		$this->load->view('common/footer');
	}
	
	public function _checkLogin($uniqueId,$password)
	{
		$cond=array(
			'unique_id'=>$uniqueId,
			'password'=>$password,
		);
		$result=$this->Form_model->get_result($cond,'str_member');
		if(!empty($result))
		{
			if($result[0]->status=='1')
			{
				$json['id']=$result[0]->member_id;
				$json['status']='1';
				$json['msg']='Login successfully.';
			}
			else
			{
				$json['status']='0';
				$json['msg']='User is not active.Please contact your administartor.';
			}
		}
		else
		{
			$json['status']='0';
			$json['msg']='Invalid Login Detail.Please Try Again.';
		} 
		return  json_encode($json);
		die;
	}
	
	public function logout()
	{ 
		$this->db->where('member_id',$this->session->userdata('userlogin'))->update('str_member',array('last_login'=>date("Y-m-d H:i:s")));
		$this->session->unset_userdata('userlogin');
		header("location:".base_url('login'));
		die;
	}
	 
}
?>