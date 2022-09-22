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
$report_id=$_GET['report_id'];
$start_date="01-".$start_date;
$month=substr($end_date,0,2);
$year=substr($end_date,3,4);
$month=number_format($month, 0);
$month;

        switch($month){
        case 1 :  $date = "31";
          break;
        case 2 :  if($year%4==0 and $year%100!=0){$date = "29";}
                                    else{$date = "28";}
          break;
        case 3 :  $date = "31";
          break;
        case 4 :  $date = "30";
          break;
        case 5 :  $date = "31";
          break;
        case 6 :  $date = "30";
          break;
        case 7 :  $date = "31";
          break;
        case 8 :  $date = "31";
          break;
        case 9 :  $date = "30";
          break;
        case 10 :  $date = "31";
          break;
        case 11 :  $date = "30";
          break;
        case 12 :  $date = "31";
          break;
        default: $date = "31";
            break;
    }

$end_date=$date."-".$end_date;
$business_type=$_GET['business_type'];
date_default_timezone_set('asia/bangkok');
$date = date('d/m/Y');
$time = date('H:i:s');
// ==============จัดรูปแบบวันที่ให้เหมือนหน้าเว็บ=============== 
$newstartdate = date("d/m/Y", strtotime($start_date));
$newenddate = date("d/m/Y", strtotime($end_date));

$pdf = new FPDF('L','mm','A3');
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
$pdf->Cell(0,4,iconv('UTF-8','cp874','รายงานการวิเคราะห์และติดตามประเมินผลการใช้แบบจำลองฯ วัดระดับความเสี่ยง'),0,1,'C');
$pdf->Ln();
$pdf->SetFont('THSarabunNew','B',18);
$pdf->Cell(0,4,iconv('UTF-8','cp874','Credit Scoring Model ( REP14 )'),0,1,'C');
$pdf->Ln();
$pdf->Cell(0,4,iconv('UTF-8','cp874',$report_id),0,1,'C');
$pdf->Ln(2);
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

// --------------------------

require('sqlExport.php');


$sql = get_report_sql($_GET['product_type'], $_GET['model_type'], $_GET['card_type'], $_GET['region_name'], $_GET['zone_name'], $_GET['branch_name'], $_GET['model_version'], $_GET['sales_channel'], $start_date, $end_date, $_GET['business_type'], $_GET['report_id']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);

switch ($_GET['report_id']) {
    case 'รายงานติดตามประเมินผลการใช้คะแนนเครดิต(Credit Bureau Score) ประกอบการพิจารณาอนุมัติบัตรเครดิตและสินเชื่อบัตรเงินสด':
        
            $pdf->SetFont('THSarabunNew','B',15);
            $pdf->Cell(55,20,iconv('UTF-8','cp874','BUREAU SCORE'),1,0,'C',true);
            $pdf->Cell(69,10,iconv('UTF-8','cp874','ความเสี่ยงต่ำ(A)'),1,0,'C',true);
            $pdf->Cell(69,10,iconv('UTF-8','cp874','ความเสี่ยงปานกลาง(B)'),1,0,'C',true);
            $pdf->Cell(69,10,iconv('UTF-8','cp874','ความเสี่ยงค่อนข้างสูง(C)'),1,0,'C',true);
            $pdf->Cell(69,10,iconv('UTF-8','cp874','ความเสี่ยงสูง(D)'),1,0,'C',true);
            $pdf->Cell(69,10,iconv('UTF-8','cp874','รวม'),1,1,'C',true);
            $pdf->Cell(55,10,iconv('UTF-8','cp874',''),0,0,'C');
            $pdf->Cell(23,10,iconv('UTF-8','cp874','PL'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','NPLs'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','รวม'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','PL'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','NPLs'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','รวม'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','PL'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','NPLs'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','รวม'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','PL'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','NPLs'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','รวม'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','PL'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','NPLs'),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874','รวม'),1,1,'C',true);
        while ($row = oci_fetch_array($query,OCI_BOTH)) {
                // $row = oci_fetch_array($query,OCI_BOTH);
                // echo 2;

                $s1=$row['BUREAU_SCORE'];
                $s2=$row['PL_A'];
                $s3=$row['NPL_A'];
                $s4=$row['TOTAL_A'];
                $s5=$row['PL_B'];
                $s6=$row['NPL_B'];
                $s7=$row['TOTAL_B'];
                $s8=$row['PL_C'];
                $s9=$row['NPL_C'];
                $s10=$row['TOTAL_C'];
                $s11=$row['PL_D'];
                $s12=$row['NPL_D'];
                $s13=$row['TOTAL_D'];
                $s14=$row['TOTAL_PL'];
                $s15=$row['TOTAL_NPL'];
                $s16=$row['TOTAL_ALL'];
            if(strtolower($row['BUREAU_SCORE']) == "total"){
                $pdf->SetFont('THSarabunNew','B',15);
                
            $pdf->Cell(55,10,iconv('UTF-8','cp874',$s1),1,0,'C',true);
            $pdf->SetFont('THSarabunNew','B',12);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s2),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s3),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s4),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s5),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s6),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s7),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s8),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s9),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s10),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s11),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s12),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s13),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s14),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s15),1,0,'C',true);
            $pdf->Cell(23,10,iconv('UTF-8','cp874',$s16),1,1,'C',true);
            } else {
$pdf->SetFont('THSarabunNew','B',15);
$pdf->Cell(55,10,iconv('UTF-8','cp874',$s1),1,0,'C');
$pdf->SetFont('THSarabunNew','B',12);
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s2),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s3),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s4),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s5),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s6),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s7),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s8),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s9),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s10),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s11),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s12),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s13),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s14),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s15),1,0,'C');
$pdf->Cell(23,10,iconv('UTF-8','cp874',$s16),1,1,'C');
            }
        }
        break;

    case 'รายงานแสดงร้อยละของลูกค้าบัตรเครดิตสินเชื่อบัตรเงินสด แยกตามระดับความเสี่ยงและสถานะของลูกค้า':
