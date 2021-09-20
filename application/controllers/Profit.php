<?php
class Profit extends CI_Controller {
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
	 
	public function previousProfit()
	{
		$data['title']="Previous Profit";
		  $this->load->view('common/headerall');
		 $this->load->view('profit/profit');
		 $this->load->view('common/footer');
	}
	 
	public function currentProfit()
	{ 
		$data['title']="Current Profit";
		$this->load->view('common/dashboard-header',$data);
		 $this->load->view('profit/current_profit');
		 $this->load->view('common/dashboard-footer');
	}
	
	public function getPreviousProfit()
	{  
	
		$profit=array();
		$getProfitResult=$this->db->where(array('user_id'=>$this->session->userdata('userlogin'),'date(created_date) < '=>date("Y-m-d")))->get('str_userincome')->result();
		
		 if(!empty($getProfitResult))
		{	
			$i=1;
			foreach($getProfitResult as $getProfitResultKey=>$getProfitResultValue)
			{
				$profit=array(
					'id'=>$i,
					'leftpv'=>$getProfitResultValue->left_pv,
					'rightpv'=>$getProfitResultValue->right_pv,
					'carryleftpv'=>$getProfitResultValue->carry_leftpv,
					'carryrightpv'=>$getProfitResultValue->carry_rightpv,
					'netpairs'=>$getProfitResultValue->net_pairs,
					'binary'=>$getProfitResultValue->binary_income,
					'leadership'=>$getProfitResultValue->leadership_amount,
					'leadbooster_amount'=>$getProfitResultValue->leadbooster_amount,
					'upline_bonus'=>$getProfitResultValue->upline_bonus,
					'grossAmount'=>$getProfitResultValue->gross_amount,
					'tds'=>$getProfitResultValue->tds_amount,
					'admin_tds'=>$getProfitResultValue->admin_amount,
					'newAmount'=>$getProfitResultValue->net_amount,
					'onDate'=>date("d/m/Y", strtotime($getProfitResultValue->created_date)),
				);
				$i++;
				$profitFinal[]=$profit;
			}
	 	}
		else
		{
			$profitFinal=array();
		}
		
		
		$jsonFinal = json_encode(array('data' => $profitFinal));
		echo  $jsonFinal;
		die;
	}
	
	public function getCurrentProfit()
	{  
		$profit=array();
		$getProfitResult=$this->db->where(array('user_id'=>$this->session->userdata('userlogin')))->get('str_userincome')->result();
		
		 if(!empty($getProfitResult))
		{	
			$i=1;
			foreach($getProfitResult as $getProfitResultKey=>$getProfitResultValue)
			{
				$profit=array(
					'id'=>$i,
					'leftpv'=>$getProfitResultValue->left_pv,
					'rightpv'=>$getProfitResultValue->right_pv,
					'carryleftpv'=>$getProfitResultValue->carry_leftpv,
					'carryrightpv'=>$getProfitResultValue->carry_rightpv,
					'netpairs'=>$getProfitResultValue->net_pairs,
					'binary'=>$getProfitResultValue->binary_income,
                    'leadership'=>$getProfitResultValue->leadership_amount,
					'leadbooster_amount'=>$getProfitResultValue->leadbooster_amount,
					'upline_bonus'=>$getProfitResultValue->upline_bonus,
					'grossAmount'=>$getProfitResultValue->gross_amount,
					'tds'=>$getProfitResultValue->tds_amount,
					'admin_tds'=>$getProfitResultValue->admin_amount,
					'newAmount'=>$getProfitResultValue->net_amount,
					'onDate'=>date("d/m/Y", strtotime($getProfitResultValue->created_date)),
				);
				$i++;
				$profitFinal[]=$profit;
			}
	 	}
		else
		{
			$profitFinal=array();
		}
		
		
		$jsonFinal = json_encode(array('data' => $profitFinal));
		echo  $jsonFinal;
		die;
	}
	
	
	public function reward()
	{
		$data['title']="Previous Profit";
		$result['result']=$this->db->where('user_id',$this->session->userdata('userlogin'))->get('achieve_reward')->result();
		 $this->load->view('common/headerall');
		 $this->load->view('profit/reward',$result);
		 $this->load->view('common/footer');
	}
}
?>