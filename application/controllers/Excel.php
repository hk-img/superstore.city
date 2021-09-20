<?php
class Excel extends CI_Controller {
function __construct() {
parent::__construct();
$this->load->helper('form');
$this->load->library('session');
$this->load->helper('query');
$this->load->model('admin/Admin_model');
$this->load->model('Form_model');
}
function data(){	
}
function searchmemberReport(){
	$cond='';
	$from=date("Y-m-d 00:00:00", strtotime($this->input->post('from')));
	$to=date("Y-m-d 23:59:59", strtotime($this->input->post('to')));
	$cond='';
	if($this->input->post('userstatus')==2){
		$cond="join_date>= '".$from."' and join_date<='".$to."'";
	}elseif($this->input->post('userstatus')==1){	
		$cond="status='1' and approval='1' and (join_date>= '".$from."' and join_date<='".$to."')";
	}elseif($this->input->post('userstatus')==0){	
		$cond="status='0' and  approval='0' and (join_date>= '".$from."' and join_date<='".$to."')";
	}
	$result=shweta_select_th('*','member_registration',$cond);

       $i=0;
        if(!empty($result)){

            require_once('export_file_excel/Classes/PHPExcel.php');
            // echo "aa";
            // die;
            $objPHPExcel = new PHPExcel;
            // set default font
            $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
            // set default font size
            $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
            // create the writer
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
            // currency format, € with < 0 being in red color
            $currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';
            // number format, with thousands separator and two decimal points.
            $numberFormat = '#,#0.##;[Red]-#,#0.##';
            // writer already created the first sheet for us, let's get it
            $objSheet = $objPHPExcel->getActiveSheet();
            // rename the sheet
            $objSheet->setTitle('My sales report');
            // let's bold and size the header font and write the header
            // as you can see, we can specify a range of cells, like here: cells from A1 to A4
            $objSheet->getStyle('A1:L1')->getFont()->setBold(true)->setSize(12);
            
            // write header
            $objSheet->getCell('A1')->setValue('S.NO');
            $objSheet->getCell('B1')->setValue('Name');
            $objSheet->getCell('C1')->setValue('Unique_id');
            $objSheet->getCell('D1')->setValue('Reference_id');
            $objSheet->getCell('E1')->setValue('dob');
            $objSheet->getCell('F1')->setValue('Email');
            $objSheet->getCell('G1')->setValue('Product Detail');
            $objSheet->getCell('H1')->setValue('Father Name');
            $objSheet->getCell('I1')->setValue('Gender');
            $objSheet->getCell('J1')->setValue('Mobile');
            $objSheet->getCell('K1')->setValue('Address');
            $objSheet->getCell('L1')->setValue('City');
            $objSheet->getCell('M1')->setValue('State');
            $objSheet->getCell('N1')->setValue('Pincode');
            $objSheet->getCell('O1')->setValue('Pan_no');
            $objSheet->getCell('P1')->setValue('Bank_name');
            $objSheet->getCell('Q1')->setValue('Account_no');
            $objSheet->getCell('R1')->setValue('Ifsc_code');
            $objSheet->getCell('S1')->setValue('Join_date');
            $objSheet->getCell('T1')->setValue('Product date');
            // we could get this data from database, but here we are writing for simplicity
            $i=2;
            $s_no=1;
 
            $availableAmount=0;
            foreach($result AS $a=>$p){
				$name1=array();
				  $proId11='';
				   $proId11=$p->product_id;
				   $proIdNew=array();
				  $proIdNew=explode('$$',$proId11);
				   foreach($proIdNew as $proIdNewValue){
					  foreach(SelectQuery('name','products','id',$proIdNewValue) as $raa) $name1[]=$raa->name;
				   }				   
				   $productName=implode(' $$ ',$name1);
             $objSheet->getCell('A'.$i)->setValue($s_no);
			$objSheet->getCell('B'.$i)->setValue(ucfirst($p->name));
			$objSheet->getCell('C'.$i)->setValue($p->unique_id);
			$objSheet->getCell('D'.$i)->setValue($p->reference_id);
             $objSheet->getCell('E'.$i)->setValue($p->dob);
             $objSheet->getCell('F'.$i)->setValue($p->email);
             $objSheet->getCell('G'.$i)->setValue($productName);
             $objSheet->getCell('H'.$i)->setValue(ucfirst($p->fname));
             $objSheet->getCell('I'.$i)->setValue(ucfirst($p->gender));
             $objSheet->getCell('J'.$i)->setValue($p->mobile);
             $objSheet->getCell('K'.$i)->setValue(ucfirst($p->address));
             $objSheet->getCell('L'.$i)->setValue(ucfirst($p->city));
             $objSheet->getCell('M'.$i)->setValue(ucfirst($p->state));
             $objSheet->getCell('N'.$i)->setValue($p->pincode);
             $objSheet->getCell('O'.$i)->setValue($p->pincode);
             $objSheet->getCell('P'.$i)->setValue(ucfirst($p->bank_name));
             $objSheet->getCell('Q'.$i)->setValue($p->account_no);
             $objSheet->getCell('R'.$i)->setValue($p->ifsc_code);
             $objSheet->getCell('S'.$i)->setValue($p->join_date);
             $objSheet->getCell('T'.$i)->setValue($p->product_date);
            $i++;
            $s_no++;
            }
            // autosize the columns
            $objSheet->getColumnDimension('A')->setAutoSize(true);
            $objSheet->getColumnDimension('B')->setAutoSize(true);
            $objSheet->getColumnDimension('C')->setAutoSize(true);
            $objSheet->getColumnDimension('D')->setAutoSize(true);
            $objSheet->getColumnDimension('E')->setAutoSize(true);
            $objSheet->getColumnDimension('F')->setAutoSize(true);
            $objSheet->getColumnDimension('G')->setAutoSize(true);
            $objSheet->getColumnDimension('H')->setAutoSize(true);
            $objSheet->getColumnDimension('I')->setAutoSize(true);
            $objSheet->getColumnDimension('J')->setAutoSize(true);
            $objSheet->getColumnDimension('K')->setAutoSize(true);
            $objSheet->getColumnDimension('L')->setAutoSize(true);
            $objSheet->getColumnDimension('M')->setAutoSize(true);
            $objSheet->getColumnDimension('N')->setAutoSize(true);
            $objSheet->getColumnDimension('O')->setAutoSize(true);
            $objSheet->getColumnDimension('P')->setAutoSize(true);
            $objSheet->getColumnDimension('Q')->setAutoSize(true);
            $objSheet->getColumnDimension('R')->setAutoSize(true);
            $objSheet->getColumnDimension('S')->setAutoSize(true);
            $objSheet->getColumnDimension('T')->setAutoSize(true);
 
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Member registration List.xls"');
header('Cache-Control: max-age=0');
// echo "aa";
            // die;
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// echo "aa";
            // die;
// ob_clean();
$objWriter->save('php://output');
        }else{
			$root = "http://".$_SERVER['HTTP_HOST'];
			$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
			$this->session->set_userdata('message','No Record Found');
			header("location:".$root."show-user");
			
		}
       

      }
function showstatement(){
  
	$result=shweta_select_thdistinct('user_id','str_wallet','');

       $i=0;
        if(!empty($result)){
            require_once('export_file_excel/Classes/PHPExcel.php');
            // echo "aa";
            // die;
            $objPHPExcel = new PHPExcel;
            // set default font
            $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
            // set default font size
            $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
            // create the writer
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
            // currency format, € with < 0 being in red color
            $currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';
            // number format, with thousands separator and two decimal points.
            $numberFormat = '#,#0.##;[Red]-#,#0.##';
            // writer already created the first sheet for us, let's get it
            $objSheet = $objPHPExcel->getActiveSheet();
            // rename the sheet
            $objSheet->setTitle('Statement');
            // let's bold and size the header font and write the header
            // as you can see, we can specify a range of cells, like here: cells from A1 to A4
            $objSheet->getStyle('A1:I1')->getFont()->setBold(true)->setSize(12);
            
            // write header
            $objSheet->getCell('A1')->setValue('Sno');
            $objSheet->getCell('B1')->setValue('User id');
            $objSheet->getCell('C1')->setValue('User Name');
            $objSheet->getCell('D1')->setValue('Total Amount');
            $objSheet->getCell('E1')->setValue('Due Amount');
            $objSheet->getCell('F1')->setValue('Complete Amount');
            $objSheet->getCell('G1')->setValue('Bank Name');
            $objSheet->getCell('H1')->setValue('Account No.');
            $objSheet->getCell('I1')->setValue('IFSC Code');
            // we could get this data from database, but here we are writing for simplicity
            $i=2;$d=2;
            $s_no=1;
            foreach($result AS $a=>$p){
					$srosdata="H".$i."";
					$crBalance=$this->Form_model->totalGrossBalance($p->user_id);
					$confirmBalance=$this->Form_model->confirmGrossBalance($p->user_id); 
					$pendingBalance=$this->Form_model->confirmPendingBalance($p->user_id); 
					$dueAmount=number_format((($crBalance)-$confirmBalance),2);  
					
				$unique_id='';$account_no='';$ifsc_code='';$name='';$bank_name='';
				foreach(SelectQuery('unique_id','str_member','member_id',$p->user_id) as $raa) $unique_id=$raa->unique_id;
				foreach(SelectQuery('account_no','str_member','member_id',$p->user_id) as $raa) $account_no= $raa->account_no;
				foreach(SelectQuery('bank_name','str_member','member_id',$p->user_id) as $raa) $bank_name= $raa->bank_name;
				foreach(SelectQuery('ifsc_code','str_member','member_id',$p->user_id) as $raa) $ifsc_code= strtoupper($raa->ifsc_code);
				foreach(SelectQuery('name','str_member','member_id',$p->user_id) as $raa) $name= $raa->name;
				 $objSheet->getCell('A'.$i)->setValue($s_no);
				 $objSheet->getCell('B'.$i)->setValue(ucfirst($name));
				 $objSheet->getCell('C'.$i)->setValue($unique_id);
				 $objSheet->getCell('D'.$i)->setValue(number_format($crBalance,2));
				 $objSheet->getCell('E'.$i)->setValue($dueAmount);
				 $objSheet->getCell('F'.$i)->setValue(number_format($confirmBalance,2));
				 $objSheet->getCell('G'.$i)->setValue($bank_name);
				 $objPHPExcel->getActiveSheet()->setCellValueExplicit($srosdata,$account_no, PHPExcel_Cell_DataType::TYPE_STRING);			  
             $objSheet->getCell('I'.$i)->setValue($ifsc_code);
            $s_no++;
            $i++;
            }
			// $objPHPExcel->getActiveSheet()
    // ->getStyle('G2:G15000')
    // ->getAlignment()
    // ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_RIGHT);
            // autosize the columns
            $objSheet->getColumnDimension('A')->setAutoSize(true);
            $objSheet->getColumnDimension('B')->setAutoSize(true);
            $objSheet->getColumnDimension('C')->setAutoSize(true);
            $objSheet->getColumnDimension('D')->setAutoSize(true);
            $objSheet->getColumnDimension('E')->setAutoSize(true);
            $objSheet->getColumnDimension('F')->setAutoSize(true);
            $objSheet->getColumnDimension('G')->setAutoSize(true);
            $objSheet->getColumnDimension('H')->setAutoSize(true);
            $objSheet->getColumnDimension('I')->setAutoSize(true);
			 
			 $file="user_statement";
			$filename = $file."_".date("Y-m-d_H-i",time());
			header('Content-Type: application/vnd.ms-excel');
			header("Content-disposition: filename=".$filename.".xls");
			header('Cache-Control: max-age=0'); 

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// echo "aa";
            // die;
// ob_clean();
$objWriter->save('php://output');
        }else{
			$this->session->set_userdata('digitalcashadminmessageFalse','No Record Found');
			header("location:".base_url('admin/user-statement'));			
		}
       

      }
	  function showTdsstatement($id){
		$condition="user_id='".$id."'";
	   $result=OrderBy_Query('*','str_wallet','created_date','DESC',$condition);
       $i=0;
        if(!empty($result)){
            require_once('export_file_excel/Classes/PHPExcel.php');
            // echo "aa";
            // die;
            $objPHPExcel = new PHPExcel;
            // set default font
            $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
            // set default font size
            $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
            // create the writer
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
            // currency format, € with < 0 being in red color
            $currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';
            // number format, with thousands separator and two decimal points.
            $numberFormat = '#,#0.##;[Red]-#,#0.##';
            // writer already created the first sheet for us, let's get it
            $objSheet = $objPHPExcel->getActiveSheet();
            // rename the sheet
            $objSheet->setTitle('My sales report');
            // let's bold and size the header font and write the header
            // as you can see, we can specify a range of cells, like here: cells from A1 to A4
            $objSheet->getStyle('A1:C1')->getFont()->setBold(true)->setSize(12);
            
            // write header
            $objSheet->getCell('A1')->setValue('S.no');
            $objSheet->getCell('B1')->setValue('Tds rate');
            $objSheet->getCell('C1')->setValue('Tds Amount');
            $objSheet->getCell('D1')->setValue('Date Time');
            // we could get this data from database, but here we are writing for simplicity
            $i=2;
            $s_no=1;

            foreach($result AS $a=>$p){
				 $objSheet->getCell('A'.$i)->setValue($s_no);
				 $objSheet->getCell('B'.$i)->setValue("5%");
				 $objSheet->getCell('C'.$i)->setValue($p->tds_amount);
				 $objSheet->getCell('d'.$i)->setValue($p->created_date);
				$s_no++;
				$i++;
            }
            // autosize the columns
            $objSheet->getColumnDimension('A')->setAutoSize(true);
            $objSheet->getColumnDimension('B')->setAutoSize(true);
            $objSheet->getColumnDimension('C')->setAutoSize(true);
            $objSheet->getColumnDimension('D')->setAutoSize(true);
 
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="tds detail.xls"');
header('Cache-Control: max-age=0');
// echo "aa";
            // die;
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// echo "aa";
            // die;
// ob_clean();
$objWriter->save('php://output');
        }else{
			$this->session->set_userdata('digitalcashadminmessageFalse','No Record Found.');
			header("location:".base_url('admin/user-statement'));
		}
       

      }
	  function searchproductMemberReport(){
		$status=$this->input->post('productStatus');
		if($status=='1'){
			$result=SelectQuery('id,name,product_id','member_registration','delivered_status','1');
			$fileName="All Member Product Detail";
		}elseif($status=='0'){
			$result=SelectQuery('id,name,product_id','member_registration','delivered_status','0');
			$fileName="All Member Pending Product Detail";
		}else{
			$result=SelectQuery('id,name,product_id','member_registration','','');
			$fileName="All Member Approve Product Detail";
		}
		$i=0;
		if(!empty($result)){
		require_once('export_file_excel/Classes/PHPExcel.php');
		// echo "aa";
		// die;
		$objPHPExcel = new PHPExcel;
		// set default font
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
		// set default font size
		$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
		// create the writer
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
		// currency format, € with < 0 being in red color
		$currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';
		// number format, with thousands separator and two decimal points.
		$numberFormat = '#,#0.##;[Red]-#,#0.##';
		// writer already created the first sheet for us, let's get it
		$objSheet = $objPHPExcel->getActiveSheet();
		// rename the sheet
		$objSheet->setTitle('My sales report');
		// let's bold and size the header font and write the header
		// as you can see, we can specify a range of cells, like here: cells from A1 to A4
		$objSheet->getStyle('A1:C1')->getFont()->setBold(true)->setSize(12);

		// write header
		$objSheet->getCell('A1')->setValue('S.no');
		$objSheet->getCell('B1')->setValue('Member Name');
		$objSheet->getCell('C1')->setValue('Product Name');
		// we could get this data from database, but here we are writing for simplicity
		$i=2;
		$s_no=1;

		foreach($result AS $a=>$p){
		$objSheet->getCell('A'.$i)->setValue($s_no);
		$objSheet->getCell('B'.$i)->setValue(ucfirst($p->name));
		$objSheet->getCell('C'.$i)->setValue(checkProductName($p->product_id));
		$s_no++;
		$i++;
		}
		// autosize the columns
		$objSheet->getColumnDimension('A')->setAutoSize(true);
		$objSheet->getColumnDimension('B')->setAutoSize(true);
		$objSheet->getColumnDimension('C')->setAutoSize(true);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header('Cache-Control: max-age=0');
		// echo "aa";
		// die;
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		// echo "aa";
		// die;
		// ob_clean();
		$objWriter->save('php://output');
		}else{
		$root = "http://".$_SERVER['HTTP_HOST'];
		$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
		$this->session->set_userdata('message','No Record Found');
		header("location:".$root."show-pending-product");

		}


	}
	 
