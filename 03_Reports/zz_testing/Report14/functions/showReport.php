<div align="right">
        <input type="button" class="btn btn-outline-dark" onclick="export_txt()" value="export TXT">
        <input type="button" class="btn btn-outline-secondary" onclick="export_csv()" value="export CSV">
        <input type="button" class="btn btn-outline-success" onclick="export_xls()" value="export XLS">
        <input type="button" class="btn btn-outline-danger" onclick="export_pdf()" value="export PDF">
        <br><br>
</div>
<?php
include("../database/connect.php");
include("SQLReportClass.php");
error_reporting(E_ERROR | E_PARSE);

$table1 = "<table class='table table-bordered'>
            <thead style='background-color:#feccff'>
                <tr>
                    <th rowspan='2' scope='col' class='text-center align-middle'>BUREAU SCORE</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>ความเสี่ยงต่ำ(A)</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>ความเสี่ยงปานกลาง(B)</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>ความเสี่ยงค่อนข้างสูง(C)</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>ความเสี่ยงสูง(D)</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>รวม</th>
                </tr>
                <tr>
                    <th scope='col' class='text-center align-middle'>PL</th>
                    <th scope='col' class='text-center align-middle'>NPLs</th>
                    <th scope='col' class='text-center align-middle'>รวม</th>
                    <th scope='col' class='text-center align-middle'>PL</th>
                    <th scope='col' class='text-center align-middle'>NPLs</th>
                    <th scope='col' class='text-center align-middle'>รวม</th>
                    <th scope='col' class='text-center align-middle'>PL</th>
                    <th scope='col' class='text-center align-middle'>NPLs</th>
                    <th scope='col' class='text-center align-middle'>รวม</th>
                    <th scope='col' class='text-center align-middle'>PL</th>
                    <th scope='col' class='text-center align-middle'>NPLs</th>
                    <th scope='col' class='text-center align-middle'>รวม</th>
                    <th scope='col' class='text-center align-middle'>PL</th>
                    <th scope='col' class='text-center align-middle'>NPLs</th>
                    <th scope='col' class='text-center align-middle'>รวม</th>
                </tr>
            </thead>
            <tbody>";

$table2 = "<table class='table table-bordered'>
                <thead style='background-color:#feccff'>
                    <tr>
                        <th rowspan='3' scope='col' class='text-center align-middle'>ระดับความเสี่ยง(A Score)</th>
                        <th rowspan='2' colspan='2' scope='col' class='text-center align-middle'>APPROVED</th>
                        <th rowspan='2' colspan='2' scope='col' class='text-center align-middle'>REJECTED</th>
                        <th rowspan='2' colspan='2' scope='col' class='text-center align-middle'>CANCELED</th>
                        <th rowspan='2' colspan='2' scope='col' class='text-center align-middle'>INCOMPLETED</th>
                        <th rowspan='2' colspan='2' scope='col' class='text-center align-middle'>PENDING</th>
                        <th rowspan='2' colspan='2' scope='col' class='text-center align-middle'>อื่น ๆ</th>
                        <th rowspan='2' colspan='2' scope='col' class='text-center align-middle'>รวมทั้งหมด</th>
                        <th colspan='4' scope='col' class='text-center align-middle'>APPROVE ที่อนุมัติและเปิดบัญชี</th>
                    </tr>
                    <tr>
                        <th scope='col' colspan='2' class='text-center align-middle'>PL</th>
                        <th scope='col' colspan='2' class='text-center align-middle'>NPLs</th>
                    </tr>
                    <tr>
                        <th scope='col' class='text-center align-middle'>ราย</th>
                        <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                        <th scope='col' class='text-center align-middle'>ราย</th>
                        <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                        <th scope='col' class='text-center align-middle'>ราย</th>
                        <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                        <th scope='col' class='text-center align-middle'>ราย</th>
                        <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                        <th scope='col' class='text-center align-middle'>ราย</th>
                        <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                        <th scope='col' class='text-center align-middle'>ราย</th>
                        <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                        <th scope='col' class='text-center align-middle'>ราย</th>
                        <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                        <th scope='col' class='text-center align-middle'>ราย</th>
                        <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                        <th scope='col' class='text-center align-middle'>ราย</th>
                        <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                    </tr>
                </thead>
            <tbody>";

$table3 = "<table class='table table-bordered'>
            <thead style='background-color:#feccff'>
                <tr>
                    <th rowspan='2' scope='col' class='text-center align-middle'>ระดับความเสี่ยง(Grade)</th>
                    <th colspan='2' scope='col' class='text-center align-middle'>ไม่ค้างชำระ</th>
                    <th colspan='2' scope='col' class='text-center align-middle'>ค้างชำระ 1-30 วัน</th>
                    <th colspan='2' scope='col' class='text-center align-middle'>ค้างชำระ 31-60 วัน</th>
                    <th colspan='2' scope='col' class='text-center align-middle'>ค้างชำระ 61-90 วัน</th>
                    <th colspan='2' scope='col' class='text-center align-middle'>ค้างชำระมากกว่า 90 วัน</th>
                    <th colspan='2' scope='col' class='text-center align-middle'>รวม</th>
                </tr>
                <tr>
                    <th scope='col' class='text-center align-middle'>จำนวนราย</th>
                    <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                    <th scope='col' class='text-center align-middle'>จำนวนราย</th>
                    <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                    <th scope='col' class='text-center align-middle'>จำนวนราย</th>
                    <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                    <th scope='col' class='text-center align-middle'>จำนวนราย</th>
                    <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                    <th scope='col' class='text-center align-middle'>จำนวนราย</th>
                    <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                    <th scope='col' class='text-center align-middle'>จำนวนราย</th>
                    <th scope='col' class='text-center align-middle'>ร้อยละ</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['start_date'], $_POST['end_date'], $_POST['business_type'], $_POST['report_id']);
//echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);

switch ($_POST['report_id']) {
    case 'รายงานติดตามประเมินผลการใช้คะแนนเครดิต(Credit Bureau Score) ประกอบการพิจารณาอนุมัติบัตรเครดิตและสินเชื่อบัตรเงินสด':
        $table = $table1;
        while ($row = oci_fetch_array($query,OCI_BOTH)) {
            if(strtolower($row['BUREAU_SCORE']) == "total"){
                $table = $table."<tr style='background-color:#feccff;font-weight: 700;'>
                                    <td>" . $row['BUREAU_SCORE'] . "</td>
                                    <td class='text-right'>" . $row['PL_A'] . "</td>
                                    <td class='text-right'>" . $row['NPL_A'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_A'] . "</td>
                                    <td class='text-right'>" . $row['PL_B'] . "</td>
                                    <td class='text-right'>" . $row['NPL_B'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_B'] . "</td>
                                    <td class='text-right'>" . $row['PL_C'] . "</td>
                                    <td class='text-right'>" . $row['NPL_C'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_C'] . "</td>
                                    <td class='text-right'>" . $row['PL_D'] . "</td>
                                    <td class='text-right'>" . $row['NPL_D'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_D'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_PL'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_NPL'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_ALL'] . "</td>
                                </tr>";
            } else {
                $table = $table."<tr>
                                    <td>" . $row['BUREAU_SCORE'] . "</td>
                                    <td class='text-right'>" . $row['PL_A'] . "</td>
                                    <td class='text-right'>" . $row['NPL_A'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_A'] . "</td>
                                    <td class='text-right'>" . $row['PL_B'] . "</td>
                                    <td class='text-right'>" . $row['NPL_B'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_B'] . "</td>
                                    <td class='text-right'>" . $row['PL_C'] . "</td>
                                    <td class='text-right'>" . $row['NPL_C'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_C'] . "</td>
                                    <td class='text-right'>" . $row['PL_D'] . "</td>
                                    <td class='text-right'>" . $row['NPL_D'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_D'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_PL'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_NPL'] . "</td>
                                    <td class='text-right'>" . $row['TOTAL_ALL'] . "</td>
                            </tr>";
            }
        }
        break;
    case 'รายงานแสดงร้อยละของลูกค้าบัตรเครดิตสินเชื่อบัตรเงินสด แยกตามระดับความเสี่ยงและสถานะของลูกค้า':
        $table = $table2;
        while ($row = oci_fetch_array($query,OCI_BOTH)) {
            // echo $row['GRADE_DESC'];
            if(strtolower($row['GRADE_DESC']) == "total"){
                $table = $table."<tr style='background-color:#feccff;font-weight: 700;'>
                                    <td>" . $row['GRADE_DESC'] . "</td>
                                    <td class='text-right'>" . number_format($row['APPROVE_RPT2'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_APPROVE_RPT2'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['REJECT_RPT2'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_REJECT_RPT2'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['CANCEL_RPT2'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_CANCEL_RPT2'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['INCOMPLETED'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_INCOMPLETED'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['PENDING'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_PENDING'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['OTHER'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_OTHER'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['TOTAL_STATUS'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_TOTAL_STATUS'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['PL'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_PL'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['NPL'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_NPL'], 2) . "</td>
                            </tr>";
            } else {
                $table = $table."<tr>
                                    <td>" . $row['GRADE_DESC'] . "</td>
                                    <td class='text-right'>" . number_format($row['APPROVE_RPT2'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_APPROVE_RPT2'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['REJECT_RPT2'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_REJECT_RPT2'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['CANCEL_RPT2'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_CANCEL_RPT2'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['INCOMPLETED'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_INCOMPLETED'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['PENDING'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_PENDING'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['OTHER'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_OTHER'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['TOTAL_STATUS'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_TOTAL_STATUS'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['PL'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_PL'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['NPL'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_NPL'], 2) . "</td>
                            </tr>";
            }
        }
        break;
    case 'รายงานติดตามการชำระหนี้สำหรับลูกค้าบัตรเครดิต/สินเชื่อบัตรเงินสด แยกตามระดับความเสี่ยง(เกรด)':
        $table = $table3;
        while ($row = oci_fetch_array($query,OCI_BOTH)) {
            if(strtolower($row['GRADE_DESC']) == "total"){
                $table = $table."<tr style='background-color:#feccff;font-weight: 700;'>
                                    <td>" . $row['GRADE_DESC'] . "</td>
                                    <td class='text-right'>" . number_format($row['EVER0'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_EVER0'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['EVER1_30'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_EVER1_30'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['EVER31_60'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_EVER31_60'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['EVER61_90'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_EVER61_90'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['DELMORE_90'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_EVER_MORE90'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['TOTAL_ACTIVE'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_ACTIVE'], 2) . "</td>
                            </tr>";
            } else {
                $table = $table."<tr>
                                    <td>" . $row['GRADE_DESC'] . "</td>
                                    <td class='text-right'>" . number_format($row['EVER0'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_EVER0'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['EVER1_30'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_EVER1_30'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['EVER31_60'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_EVER31_60'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['EVER61_90'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_EVER61_90'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['DELMORE_90'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_EVER_MORE90'], 2) . "</td>
                                    <td class='text-right'>" . number_format($row['TOTAL_ACTIVE'], 0) . "</td>
                                    <td class='text-right'>" . number_format($row['PER_ACTIVE'], 2) . "</td>
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