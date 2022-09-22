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
$pdf->SetFont('THSarabunNew','B',25);


$pdf->AddPage();
$pdf->Image('logo/logo.png',10,8,50);
$pdf->Ln();
$pdf->Cell(0,5,iconv('UTF-8','cp874','ธนาคารออมสิน'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',16);
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานการติดตามผลการพิจารณาบัตรเครดิตและสินเชื่อบัตรเงินสด ณ ช่วงเวลาที่แตกต่างกัน'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',16);
$pdf->Cell(0,4,iconv('UTF-8','cp874','Approval Rate Report ( REP02 )'),0,1,'C');
$pdf->Ln();

$pdf->Cell(0,6,iconv('UTF-8','cp874','เวอร์ชันโมเดล: '.$model_version),0,1,);
$pdf->Cell(1,6,iconv('UTF-8','cp874','ประเภทสินเชื่อ: '.$product_type),0,0,'L');
$pdf->Cell(0,6,iconv('UTF-8','cp874','ประเภทโมเดล: '.$model_type),0,0,'C');
$pdf->Cell(0,6,iconv('UTF-8','cp874','ประเภทบัตร: '.$card_type),0,1,'R');
$pdf->Cell(1,6,iconv('UTF-8','cp874','ภาค: '.$region_name.'  เขต: '.$zone_name.'  สาขา: '.$branch_name),0,0,'L');
$pdf->Cell(0,6,iconv('UTF-8','cp874','ช่องทางการขาย: '.$sales_channel),0,1,'R');
$pdf->Cell(0,6,iconv('UTF-8','cp874','สายงานธุรกิจ: '.$business_type),0,1,);
$pdf->Cell(1,6,iconv('UTF-8','cp874','เดือน/ปี ที่ออกผลการพิจารณา: '.$month.' / '.$year),0,0,'L');
$pdf->Cell(0,6,iconv('UTF-8','cp874','ผู้ออกรายงาน: ascbiadmin'),0,0,'C');
$pdf->Cell(0,9,iconv('UTF-8','cp874','วันที่ออกรายงาน: '.$date.' '.$time),0,1,'R');


// ========ใส่สีช่องหัวตาราง=========
$pdf->SetFillColor(254,204,255);
// =============================
$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell(38,20,'        Score Range',1,0,'L',true);
$pdf->cell(60,10,'    Through-the-door Population',1,0,'L',true);
$pdf->cell(60,10,'     Withdraw as % TTD in range',1,0,'L',true);
$pdf->cell(60,10,'  Approve as % decisioned in range',1,0,'L',true);
$pdf->cell(60,10,'        Other as % TTD in range',1,1,'L',true);
$pdf->cell(38,10,'',0,0,'L');
$pdf->cell(18,10,'   Past 3',1,0,'L',true);
$pdf->cell(18,10,'  Past 12',1,0,'L',true);
$pdf->cell(24,10,' Year ago 12',1,0,'L',true);
$pdf->cell(18,10,' %Past 3',1,0,'L',true);
$pdf->cell(18,10,'%Past 12',1,0,'L',true);
$pdf->cell(24,10,'%Year ago 12',1,0,'L',true);
$pdf->cell(18,10,' %Past 3',1,0,'L',true);
$pdf->cell(18,10,'%Past 12',1,0,'L',true);
$pdf->cell(24,10,'%Year ago 12',1,0,'L',true);
$pdf->cell(18,10,' %Past 3',1,0,'L',true);
$pdf->cell(18,10,'%Past 12',1,0,'L',true);
$pdf->cell(24,10,'%Year ago 12',1,0,'L',true);




$pdf->Ln();


// --------------------------



require('sqlExport.php');


$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {

                $s1=$row['SCORE_RANGE_DESC'];
                $s2=number_format($row['ACTUAL_3M'], 0);
                $s3=number_format($row['ACTUAL_12M'], 0);
                $s4=number_format($row['ACTUAL_MORE12M'], 0);
                $s5=number_format($row['APPROVE_3M'], 2);
                $s6=number_format($row['APPROVE_12M'], 2);
                $s7=number_format($row['APPROVE_MORE12M'], 2);
                $s8=number_format($row['REJECT_3M'], 2);
                $s9=number_format($row['REJECT_12M'], 2);
                $s10=number_format($row['REJECT_MORE12M'], 2);
                $s11=number_format($row['OTHER_3M'], 2);
                $s12=number_format($row['OTHER_12M'], 2);
                $s13=number_format($row['OTHER_MORE12M'], 2);

        if($row['SCORE_RANGE_DESC'] =='No. of Loans'){
$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell(38,10,$s1,1,0,'C',true);
$pdf->cell(18,10,$s2,1,0,'C',true);
$pdf->cell(18,10,$s3,1,0,'C',true);
$pdf->cell(24,10,$s4,1,0,'C',true);
$pdf->cell(18,10,$s5,1,0,'C',true);
$pdf->cell(18,10,$s6,1,0,'C',true);
$pdf->cell(24,10,$s7,1,0,'C',true);
$pdf->cell(18,10,$s8,1,0,'C',true);
$pdf->cell(18,10,$s9,1,0,'C',true);
$pdf->cell(24,10,$s10,1,0,'C',true);
$pdf->cell(18,10,$s11,1,0,'C',true);
$pdf->cell(18,10,$s12,1,0,'C',true);
$pdf->cell(24,10,$s13,1,1,'C',true);

} else if(preg_match("/Avg/i", $row['SCORE_RANGE_DESC']) || preg_match("/%/i", $row['SCORE_RANGE_DESC'])) {

$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell(38,10,$s1,1,0,'C');
$pdf->cell(18,10,$s2,1,0,'C');
$pdf->cell(18,10,$s3,1,0,'C');
$pdf->cell(24,10,$s4,1,0,'C');
$pdf->cell(18,10,$s5,1,0,'C');
$pdf->cell(18,10,$s6,1,0,'C');
$pdf->cell(24,10,$s7,1,0,'C');
$pdf->cell(18,10,$s8,1,0,'C');
$pdf->cell(18,10,$s9,1,0,'C');
$pdf->cell(24,10,$s10,1,0,'C');
$pdf->cell(18,10,$s11,1,0,'C');
$pdf->cell(18,10,$s12,1,0,'C');
$pdf->cell(24,10,$s13,1,1,'C');

} else {

$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell(38,10,$s1,1,0,'C');
$pdf->cell(18,10,$s2,1,0,'C');
$pdf->cell(18,10,$s3,1,0,'C');
$pdf->cell(24,10,$s4,1,0,'C');
$pdf->cell(18,10,$s5,1,0,'C');
$pdf->cell(18,10,$s6,1,0,'C');
$pdf->cell(24,10,$s7,1,0,'C');
$pdf->cell(18,10,$s8,1,0,'C');
$pdf->cell(18,10,$s9,1,0,'C');
$pdf->cell(24,10,$s10,1,0,'C');
$pdf->cell(18,10,$s11,1,0,'C');
$pdf->cell(18,10,$s12,1,0,'C');
$pdf->cell(24,10,$s13,1,1,'C');

}
}
$pdf->Output('Report2_PDF.pdf', 'D');

