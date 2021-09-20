<?php
class Achiver extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Form_model');
	} 
	 public function index($id=NULL)
	 {
	     $data['title']="Add Achiever";
		 $result['result']=array();
		 if($id!='')
		 {
			 $result['result']=$this->db->where('id',$id)->get('achiever')->row();
		 }
		$this->load->view('admin/header',$data);
		$this->load->view('admin/achiver/add_achiver',$result);
		$this->load->view('admin/footer');
	}
	 
	 public function addachiverEnd()
	 {
		 $data=$_POST;
	    if($data['id']=='')
		{
			unset($data['id']);
			$this->db->insert('achiever',$data);
			$json['msg']="Achiver Added successfully.";
		}
		else
		{
			$this->db->where('id',$data['id'])->update('achiever',$data);
			$json['msg']="Achiver updated successfully.";
		}
		$json['status']='1';
		echo json_encode($json);
		die;
	}
	 
	 public function showAchiver()
	 {
		 $data['title']="Show Achiever";
		 $result['result']=$this->db->order_by('id','desc')->get('achiever')->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/achiver/allachiver',$result);
		$this->load->view('admin/footer');
	 }
	 
	 
	 public function deleteAchiver($id)
	 {
		 $this->db->where('id',$id)->delete('achiever');
		 $this->session->set_userdata('digitalcashadminmessageTrue','Achiver deleted successfully.');
		 header("location:".base_url('admin/show-achiver'));
		 die;
	 }
}
?>