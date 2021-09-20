<?php



class Home extends CI_Controller {



function __construct() {

parent::__construct();

	$this->load->helper('form');

	$this->load->library('session');

	$this->load->helper('query');

	$this->load->database();

	$this->load->model("admin/Admin_model");

 }

	public function index() 
	{ 
		$data['title']='Admin Dashboard';
		$this->load->view('admin/header',$data); 
		$this->load->view('admin/dashboard'); 
		$this->load->view('admin/footer'); 
	}
	
	public function bonanzaOffer() 
	{ 
		$data['title']='Bonanza offer';
		
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$update['image_name']='';
			if(file_exists('./web_root/images/'.$this->input->post('image')))
			{
				unlink('./web_root/images/'.$this->input->post('image'));
			}
			if(isset($_FILES['image_name']['name']))
			{
				if($_FILES['image_name']['name'] !="")
				{
					$ran_no = rand(100000,999999);
					$config['file_name']='offerbonanza-image'.$ran_no;
					$this->load->library('upload');
					$config['upload_path']   = './web_root/images/';
					$config['allowed_types'] = 'jpg|jpeg|gif|png';
					$config['max_size']      = 8000;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->upload->initialize($config); 
					$this->upload->do_upload('image_name');
					$upload_data = $this->upload->data();
					$update['image_name'] = $upload_data['file_name'];
				}
				
				$this->db->where('offer_id','1')->update('str_bonanzaoffer',$update);
				$this->session->set_userdata('digitalcashadminmessageTrue','Offer Image updated successfully');
			}
		}
		$result['result']=$this->db->where('offer_id','1')->get('str_bonanzaoffer')->row_array();
		$this->load->view('admin/header',$data); 
		$this->load->view('admin/bonanza_offer',$result); 
		$this->load->view('admin/footer'); 
	}

 }

?>