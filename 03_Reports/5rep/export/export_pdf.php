<?php
include('../server/server.php');
include('../query/dropdown.php');
include('../query/query_tab1.php');
include('../query/query_tab2.php');
include('../query/query_tab3.php');
include('../query/query_tab4.php');
include('../query/query_tab5.php');
// --------------------------
define('FPDF_FONTPATH','font/');
require('../fpdf184/fpdf.php');

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

date_default_timezone_set('asia/bangkok');
$date = date('d/m/Y');
$time = date('H:i:s');



$pdf = new FPDF('L','mm','A3');
// ========เพิ่มฟ้อนภาษาไทย=========
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
$pdf->SetFont('THSarabunNew','B',24);


$pdf->AddPage();
$pdf->Image('logo/logo.png',5,4,25);
$pdf->Ln(6);
$pdf->cell(0,10,iconv('UTF-8','cp874','5.รายงานการค้นหาและแสดงผลใบคำขอสินเชื่อเพื่อส่งออกข้อมูล'),0,0,'L');
$pdf->SetFont('THSarabunNew','B',16);
$pdf->Cell(0,10,iconv('UTF-8','cp874','วันที่ออกรายงาน: '.$date.' '.$time),0,0,'R');
$pdf->Ln();

// =============================================================
// $pdf->Cell(0,5,iconv('UTF-8','cp874','ธนาคารออมสิน'),0,1,'C');
// =============================================================
$bd = 1;
$wid = 28;
// ========ใส่สีช่องหัวตาราง=========
$pdf->SetFillColor(254,204,255);
// =============================
$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell($wid,10,iconv('UTF-8','cp874','เลขที่ใบสมัคร'),$bd,0,'C',true);
$pdf->cell(20,10,iconv('UTF-8','cp874','sequence'),$bd,0,'C',true);
$pdf->cell($wid,10,iconv('UTF-8','cp874','วันที่บันทึกข้อมูล'),$bd,0,'C',true);
$pdf->cell($wid,10,iconv('UTF-8','cp874','สาขา/หน่วย'),$bd,0,'C',true);
$pdf->cell($wid,10,iconv('UTF-8','cp874','ประเภทสินเชื่อ'),$bd,0,'C',true);
$pdf->cell(40,10,iconv('UTF-8','cp874','ประเภทบัตร'),$bd,0,'C',true);
$pdf->cell($wid,10,iconv('UTF-8','cp874','วงเงินบัตร/สินเชื่อ'),$bd,0,'C',true);
$pdf->cell($wid,10,iconv('UTF-8','cp874','เลข CIF'),$bd,0,'C',true);
$pdf->cell($wid,10,iconv('UTF-8','cp874','เลขที่บัตรประชาชน'),$bd,0,'C',true);
$pdf->cell($wid,10,iconv('UTF-8','cp874','ชื่อ-นามสกุล ลูกค้า'),$bd,0,'C',true);
$pdf->cell($wid,10,iconv('UTF-8','cp874','Score'),$bd,0,'C',true);
$pdf->cell(15,10,iconv('UTF-8','cp874','Grade'),$bd,0,'C',true);
$pdf->cell($wid,10,iconv('UTF-8','cp874','วันที่คำนวณ'),$bd,0,'C',true);
$pdf->cell($wid,10,iconv('UTF-8','cp874','วันที่ออกผลพิจรณา'),$bd,0,'C',true);
$pdf->cell(20,10,iconv('UTF-8','cp874','ผลพิจรณา'),$bd,0,'C',true);
$pdf->Ln();


// --------------------------

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

$pdf->SetWidths(array(28,20,28,28,28,40,28,28,28,28,28,15,28,28,20));
$pdf->Row(array(iconv('UTF-8','cp874',$appl_id_aam),iconv('UTF-8','cp874',$max_calc_sequence),iconv('UTF-8','cp874',$create_date),iconv('UTF-8','cp874',$branch_name),iconv('UTF-8','cp874',$product_type),iconv('UTF-8','cp874',$card_type),iconv('UTF-8','cp874',$ca2_cr_limit_amt),iconv('UTF-8','cp874',$cif),iconv('UTF-8','cp874',$cid),iconv('UTF-8','cp874',$customer_name),iconv('UTF-8','cp874',$score),iconv('UTF-8','cp874',$max_seq_total_grade),iconv('UTF-8','cp874',$req_requrest_date),iconv('UTF-8','cp874',$update_date_aam),iconv('UTF-8','cp874',$ca2_appl_result_code)));
}
$pdf->AliasNbPages();
$pdf->Output('Export.pdf', 'D');

