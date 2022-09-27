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
$pdf->Ln(8);
$pdf->Cell(0,5,iconv('UTF-8','cp874','ธนาคารออมสิน'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานการดำเนินการของแบบจำลองฯ ในการวัดความเสี่ยงของลูกค้าก่อนที่จะเป็นหนี้เสีย'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','Early Performance Score Report ( REP08 )'),0,1,'C');
$pdf->Ln(3);
$pdf->Cell(0,7,iconv('UTF-8','cp874','เวอร์ชันโมเดล: '.$model_version),0,1,);
$pdf->Cell(1,7,iconv('UTF-8','cp874','ประเภทสินเชื่อ: '.$product_type),0,0,'L');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ประเภทโมเดล: '.$model_type),0,0,'C');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ประเภทบัตร: '.$card_type),0,1,'R');
$pdf->Cell(1,7,iconv('UTF-8','cp874','ภาค: '.$region_name.'  เขต: '.$zone_name.'  สาขา: '.$branch_name),0,0,'L');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ช่องทางการขาย: '.$sales_channel),0,1,'R');
$pdf->Cell(0,7,iconv('UTF-8','cp874','สายงานธุรกิจ: '.$business_type),0,1,);
$pdf->Cell(1,6,iconv('UTF-8','cp874','เดือน/ปี ที่ออกผลการพิจารณา: '.$month.'  /  '.$year),0,0,'L');
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
$pdf->cell(37,10,'Early Performance',1,0,'C',true);
$pdf->cell(80,10,'Bad: Ever 1-30',1,0,'C',true);
$pdf->cell(80,10,'Bad: Ever 31-60',1,0,'C',true);
$pdf->cell(80,10,'Bad: Ever 61-90',1,0,'C',true);
$pdf->Ln();
$pdf->cell(37,10,'Score Range',1,0,'C',true);
$pdf->cell(26.66,10,'Past 3 M',1,0,'C',true);
$pdf->cell(26.66,10,'Past 12 M',1,0,'C',true);
$pdf->cell(26.66,10,'Year ago 12 M',1,0,'C',true);
$pdf->cell(26.66,10,'Past 3 M',1,0,'C',true);
$pdf->cell(26.66,10,'Past 12 M',1,0,'C',true);
$pdf->cell(26.66,10,'Year ago 12 M',1,0,'C',true);
$pdf->cell(26.66,10,'Past 3 M',1,0,'C',true);
$pdf->cell(26.66,10,'Past 12 M',1,0,'C',true);
$pdf->cell(26.66,10,'Year ago 12 M',1,1,'C',true);


// --------------------------



require('sqlExport.php');

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
                $s1=$row['SCORE_RANGE_DESC'];
                $s2=number_format($row['BAD1_30PAST3MONTHS'], 2);
                $s3=number_format($row['BAD1_30PAST12MONTHS'], 2);
                $s4=number_format($row['BAD1_30PASTMORE12'], 2);
                $s5=number_format($row['BAD31_60PAST3MONTHS'], 2);
                $s6=number_format($row['BAD31_60PAST12MONTHS'], 2);
                $s7=number_format($row['BAD31_60PASTMORE12'], 2);
                $s8=number_format($row['BAD61_90PAST3MONTHS'], 2);
                $s9=number_format($row['BAD61_90PAST12MONTHS'], 2);
                $s10=number_format($row['BAD61_90PASTMORE12'], 2);

        if(preg_match("/Total/i", $row['SCORE_RANGE_DESC'])){ 
$pdf->cell(37,10,$s1,1,0,'C',true);
$pdf->cell(26.66,10,$s2,1,0,'C',true);
$pdf->cell(26.66,10,$s3,1,0,'C',true);
$pdf->cell(26.66,10,$s4,1,0,'C',true);
$pdf->cell(26.66,10,$s5,1,0,'C',true);
$pdf->cell(26.66,10,$s6,1,0,'C',true);
$pdf->cell(26.66,10,$s7,1,0,'C',true);
$pdf->cell(26.66,10,$s8,1,0,'C',true);
$pdf->cell(26.66,10,$s9,1,0,'C',true);
$pdf->cell(26.66,10,$s10,1,1,'C',true);

        } else if(preg_match("/Average Bad Rate/i", $row['SCORE_RANGE_DESC'])){

$pdf->cell(37,10,$s1,1,0,'C');
$pdf->cell(26.66,10,$s2,1,0,'C');
$pdf->cell(26.66,10,$s3,1,0,'C');
$pdf->cell(26.66,10,$s4,1,0,'C');
$pdf->cell(26.66,10,$s5,1,0,'C');
$pdf->cell(26.66,10,$s6,1,0,'C');
$pdf->cell(26.66,10,$s7,1,0,'C');
$pdf->cell(26.66,10,$s8,1,0,'C');
$pdf->cell(26.66,10,$s9,1,0,'C');
$pdf->cell(26.66,10,$s10,1,1,'C');

} else {

$pdf->cell(37,10,$s1,1,0,'C');
$pdf->cell(26.66,10,$s2,1,0,'C');
$pdf->cell(26.66,10,$s3,1,0,'C');
$pdf->cell(26.66,10,$s4,1,0,'C');
$pdf->cell(26.66,10,$s5,1,0,'C');
$pdf->cell(26.66,10,$s6,1,0,'C');
$pdf->cell(26.66,10,$s7,1,0,'C');
$pdf->cell(26.66,10,$s8,1,0,'C');
$pdf->cell(26.66,10,$s9,1,0,'C');
$pdf->cell(26.66,10,$s10,1,1,'C');
}
}


$pdf->Output('Report8_PDF.pdf', 'D');

