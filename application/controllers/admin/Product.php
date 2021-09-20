<?php
class Product extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Form_model');
	} 
	 public function index($id=NULL)
	 {
	     $data['title']="Add Product";
		 $result['result']=array();
		 if($id!='')
		 {
			 $result['result']=$this->db->where('id',$id)->get('products')->row();
		 }
		$this->load->view('admin/header',$data);
		$this->load->view('admin/product/add_product',$result);
		$this->load->view('admin/footer');
	}
	 
	 public function AddProductEnd()
	 {
		 $data=$_POST;
		$data['image_name']=$this->input->post('image');
		if(isset($_FILES['image_name']['name'])){
			if($_FILES['image_name']['name'] !=""){
				$ran_no = rand(100000,999999);
				$config['file_name']=newslugend($this->input->post('name').'-product-image'.$ran_no);
				$this->load->library('upload');
				$config['upload_path']   = './web_root/images/product_image/';
				$config['allowed_types'] = 'jpg|jpeg|gif|png';
				$config['max_size']      = 8000;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$this->upload->initialize($config); 
				$this->upload->do_upload('image_name');
				$upload_data = $this->upload->data();
				$data['image_name'] = $upload_data['file_name'];
			}
		}
	  
	  unset($data['image']);
	 
	  if($data['id']=='')
	  {
	      unset($data['id']);
	      $this->db->insert('products',$data);
	      $this->session->set_userdata('digitalcashadminmessageTrue','Product Added Successfully');
	  }
	  else
	  {
	      $this->db->where('id',$data['id'])->update('products',$data);
	      $this->session->set_userdata('digitalcashadminmessageTrue','Product Updated Successfully');
	  }
	  
	  header("location:".base_url('admin/show-product'));
	}
	 
	 public function showProduct()
	 {
		 $data['title']="Show Product";
		 $result['result']=$this->db->order_by('id','desc')->get('products')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/product/allProduct',$result);
		$this->load->view('admin/footer');
	 }
	 
	 
	 public function deleteProduct($id)
	 {
		 $this->db->where('id',$id)->delete('products');
		 $this->session->set_userdata('digitalcashadminmessageTrue','Product deleted successfully.');
		 header("location:".base_url('admin/show-product'));
		 die;
	 }
	 
	 public function changeStatus($productId,$status)
	 {
	     $this->db->where('id',$productId)->update('products',array('status'=>$status));
	     $this->session->set_userdata('digitalcashadminmessageTrue','Product status changed Successfully');
	     header("location:".base_url('admin/show-product'));
	 }
	 
	 public function changeDeliveryStatus($productId,$status)
	 {
		 $data['delivery_date']=NULL;
		 
		 if($status=='1')
		 {
			 $data['delivery_date']=date("Y-m-d H:i:s");
		 }
		 $data['delivery_status']=$status;
	     $this->db->where('purchase_id',$productId)->update('repurchase_product',$data);
	     $this->session->set_userdata('digitalcashadminmessageTrue','Product Delivery status changed Successfully');
	     header("location:".base_url('admin/show-repurchase-product'));
	 }
	 
	public function showRepuProduct()
	{
		$data['title']="Repurchase Product List";
		$result['result']=$this->db->order_by('purchase_id','desc')->get('repurchase_product')->result_array();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/product/allrepProduct',$result);
		$this->load->view('admin/footer');
	}
	
	public function repurchaseBonus()
	{
		$data['title']="Repurchase Bonus List";
		$result['result']=$this->db->order_by('bonus_id','desc')->get('repurchase_bonus')->result_array();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/product/repurchase_bonus',$result);
		$this->load->view('admin/footer');
	}
	
	public function changeBonusDeliveryStatus($productId,$status)
	{
		 $data['delivered_date']=NULL;
		 
		 if($status=='1')
		 {
			 $data['delivered_date']=date("Y-m-d H:i:s");
		 }
		 $data['delivered_status']=$status;
		 $this->db->where('bonus_id',$productId)->update('repurchase_bonus',$data);
		 $this->session->set_userdata('digitalcashadminmessageTrue','Product Delivery Bonus status changed Successfully');
		 header("location:".base_url('admin/repurchase-bonus'));
		 die;
	 }
}
?>
