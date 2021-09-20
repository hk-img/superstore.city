<?php
class Pin extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Form_model');
	} 
	
	 public function index()
	 {
		$data['title']="Create Pin"; 
		$result['pinAmount']=$this->db->where('status','1')->get('str_pin_amount')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/pin/create_pin',$result);
		$this->load->view('admin/footer');
	}
	
	public function createPinEnd()
	{
		$pin=array();
		$totalPin=$_POST['pin_no'];
		$amount=$_POST['amount']; 
		$business_volume=$_POST['business_volume']; 
		$pv_value=$_POST['pv_value']; 
		
		$Pinresult=selectQuery('pin_id','str_pinlist','','');
		$alreadyCreatedPin=count($Pinresult);
		$totalpinAftercreated=$alreadyCreatedPin+$totalPin;
		$duePinAfterCreated=9000000-$alreadyCreatedPin;
		if($totalPin>0)
		{
			if($totalpinAftercreated<='9000000')
			{
				for ($x = 1; $x <= $totalPin; $x++) {
					$pin[]=$this->_createUniquePin();
				} 
				/*==save pin after genrated==*/
				
				if(!empty($pin))
				{
					foreach($pin as $pinKey)
					{
						$pinResult=array(
							'pin_no'=>$pinKey,
							'amount'=>$amount,
							'business_volume'=>$business_volume,
							'pv_value'=>$pv_value,
						);
						shweta_insert_form('str_pinlist',$pinResult);
					}
				 }
				 
				 $json['status']='1';
				$json['msg']='Pin created successfully.';
			}
			else
			{
				$duePin=
				$json['status']='0';
				$json['msg']='Only '.$duePinAfterCreated.' Available at this time.';
			}
		 }
		else
		{
			$json['status']='0';
			$json['msg']='Pin No must be greater than 0.';
		}
		echo json_encode($json);
		die;
	}
	 
	public function _createUniquePin()
	{
		$pinNo=rand(100000,999999);
		/*==Check exist pin no==*/
		$result=SelectQuery('pin_id','str_pinlist','pin_no',$pinNo);
		if(!empty($result))
		{
			return $this->_createUniquePin();
		}
		else
		{
			return $pinNo;
		}
	}
	
	public function allPin()
	{
		$data['title']="All Pin"; 
		$this->load->view('admin/header',$data);
		$this->load->view('admin/pin/all_pin');
		$this->load->view('admin/footer');
	}
	
	public function checkUniqueId(){
		$unique_id=$this->input->post('assignUser_name');
		$cond="status='1' and unique_id='".$unique_id."'";
		  $result=SelectQuery_th('member_id','str_member',$cond);
		if(!empty($result)){
			echo(json_encode(true));
		}else{
			echo(json_encode(false));
		} 
	}
	
	public function pinAssignEnd()
	{
		$userId=$_GET['userId'];
		$uniqueId=$_POST['assignUser_name'];
		$memberId=getIdByUniqueId($uniqueId);
		 if($userId!='')
		 {
			 $userIdArray=explode(',',$userId);
			 foreach($userIdArray as $userIdArrayKey)
			 {
				 $pinArray=array(
					'assign_userid'=>$memberId
				 );
				 shweta_popular('str_pinlist',$pinArray,'pin_id',$userIdArrayKey);
			 }
			 $json['status']='1';
			 $json['msg']="Pin Assigned Successfully.";
		 }
		 else
		 {
			 $json['status']='0';
			 $json['msg']="Something Wrong.Please try Again.";
		 }
		 echo json_encode($json);
		 die;
	}
		
}
?>