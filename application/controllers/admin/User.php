<?php
class User extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Form_model'); 
	} 
	 public function index()
	 {
	     $data['title']="All Users";
	     $result['result']=$this->db->order_by('member_id','desc')->get_where('str_member',array('member_id >','1'))->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/user/userlist',$result);
		$this->load->view('admin/footer');
	}
	 
	 public function editUser($userId)
	 {
		 $result['result']=$this->db->where('member_id',$userId)->get('str_member')->row();
		 $data['title']="Edit User Detail"; 
		$this->load->view('admin/header',$data);
		$this->load->view('admin/user/edit_user',$result);
		$this->load->view('admin/footer');
	 }
	 
	 public function editUserEnd()
	 {
		$data=$_POST;
		// $data['product_id']=implode('$$',$data['chkbox']);
		unset($data['chkbox']);
		$this->db->where('member_id',$data['member_id'])->update('str_member',$data);
		$json['status']='1';
		$json['msg']='Member Updated Successfully';
		echo json_encode($json);
		die;
	 }
	 
	 public function userStatement()
	 {
		 $result['result']=$this->db->select('member_id,unique_id,name,account_no,ifsc_code')->get('str_member')->result();
		 $data['title']="Show User Statement"; 
		$this->load->view('admin/header',$data);
		$this->load->view('admin/user/userStatement',$result);
		$this->load->view('admin/footer');
	 }
	 
	 public function sendmoney()
	 {
		 $userId=$this->input->post('userid');
		 $amount=$this->input->post('amount');
		 
		 $crBalance=$this->Form_model->totalCrBalance($userId);
		 $drBalance=$this->Form_model->confirmBalance($userId);
		 $finalDueBalance=$crBalance-$drBalance;
		 
		 if($finalDueBalance>=$amount)
		 {
			 $data=array(
				'user_id'=>$userId,
				'particular_id'=>$userId,
				'particular_id'=>'14',
				'type'=>'dr',
				'net_amount'=>$amount,
			 );
			 
			 $this->db->insert('str_wallet',$data);
			$this->session->set_userdata('digitalcashadminmessageTrue','Amount transferred successfully.'); 
		 }
		 else
		 {
			 $this->session->set_userdata('digitalcashadminmessageFalse','Amount should be greater than to due balance.');
		 }
		 header("location:".base_url('admin/user-statement'));
	 }
	 
	 public function userBalanceSheet($userId)
	 {
		 $result=$this->db->get_where('str_wallet',array('user_id'=>$userId,'status'=>'SUCCESS'))->result();
		 if(!empty($result))
		 {
			$result['result']=$this->db->get_where('str_wallet',array('user_id'=>$userId,'status'=>'SUCCESS'))->result();
			$name=getNameByMemberId($userId);
			$data['title']="Show User Balance Sheet of ( $name ) "; 
			$this->load->view('admin/header',$data);
			$this->load->view('admin/user/balancesheet',$result);
			$this->load->view('admin/footer');
		 }
		 else
		 {
			$this->session->set_userdata('digitalcashadminmessageFalse','Record Not Found.'); 
			header("location:".base_url('admin/user-statement'));
			die;
		 }
	 }
	 
	 public function showturnover(){  
		   $month = date("m");
			$year = date("Y");

			$data['month']=$month;
			$data['year']=$year;
		if(!empty($this->input->post()) && $this->input->post('submit')!=''){
			$month = date($this->input->post('month'));
			$year = date($this->input->post('year'));
			$data['month']=$month;
			$data['year']=$year;
		}
		$start_date = "01-".$month."-".$year;
		$start_time = strtotime($start_date);
		$end_time = strtotime("+1 month", $start_time);
		for($i=$start_time; $i<$end_time; $i+=86400)
		{
		   $list[] = date('d-M-Y D',$i);
		}
		$result['list']=$list;
		$result['total_business']=$this->Form_model->getTotalTurnover('2018-06-01',date("Y-m-d"));
		$data['title']="Show Business Turnover"; 
		$this->load->view('admin/header',$data);
		$this->load->view('admin/user/turnoverList',$result);
		$this->load->view('admin/footer');
	} 	
	
	 public function silverClub()
	 {
	    $data['title']="All Silver Club Users";
		$cond="silver_position='1' OR silver_position='2'";
	    $result['result']=OrderBy_Query('member_id,name,unique_id','str_member','member_id','desc',$cond);

		$result['clubId']='7';
		$this->load->view('admin/header',$data);
		$this->load->view('admin/user/clubUsers',$result);
		$this->load->view('admin/footer');
	}
	
	 public function starClub()
	 {
	     $data['title']="All Star Club Users";
		 $cond="startclub_position='1' OR startclub_position='2'";
	    $result['result']=OrderBy_Query('member_id,name,unique_id','str_member','member_id','desc',$cond);
	   $result['clubId']='8';
		$this->load->view('admin/header',$data);
		$this->load->view('admin/user/clubUsers',$result);
		$this->load->view('admin/footer');
	}
		 public function emerldClub()
	 {
	     $data['title']="All Emerld Club Users";
		 $cond="emerld_position='1' OR emerld_position='2'";
		 $result['result']=OrderBy_Query('member_id,name,unique_id','str_member','member_id','desc',$cond);
	   $result['clubId']='9';
		$this->load->view('admin/header',$data);
		$this->load->view('admin/user/clubUsers',$result);
		$this->load->view('admin/footer');
	}
	
	/*==Reward User List===*/
	
	public function rewardList()
	 {
	     $data['title']="All Reward Users";
	     $result['result']=$this->db->order_by('reward_id','desc')->get('achieve_reward')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/user/rewardList',$result);
		$this->load->view('admin/footer');
	}
	
	public function withdrawlRequest()
	{
		$result['month'] = date("m");
		$result['year'] = date("Y");
	    $result['result']=$this->db->select('str_wallet.*,str_member.name,str_member.unique_id,withdrawl_bankdetail.account_no,withdrawl_bankdetail.ifsc_code')->where('str_wallet.status','PENDING')->join('str_member','str_member.member_id=str_wallet.user_id')->join('withdrawl_bankdetail','withdrawl_bankdetail.wallet_id=str_wallet.wallet_id')->get('str_wallet')->result();
	    $data['title']="Withdrawl Request"; 
	    $this->load->view('admin/header',$data);
	    $this->load->view('admin/user/withdrawlbalancesheet',$result);
		$this->load->view('admin/footer');
	}
	
	public function withdrawlEnd($walletId,$status)
	{
	    $result=$this->db->select('str_wallet.*,str_member.*')->where('str_wallet.wallet_id',$walletId)->join('str_member','str_member.member_id=str_wallet.user_id')->get('str_wallet')->row_array();
	
	    $this->db->where('wallet_id',$walletId)->update('str_wallet',array('status'=>$status));
	    
	    if($status=='SUCCESS')
	    {
	           
			 /*==send mail==*/
			 	$message = "<html>
					<head>
					<title><a href='".base_url()."'  style='color:  rgb(255,110,0);text-decoration:none;'>AYRGROUP</a></title>
					</head>
					<body>
					<div>
					<p style='color:#333;font-size:14px;'>Hi ".$result['name_type']." ".$result['name']." !</p>
					<p style='color:#333;font-size:14px;'>Congratulation, Your Request Approve Successfully.Request Detail Given Below </p>
					<p style='color:#333;font-size:14px;'>Request Amount : - ".$result['amount']."</p>
					<p style='color:#333;font-size:14px;'>Admin Charge: - ".$result['admin_amount']."</p>
					<p style='color:#333;font-size:14px;'>TDS: - ".$result['tds_amount']."</p>
					<p style='color:#333;font-size:14px;'>Final Amount: - ".$result['net_amount']."</p>
					<table>
					<tr>
					<td><br/>Thank you,<br/><br/><b style='color:  rgb(255,110,0);'>AYRGROUP</b></td>
					<td></td>
					</tr>
					</div>
					</table>
					</body>
					</html>"; 
					
	         $this->session->set_userdata('digitalcashadminmessageTrue','Request Approve successfully.');
	    }
	    else
	    {
	       	$message = "<html>
					<head>
					<title><a href='".base_url()."'  style='color:  rgb(255,110,0);text-decoration:none;'>AYRGROUP</a></title>
					</head>
					<body>
					<div>
					<p style='color:#333;font-size:14px;'>Hi ".$result['name_type']." ".$result['name']." !</p>
					<p style='color:#333;font-size:14px;'>Sorry ! Your withdrawl request has been rejected.Please Contact Your Administrator. </p>
					<table>
					<tr>
					<td><br/>Thank you,<br/><br/><b style='color:  rgb(255,110,0);'>AYRGROUP</b></td>
					<td></td>
					</tr>
					</div>
					</table>
					</body>
					</html>"; 
					
	         $this->session->set_userdata('digitalcashadminmessageFalse','Request Rejected successfully.');    
	    
	    }
	        
	   	MailSentNow($message,'Withdrawl Request',$result['email']);
	   	
	   header('location:'.base_url().'admin/withdrawl-request');
	}
}
?>