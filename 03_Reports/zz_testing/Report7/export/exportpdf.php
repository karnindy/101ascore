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
$pdf->SetFont('THSarabunNew','B',24);


$pdf->AddPage();
$pdf->Image('logo/logo.png',10,8,50);
$pdf->Ln(13);
$pdf->Cell(0,5,iconv('UTF-8','cp874','ธนาคารออมสิน'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานประเมินประสิทธิผลของแบบจำลองฯ ในการแยกลูกค้าดีออกจากลูกค้าไม่ดี'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,2,iconv('UTF-8','cp874','Good or Bad Separation Report ( REP07 )'),0,1,'C');
$pdf->Ln(6);
$pdf->Cell(0,6,iconv('UTF-8','cp874','เวอร์ชันโมเดล: '.$model_version),0,1,);
$pdf->Cell(1,6,iconv('UTF-8','cp874','ประเภทสินเชื่อ: '.$product_type),0,0,'L');
$pdf->Cell(0,6,iconv('UTF-8','cp874','ประเภทโมเดล: '.$model_type),0,0,'C');
$pdf->Cell(0,6,iconv('UTF-8','cp874','ประเภทบัตร: '.$card_type),0,1,'R');
$pdf->Cell(1,6,iconv('UTF-8','cp874','ภาค: '.$region_name.'  เขต: '.$zone_name.'  สาขา: '.$branch_name),0,0,'L');
$pdf->Cell(0,6,iconv('UTF-8','cp874','ช่องทางการขาย: '.$sales_channel),0,1,'R');
$pdf->Cell(0,6,iconv('UTF-8','cp874','สายงานธุรกิจ: '.$business_type),0,1,);
$pdf->Cell(1,6,iconv('UTF-8','cp874','เดือน/ปี ที่ออกผลการพิจารณา: '.$month.'  /  '.$year),0,0,'L');
$pdf->Cell(0,6,iconv('UTF-8','cp874','ผู้ออกรายงาน: ascbiadmin'),0,0,'C');
$pdf->Cell(0,6,iconv('UTF-8','cp874','วันที่ออกรายงาน: '.$date.' '.$time),0,1,'R');
$pdf->Ln(6);

// =============================================================
// $pdf->Cell(0,5,iconv('UTF-8','cp874','ธนาคารออมสิน'),0,1,'C');
// =============================================================

// ========ใส่สีช่องหัวตาราง=========
$pdf->SetFillColor(254,204,255);
// =============================
$pdf->SetFont('THSarabunNew','B',16);
$pdf->cell(38,20,'Score Range ',1,0,'C',true);
$pdf->cell(80,10,'Currentt Validation Sample(%)',1,0,'C',true);
$pdf->cell(93.3,10,'Development Sample(%)',1,0,'C',true);
$pdf->cell(66.6,10,'Past 12 Months',1,1,'C',true);
$pdf->cell(38,10,'',0,0,'L');
$pdf->SetFont('THSarabunNew','B',14);
$pdf->cell(26.66,10,'% Cum_G',1,0,'C',true);
$pdf->cell(26.66,10,'% Cum_B',1,0,'C',true);
$pdf->cell(26.66,10,'Sep_BG',1,0,'C',true);
$pdf->cell(40,10,'% BadRate(Current)',1,0,'C',true);
$pdf->cell(26.66,10,'% Cum_G',1,0,'C',true);
$pdf->cell(26.66,10,'% Cum_B',1,0,'C',true);
$pdf->cell(26.66,10,'Sep_BG',1,0,'C',true);
$pdf->cell(40,10,'% BadRate(Current)',1,0,'C',true);

$pdf->Ln();


// --------------------------

require('sqlExport.php');
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
        $s1=$row['SCORE_RANGE_DESC'];
                // $s2=number_format($row['PER_CUM_G_CURR'], 2);
                // $s3=number_format($row['PER_CUM_B_CURR'], 2);
                // $s4=number_format($row['SEP_BG_CURR'], 2);
                // $s5=number_format($row['PER_BAD_RATE_CURR'], 2);
                // $s6=number_format($row['PER_GOOD_DEV'], 2);
                // $s7=number_format($row['PER_BAD_DEV'], 2);
                // $s8=number_format($row['SEP_BG_DEV'], 2);
                // $s9=number_format($row['PER_BAD_RATE_DEV'], 2);

                if ($row['PER_CUM_G_CURR']== '') {
                        $s2="";
                }else{$s2=number_format($row['PER_CUM_G_CURR'], 2);}

                if ($row['PER_CUM_B_CURR']== '') {
                        $s3="";
                }else{$s3=number_format($row['PER_CUM_B_CURR'], 2);}

                if ($row['SEP_BG_CURR']== '') {
                        $s4="";
                }else{$s4=number_format($row['SEP_BG_CURR'], 2);}

                if ($row['PER_BAD_RATE_CURR']== '') {
                        $s5="";
                }else{$s5=number_format($row['PER_BAD_RATE_CURR'], 2);}

                if ($row['PER_GOOD_DEV']== '') {
                        $s6="";
                }else{$s6=number_format($row['PER_GOOD_DEV'], 2);}

                if ($row['PER_BAD_DEV']== '') {
                        $s7="";
                }else{$s7=number_format($row['PER_BAD_DEV'], 2);}

                if ($row['SEP_BG_DEV']== '') {
                        $s8="";
                }else{$s8=number_format($row['SEP_BG_DEV'], 2);}

                if ($row['PER_BAD_RATE_DEV']== '') {
                        $s9="";
                }else{$s9=number_format($row['PER_BAD_RATE_DEV'], 2);}

        if(preg_match("/Total/i", $row['SCORE_RANGE_DESC'])){ 

$pdf->SetFont('THSarabunNew','B',16);
$pdf->cell(38,10,$s1,1,0,'C',true);
$pdf->cell(26.66,10,$s2,1,0,'C',true);
$pdf->cell(26.66,10,$s3,1,0,'C',true);
$pdf->cell(26.66,10,$s4,1,0,'C',true);
$pdf->cell(40,10,$s5,1,0,'C',true);
$pdf->cell(26.66,10,$s6,1,0,'C',true);
$pdf->cell(26.66,10,$s7,1,0,'C',true);
$pdf->cell(26.66,10,$s8,1,0,'C',true);
$pdf->cell(40,10,$s9,1,1,'C',true);

} else {

$pdf->SetFont('THSarabunNew','B',16);
$pdf->cell(38,10,$s1,1,0,'C');
$pdf->cell(26.66,10,$s2,1,0,'C');
$pdf->cell(26.66,10,$s3,1,0,'C');
$pdf->cell(26.66,10,$s4,1,0,'C');
$pdf->cell(40,10,$s5,1,0,'C');
$pdf->cell(26.66,10,$s6,1,0,'C');
$pdf->cell(26.66,10,$s7,1,0,'C');
$pdf->cell(26.66,10,$s8,1,0,'C');
$pdf->cell(40,10,$s9,1,1,'C');

}
}


$pdf->Output('Report7_PDF.pdf', 'D');

