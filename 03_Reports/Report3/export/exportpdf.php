<?php
include('../database/connect.php');
// --------------------------
define('FPDF_FONTPATH','font/');
require('../fpdf184/fpdf.php');

error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$business_type=$_GET['business_type'];
$sales_channel=$_GET['sales_channel'];
$region_name=$_GET['region_name'];
$zone_name=$_GET['zone_name'];
$branch_name=$_GET['branch_name'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$factors=$_GET['factors'];
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
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานการเปรียบเทียบการเปลี่ยนแปลงคุณลักษณะของลูกค้าปัจจุบันกับลูกค้าช่วงที่ใช้พัฒนาแบบจำลองฯ'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','Characteristic Analysis Rate Report ( REP03 )'),0,1,'C');
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
$pdf->Cell(56,10,iconv('UTF-8','cp874',$factors),1,0,'C',true);
$pdf->cell(32,10,'DEV',1,0,'C',true);
$pdf->cell(32,10,'% DEV',1,0,'C',true);
$pdf->cell(32,10,'Actual',1,0,'C',true);
$pdf->cell(32,10,'% Actual',1,0,'C',true);
$pdf->cell(32,10,'Change',1,0,'C',true);
$pdf->cell(32,10,'Point',1,0,'C',true);
$pdf->cell(32,10,'Point Diff',1,0,'C',true);

$pdf->Ln();


// --------------------------



require('sqlExport.php');

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
        if($row['ATTIBUTE'] == "Total"){
                $s1=$row['ATTIBUTE'];
		$s2=number_format($row['DEV'], 0);
		$s3=number_format($row['PER_DEV'], 2);
		$s4=number_format($row['ACTUAL'], 0);
		$s5=number_format($row['PER_ACTUAL'], 2);
		$s6=number_format($row['CHANGE'], 2);
		$s7=$row['POINT'];
		$s8=$row['POINT_DIFF'];

// $pdf->Cell(0,5,iconv('UTF-8','cp874','ธนาคารออมสิน'),0,1,'C');
$pdf->SetFont('THSarabunNew','B',16);
$pdf->SetWidths(array(56,32,32,32,32,32,32,32));
    $pdf->Row(array(iconv('UTF-8','cp874',$s1),iconv('UTF-8','cp874',$s2),iconv('UTF-8','cp874',$s3),iconv('UTF-8','cp874',$s4),iconv('UTF-8','cp874',$s5),iconv('UTF-8','cp874',$s6),iconv('UTF-8','cp874',$s7),iconv('UTF-8','cp874',$s8)));


} else {
                $s1=$row['ATTIBUTE'];
                $s2=number_format($row['DEV'], 0);
                $s3=number_format($row['PER_DEV'], 2);
                $s4=number_format($row['ACTUAL'], 0);
                $s5=number_format($row['PER_ACTUAL'], 2);
                $s6=number_format($row['CHANGE'], 2);
                $s7=number_format($row['POINT'], 0);
                $s8=number_format($row['POINT_DIFF'], 2);

$pdf->SetFont('THSarabunNew','B',16);
$pdf->SetWidths(array(56,32,32,32,32,32,32,32));
    $pdf->Row(array(iconv('UTF-8','cp874',$s1),iconv('UTF-8','cp874',$s2),iconv('UTF-8','cp874',$s3),iconv('UTF-8','cp874',$s4),iconv('UTF-8','cp874',$s5),iconv('UTF-8','cp874',$s6),iconv('UTF-8','cp874',$s7),iconv('UTF-8','cp874',$s8)));
}
}

$pdf->Output('Report3_PDF.pdf', 'D');

