<?php
class Profile extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('query');
		$this->load->model('Form_model'); 
		if($this->Form_model->checkLogin()==false)
		{
			header("location:".base_url('login'));
			die;
		}
	} 
	public function index() {
		$data['result']=$this->Form_model->get_result(array('member_id'=>$this->session->userdata('userlogin')),'str_member');
		$this->load->view('common/dashboard-header'); 
		$this->load->view('profile/profile',$data); 
		$this->load->view('common/dashboard-footer'); 
	}
	
	function EditProfilePage() {
		$title['title']="Edit Profile";
		$data = array(
			'member_id' => $this->session->userdata('userlogin'),
		);
		$result['result']=$this->Form_model->get_result($data,'str_member');
		$this->load->view('common/dashboard-header',$title);
		$this->load->view('profile/edit_profile_page',$result);
		$this->load->view('common/dashboard-footer');
	}
	
		function UpdateProfileEnd()
		{
			$data=$this->input->post(); 
			$memberResult=$this->db->get_where('str_member',array('member_id'=>$this->session->userdata('userlogin')))->row_array();
			
			if($memberResult['bank_name']!=''){ unset($data['bank_name']); }
			
			if($memberResult['account_no']!=''){ unset($data['account_no']); }
			
			if($memberResult['branch']!=''){ unset($data['branch']); }
			
			if($memberResult['ifsc_code']!=''){ unset($data['ifsc_code']); }
			
			if($memberResult['nominee_name']!=''){ unset($data['nominee_name']); }
			
			if($memberResult['relation']!=''){ unset($data['relation']); }
			
			if($memberResult['pan_no']!=''){ unset($data['pan_no']); }
			
			if($memberResult['email']!=''){ unset($data['email']); }
			
			if($memberResult['mobile_no']!=''){ unset($data['mobile_no']); }
			
			$image_name="";
			if(isset($_FILES['model_image']['name'])){
				if($_FILES['model_image']['name'] !=""){
					$this->load->library('upload');
					// required configuration.
					$randNo=rand(10000,99999);
					$config['file_name']=$_POST['name'].$randNo;
					$config['upload_path']   = './web_root/images/userimage/';
					$config['allowed_types'] = 'jpg|jpeg|gif|png';
					$config['max_size']      = 8000;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->upload->initialize($config); 
					$this->upload->do_upload('model_image');
					$upload_data = $this->upload->data();
					$image_name = $upload_data['file_name'];
					$data['image']=$image_name; 
						foreach(SelectQuery('image','str_member','member_id',$this->session->userdata('userlogin')) as $rasaa1) { $old_file=$rasaa1->image; }
						if($old_file!=""){
							if(file_exists("./web_root/images/userimage/".$old_file)){
								unlink('./web_root/images/userimage/'.$old_file);
							}
						} 
				}
			}
 	
			$this->Form_model->update_data('str_member',$data,'member_id',$this->session->userdata('userlogin')); 
			$this->session->set_userdata('storesucmsg',"Your profile updated successfully");
			header("location: ".base_url('my-profile'));
		}
	
	public function getCity()
	{
	 
		$stateId=$_POST['state_id'];
		$selected=$_POST['selected'];
		$cityResult=$this->db->where('state_id',$stateId)->get('str_cities')->result();
 
		$option='';
		if(!empty($cityResult))
		{
			foreach($cityResult as $cityResultKey=>$cityResultValue)
			{
				?>
					<option <?php if($selected==$cityResultValue->id){ echo "selected"; } ?> value="<?php echo $cityResultValue->id; ?>"><?php echo $cityResultValue->name; ?></option>
				<?php  
			}
			
		}
		else
		{
			echo $option.="<option value=''>No Result Found</option>";
		}  
	}
	
	/*==upgrade account work===*/
	
	public function upgradeAccount()
	{
		
		if(!empty($this->input->post()) && $this->input->post('upgrade')=='upgrade')
		{
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('unique_id', 'Member ID', 'trim|required|callback_isUniqueIdExist',
				array(
					'required'  => '%s Can not be empty.',
					'isUniqueIdExist'  => '! %s Not Found ...',										
				) 
			);
			
			$this->form_validation->set_rules('pin', 'E-pin', 'trim|required|callback_ischeckvalidPinExist|callback_ischeckvalidPinForUpgrade',
				array(
					'required'  => '%s Can not be empty.',   
					'ischeckvalidPinExist'  => 'Please Enter Valid Pin No.',
					'ischeckvalidPinForUpgrade'  => 'Please Use upper amount pin from current plan ...',
				) 
			);
		
		
			if($this->form_validation->run() == TRUE)
			{ 
				$regdata=array();
				
				/*=update data in str_member create for member registration==*/
				$pinAmountId=$this->input->post('pin');
				$regdata['package_amount']=checkPinAmount($pinAmountId);
				$regdata['business_volume']=checkPinBusinessVolume($pinAmountId);
				$regdata['pv_value']=checkPinPvValue($pinAmountId);
				$regdata['upgrade_date']=date("Y-m-d H:i:s");
				
				/*==update activation date==*/
				
				$activationDate=$this->db->where('unique_id',$this->input->post('unique_id'))->get('str_member')->row()->active_date;
				
				if($activationDate=='0000-00-00 00:00:00' || $activationDate=='')
				{
					$regdata['active_date']=date("Y-m-d H:i:s");
				}
				
				$this->Form_model->update_data('str_member',$regdata,'unique_id',$this->input->post('unique_id'));
				
				/*=Insert data in str_pinlist update entry	 for used pin==*/
					
				$memberId=getIdByUniqueId($this->input->post('unique_id'));			
				$pinArray=array(
					'particular_id'=>'3',
					'used_status'=>'1',
					'used_byid'=>$memberId,
				); 
				
				$this->Form_model->update_data('str_pinlist',$pinArray,'pin_no',$this->input->post('pin'));
				
				/*=Insert data in str_turnover_detail for check turnover detail==*/
				
				$turn['user_id']=$memberId;
				$turn['package_amount']=$regdata['package_amount'];
				$turn['business_amount']=$regdata['business_volume'];
				$turn['pv_value']=$regdata['pv_value'];
				$this->Form_model->insert_data($turn,'str_turnover_detail');
					
				
				/*==sent sms==*/
				
				$userName=getNameIdByUniqueId($this->input->post('unique_id'));
				$userFirstName=getFirstNameIdByUniqueId($this->input->post('unique_id'));
				$userMobile=getMobileIdByUniqueId($this->input->post('unique_id'));
				$msg="Dear $userFirstName $userName, Congratulation,Your account has been upgraded successfully.";
				// $this->Form_model->sendMsg($userMobile,$msg); 
								
				$this->session->set_userdata('storesucmsg','Your Account upgraded successfully.');	
			}
		}
		$title['title']="Upgrade Account";  
		$this->load->view('common/dashboard-header',$title);
		$this->load->view('profile/upgradeAccount');
		$this->load->view('common/dashboard-footer');
	}
	
	public function isUniqueIdExist($key)
	{ 
		$data=array(
			'unique_id'=>$key,
			'status'=>'1',
		);
		$result=$this->db->select('member_id')->where($data)->get('str_member')->result();
		 
		if(empty($result))
		{
			return  false;
		}
		else			
		{
			return  true;
		}
	}
	
	public function ischeckvalidPinExist($key)
	{ 
		$data=array(
			'pin_no'=>$key,
			'used_status'=>'0',
			'status'=>'1',
		);
		
		$regAmount=array('1000','3000','5000','10000');

		$result=$this->db->select('pin_id')->where_in('business_volume',$regAmount)->where($data)->get('str_pinlist')->result();
		 
		if(!empty($result))
		{
			return  true;
		}
		else			
		{
			return  false; 
		}
	}
	
	public function ischeckvalidPinForUpgrade($key)
	{ 
		$uniqueId=$this->input->post('unique_id');
		
		$getCurBvValue=$this->db->select('business_volume')->where('unique_id',$uniqueId)->get('str_member')->row_array();
		
		$getCurBvValue=(float)$getCurBvValue['business_volume'];
		
		$getPinAmount=$this->db->select('business_volume')->where('pin_no',$key)->get('str_pinlist')->row_array();
		
		$getPinAmount=(float)$getPinAmount['business_volume'];

		if($getPinAmount>$getCurBvValue)
		{
			return  true;
		}
		else			
		{
			return  false; 
		}
	}
	
	
	/*==Password related work==*/
	
	function changepassword(){
		$result['result']=array();
		$this->load->view('common/dashboard-header');
		$this->load->view('profile/changepassword',$result);
		$this->load->view('common/dashboard-footer');
	}
	
	function changePasswordEnd() { 
	
		$adminid="";
		$oldpassword="";
		$newpassword="";
		$confirmpassword="";
		
		$adminid=$this->session->userdata('userlogin');
		$oldpassword=$this->input->post('o_pass');
		$newpassword=$this->input->post('n_pass');
		$confirmpassword=$this->input->post('c_pass');
		
		$data=array(
			'password'=>$newpassword,
		);


		$condition="";
		$condition="member_id='".$adminid."' and password='".$oldpassword."'";
		$result=array();

		$result=SelectQuery_th('*','str_member',$condition);

		if(empty($result)){
				$this->session->set_userdata('storefailmsg', 'Old Password not match.Please Try Again.');
				header("Location:".base_url('change-password'));
		}
		else{
			if($newpassword == $confirmpassword)
			{
				$totalPasswordCharactor = strlen($confirmpassword);
				
				 if ((int)$totalPasswordCharactor<4) 
				 {
						$this->session->set_userdata('storefailmsg', 'Password must be contain at least 4 charactor.');
						header("Location:".base_url('change-password'));
				}
				else			
				{
					shweta_popular('str_member',$data,'member_id',$adminid);
					$this->session->set_userdata('storesucmsg', 'Your Password Successfully Changed successfully.');
					header("Location:".base_url('logout'));
				}
		
			 }
			else{
				$this->session->set_userdata('storefailmsg', 'New Password and confirm password not matched.Please Try Again.');
				header("Location:".base_url('change-password')); 
			}

		}
	}	

	public function KycUpdatePage() {	
		$this->load->view('common/dashboard-header');
		$this->load->view('profile/kyc_upadte_page');
		$this->load->view('common/dashboard-footer');
	}
	
	function UploadKycEnd()
	{	
		 
		$result=$this->db->select('name')->where('member_id',$this->session->userdata('userlogin'))->get('str_member')->row();
	 	$name='';
		if(!empty($result))
		{
			$name=$result->name;
		} 
		$filename=$name.'-id-proof-';
		$id_proof=$this->file_upload('id_proof',$filename);
		$filename=$name.'-pan-card-';
		$pan_card=$this->file_upload('pan_card',$filename);
		$filename=$name.'-bank-details-';
		$bank_detail=$this->file_upload('bank_detail',$filename);
		$data_kyc=array(
			'id_proof'=>$id_proof,
			'pan_card'=>$pan_card,
			'bank_detail'=>$bank_detail,
			'kyc_upadte'=>1,
		);
		$this->db->where('member_id',$this->session->userdata('userlogin'))->update('str_member',$data_kyc); 
		$this->session->set_userdata('storesucmsg',"Your KYC request submitted successfully.Please wait for admin approval.");
		header("location: ".base_url('profile'));
	}
	public function file_upload($tag_name,$upload_filename){
		$image_name='';
		if(isset($_FILES[$tag_name]['name'])){
			if($_FILES[$tag_name]['name'] !=""){
				$ran_no = rand(100000,999999);
				$config['file_name']=newslugend($upload_filename.$ran_no);
				$this->load->library('upload');
				$config['upload_path']   = './web_root/images/kyc_details/';
				$config['allowed_types'] = 'jpg|jpeg|gif|png';
				$config['max_size']      = 8000;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$this->upload->initialize($config); 
				$this->upload->do_upload($tag_name);
				$upload_data = $this->upload->data();
				$image_name = $upload_data['file_name'];
			} 
		}
		return $image_name;
	}
	
	
	public	function Passbook() {	
		$this->load->view('common/dashboard-header');
		$this->load->view('profile/passbook');
		$this->load->view('common/dashboard-footer');
	}
	
	public	function userprofile() {
    	$data['result']=$this->Form_model->get_result(array('member_id'=>$this->session->userdata('userlogin')),'str_member');
		$this->load->view('common/dashboard-header');
		$this->load->view('profile/userprofile',$data);
		$this->load->view('common/dashboard-footer');
	}
	
	function downline() {
		$title['title']="Downline";
		$data = array(
			'member_id' => $this->session->userdata('userlogin'),
		); 
		$this->load->view('common/dashboard-header',$title);
		$this->load->view('group/downline_group',$result);
		$this->load->view('common/dashboard-footer');
	}
	
	function myTeam() {
		$title['title']="My Team";
		$data = array(
			'member_id' => $this->session->userdata('userlogin'),
		); 
		$unique_id=getUniqueIdById($this->session->userdata('userlogin'));
		$result['result']=$this->db->order_by('member_id','desc')->where('referrer_id',$unique_id)->get('str_member')->result_array();
		$this->load->view('common/dashboard-header',$title);
		$this->load->view('group/direct_group',$result);
		$this->load->view('common/dashboard-footer');
	}
	
	function TeamIncome() {
		$title['title']="Total Team";
		$data = array(
			'member_id' => $this->session->userdata('userlogin'),
		); 
		$this->load->view('common/dashboard-header',$title);
		$this->load->view('profile/teamincome',$data);
		$this->load->view('common/dashboard-footer');
	}
	function rewards() {
		$title['title']="Team Income";
		$data = array(
			'member_id' => $this->session->userdata('userlogin'),
		); 
		$this->load->view('common/dashboard-header',$title);
		$this->load->view('profile/rewards',$result);
		$this->load->view('common/dashboard-footer');
	}
	
	/*==WITHDRAWL WORKING==*/
	
	public function withdrawlWindow()
	{	 

		$chkAlreadyWithdraw=$this->db->get_where('str_wallet',array('user_id'=>$this->session->userdata('userlogin'),'date(created_date)'=>date("Y-m-d"),'particular_id'=>'12','status !='=>'FAILED'))->row_array();
		
		if(empty($chkAlreadyWithdraw)){
				
				$json['status']='1';
		}else{

			$json['status']='0';
		
			$this->session->set_userdata('storefailmsg','you can create fund withdrawl request only one time in a one day.');
		}			

		
		echo json_encode($json);
		die;
	}
	
	public function withdrwlAmount()
	{

		$currentBalance=$this->input->post('balance');
	    $requestBalance=$this->input->post('amount');

		if($currentBalance>=$requestBalance){

			if($requestBalance>0){

				$this->Form_model->addMoneyInWallet($this->session->userdata('userlogin'),'12','dr',$requestBalance,'PENDING');
				
				// $walletId=$this->db->insert_id();
				
				// $memberDetail=$this->db->where('member_id',$this->session->userdata('userlogin'))->get('str_member')->row_array();
				
				// $bankDetail=array(
				// 	'wallet_id'=>$walletId,
				// 	'user_id'=>$this->session->userdata('userlogin'),
				// 	'bank_name'=>$memberDetail['bank_name'],
				// 	'account_no'=>$memberDetail['account_no'],
				// 	'ifsc_code'=>$memberDetail['ifsc_code'],
				// 	'branch_name'=>$memberDetail['branch'],
				// );
				
				// $this->db->insert('withdrawl_bankdetail',$bankDetail); 
				
				$this->session->set_userdata('storesucmsg',"Your Withdrawl Request Recevied Successfully"); 

			}else{
				$this->session->set_userdata('storefailmsg',"Amount should be greater than 0");   
			}
		}else{
			$this->session->set_userdata('storefailmsg', 'Insufficient Balance.');
		}
		
		
		header("location: ".base_url('profile'));
	}
	
	function rankReward()
	{ 
		$this->load->view('common/dashboard-header');
		$this->load->view('profile/rankReward');
		$this->load->view('common/dashboard-footer');
	}
	
}
?>