$wide1 = 38;
$wide2 = 19;
$pdf->SetFont('THSarabunNew','B',16);
$pdf->Cell(55,30,iconv('UTF-8','cp874','ระดับความเสี่ยง(A Score)'),1,0,'C',true);
$pdf->Cell($wide1,20,iconv('UTF-8','cp874','APPROVED'),1,0,'C',true);
$pdf->Cell($wide1,20,iconv('UTF-8','cp874','REJECTED'),1,0,'C',true);
$pdf->Cell($wide1,20,iconv('UTF-8','cp874','CANCELED'),1,0,'C',true);
$pdf->Cell($wide1,20,iconv('UTF-8','cp874','INCOMPLETED'),1,0,'C',true);
$pdf->Cell($wide1,20,iconv('UTF-8','cp874','PENDING'),1,0,'C',true);
$pdf->Cell($wide1,20,iconv('UTF-8','cp874','อื่น ๆ'),1,0,'C',true);
$pdf->Cell($wide1,20,iconv('UTF-8','cp874','รวมทั้งหมด'),1,0,'C',true);
$pdf->Cell(76,10,iconv('UTF-8','cp874','APPROVE ที่อนุมัติและเปิดบัญชี'),1,1,'C',true);
$pdf->Cell(321,20,iconv('UTF-8','cp874',''),0,0,'C');
$pdf->Cell($wide1,10,iconv('UTF-8','cp874','PL'),1,0,'C',true);
$pdf->Cell($wide1,10,iconv('UTF-8','cp874','NPLs'),1,1,'C',true);
$pdf->Cell(55,20,iconv('UTF-8','cp874',''),0,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ราย'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ราย'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);	
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ราย'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ราย'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ราย'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ราย'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ราย'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ราย'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ราย'),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874','ร้อยละ'),1,1,'C',true);
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
        $s1=$row['GRADE_DESC'];
        $s2=number_format($row['APPROVE_RPT2'], 0);
                $s3=number_format($row['PER_APPROVE_RPT2'], 2);
                $s4=number_format($row['REJECT_RPT2'], 0);
                $s5=number_format($row['PER_REJECT_RPT2'], 2);
                $s6=number_format($row['CANCEL_RPT2'], 0);
                $s7=number_format($row['PER_CANCEL_RPT2'], 2);
                $s8=number_format($row['INCOMPLETED'], 0);
                $s9=number_format($row['PER_INCOMPLETED'], 2);
                $s10=number_format($row['PENDING'], 0);
                $s11=number_format($row['PER_PENDING'], 2);
                $s12=number_format($row['OTHER'], 0);
                $s13=number_format($row['PER_OTHER'], 2);
                $s14=number_format($row['TOTAL_STATUS'], 0);
                $s15=number_format($row['PER_TOTAL_STATUS'], 2);
                $s16=number_format($row['PL'], 0);
                $s17=number_format($row['PER_PL'], 2);
                $s18=number_format($row['NPL'], 0);
                $s19=number_format($row['PER_NPL'], 2);

            if(strtolower($row['GRADE_DESC']) == "total"){
$pdf->Cell(55,10,iconv('UTF-8','cp874',$s1),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s2),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s3),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s4),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s5),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s6),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s7),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s8),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s9),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s10),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s11),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s12),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s13),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s14),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s15),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s16),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s17),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s18),1,0,'C',true);
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s19),1,1,'C',true);
            } else {
$pdf->Cell(55,10,iconv('UTF-8','cp874',$s1),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s2),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s3),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s4),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s5),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s6),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s7),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s8),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s9),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s10),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s11),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s12),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s13),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s14),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s15),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s16),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s17),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s18),1,0,'C');
$pdf->Cell($wide2,10,iconv('UTF-8','cp874',$s19),1,1,'C');
            }
        }
        break;

    case 'รายงานติดตามการชำระหนี้สำหรับลูกค้าบัตรเครดิต/สินเชื่อบัตรเงินสด แยกตามระดับความเสี่ยง(เกรด)':
