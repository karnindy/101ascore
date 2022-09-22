<?php
include('../server/server.php');
include('../query/dropdown.php');
include('../query/query_tab1.php');
include('../query/query_tab2.php');
include('../query/query_tab3.php');
include('../query/query_tab4.php');
include('../query/query_tab5.php');

$FileNmae="Export_TXT.txt";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");

$file = fopen("file/".$FileNmae, "w");
fwrite($file, "5.รายงานการค้นหาและแสดงผลใบคำขอสินเชื่อเพื่อส่งออกข้อมูล \r\n");
fwrite($file, "|ลำดับ|เลขที่ใบสมัคร|sequence|วันที่บันทึกข้อมูล|สาขา/หน่วย|ประเภทสินเชื่อ|ประเภทบัตร|วงเงินบัตร/สินเชื่อ|เลข CIF|เลขที่บัตรประชาชน|ชื่อ-นามสกุล ลูกค้า|Score|Grade|วันที่คำนวณ|วันที่ออกผลพิจรณา|ผลพิจรณา| \r\n");

$appl_id_aam=$_GET['appl_id_aam'];
if($appl_id_aam==''){
	$appl_id_aam='Donut@Poseidons!@';
}
$product_type=$_GET['product_type'];
$card_type=$_GET['card_type'];
$cid=$_GET['cid'];
if($cid==''){
	$cid='Donut@Poseidons!@';
}
$region_name=$_GET['region_name'];
$zone_name=$_GET['zone_name'];
$branch_name=$_GET['branch_name'];
$ca2_appl_result_code=$_GET['ca2_appl_result_code'];


$create_start_date=$_GET['create_start_date'];
$create_end_date=$_GET['create_end_date'];
$update_start_date=$_GET['update_start_date'];
$update_end_date=$_GET['update_end_date'];

$create_start_date=date("d/m/Y",strtotime($create_start_date));
$create_end_date=date("d/m/Y",strtotime($create_end_date));
$update_start_date=date("d/m/Y",strtotime($update_start_date));
$update_end_date=date("d/m/Y",strtotime($update_end_date));
$num=0;

$sql=tab5($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
// echo $sql;
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
	while($row = oci_fetch_array($objParse,OCI_BOTH)){

 $num=$num+1;
 $appl_id_aam = $row['APPL_ID_AAM']; 
 $max_calc_sequence = $row['MAX_CALC_SEQUENCE']; 
 $create_date = date("d/m/Y",strtotime($row['CREATE_DATE'])); 
 $branch_name = $row['BRANCH_NAME']; 
 $product_type = $row['PRODUCT_TYPE']; 
 $card_type = $row['CARD_TYPE']; 
 $ca2_cr_limit_amt = number_format($row['CA2_CR_LIMIT_AMT'], 2); 
 $cif = $row['CIF']; 
 $cid = $row['CID']; 
 $customer_name = $row['CUSTOMER_NAME']; 
 if($row['SCORE']!=null){$score = $row['SCORE'];}else{$score = "-";} 
 $max_seq_total_grade = $row['MAX_SEQ_TOTAL_GRADE']; 
 if($row['REQ_REQUEST_DATE']!=null){$req_requrest_date = $row['REQ_REQUEST_DATE'];}else{$req_requrest_date = "-";} 
 $update_date_aam = date("d/m/Y",strtotime($row['UPDATE_DATE_AAM'])); 
 $ca2_appl_result_code = $row['CA2_APPL_RESULT_CODE']; 

fwrite($file, "|$num|$appl_id_aam|$max_calc_sequence|$create_date|$branch_name|$product_type|$card_type|$ca2_cr_limit_amt|$cif|$cid|$customer_name|$score|$max_seq_total_grade|$req_requrest_date|$update_date_aam|$ca2_appl_result_code| \r\n");
	}

fclose($file);
readfile('file/'.$FileNmae);
?> 

