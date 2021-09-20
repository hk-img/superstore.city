<?php
class Form_model extends CI_Model{
public function __construct() {
parent::__construct();
$this->load->helper('query');
}
 
	public function show_pagination_filter($limit,$start,$table_name,$condition){
	$data=array();
        $query = order_by_limit_new('*',$table_name,$condition,$limit, $start,'id','DESC');
		if ($query > 0) {
            foreach ($query as $row) {
                $data[] = $row;
            } 
            return $data;
        }
        return false;
}

}
?>