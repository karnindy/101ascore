<?php
include('../database/connect.php');
// --------------------------
define('FPDF_FONTPATH','font/');
require('../fpdf184/fpdf.php');

error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$region_name=$_GET['region_name'];
$zone_name=$_GET['zone_name'];
$branch_name=$_GET['branch_name'];
$model_version=$_GET['model_version'];
$sales_channel=$_GET['sales_channel'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$business_type=$_GET['business_type'];
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
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานเปรียบเทียบการกระจายตัวของคะแนนของลูกค้าแต่ละกลุ่ม ณ ช่วงเวลาที่แตกต่างกัน'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','( Population Stability Report ) ( REP01 )'),0,1,'C');
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
$pdf->cell(38,10,'Score Range ',1,0,'C',true);
$pdf->cell(24,10,'DEV',1,0,'C',true);
$pdf->cell(24,10,'% DEV',1,0,'C',true);
$pdf->cell(24,10,'Actual',1,0,'C',true);
$pdf->cell(24,10,'% Actual',1,0,'C',true);
$pdf->cell(24,10,'% Change',1,0,'C',true);
$pdf->cell(24,10,'Ratio',1,0,'C',true);
$pdf->cell(24,10,'WOE',1,0,'C',true);
$pdf->cell(24,10,'Index',1,0,'C',true);
$pdf->cell(24,10,'% Approve',1,0,'C',true);
$pdf->cell(24,10,'% Reject',1,0,'C',true);
$pdf->Ln();

// --------------------------

require('sqlExport.php');

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if(strtolower($row['SCORE_RANGE_DESC']) == "total"){ ?>
<?php 
        $s1=$row['SCORE_RANGE_DESC'];
        $s2=number_format($row['DEV'], 0);
        $s3=number_format($row['PER_DEV'], 2);
        $s4=number_format($row['ACTUAL'], 0);
        $s5=number_format($row['PER_ACTUAL'], 2);
        $s6=$row['PER_CHANGE'];
        $s7=$row['RATIO'];
        $s8=$row['WOE'];
        $s9=$row['INDEX_'];
        $s10=number_format($row['PER_APPROVE'], 2);
        $s11=number_format($row['PER_REJECT'], 2);
        
        // ===========บรรทัดล่างสุด=============
        $pdf->SetFont('THSarabunNew','B',16);
        $pdf->cell(38,10,$s1,1,0,'C',true);
        $pdf->cell(24,10,$s2,1,0,'C',true);
        $pdf->cell(24,10,$s3,1,0,'C',true);
        $pdf->cell(24,10,$s4,1,0,'C',true);
        $pdf->cell(24,10,$s5,1,0,'C',true);
        $pdf->cell(24,10,$s6,1,0,'C',true);
        $pdf->cell(24,10,$s7,1,0,'C',true);
        $pdf->cell(24,10,$s8,1,0,'C',true);
        $pdf->cell(24,10,$s9,1,0,'C',true);
        $pdf->cell(24,10,$s10,1,0,'C',true);
        $pdf->cell(24,10,$s11,1,1,'C',true);
?>
<?php
} else {
?>
<?php 
        $s1=$row['SCORE_RANGE_DESC'];
        $s2=number_format($row['DEV'], 0);
        $s3=number_format($row['PER_DEV'], 2);
        $s4=number_format($row['ACTUAL'], 0);
        $s5=number_format($row['PER_ACTUAL'], 2);
        $s6=number_format($row['PER_CHANGE'], 2);
        $s7=number_format($row['RATIO'], 2);
        $s8=number_format($row['WOE'], 2);
        $s9=number_format($row['INDEX_'], 2);
        $s10=number_format($row['PER_APPROVE'], 2);
        $s11=number_format($row['PER_REJECT'], 2);
// =======ตรงกลางตาราง=========
$pdf->SetFont('THSarabunNew','B',16);
$pdf->cell(38,10,$s1,1,0,'C');
$pdf->cell(24,10,$s2,1,0,'C');
$pdf->cell(24,10,$s3,1,0,'C');
$pdf->cell(24,10,$s4,1,0,'C');
$pdf->cell(24,10,$s5,1,0,'C');
$pdf->cell(24,10,$s6,1,0,'C');
$pdf->cell(24,10,$s7,1,0,'C');
$pdf->cell(24,10,$s8,1,0,'C');
$pdf->cell(24,10,$s9,1,0,'C');
$pdf->cell(24,10,$s10,1,0,'C');
$pdf->cell(24,10,$s11,1,1,'C');

?>
<?php
}
$count++;
}
?>
<?php 
$pdf->Output('Report1_PDF.pdf', 'D');
?>
