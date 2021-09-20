<?php
class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->helper('query');
        $this->load->database();
        $this->load->model("admin/Admin_model");
    }
    public function index() {
        $root = root();
        if($this->session->userdata('store100mlmadmin')){
			header("location:".$root."admin/dashboard");
        }else{
			$data['title']="AYR Group Admin Login";
            $this->load->view('admin/login',$data);
        }
    }
    public function AdminLoginEnd() {
		 $root=root();
			$data = array(
                'user_name' =>$this->input->post('username'),
                'password' =>$this->input->post('password'),
            );
            $result=$this->Admin_model->get_result($data,'admin');
            if(empty($result)){
				 $Json['status']="0";
				 $Json['msg']="Invalid username/password";
            }
            else{
				foreach($result as $key=>$value){}
				 $Json['status']="1";
				 $Json['msg']="Login successfully";
                $this->session->set_userdata('store100mlmadmin',$value->id); 
            } 
			$final_result=json_encode($Json);
			echo $final_result;
			die;
      }
	  
	public function changeusername(){ 
		$data['title']='Admin Change Username';
        $this->load->view('admin/header',$data);
        $this->load->view('admin/change_username');
        $this->load->view('admin/footer');
    }
	  
	  public function usernamechangeEnd(){
        $root = root(); 
           $data=array(
                'user_name'=>$this->input->post('username'),
            );
        shweta_popular('admin',$data,'id','1');
		$json['status']='1';
		$json['admin_name']=ucfirst($data['user_name']);
		$final_result=json_encode($json);
		echo $final_result;
		die;
    } 
	  
	  public function changepassword(){
        $data['title']='Admin Change Password';
        $this->load->view('admin/header',$data);
        $this->load->view('admin/change_password');
        $this->load->view('admin/footer');
    }  
	  
	  public function Passwordchangeend(){
        $root = root();
        $adminid=$this->session->userdata('mlmadmin');
        $oldpassword=$this->input->post('o_pass');
        $newpassword=$this->input->post('n_pass');
        $confirmpassword=$this->input->post('c_pass');
        $data=array(
            'password'=>$newpassword,
        );
        $condition="";
         $condition="id='".$this->session->userdata('store100mlmadmin')."' and password='".$oldpassword."'";
		 $result=array();
        $result=SelectQuery_th('*','admin',$condition);
        if(empty($result)){
			$json['status']="0";
			$json['msg']="Old Password not matched"; 
        }
        else{
            if($newpassword == $confirmpassword){
                shweta_popular('admin',$data,'id',$adminid);
				$json['status']="1";
				$json['msg']="Password Changed Successfully"; 
            }
            else{
				$json['status']="1";
				$json['msg']="Password not matched";  
            }
		}
		$final_result=json_encode($json);
		echo $final_result;
		die;
    } 
	  
	 public function logout() {  
        $this->session->unset_userdata('store100mlmadmin');
        header("location: ".root().'admin');
        die;
    } 
}
?>