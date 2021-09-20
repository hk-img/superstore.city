<?php
class Group extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Form_model');
		if($this->Form_model->checkLogin()==false)
		{
			header("location:".base_url('login'));
			die;
		}
	} 
	 public function index()
	 {
		 
	}
	 public function directGroup()
	 { 
	 
		$result['text']='';
		$uniqueId=getUniqueIdById($this->session->userdata('userlogin'));
		 if(($this->input->post('searchText'))!=null)
		{
			$result['text']=$this->input->post('searchText');
			 $cond="(name LIKE '%".$result['text']."%' or address LIKE '%".$result['text']."%' OR mobile LIKE '%".$result['text']."%' ) and referrer_id='".$uniqueId."'";
			 $result['result']=$this->db->where($cond)->get('str_member')->result();
		  }
		else
		{
			$result['result']=$this->db->where('referrer_id',$uniqueId)->get('str_member')->result();
		}
		
		 $data['title']="Direct Group";
		 
		 $this->load->view('common/headerall',$data);
		 $this->load->view('group/direct_group',$result);
		 $this->load->view('common/footer');
	}
	 public function genealogy()
	 {
		
		 $this->load->view('common/dashboard-header');
		 $this->load->view('group/genealogy');
		 $this->load->view('common/dashboard-footer');
	}
	
	 public function downlineGroup()
	 {
		 $result['text']=''; 
		 if(($this->input->post('downline'))!=null)
		{
			$result['text']=$this->input->post('downline');
			 $cond="(name LIKE '%".$result['text']."%' or address LIKE '%".$result['text']."%' OR mobile LIKE '%".$result['text']."%' ) and member_id >'".$this->session->userdata('userlogin')."'";
			 $result['result']=$this->db->where($cond)->get('str_member')->result();
		  }
		else
		{
			$result['result']=$this->db->where('member_id >',$this->session->userdata('userlogin'))->get('str_member')->result();
		}
		
		 $data['title']="Downline Group";
		 $this->load->view('common/headerall',$data);
		 $this->load->view('group/downline_group',$result);
		 $this->load->view('common/footer');
	}
	
	 public function leftRightTeam()
	 {
		 $uniqueId=getUniqueIdById($this->session->userdata('userlogin'));
		 $left_child=getUserleftRightId($uniqueId,'left');
		  
		 /*===left user Result==*/
		 $leftUserResult=array();
		  
		 if(!empty($left_child))
		 { 
			 foreach($left_child as $left_child1)
			 { 
				 $userLeftResult=showTreeMemberInfo($left_child1['1']);
				 
				 $leftUserResult[]=array( 
						'uniqueId'=>$left_child1['1'],
						'reg_date'=>date("M d Y H:i:a", strtotime($userLeftResult['doj'])),
						'sponsor_id'=>$userLeftResult['sponsor_id'],
						'packageAmount'=>$userLeftResult['package_amount'],
				 ); 
			 }
			  
		 }
		 echo "<pre>";
		 print_r($leftUserResult);
		 die;
		 $result['right_child']=getUserleftRightId($uniqueId,'right');
		 $data['title']="Left Right Group";
		 $result['left_user']=$leftUserResult;
		 $this->load->view('common/headerall',$data);
		 $this->load->view('group/left_right',$result);
		 $this->load->view('common/footer');
	}
	
}
?>