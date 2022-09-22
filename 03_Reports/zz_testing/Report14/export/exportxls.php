<?php
include("../database/connect.php");
// --------------------------
$FileNmae="Report14_XLS.xls";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");
// --------------------------

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

require('sqlExport.php');
$table1 = "<table >
            <thead >
                <tr>
                    <th rowspan='2' >BUREAU SCORE</th>
                    <th colspan='3' >ความเสี่ยงต่ำ(A)</th>
                    <th colspan='3' >ความเสี่ยงปานกลาง(B)</th>
                    <th colspan='3' >ความเสี่ยงค่อนข้างสูง(C)</th>
                    <th colspan='3' >ความเสี่ยงสูง(D)</th>
                    <th colspan='3' >รวม</th>
                </tr>
                <tr>
                    <th >PL</th>
                    <th >NPLs</th>
                    <th >รวม</th>
                    <th >PL</th>
                    <th >NPLs</th>
                    <th >รวม</th>
                    <th >PL</th>
                    <th >NPLs</th>
                    <th >รวม</th>
                    <th >PL</th>
                    <th >NPLs</th>
                    <th >รวม</th>
                    <th >PL</th>
                    <th >NPLs</th>
                    <th >รวม</th>
                </tr>
            </thead>
            <tbody>";

$table2 = "<table >
                <thead >
                    <tr>
                        <th rowspan='3' >ระดับความเสี่ยง(A Score)</th>
                        <th rowspan='2' colspan='2' >APPROVED</th>
                        <th rowspan='2' colspan='2' >REJECTED</th>
                        <th rowspan='2' colspan='2' >CANCELED</th>
                        <th rowspan='2' colspan='2' >INCOMPLETED</th>
                        <th rowspan='2' colspan='2' >PENDING</th>
                        <th rowspan='2' colspan='2' >อื่น ๆ</th>
                        <th rowspan='2' colspan='2' >รวมทั้งหมด</th>
                        <th colspan='4' >APPROVE ที่อนุมัติและเปิดบัญชี</th>
                    </tr>
                    <tr>
                        <th  colspan='2'>PL</th>
                        <th  colspan='2'>NPLs</th>
                    </tr>
                    <tr>
                        <th >ราย</th>
                        <th >ร้อยละ</th>
                        <th >ราย</th>
                        <th >ร้อยละ</th>
                        <th >ราย</th>
                        <th >ร้อยละ</th>
                        <th >ราย</th>
                        <th >ร้อยละ</th>
                        <th >ราย</th>
                        <th >ร้อยละ</th>
                        <th >ราย</th>
                        <th >ร้อยละ</th>
                        <th >ราย</th>
                        <th >ร้อยละ</th>
                        <th >ราย</th>
                        <th >ร้อยละ</th>
                        <th >ราย</th>
                        <th >ร้อยละ</th>
                    </tr>
                </thead>
            <tbody>";

$table3 = "<table >
            <thead >
                <tr>
                    <th rowspan='2' >ระดับความเสี่ยง(Grade)</th>
                    <th colspan='2' >ไม่ค้างชำระ</th>
                    <th colspan='2' >ค้างชำระ 1-30 วัน</th>
                    <th colspan='2' >ค้างชำระ 31-60 วัน</th>
                    <th colspan='2' >ค้างชำระ 61-90 วัน</th>
                    <th colspan='2' >ค้างชำระมากกว่า 90 วัน</th>
                    <th colspan='2' >รวม</th>
                </tr>
                <tr>
                    <th >จำนวนราย</th>
                    <th >ร้อยละ</th>
                    <th >จำนวนราย</th>
                    <th >ร้อยละ</th>
                    <th >จำนวนราย</th>
                    <th >ร้อยละ</th>
                    <th >จำนวนราย</th>
                    <th >ร้อยละ</th>
                    <th >จำนวนราย</th>
                    <th >ร้อยละ</th>
                    <th >จำนวนราย</th>
                    <th >ร้อยละ</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_GET['product_type'], $_GET['model_type'], $_GET['card_type'], $_GET['region_name'], $_GET['zone_name'], $_GET['branch_name'], $_GET['model_version'], $_GET['sales_channel'], $start_date, $end_date, $_GET['business_type'], $_GET['report_id']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);

