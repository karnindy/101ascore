<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
error_reporting(0); 
$product_type=$_POST['product_type'];
$model_type=$_POST['model_type'];
$card_type=$_POST['card_type'];
$model_version=$_POST['model_version'];
$sales_channel=$_POST['sales_channel'];
$business_type=$_POST['business_type'];
$region_name=$_POST['region_name'];
$zone_name=$_POST['zone_name'];
$branch_name=$_POST['branch_name'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
$report_id=$_POST['report_id'];
$start_date="01-".$start_date;
$month=substr($end_date,0,2);
$year=substr($end_date,3,4);
$month=number_format($month, 0);
$month;

		switch($month){
        case 1 :  $date = "31";
          break;
        case 2 :  if($year%4==0){$date = "29";}
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

require('sqlExport.php');
$FileName="Report14_CSV.csv";
$fileFileName = "csv/".$FileName;
$objWrite = fopen("csv/".$FileName, "w");
fwrite($objWrite, "\xEF\xBB\xBF");


$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $start_date, $end_date, $_POST['business_type'], $_POST['report_id']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);

switch ($_POST['report_id']) {
    case 'รายงานติดตามประเมินผลการใช้คะแนนเครดิต(Credit Bureau Score) ประกอบการพิจารณาอนุมัติบัตรเครดิตและสินเชื่อบัตรเงินสด':
fwrite($objWrite, "\" \",\" \",\"ความเสี่ยงต่ำ(A)\",\" \",\" \",\"ความเสี่ยงปานกลาง(B)\",\" \",\" \",\"ความเสี่ยงค่อนข้างสูง(C)\",\" \",\" \",\"ความเสี่ยงสูง(D)\",\" \",\" \",\"รวม\",\" \" \n");

fwrite($objWrite, "\"BUREAU SCORE\",\"PL\",\"NPLs\",\"รวม\",\"PL\",\"NPLs\",\"รวม\",\"PL\",\"NPLs\",\"รวม	\",\"PL\",\"NPLs\",\"รวม\",\"PL\",\"NPLs\",\"รวม\" \n");
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
fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\",\"$s12\",\"$s13\",\"$s14\",\"$s15\",\"$s16\" \n");
            } else {
fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\",\"$s12\",\"$s13\",\"$s14\",\"$s15\",\"$s16\" \n");
            }
        }
        break;

    case 'รายงานแสดงร้อยละของลูกค้าบัตรเครดิตสินเชื่อบัตรเงินสด แยกตามระดับความเสี่ยงและสถานะของลูกค้า':
fwrite($objWrite, "\" \",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\" \",\"APPROVE ที่อนุมัติและเปิดบัญชี\",\" \",\" \" \n");

fwrite($objWrite, "\" \",\"APPROVED\",\" \",\"REJECTED\",\" \",\"CANCELED\",\" \",\"INCOMPLETED\",\" \",\"PENDING\",\" \",\"อื่น ๆ\",\" \",\"รวมทั้งหมด\",\" \",\"PL\",\" \",\"NPLs\",\" \",\" \",\" \" \n");

fwrite($objWrite, "\"ระดับความเสี่ยง(A Score)\",\"ราย\",\"ร้อยละ\",\"ราย\",\"ร้อยละ\",\"ราย\",\"ร้อยละ\",\"ราย\",\"ร้อยละ\",\"ราย\",\"ร้อยละ\",\"ราย\",\"ร้อยละ\",\"ราย\",\"ร้อยละ\",\"ราย\",\"ร้อยละ\",\"ราย\",\"ร้อยละ\" \n");
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
fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\",\"$s12\",\"$s13\",\"$s14\",\"$s15\",\"$s16\",\"$s17\",\"$s18\",\"$s19\" \n");
            } else {
fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\",\"$s12\",\"$s13\",\"$s14\",\"$s15\",\"$s16\",\"$s17\",\"$s18\",\"$s19\" \n");
            }
        }
        break;

    case 'รายงานติดตามการชำระหนี้สำหรับลูกค้าบัตรเครดิต/สินเชื่อบัตรเงินสด แยกตามระดับความเสี่ยง(เกรด)':
fwrite($objWrite, "\"ระดับความเสี่ยง(Grade)\",\"ไม่ค้างชำระ\",\"  \",\"ค้างชำระ 1-30 วัน\",\"  \",\"ค้างชำระ 31-60 วัน\",\"  \",\"ค้างชำระ 61-90 วัน\",\"  \",\"ค้างชำระมากกว่า 90 วัน\",\"  \",\"รวม\",\"  \" \n");

fwrite($objWrite, "\"ระดับความเสี่ยง(Grade)\",\"จำนวนราย\",\"ร้อยละ\",\"จำนวนราย\",\"ร้อยละ\",\"จำนวนราย\",\"ร้อยละ\",\"จำนวนราย\",\"ร้อยละ\",\"จำนวนราย\",\"ร้อยละ\",\"จำนวนราย\",\"ร้อยละ\" \n");
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
fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\",\"$s12\",\"$s13\" \n");
            } else {
fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\",\"$s12\",\"$s13\" \n");
            }
        }
        break;    

    default:
fwrite($objWrite, "\"\",\" \",\"ความเสี่ยงต่ำ(A)\",\" \",\" \",\"ความเสี่ยงปานกลาง(B)\",\" \",\" \",\"ความเสี่ยงค่อนข้างสูง(C)\",\" \",\" \",\"ความเสี่ยงสูง(D)\",\" \",\" \",\"รวม\",\" \" \n");

fwrite($objWrite, "\"BUREAU SCORE\",\"PL\",\"NPLs\",\"รวม\",\"PL\",\"NPLs\",\"รวม\",\"PL\",\"NPLs\",\"รวม	\",\"PL\",\"NPLs\",\"รวม\",\"PL\",\"NPLs\",\"รวม\" \n");
    	break;
}
fclose($objWrite);
?>