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
$month=$_GET['month'];
$year=$_GET['year'];
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
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานแสดงสัดส่วนของลูกค้าที่มีการ Override ทั้ง High-Side Override และ Low-Side Override'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','Override Rate Report ( REP05 )'),0,1,'C');
$pdf->Ln(6);
$pdf->Cell(0,7,iconv('UTF-8','cp874','เวอร์ชันโมเดล: '.$model_version),0,1,);
$pdf->Cell(1,7,iconv('UTF-8','cp874','ประเภทสินเชื่อ: '.$product_type),0,0,'L');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ประเภทโมเดล: '.$model_type),0,0,'C');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ประเภทบัตร: '.$card_type),0,1,'R');
$pdf->Cell(1,7,iconv('UTF-8','cp874','ภาค: '.$region_name.'  เขต: '.$zone_name.'  สาขา: '.$branch_name),0,0,'L');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ช่องทางการขาย: '.$sales_channel),0,1,'R');
$pdf->Cell(0,7,iconv('UTF-8','cp874','สายงานธุรกิจ: '.$business_type),0,1,);
$pdf->Cell(1,7,iconv('UTF-8','cp874','เดือน/ปี ที่ออกผลการพิจารณา: '.$month.' / '.$year),0,0,'L');
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
$pdf->cell(38,20,'        Category ',1,0,'L',true);
$pdf->cell(120,10,'As % of Applications in Range ',1,0,'C',true);
$pdf->cell(120,10,'As % of Approved ',1,1,'C',true);
$pdf->cell(38,10,'',0,0,'L');
$pdf->cell(40,10,'Past 3 Months',1,0,'C',true);
$pdf->cell(40,10,'Past 12 Months',1,0,'C',true);
$pdf->cell(40,10,'Year ago 12 Months',1,0,'C',true);
$pdf->cell(40,10,'Past 3 Months',1,0,'C',true);
$pdf->cell(40,10,'Past 12 Months',1,0,'C',true);
$pdf->cell(40,10,'Year ago 12 Months',1,0,'C',true);

$pdf->Ln();
// --------------------------

// --------------------------



require('sqlExport.php');

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if(preg_match("/%/i", $row['CATEGORY'])){ 
        $s1=$row['CATEGORY'];
                $s2=number_format($row['APP_IN_RANGE_3M'], 2);
                $s3=number_format($row['APP_IN_RANGE_12M'], 2);
                $s4=number_format($row['APP_IN_RANGE_MORE12M'], 2);
                $s5=number_format($row['APPROVAL_3M'], 2);
                $s6=number_format($row['APPROVAL_12M'], 2);
                $s7=number_format($row['APPROVAL_MORE12M'], 2);

$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell(38,10,$s1,1,0,'C');
$pdf->cell(40,10,$s2,1,0,'C');
$pdf->cell(40,10,$s3,1,0,'C');
$pdf->cell(40,10,$s4,1,0,'C');
$pdf->cell(40,10,$s5,1,0,'C');
$pdf->cell(40,10,$s6,1,0,'C');
$pdf->cell(40,10,$s7,1,1,'C');

} else {
                $s1=$row['CATEGORY'];
                $s2=number_format($row['APP_IN_RANGE_3M'], 0);
                $s3=number_format($row['APP_IN_RANGE_12M'], 0);
                $s4=number_format($row['APP_IN_RANGE_MORE12M'], 0);
                $s5=number_format($row['APPROVAL_3M'], 0);
                $s6=number_format($row['APPROVAL_12M'], 0);
                $s7=number_format($row['APPROVAL_MORE12M'], 0);

$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell(38,10,$s1,1,0,'C');
$pdf->cell(40,10,$s2,1,0,'C');
$pdf->cell(40,10,$s3,1,0,'C');
$pdf->cell(40,10,$s4,1,0,'C');
$pdf->cell(40,10,$s5,1,0,'C');
$pdf->cell(40,10,$s6,1,0,'C');
$pdf->cell(40,10,$s7,1,1,'C');
}
}


$pdf->Output('Report5_PDF.pdf', 'D');

