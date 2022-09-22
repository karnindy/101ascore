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

$table = "<table class='table table-bordered'>
            <thead style='background-color:#feccff'>
                <tr>
                    <th scope='col' class='text-center'>Score Range</th>
                    <th scope='col' class='text-center'>% Accepted Accounts</th>
                    <th scope='col' class='text-center'>% Active Accounts</th>
                    <th scope='col' class='text-center'>% Current 1-30 Days</th>
                    <th scope='col' class='text-center'>% Current 31-60 Days</th>
                    <th scope='col' class='text-center'>% Current 61-90 Days</th>
                    <th scope='col' class='text-center'>% Current More 90 Days</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['start_mm'], $_POST['start_yyyy'], $_POST['end_mm'], $_POST['end_yyyy'], $_POST['business_type']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if(strtolower($row['SCORE_RANGE_DESC']) == "total"){
        $table = $table."<tr style='background-color:#feccff;font-weight: 700;'>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . number_format($row['PER_ACCEPT_ACCT'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_ACTIVE_ACCT'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_CURRENT_1_30'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_CURRENT_31_60'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_CURRENT_61_90'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_CURRENT_MORE_90'], 2) . "</td>
                        </tr>";
    } else {
        $table = $table."<tr>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . number_format($row['PER_ACCEPT_ACCT'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_ACTIVE_ACCT'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_CURRENT_1_30'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_CURRENT_31_60'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_CURRENT_61_90'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_CURRENT_MORE_90'], 2) . "</td>
                        </tr>";
    }

    $count++;
}

$table = $table. "</tbody></table>";

echo $table;
?>