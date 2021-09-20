<?php
class Product extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Form_model'); 
	 
	} 
	 
	public function index()
	{
	    $this->session->set_userdata('tabmenu','product');
		$data['title']="All Product";
		$this->load->view('common/headerall');
		$this->load->view('product/allProduct');
		$this->load->view('common/footer');
	}
	 
	
	function repurchaseProduct()
	{
		
		if($this->session->userdata('userlogin')=='')
		{
			$this->session->userdata('storefailmsg','Please First Login.');
			header("location:".base_url()."login");
			die;
		}
		
		$result['product_list']=$this->db->where('status','1')->get('products')->result_array();
 	
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			
			$this->load->library('form_validation');

			
			/*==check Select Product id==*/
			
			$this->form_validation->set_rules('product_id[]', 'Product Name', 'trim|required', array('required'  => '! %s can not be empty.') );
			
			/*==check Select Product Qty==*/
			
			$this->form_validation->set_rules('qty[]', 'Product Qty', 'trim|required|callback_chkProductQty',
			array(
				'required'  => '! %s can not be empty.',
				'chkProductQty'=>'! %s must be greater than 0.'
			) );
			
			
			/*==check Pin Detail==*/
			
			$this->form_validation->set_rules('pin', 'E-PIN', 'trim|required|callback_ischeckvalidPinExist|callback_ischeckvalidProductPinExist',
				array(
					'required'  => '%s Can not be empty.',  
					'ischeckvalidPinExist'  => '! Please Enter Valid E-pin.',  
					'ischeckvalidProductPinExist'  => '! Please Use valid Pin For Purchase this Products.',  
				) 
			);
			 
			if($this->form_validation->run()==TRUE)
			{
				$getTotalProductAmount=$this->Form_model->getProductAmountById($this->input->post('product_id'),$this->input->post('qty'));
	
				/*==UPDATE PIN DATA==*/
				
				$pinArray=array(
					'particular_id'=>'13',
					'used_status'=>'1',
					'used_byid'=>$this->session->userdata('userlogin'),
				); 
				
				$this->Form_model->update_data('str_pinlist',$pinArray,'pin_no',$this->input->post('pin'));
				
				$data=array(
					'user_id'=>$this->session->userdata('userlogin') ,
					'product_id'=>implode(',',$this->input->post('product_id')),
					'qty'=>implode(',',$this->input->post('qty')),
					'amount'=>$getTotalProductAmount['price'],
					'dealer_price'=>$getTotalProductAmount['dealer_price'],
					'business_volume'=>$getTotalProductAmount['business_volume'],
				);
				
				$this->db->insert('repurchase_product',$data);
				$id=$this->db->insert_id();
				$orderId=createOrderNo($id);
				$this->session->set_userdata('storesucmsg','Product Purchase Successfully.and Your purchase order is:-'.$orderId);
				
				/*==CREATE REPURCHASE BONUS FOR COUNTINUS 6 MONTH==*/
				
				$this->createRepurchaseBonus($getTotalProductAmount['dealer_price']); 
				
				header("location:".root()."repurchase-product"); 
				die;
			}
		}
		
		$header['title']="Repurchase Product";
		$this->load->view('common/dashboard-header',$header); 
		$this->load->view('product/repurchase_product',$result); 
		$this->load->view('common/dashboard-footer'); 
	}
	
	function getProductHtml()
	{
		$productId=$this->input->post('productId');
		$allQty=explode(',',$this->input->post('allQty'));
		$tableProductId=explode(',',$this->input->post('tableProductId'));
		
		$tableHtml='';
		
		if($productId!='')
		{
			$i=1;
			
			foreach($productId as $productIdValue)
			{
				$productResult=$this->db->where('id',$productIdValue)->get('products')->row_array();
				
				$tableHtml.='
					<tr>
						<td>'.$i.'</td>
						<td>'.ucfirst($productResult['name']).'</td>
						<td>'.number_format($productResult['price'],2).'<input type="hidden" value="'.$productResult['price'].'" class="price"/></td>
						<td>'.number_format($productResult['dealer_price'],2).'<input type="hidden" value="'.$productResult['dealer_price'].'" class="dealer_price"/></td>
						<td>'.number_format($productResult['business_volume'],2).'<input type="hidden" value="'.$productResult['business_volume'].'" class="business_volume"/></td>
						<td><input type="text" name="qty[]" class="form-control qtyValue" value="1" placeholder="Qty" onkeypress="return isNumberKey(event)" min="1" onchange="getProductAmount()"/></td>
					</tr>
				';
				
				$i++;
			}
		}
		else
		{
			$tableHtml.='
				<tr>
					<td colspan="6" style="text-align:center">Please Select at least One Product.</td>
				</tr>
			';
		}
		
		
		$json['tableHtml']=$tableHtml;
		
		echo json_encode($json);
		die;
	}
 
	public function getProductAmount()
	{
		$allQty=explode(',',$this->input->post('allQty'));
		$allproductDp=explode(',',$this->input->post('allproductDp'));
		$allproductBv=explode(',',$this->input->post('allproductBv'));
		$allproductPrice=explode(',',$this->input->post('allproductPrice'));
		
		$amount='0';$dealerAmount='0';$businessVolume='0';
		
		if((count($allQty)==count($allproductDp)) && (count($allproductDp)==count($allproductBv)) && (count($allproductPrice)==count($allproductBv)) && (count($allproductPrice)==count($allQty)))
		{
			
			$index=0;
			
			foreach($allproductPrice as $allproductPriceValue)
			{
				$amount+=(((float)($allproductPriceValue))*((int) $allQty[$index]));
				$dealerAmount+=(((float)($allproductDp[$index]))*((int) $allQty[$index]));
				$businessVolume+=(((float)($allproductBv[$index]))*((int) $allQty[$index]));
				
				$index++;
			}

			$json['error']='0';
			$json['amount']=$amount;
			$json['dealer_price']=$dealerAmount;		
			$json['business_volume']=$businessVolume;		
		}
		else
		{
			$json['error']='1';
			
			$this->session->set_userdata('storefailmsg','Some error found.Please check.');
		}
		
		echo json_encode($json);
		die;		
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
	
	public function chkProductQty($key)
	{ 
		$error=0;
		$key=$this->input->post('qty');
		
		foreach($key as $value)
		{
			if((int) $value<=0)
			{
				$error++;
			}
		}
		
		if($error=='0')
		{
			return  true;
		}
		else			
		{
			return  false;
		}
	}
	
	public function ischeckvalidProductPinExist($key)
	{  
 
		$result=$this->db->select('amount')->where(array('pin_no'=>$key,'used_status'=>'0','status'=>'1'))->get('str_pinlist')->row_array();
		
		if(!empty($result))
		{
			
			$productId=$this->input->post('product_id');
			$productQty=$this->input->post('qty');
		
			$getTotalProductAmount=$this->Form_model->getProductAmountById($productId,$productQty);

			if(($getTotalProductAmount['dealer_price']==$result['amount']) && $getTotalProductAmount['dealer_price']>0)
			{
				return true;
			}
			else
			{
				return false;
			} 
		}
		else
		{
			return false;
		} 
	}
	
	function createRepurchaseBonus($amount)
	{
		$userId=$this->session->userdata('userlogin');
		
		$times=1;
		
		$getLastResult=$this->db->select('bonus_enddate')->where(array('user_id'=>$userId,'amount'=>$amount))->order_by('bonus_id','DESC')->get('repurchase_bonus')->row_array();

		for($i=1;$i<=5;$i++)
		{
			$result=array();
			$date=date("Y-m-d",strtotime('-'.$i.' month'));
			$curYear=date("Y",strtotime($date));
			$curMonth=date("m",strtotime($date));			
			$cond="purchase_id!='0'";
			if(!empty($getLastResult))
			{
				$cond="date(created_date)>'".$getLastResult['bonus_enddate']."'";
			}
			$result=$this->db->select('purchase_id')->where($cond)->where(array('user_id'=>$userId,'dealer_price'=>$amount,'year(created_date)'=>$curYear,'month(created_date)'=>$curMonth))->get('repurchase_product')->result_array();
			
			if(!empty($result)){ $times++; }else{ break; }
		}
		
		if($times==6)
		{
			$insert=array(
				'user_id'=>$userId,
				'amount'=>$amount,
				'bonus_startdate'=>date("Y-m-01",strtotime("-5 month")),
				'bonus_enddate'=>date("Y-m-t")
			);
			
			$this->db->insert('repurchase_bonus',$insert);
		} 
	}
	
	function allRepurchase()
	{
		
		if($this->session->userdata('userlogin')=='')
		{
			$this->session->userdata('storefailmsg','Please First Login.');
			header("location:".base_url()."login");
			die;
		}
	    $header['title']="Purchase List";
	    $result['result']=$this->db->where('user_id',$this->session->userdata('userlogin'))->get('repurchase_product')->result_array();
	    $this->load->view('common/dashboard-header'); 
		$this->load->view('product/repurchase_list',$result); 
		$this->load->view('common/dashboard-footer'); 
	}
}
?>