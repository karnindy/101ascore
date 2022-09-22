<?php
include('../database/connect.php');
// --------------------------
define('FPDF_FONTPATH','font/');
require('../fpdf184/fpdf.php');

error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$model_version=$_GET['model_version'];
$sales_channel=$_GET['sales_channel'];
$business_type=$_GET['business_type'];
$region_name=$_GET['region_name'];
$zone_name=$_GET['zone_name'];
$branch_name=$_GET['branch_name'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];


$START_YYYY=substr($start_date, 0,4);
$start_mm=substr($start_date, 5,2);
$end_yyyy=substr($end_date, 0,4);
$end_mm=substr($end_date, 5,2);


// ==============จัดรูปแบบวันที่ให้เหมือนหน้าเว็บ=============== 
$newstartdate = date("m/Y", strtotime($start_date));
$newenddate = date("m/Y", strtotime($end_date));


// $start_mm=$_GET['start_mm'];
// $START_YYYY=$_GET['START_YYYY'];
// $end_mm=$_GET['end_mm'];
// $end_yyyy=$_GET['end_yyyy'];
date_default_timezone_set('asia/bangkok');
$date = date('d/m/Y');
$time = date('H:i:s');



$pdf = new FPDF('L','mm','A4');
// ========เพิ่มฟ้อนภาษาไทย=========
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
$pdf->SetFont('THSarabunNew','B',28);


$pdf->AddPage();
$pdf->Image('logo/logo.png',10,8,50);
$pdf->Ln(13);
$pdf->Cell(0,5,iconv('UTF-8','cp874','ธนาคารออมสิน'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานอัตราการผิดนัดชำระหนี้ของลูกค้าตามระดับคะแนน ณ ช่วงไตรมาสต่างกันในแต่ละช่วงคะแนน'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','Delinquency Distribution Report ( REP10 )'),0,1,'C');
$pdf->Ln(6);
$pdf->Cell(0,7,iconv('UTF-8','cp874','เวอร์ชันโมเดล: '.$model_version),0,1,);
$pdf->Cell(1,7,iconv('UTF-8','cp874','ประเภทสินเชื่อ: '.$product_type),0,0,'L');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ประเภทโมเดล: '.$model_type),0,0,'C');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ประเภทบัตร: '.$card_type),0,1,'R');
$pdf->Cell(1,7,iconv('UTF-8','cp874','ภาค: '.$region_name.'  เขต: '.$zone_name.'  สาขา: '.$branch_name),0,0,'L');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ช่องทางการขาย: '.$sales_channel),0,1,'R');
$pdf->Cell(0,7,iconv('UTF-8','cp874','สายงานธุรกิจ: '.$business_type),0,1,);
$pdf->Cell(1,7,iconv('UTF-8','cp874','วันที่สร้างใบสมัคร: '.$newstartdate.'  ถึง  '.$newenddate),0,0,'L');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ผู้ออกรายงาน: ascbiadmin'),0,0,'C');
$pdf->Cell(0,7,iconv('UTF-8','cp874','วันที่ออกรายงาน: '.$date.' '.$time),0,1,'R');
$pdf->Ln(6);

// =============================================================
// $pdf->Cell(0,5,iconv('UTF-8','cp874','ธนาคารออมสิน'),0,1,'C');
// =============================================================

// ========ใส่สีช่องหัวตาราง=========
$pdf->SetFillColor(254,204,255);
// =============================
$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell(38,10,'Score Range',1,0,'C',true);
$pdf->cell(40,10,'% Accepted Accounts',1,0,'C',true);
$pdf->cell(40,10,'% Active Accounts',1,0,'C',true);
$pdf->cell(40,10,'% Current 1-30 Days',1,0,'C',true);
$pdf->cell(40,10,'% Current 31-60 Days',1,0,'C',true);
$pdf->cell(40,10,'% Current 61-90 Days',1,0,'C',true);
$pdf->cell(40,10,'% Current More 90 Days',1,0,'C',true);
$pdf->Ln();


// --------------------------



require('sqlExport.php');

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
                $s1=$row['SCORE_RANGE_DESC'];
                $s2=number_format($row['PER_ACCEPT_ACCT'], 2);
                $s3=number_format($row['PER_ACTIVE_ACCT'], 2);
                $s4=number_format($row['PER_CURRENT_1_30'], 2);
                $s5=number_format($row['PER_CURRENT_31_60'], 2);
                $s6=number_format($row['PER_CURRENT_61_90'], 2);
                $s7=number_format($row['PER_CURRENT_MORE_90'], 2);

                if(strtolower($row['SCORE_RANGE_DESC']) == "total"){

$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell(38,10,$s1,1,0,'C',true);
$pdf->cell(40,10,$s2,1,0,'C',true);
$pdf->cell(40,10,$s3,1,0,'C',true);
$pdf->cell(40,10,$s4,1,0,'C',true);
$pdf->cell(40,10,$s5,1,0,'C',true);
$pdf->cell(40,10,$s6,1,0,'C',true);
$pdf->cell(40,10,$s7,1,0,'C',true);
$pdf->Ln();

} else {

$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell(38,10,$s1,1,0,'C');
$pdf->cell(40,10,$s2,1,0,'C');
$pdf->cell(40,10,$s3,1,0,'C');
$pdf->cell(40,10,$s4,1,0,'C');
$pdf->cell(40,10,$s5,1,0,'C');
$pdf->cell(40,10,$s6,1,0,'C');
$pdf->cell(40,10,$s7,1,0,'C');
$pdf->Ln();

}
$count++;
}

$pdf->Output('Report10_PDF.pdf', 'D');

