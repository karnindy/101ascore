<?php
include('../database/connect.php');
// --------------------------
define('FPDF_FONTPATH','font/');
require('../fpdf184/fpdf.php');

error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$region_FileName=$_GET['region_FileName'];
$zone_FileName=$_GET['zone_FileName'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
date_default_timezone_set('asia/bangkok');
$date = date('d/m/Y');
$time = date('H:i:s');
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
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานเหตุการณ์'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','Portfolio Chronology logs Report ( REP13 )'),0,1,'C');
$pdf->Ln(6);
$pdf->Cell(1,7,iconv('UTF-8','cp874','ประเภทสินเชื่อ: '.$product_type),0,0,'L');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ประเภทโมเดล: '.$model_type),0,0,'C');
$pdf->Cell(0,7,iconv('UTF-8','cp874','ประเภทบัตร: '.$card_type),0,1,'R');
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
$pdf->Cell(40,10,iconv('UTF-8','cp874','วันบันทึกข้อมูล'),1,0,'C',true);
$pdf->Cell(40,10,iconv('UTF-8','cp874','ประเภทสินเชื่อ'),1,0,'C',true);
$pdf->Cell(40,10,iconv('UTF-8','cp874','ประเภทโมเดล'),1,0,'C',true);
$pdf->Cell(40,10,iconv('UTF-8','cp874','ประเภทบัตร'),1,0,'C',true);
$pdf->Cell(40,10,iconv('UTF-8','cp874','เวอร์ชันโมเดล'),1,0,'C',true);
$pdf->Cell(40,10,iconv('UTF-8','cp874','วันที่เริ่มใช้งาน'),1,0,'C',true);
$pdf->Cell(40,10,iconv('UTF-8','cp874','Description'),1,0,'C',true);
$pdf->Ln();


// --------------------------



require('sqlExport.php');

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {

                $s1=$row['CREATE_DATE'];
                $s2=$row['PRODUCT_TYPE'];
                $s3=$row['MODEL_TYPE'];
                $s4=$row['CARD_TYPE'];
                $s5=$row['VERSION_MODEL'];
                $s6=$row['START_DATE'];
                $s7=$row['DESCRIPTION'];

$pdf->SetFont('THSarabunNew','B',16);
$pdf->SetWidths(array(40,40,40,40,40,40,40));
    $pdf->Row(array(iconv('UTF-8','cp874',$s1),iconv('UTF-8','cp874',$s2),iconv('UTF-8','cp874',$s3),iconv('UTF-8','cp874',$s4),iconv('UTF-8','cp874',$s5),iconv('UTF-8','cp874',$s6),iconv('UTF-8','cp874',$s7)));
}
$pdf->AliasNbPages();
$pdf->Output('Report13_PDF.pdf', 'D');