switch ($_GET['report_id']) {
    case 'รายงานติดตามประเมินผลการใช้คะแนนเครดิต(Credit Bureau Score) ประกอบการพิจารณาอนุมัติบัตรเครดิตและสินเชื่อบัตรเงินสด':
        $table = $table1;
        while ($row = oci_fetch_array($query,OCI_BOTH)) {
            if(strtolower($row['BUREAU_SCORE']) == "total"){
                $table = $table."<tr>
                                    <td>" . $row['BUREAU_SCORE'] . "</td>
                                    <td >" . $row['PL_A'] . "</td>
                                    <td >" . $row['NPL_A'] . "</td>
                                    <td >" . $row['TOTAL_A'] . "</td>
                                    <td >" . $row['PL_B'] . "</td>
                                    <td >" . $row['NPL_B'] . "</td>
                                    <td >" . $row['TOTAL_B'] . "</td>
                                    <td >" . $row['PL_C'] . "</td>
                                    <td >" . $row['NPL_C'] . "</td>
                                    <td >" . $row['TOTAL_C'] . "</td>
                                    <td >" . $row['PL_D'] . "</td>
                                    <td >" . $row['NPL_D'] . "</td>
                                    <td >" . $row['TOTAL_D'] . "</td>
                                    <td >" . $row['TOTAL_PL'] . "</td>
                                    <td >" . $row['TOTAL_NPL'] . "</td>
                                    <td >" . $row['TOTAL_ALL'] . "</td>
                                </tr>";
            } else {
                $table = $table."<tr>
                                    <td>" . $row['BUREAU_SCORE'] . "</td>
                                    <td >" . $row['PL_A'] . "</td>
                                    <td >" . $row['NPL_A'] . "</td>
                                    <td >" . $row['TOTAL_A'] . "</td>
                                    <td >" . $row['PL_B'] . "</td>
                                    <td >" . $row['NPL_B'] . "</td>
                                    <td >" . $row['TOTAL_B'] . "</td>
                                    <td >" . $row['PL_C'] . "</td>
                                    <td >" . $row['NPL_C'] . "</td>
                                    <td >" . $row['TOTAL_C'] . "</td>
                                    <td >" . $row['PL_D'] . "</td>
                                    <td >" . $row['NPL_D'] . "</td>
                                    <td >" . $row['TOTAL_D'] . "</td>
                                    <td >" . $row['TOTAL_PL'] . "</td>
                                    <td >" . $row['TOTAL_NPL'] . "</td>
                                    <td >" . $row['TOTAL_ALL'] . "</td>
                            </tr>";
            }
        }
        break;
    case 'รายงานแสดงร้อยละของลูกค้าบัตรเครดิตสินเชื่อบัตรเงินสด แยกตามระดับความเสี่ยงและสถานะของลูกค้า':
        $table = $table2;
        while ($row = oci_fetch_array($query,OCI_BOTH)) {
            // echo $row['GRADE_DESC'];
            if(strtolower($row['GRADE_DESC']) == "total"){
                $table = $table."<tr>
                                    <td>" . $row['GRADE_DESC'] . "</td>
                                    <td >" . number_format($row['APPROVE_RPT2'], 0) . "</td>
                                    <td >" . number_format($row['PER_APPROVE_RPT2'], 2) . "</td>
                                    <td >" . number_format($row['REJECT_RPT2'], 0) . "</td>
                                    <td >" . number_format($row['PER_REJECT_RPT2'], 2) . "</td>
                                    <td >" . number_format($row['CANCEL_RPT2'], 0) . "</td>
                                    <td >" . number_format($row['PER_CANCEL_RPT2'], 2) . "</td>
                                    <td >" . number_format($row['INCOMPLETED'], 0) . "</td>
                                    <td >" . number_format($row['PER_INCOMPLETED'], 2) . "</td>
                                    <td >" . number_format($row['PENDING'], 0) . "</td>
                                    <td >" . number_format($row['PER_PENDING'], 2) . "</td>
                                    <td >" . number_format($row['OTHER'], 0) . "</td>
                                    <td >" . number_format($row['PER_OTHER'], 2) . "</td>
                                    <td >" . number_format($row['TOTAL_STATUS'], 0) . "</td>
                                    <td >" . number_format($row['PER_TOTAL_STATUS'], 2) . "</td>
                                    <td >" . number_format($row['PL'], 0) . "</td>
                                    <td >" . number_format($row['PER_PL'], 2) . "</td>
                                    <td >" . number_format($row['NPL'], 0) . "</td>
                                    <td >" . number_format($row['PER_NPL'], 2) . "</td>
                            </tr>";
            } else {
                $table = $table."<tr>
                                    <td>" . $row['GRADE_DESC'] . "</td>
                                    <td >" . number_format($row['APPROVE_RPT2'], 0) . "</td>
                                    <td >" . number_format($row['PER_APPROVE_RPT2'], 2) . "</td>
                                    <td >" . number_format($row['REJECT_RPT2'], 0) . "</td>
                                    <td >" . number_format($row['PER_REJECT_RPT2'], 2) . "</td>
                                    <td >" . number_format($row['CANCEL_RPT2'], 0) . "</td>
                                    <td >" . number_format($row['PER_CANCEL_RPT2'], 2) . "</td>
                                    <td >" . number_format($row['INCOMPLETED'], 0) . "</td>
                                    <td >" . number_format($row['PER_INCOMPLETED'], 2) . "</td>
                                    <td >" . number_format($row['PENDING'], 0) . "</td>
                                    <td >" . number_format($row['PER_PENDING'], 2) . "</td>
                                    <td >" . number_format($row['OTHER'], 0) . "</td>
                                    <td >" . number_format($row['PER_OTHER'], 2) . "</td>
                                    <td >" . number_format($row['TOTAL_STATUS'], 0) . "</td>
                                    <td >" . number_format($row['PER_TOTAL_STATUS'], 2) . "</td>
                                    <td >" . number_format($row['PL'], 0) . "</td>
                                    <td >" . number_format($row['PER_PL'], 2) . "</td>
                                    <td >" . number_format($row['NPL'], 0) . "</td>
                                    <td >" . number_format($row['PER_NPL'], 2) . "</td>
                            </tr>";
            }
        }
        break;
    case 'รายงานติดตามการชำระหนี้สำหรับลูกค้าบัตรเครดิต/สินเชื่อบัตรเงินสด แยกตามระดับความเสี่ยง(เกรด)':
        $table = $table3;
        while ($row = oci_fetch_array($query,OCI_BOTH)) {
            if(strtolower($row['GRADE_DESC']) == "total"){
                $table = $table."<tr>
                                    <td>" . $row['GRADE_DESC'] . "</td>
                                    <td >" . number_format($row['EVER0'], 0) . "</td>
                                    <td >" . number_format($row['PER_EVER0'], 2) . "</td>
                                    <td >" . number_format($row['EVER1_30'], 0) . "</td>
                                    <td >" . number_format($row['PER_EVER1_30'], 2) . "</td>
                                    <td >" . number_format($row['EVER31_60'], 0) . "</td>
                                    <td >" . number_format($row['PER_EVER31_60'], 2) . "</td>
                                    <td >" . number_format($row['EVER61_90'], 0) . "</td>
                                    <td >" . number_format($row['PER_EVER61_90'], 2) . "</td>
                                    <td >" . number_format($row['DELMORE_90'], 0) . "</td>
                                    <td >" . number_format($row['PER_EVER_MORE90'], 2) . "</td>
                                    <td >" . number_format($row['TOTAL_ACTIVE'], 0) . "</td>
                                    <td >" . number_format($row['PER_ACTIVE'], 2) . "</td>
                            </tr>";
            } else {
                $table = $table."<tr>
                                    <td>" . $row['GRADE_DESC'] . "</td>
                                    <td >" . number_format($row['EVER0'], 0) . "</td>
                                    <td >" . number_format($row['PER_EVER0'], 2) . "</td>
                                    <td >" . number_format($row['EVER1_30'], 0) . "</td>
                                    <td >" . number_format($row['PER_EVER1_30'], 2) . "</td>
                                    <td >" . number_format($row['EVER31_60'], 0) . "</td>
                                    <td >" . number_format($row['PER_EVER31_60'], 2) . "</td>
                                    <td >" . number_format($row['EVER61_90'], 0) . "</td>
                                    <td >" . number_format($row['PER_EVER61_90'], 2) . "</td>
                                    <td >" . number_format($row['DELMORE_90'], 0) . "</td>
                                    <td >" . number_format($row['PER_EVER_MORE90'], 2) . "</td>
                                    <td >" . number_format($row['TOTAL_ACTIVE'], 0) . "</td>
                                    <td >" . number_format($row['PER_ACTIVE'], 2) . "</td>
                            </tr>";
            }
        }
        break;      
    default:
        $table = $table1;
        break;
}

$table = $table. "</tbody></table>";

echo $table;
?>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>
