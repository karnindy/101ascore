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
$all_year=$_GET['all_year'];
date_default_timezone_set('asia/bangkok');
$date = date('d/m/Y');
$time = date('H:i:s');

require('sqlExport.php');


$pdf = new FPDF('L','mm','A3');
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
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานเปรียบเทียบการผิดนัดชำระหนี้ของลูกหนี้ที่ได้เปิดบัญชีมาเป็นระยะเวลาเท่ากัน'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','Vintage Analysis Report ( REP09 )'),0,1,'C');
$pdf->Ln(6);
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
$pdf->Ln(3);

// =============================================================
// $pdf->Cell(0,5,iconv('UTF-8','cp874','ธนาคารออมสิน'),0,1,'C');
// =============================================================

// ========ใส่สีช่องหัวตาราง=========
$pdf->SetFillColor(254,204,255);
// =============================
$pdf->SetFont('THSarabunNew','B',15);
$pdf->Cell(38,20,iconv('UTF-8','cp874','Approve Date'),1,0,'C',true);
$pdf->Cell(25,20,iconv('UTF-8','cp874','Total Account'),1,0,'C',true);
// $pdf->Cell(180,10,iconv('UTF-8','cp874','Deliquency'),1,1,'C',true);
// $pdf->Cell(96,10,iconv('UTF-8','cp874',''),0,0,'C');
// $pdf->Cell(45,10,iconv('UTF-8','cp874','ม.ค.-มี.ค. (Q2)'),1,0,'C',true);
// $pdf->Cell(45,10,iconv('UTF-8','cp874','เม.ย.-มิ.ย. (Q3)'),1,0,'C',true);
// $pdf->Cell(45,10,iconv('UTF-8','cp874','ก.ค.-ก.ย. (Q4)'),1,0,'C',true);
// $pdf->Cell(45,10,iconv('UTF-8','cp874','ต.ค.-ธ.ค. (Q1)'),1,0,'C',true);
// --------------------------
$long=45;
$sql_all_year = get_all_year($_GET['product_type'], $_GET['model_type'], $_GET['card_type'], $_GET['model_version'], $_GET['sales_channel'], $_GET['region_name'], $_GET['zone_name'], $_GET['branch_name'], $_GET['month'], $_GET['year']);
$query_all_year = oci_parse($conn, $sql_all_year);
// echo $sql_all_year;
oci_execute($query_all_year,OCI_DEFAULT);

$numrows = oci_fetch_all($query_all_year, $res);

// fwrite($objWrite, "\" \",\" \",\"Deliquency\"");
for ($x = 1; $x <= $numrows-1; $x++) {
  $long=$long+37.14;
} 

$pdf->Cell($long,10,iconv('UTF-8','cp874','Deliquency'),1,1,'C',true);
$pdf->Cell(63,10,iconv('UTF-8','cp874',''),0,0,'C');


$all_year = "";
$array_all_year = array();
$count_all_year = 1;
//print_r($res["ALL_YEAR"]);
foreach ($res["ALL_YEAR"] as $row_all_year) {
    array_push($array_all_year, $row_all_year);

  $pdf->Cell(38,10,iconv('UTF-8','cp874',$row_all_year),1,0,'C',true);

    if($count_all_year == $numrows){
        $all_year = $all_year . "'" . $row_all_year . "'";
    } else {
        $all_year = $all_year . "'" . $row_all_year . "',";
    }
    $count_all_year++;
}
	$pdf->Cell(45,10,iconv('UTF-8','cp874',''),0,1,'C');
$sql = get_report_sql($_GET['product_type'], $_GET['model_type'], $_GET['card_type'], $_GET['region_name'], $_GET['zone_name'], $_GET['branch_name'], $_GET['model_version'], $_GET['sales_channel'], $_GET['month'], $_GET['year'], $all_year, $_GET['business_type']);

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 0;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
	$month = "'" . $array_all_year[$count] . "'";

		$s1=$array_all_year[$count];
		$s2=number_format($row['TOTAL_ACCOUNT'], 0);
		$s3=number_format($row[$month], 2);

			$pdf->Cell(38,10,iconv('UTF-8','cp874',$s1),1,0,'C');
			$pdf->Cell(25,10,iconv('UTF-8','cp874',$s2),1,0,'C');

    for ($i=0; $i < $numrows; $i++) {
        if($count == $i){
            $pdf->SetFillColor(203,202,203);
        	$pdf->Cell(38,10,iconv('UTF-8','cp874',$s3),1,0,'C');
        } else {
            $pdf->Cell(38,10,iconv('UTF-8','cp874','0.00'),1,0,'C');
        }
    }

	$pdf->Cell(45,10,iconv('UTF-8','cp874',''),0,1,'C');
    $count++;
}

$pdf->Output('Report9_PDF.pdf', 'D');

