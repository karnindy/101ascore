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
$start_date="01-".$start_date;
$end_date="31-".$end_date;
date_default_timezone_set('asia/bangkok');
$date = date('d/m/Y');
$time = date('H:i:s');
// ==============จัดรูปแบบวันที่ให้เหมือนหน้าเว็บ=============== 
$newstartdate = date("d/m/Y", strtotime($start_date));
$newenddate = date("d/m/Y", strtotime($end_date));

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
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานความสามารถในการชำระหนี้ของลูกค้าในแต่ละช่วงคะแนน อัตราการเกิดหนี้เสียหลังจากที่นำระบบ Credit Scoring เข้ามาใช้งาน'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','Portfolio Score Performance Report ( REP11 )'),0,1,'C');
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
$pdf->SetFont('THSarabunNew','B',16);
$pdf->cell(38,20,'Score Range ',1,0,'C',true);
$pdf->cell(60,10,'Active account',1,0,'C',true);
$pdf->Cell(135,10,iconv('UTF-8','cp874','หนี้ที่ไม่ก่อรายได้ (NPLs)'),1,0,'C',true);
$pdf->cell(45,20,'% of Cumulative NPLs',1,0,'C',true);
$pdf->cell(0,10,'',0,1);
$pdf->cell(38,10,'',0,0);
$pdf->cell(30,10,'No. of Account',1,0,'C',true);
$pdf->cell(30,10,'Amount',1,0,'C',true);
$pdf->cell(33.75,10,'No. of Account',1,0,'C',true);
$pdf->cell(33.75,10,'% NPLs',1,0,'C',true);
$pdf->cell(33.75,10,'Amount',1,0,'C',true);
$pdf->cell(33.75,10,'%Amount',1,0,'C',true);

$pdf->Ln();


// --------------------------



require('sqlExport.php');

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
                $s1=$row['SCORE_RANGE_DESC'];
                $s2=number_format($row['ACTIVE_ACCOUNT'], 0);
                $s3=number_format($row['ACTIVE_AMOUNT'], 2);
                $s4=number_format($row['NPLS_ACCOUNT'], 0);
                $s5=number_format($row['PER_NPLS'], 2);
                $s6=number_format($row['NCB_AMOUNT'], 2);
                $s7=number_format($row['PER_NCB_AMOUNT'], 2);
                $s8=number_format($row['PER_CUM_NPL'], 2);

        if(strtolower($row['SCORE_RANGE_DESC']) == "total"){ 

$pdf->SetFont('THSarabunNew','B',16);
$pdf->cell(38,10,$s1,1,0,'C',true);
$pdf->cell(30,10,$s2,1,0,'C',true);
$pdf->cell(30,10,$s3,1,0,'C',true);
$pdf->cell(33.75,10,$s4,1,0,'C',true);
$pdf->cell(33.75,10,$s5,1,0,'C',true);
$pdf->cell(33.75,10,$s6,1,0,'C',true);
$pdf->cell(33.75,10,$s7,1,0,'C',true);
$pdf->cell(45,10,$s8,1,0,'C',true);
$pdf->Ln();

} else {

$pdf->SetFont('THSarabunNew','B',16);
$pdf->cell(38,10,$s1,1,0,'C');
$pdf->cell(30,10,$s2,1,0,'C');
$pdf->cell(30,10,$s3,1,0,'C');
$pdf->cell(33.75,10,$s4,1,0,'C');
$pdf->cell(33.75,10,$s5,1,0,'C');
$pdf->cell(33.75,10,$s6,1,0,'C');
$pdf->cell(33.75,10,$s7,1,0,'C');
$pdf->cell(45,10,$s8,1,0,'C');
$pdf->Ln();

}
}
$pdf->Output('Report11_PDF.pdf', 'D');