$pdf->SetFont('THSarabunNew','B',16);
$pdf->Cell(60,20,iconv('UTF-8','cp874','ระดับความเสี่ยง(Grade)'),1,0,'C',true);
$pdf->Cell(56,10,iconv('UTF-8','cp874','ไม่ค้างชำระ'),1,0,'C',true);
$pdf->Cell(56,10,iconv('UTF-8','cp874','ค้างชำระ 1-30 วัน'),1,0,'C',true);
$pdf->Cell(56,10,iconv('UTF-8','cp874','ค้างชำระ 31-60 วัน'),1,0,'C',true);
$pdf->Cell(56,10,iconv('UTF-8','cp874','ค้างชำระ 61-90 วัน'),1,0,'C',true);
$pdf->Cell(56,10,iconv('UTF-8','cp874','ค้างชำระมากกว่า 90 วัน'),1,0,'C',true);
$pdf->Cell(56,10,iconv('UTF-8','cp874','รวม'),1,1,'C',true);
$pdf->Cell(60,10,iconv('UTF-8','cp874',''),0,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874','จำนวนราย'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','จำนวนราย'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','จำนวนราย'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','จำนวนราย'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','จำนวนราย'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','ร้อยละ'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','จำนวนราย'),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874','ร้อยละ'),1,1,'C',true);
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
                $s1=$row['GRADE_DESC'];
        $s2=number_format($row['EVER0'], 0);
                $s3=number_format($row['PER_EVER0'], 2);
                $s4=number_format($row['EVER1_30'], 0);
                $s5=number_format($row['PER_EVER1_30'], 2);
                $s6=number_format($row['EVER31_60'], 0);
                $s7=number_format($row['PER_EVER31_60'], 2);
                $s8=number_format($row['EVER61_90'], 0);
                $s9=number_format($row['PER_EVER61_90'], 2);
                $s10=number_format($row['DELMORE_90'], 0);
                $s11=number_format($row['PER_EVER_MORE90'], 2);
                $s12=number_format($row['TOTAL_ACTIVE'], 0);
                $s13=number_format($row['PER_ACTIVE'], 2);
            if(strtolower($row['GRADE_DESC']) == "total"){
$pdf->SetFont('THSarabunNew','B',16);
$pdf->Cell(60,10,iconv('UTF-8','cp874',$s1),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s2),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s3),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s4),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s5),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s6),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s7),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s8),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s9),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s10),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s11),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s12),1,0,'C',true);
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s13),1,1,'C',true);
            } else {
$pdf->SetFont('THSarabunNew','B',16);
$pdf->Cell(60,10,iconv('UTF-8','cp874',$s1),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s2),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s3),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s4),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s5),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s6),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s7),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s8),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s9),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s10),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s11),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s12),1,0,'C');
$pdf->Cell(28,10,iconv('UTF-8','cp874',$s13),1,1,'C');
            }
        }
        break;    
}



$pdf->Output('Report14_PDF.pdf', 'D');

