<?php
class News extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Form_model');
	} 
	 public function index($id=NULL)
	 {
	     $data['title']="Add News";
		 $result['result']=array();
		 if($id!='')
		 {
			 $result['result']=$this->db->where('id',$id)->get('news')->row();
		 }
		$this->load->view('admin/header',$data);
		$this->load->view('admin/news/add_news',$result);
		$this->load->view('admin/footer');
	}
	 
	 public function addNewsEnd()
	 {
		$data=$this->input->post();
		$data['image_name']=$this->input->post('image');
	
		if(isset($_FILES['image_name']['name']))
		{
			if($_FILES['image_name']['name']!="")
			{
				$ran_no = rand(100000,999999);
				$config['file_name']=newslugend($this->input->post('name').'-news-image'.$ran_no);
				$this->load->library('upload');
				$config['upload_path']   = './web_root/admin_root/img/';
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
		
		if($this->input->post('image')!='' && $_FILES['image_name']['name']!='')
		{
			if(file_exists("./web_root/admin_root/img/".$this->input->post('image')))
			{
				unlink("./web_root/admin_root/img/".$this->input->post('image'));
			}
		}
		
		unset($data['image']);
		
	    if($data['id']=='')
		{
			unset($data['id']);
			$this->db->insert('news',$data);
			$this->session->set_userdata('digitalcashadminmessageTrue','News Added successfully.');
			$json['msg']="News Added successfully.";
		}
		else
		{
			$this->db->where('id',$data['id'])->update('news',$data);
			$this->session->set_userdata('digitalcashadminmessageTrue','News updated successfully.');
		}
		
		 header("location:".base_url('admin/show-latest-news'));
		 
		die;
	}
	 
	 public function showNews()
	 {
		 $data['title']="Show News";
		 $result['result']=$this->db->order_by('id','desc')->get('news')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/news/allNews',$result);
		$this->load->view('admin/footer');
	 }
	 
	 
	 public function deleteNews($id)
	 {
		 $this->db->where('id',$id)->delete('news');
		 $this->session->set_userdata('digitalcashadminmessageTrue','News deleted successfully.');
		 header("location:".base_url('admin/show-latest-news'));
		 die;
	 }
}
?>