	 function showAllTdsstatement(){
		 $condition="";
		$result=select_th('*','str_member',$condition);
		$i=0;
		if(!empty($result)){
			require_once('export_file_excel/Classes/PHPExcel.php');
			// echo "aa";
			// die;
			$objPHPExcel = new PHPExcel;
			// set default font
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
			// set default font size
			$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
			// create the writer
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
			// currency format, € with < 0 being in red color
			$currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';
			// number format, with thousands separator and two decimal points.
			$numberFormat = '#,#0.##;[Red]-#,#0.##';
			// writer already created the first sheet for us, let's get it
			$objSheet = $objPHPExcel->getActiveSheet();
			// rename the sheet
			$objSheet->setTitle('My sales report');
			// let's bold and size the header font and write the header
			// as you can see, we can specify a range of cells, like here: cells from A1 to A4
			$objSheet->getStyle('A1:F1')->getFont()->setBold(true)->setSize(12);

			// write header
			$objSheet->getCell('A1')->setValue('S.no');
			$objSheet->getCell('B1')->setValue('Unique id');
			$objSheet->getCell('C1')->setValue('Name');
			$objSheet->getCell('D1')->setValue('Tds Ratio');
			$objSheet->getCell('E1')->setValue('Tds Amount');
			$objSheet->getCell('F1')->setValue('Date Time');
			// we could get this data from database, but here we are writing for simplicity
			$i=2;
			$s_no=1;
			foreach($result AS $a=>$p){
				$cur_date=date("d-M-Y");
				$unique_id='';$name=''; 				
				foreach(SelectQuery('unique_id','str_member','member_id',$p->member_id) as $raa) $unique_id=$raa->unique_id;
				foreach(SelectQuery('name','str_member','member_id',$p->member_id) as $raa) $name=ucfirst($raa->name);
				$tdsResult=array();
				$field='SUM(tds_amount)';
				$tdsResult=$this->db->where('user_id',$p->member_id)->select($field)->get('str_wallet')->row();
				 
				if(!empty($tdsResult))
				{
					if($tdsResult->$field>0){
						$objSheet->getCell('A'.$i)->setValue($s_no);
						$objSheet->getCell('B'.$i)->setValue($unique_id);
						$objSheet->getCell('C'.$i)->setValue($name);
						$objSheet->getCell('D'.$i)->setValue('5%');
						$objSheet->getCell('E'.$i)->setValue($tdsResult->$field);
						$objSheet->getCell('F'.$i)->setValue($cur_date);
						$s_no++;
						$i++;
					}
				}
			}
			// autosize the columns
			$objSheet->getColumnDimension('A')->setAutoSize(true);
			$objSheet->getColumnDimension('B')->setAutoSize(true);
			$objSheet->getColumnDimension('C')->setAutoSize(true);
			$objSheet->getColumnDimension('D')->setAutoSize(true);
			$objSheet->getColumnDimension('E')->setAutoSize(true);
			$objSheet->getColumnDimension('F')->setAutoSize(true);
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="All Tds Detail.xls"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			}
			else{
				$root = "http://".$_SERVER['HTTP_HOST'];
				$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
				$this->session->set_userdata('message','No Record Found');
				header("location:".$root."show-turnover".$id);
			}
    }	 
	
