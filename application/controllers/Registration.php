<?php
class Registration extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('query');
		$this->load->helper('form');
		$this->load->model('Form_model'); 
	} 
	public function index() {
		$data['active']='1';
		$this->load->library('form_validation');
		if(!empty($this->input->post()) && $this->input->post('register')=='register')
		{		
	 
			// $this->form_validation->set_rules('pin', 'Enter PIN', 'trim|required|callback_ischeckvalidPinExist',
				// array(
					// 'required'  => '%s Can not be empty.',  
					// 'ischeckvalidPinExist'  => '! Please Enter Valid Pin.',  
				// ) 
			// );
	 
			$this->form_validation->set_rules('unique_id', 'Sponsor ID', 'trim|required|callback_isUniqueIdExist',
				array(
					'required'  => '%s Can not be empty.',  
					'isUniqueIdExist'  => '! %s Not Found ...',  
				) 
			);
			
			$this->form_validation->set_rules('tree_side', 'Select Side', 'required',
			 array(
					'required'  => 'You have not select %s.',   
				) 
			); 
				// $data['pin']=$this->input->post('pin');					
				$data['unique_id']=$this->input->post('unique_id');					
				$data['tree_side']=$this->input->post('tree_side');				
			 if ($this->form_validation->run() == true)
			 { 
					$data['active']='2';
					// $data['pin']=$this->input->post('pin');
					$data['unique_id']=$this->input->post('unique_id');
					$data['tree_side']=$this->input->post('tree_side');
										
			 } 			 
		 
		}
		

			/*====SECOND FORM WORK====*/
			
		if(!empty($this->input->post()) && $this->input->post('register')=='register1')
		{			
		
		
			// $this->form_validation->set_rules('pin', 'Enter PIN', 'trim|required|callback_ischeckvalidPinExist',
				// array(
					// 'required'  => '%s Can not be empty.',  
					// 'ischeckvalidPinExist'  => '! Please Enter Valid Pin.',  
				// ) 
			// );
			
			/*==redirect to homepage if pin is invaild===*/
			
			// if($this->checkPasswordValidation($this->input->post('password1')) == FALSE)
			// {
				// $this->session->set_userdata('storefailmsg','Please enter valid pin.');
				// header("location:".base_url('login'));
				// die;
			// }	
			
			/*==check password validation==*/
			
			 
			
			$this->form_validation->set_rules('unique_id', 'Sponsor ID', 'trim|required|is_unique[str_member.unique_id]',
					array(
						'required'  => '%s can not be empty.', 
						'is_unique'  => '%s must be unique.', 
					) 
				);
				
				$this->form_validation->set_rules('name', 'Your Name', 'trim|required',
					array(
						'required'  => '%s can not be empty.',  
					) 
				);
				
				$this->form_validation->set_rules('email', 'Email ID', 'trim|valid_email',
					array(  
						'valid_email'  => '%s should be email format.',  
					) 
				);
				$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|regex_match[/^[0-9]{10}$/]|required',
					array(
						'required'  => '%s can not be empty.',  
						'regex_match'  => '%s should be mobile format.',  
					) 
				);
				$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_checkPasswordValidation',
					array(
						'required'  => '%s can not be empty.',  
						'checkPasswordValidation'  => '! %s Must be include at least 4 charactor ...', 						
					) 
				);
				$this->form_validation->set_rules('password1', 'Confirm Password', 'trim|matches[password],required',
					array(
						'required'  => '%s can not be empty.',    
						'matches'  => '%s should be match.',    
					) 
				);
				
				if($this->form_validation->run() == TRUE)
				{
					
					/*=====Registration work ====*/
					$regdata=$this->input->post();
					// $pin=$regdata['pin'];
					// unset($regdata['pin']);
					unset($regdata['password1']);
					unset($regdata['register']); 
				 
					/*==Binary Tree work====*/
					
					$treeResult=createuserSide($this->input->post('referrer_id'),$this->input->post('tree_side'));
					if($treeResult=='0')
					{
						$tree_side=$this->input->post('referrer_id');
					}
					else
					{
						$tree_side=getUniqueIdById($treeResult);
					}
					
					/*==update unique id side under the referrer id===*/
					$updateTree=array(
						$this->input->post('tree_side')=>$this->input->post('unique_id'),
					);
					$this->Form_model->update_data('str_binarytree',$updateTree,'unique_id',$tree_side);
					
						/*=Insert data in str_binarytree create for binary structure tree==*/
					$treeArray=array(
						'unique_id'=>$this->input->post('unique_id'),  
					); 
				
					$this->Form_model->insert_data($treeArray,'str_binarytree');
					
					
				
					/*=Insert data in str_member create for member registration==*/
					
					
					// $pinAmountId=pinAmountIdByPinNo($pin);
					// $regdata['package_amount']=checkPinAmount($pin);
					// $regdata['business_volume']=checkPinBusinessVolume($pin);
					// $regdata['pv_value']=checkPinPvValue($pin);
					
					$regdata['package_amount']='0.00';
					$regdata['business_volume']='0.00';
					$regdata['pv_value']='0';
					$memberId=$this->Form_model->insert_data($regdata,'str_member');
					
					
					
					
					/*=Insert data in str_pinlist update entry	 for used pin==*/
					
					// $pinArray=array(
						// 'particular_id'=>'2',
						// 'used_status'=>'1',
						// 'used_byid'=>$memberId,
					// ); 
					// $this->Form_model->update_data('str_pinlist',$pinArray,'pin_no',$pin);
					  
					 /*==send mail==*/
					 	$message = "<html>
							<head>
							<title><a href='".base_url()."'  style='color:  rgb(255,110,0);text-decoration:none;'>AYRGROUP</a></title>
							</head>
							<body>
							<div>
							<p style='color:#333;font-size:14px;'>Hi ".$regdata['name_type']." ".$regdata['name']." !</p>
							<p style='color:#333;font-size:14px;'>Congratulation, You have successfully registered withus. Your Crediential is:- </p>
							<p style='color:#333;font-size:14px;'>Your Member ID is: - ".$regdata['unique_id']."</p>
							<p style='color:#333;font-size:14px;'>Your Password: - ".$regdata['password']."</p>
							<table>
							<tr>
							<td><br/>Thank you,<br/><br/><b style='color:  rgb(255,110,0);'>AYRGROUP</b></td>
							<td></td>
							</tr>
							</div>
							</table>
							</body>
							</html>"; 
							
					MailSentNow($message,'Registration',$regdata['email']);
					$this->session->set_userdata('storesucmsg','Congratulations,Member added successfully');
					
					if($this->session->userdata('userlogin')=='')
					{
					   header("location:".base_url('login'));  
					}
					else
					{
					    header("location:".base_url('genealogy'));
					}
					die;
				}
				else
				{
					$data['active']='2';
					// $data['pin']=$this->input->post('pin');
					$data['unique_id']=$this->input->post('referrer_id');
					$data['tree_side']=$this->input->post('tree_side');
				}
						
		}	
 
     	$this->load->view('common/headerall');
    	$this->load->view('registration/registration_page',$data);
    	$this->load->view('common/footer');
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
		$result=$this->db->select('pin_id')->where($data)->get('str_pinlist')->result();
		 
		if(!empty($result))
		{
			return  true;
		}
		else			
		{
			return  false;
		}
	}
	
	public function checkPasswordValidation($password)
	{ 
		 $totalPasswordCharactor = strlen($password);
		 
		 if((int)$totalPasswordCharactor<4) 
		 {
			return  false;
		}
		else			
		{
			return  true;
		}
	}
	
	function forgotpassword(){
		$this->load->view('common/headerall');
		$this->load->view('registration/forgotpassword');
		$this->load->view('common/footer');
	}
	
 
	function forgotPasswordEnd12(){ 
		$otp=$this->input->post('otp');
		$userId=$this->input->post('email'); 
		$result=$this->db->where(array('unique_id'=>$userId,'otp'=>$otp))->get('str_member')->result(); 
		
		if(!empty($result)){
			foreach($result as $key=>$value){}
			$mobileNo=$value->mobile;
			$password=$value->password;
			$txt="Your login password is:-".$password;		
			$this->Form_model->sendMsg($mobileNo,$txt); 
			$this->session->set_userdata('storesucmsg',"Password send sucessfully.");
			header("Location:".base_url('home'));		
		}else{		
				$this->session->set_userdata('storefailmsg',"Otp is not math please try again.");
				header("Location:".base_url('forgot-password'));
			}
		}

		function genrateOTP(){ 
	
		$userId=$_POST['otp'];
		 
		
		$result=$this->db->where('unique_id',$userId)->get('str_member')->result();
	 
		if(!empty($result))
		{
			foreach($result as $key=>$value){}
	

			/*==send mail==*/
			$message = "<html>
				<head>
				<title><a href='".base_url()."'  style='color:  rgb(255,110,0);text-decoration:none;'>AYRGROUP</a></title>
				</head>
				<body>
				<div>
				<p style='color:#333;font-size:14px;'>Hi ".$value->name_type." ".$value->name." !</p>
				<p style='color:#333;font-size:14px;'>Dear,Partner your password has been reset successfully and, Your Crediential is given below:- </p>
				<p style='color:#333;font-size:14px;'>Your Member ID is: - ".$value->unique_id."</p>
				<p style='color:#333;font-size:14px;'>Your Password: - ".$value->password."</p>
				<table>
				<tr>
				<td><br/>Thank you,<br/><br/><b style='color:  rgb(255,110,0);'>AYRGROUP</b></td>
				<td></td>
				</tr>
				</div>
				</table>
				</body>
				</html>"; 
				
			MailSentNow($message,'Forgot Password',$value->email);
			$this->session->set_userdata('storesucmsg','Password has been send your email Id');
			echo "1";
		}
		else{
			echo "0";
		}
	}
}
?>