	function showwithdrawlstatement()
	{
		$month=$this->input->post('month');
		$year=$this->input->post('year');
		$result=$this->db->where(array('particular_id'=>'12','month(str_wallet.created_date)'=>$month,'year(str_wallet.created_date)'=>$year))->order_by('str_wallet.created_date','desc')->join('withdrawl_bankdetail','withdrawl_bankdetail.wallet_id=str_wallet.wallet_id')->get('str_wallet')->result_array();

		$i=0;
		if(!empty($result))
		{
			require_once('export_file_excel/Classes/PHPExcel.php');
 
			$objPHPExcel = new PHPExcel;
			// set default font
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
			// set default font size
			$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
			// create the writer
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
			// currency format, € with < 0 being in red color
			$currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';
			// number format, with thousands separator and two decimal points.
			$numberFormat = '#,#0.##;[Red]-#,#0.##';
			// writer already created the first sheet for us, let's get it
			$objSheet = $objPHPExcel->getActiveSheet();
			// rename the sheet
			$objSheet->setTitle('Withdrawl Statement');
			// let's bold and size the header font and write the header
			// as you can see, we can specify a range of cells, like here: cells from A1 to A4
			$objSheet->getStyle('A1:K1')->getFont()->setBold(true)->setSize(12);

			// write header
			$objSheet->getCell('A1')->setValue('Sno');
			$objSheet->getCell('B1')->setValue('Date');
			$objSheet->getCell('C1')->setValue('User id');
			$objSheet->getCell('D1')->setValue('User Name');
			$objSheet->getCell('E1')->setValue('Due Amount');
			$objSheet->getCell('F1')->setValue('Withdrawl Amount');
			$objSheet->getCell('G1')->setValue('Transfer Amount');
			$objSheet->getCell('H1')->setValue('Bank Name');
			$objSheet->getCell('I1')->setValue('Account No.');
			$objSheet->getCell('J1')->setValue('IFSC Code');
			$objSheet->getCell('K1')->setValue('Status');
			
		// we could get this data from database, but here we are writing for simplicity
		
			$i=2;$d=2; $s_no=1;
			
			foreach($result AS $a=>$p)
			{
				$srosdata="I".$i."";
				$crBalance=$this->Form_model->totalGrossBalance($p['user_id']);
				$confirmBalance=$this->Form_model->confirmGrossBalance($p['user_id']);  
				$dueAmount=$crBalance-$confirmBalance;
				$unique_id='';$name=''; 
				foreach(SelectQuery('unique_id','str_member','member_id',$p['user_id']) as $raa) $unique_id=$raa->unique_id;   
				foreach(SelectQuery('name','str_member','member_id',$p['user_id']) as $raa) $name= $raa->name;
				$objSheet->getCell('A'.$i)->setValue($s_no);
				$objSheet->getCell('B'.$i)->setValue($p['created_date']);
				$objSheet->getCell('C'.$i)->setValue($unique_id);
				$objSheet->getCell('D'.$i)->setValue(ucfirst($name));
				$objSheet->getCell('E'.$i)->setValue(number_format($dueAmount,2));
				$objSheet->getCell('F'.$i)->setValue(number_format($p['amount'],2)); 
				$objSheet->getCell('G'.$i)->setValue(number_format($p['net_amount'],2)); 
				$objSheet->getCell('H'.$i)->setValue($p['bank_name']); 
				$objPHPExcel->getActiveSheet()->setCellValueExplicit($srosdata,$p['account_no'], PHPExcel_Cell_DataType::TYPE_STRING);	
				$objSheet->getCell('J'.$i)->setValue($p['ifsc_code']);
				$objSheet->getCell('K'.$i)->setValue($p['status']); 
				$s_no++;
				$i++;
			}
 
			$objSheet->getColumnDimension('A')->setAutoSize(true);
			$objSheet->getColumnDimension('B')->setAutoSize(true);
			$objSheet->getColumnDimension('C')->setAutoSize(true);
			$objSheet->getColumnDimension('D')->setAutoSize(true);
			$objSheet->getColumnDimension('E')->setAutoSize(true);
			$objSheet->getColumnDimension('F')->setAutoSize(true);
			$objSheet->getColumnDimension('G')->setAutoSize(true);
			$objSheet->getColumnDimension('H')->setAutoSize(true);
			$objSheet->getColumnDimension('I')->setAutoSize(true);
			$objSheet->getColumnDimension('J')->setAutoSize(true);
			$objSheet->getColumnDimension('K')->setAutoSize(true);

			$file="withdrawl_statement";
			$filename = $file."_".date("Y-m-d_H-i",time());
			header('Content-Type: application/vnd.ms-excel');
			header("Content-disposition: filename=".$filename.".xls");
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
 
			// ob_clean();
			$objWriter->save('php://output');
		}
		else
		{
			$this->session->set_userdata('digitalcashadminmessageFalse','No Record Found');
			
			header("location:".base_url('admin/withdrawl-request'));			
		}
    }
 

}

?>
