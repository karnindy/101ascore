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
                    <th scope='col'>Score Range</th>
                    <th scope='col'>DEV</th>
                    <th scope='col'>% DEV</th>
                    <th scope='col'>Actual</th>
                    <th scope='col'>% Actual</th>
                    <th scope='col'>% Change</th>
                    <th scope='col'>Ratio</th>
                    <th scope='col'>WOE</th>
                    <th scope='col'>Index</th>
                    <th scope='col'>% Approve</th>
                    <th scope='col'>% Reject</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['start_date'], $_POST['end_date'], $_POST['business_type']);
//echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if(strtolower($row['SCORE_RANGE_DESC']) == "total"){
        $table = $table."<tr style='background-color:#feccff;font-weight: 700;'>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . number_format($row['DEV'], 0) . "</td>
                            <td class='text-right'>" . number_format($row['PER_DEV'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['ACTUAL'], 0) . "</td>
                            <td class='text-right'>" . number_format($row['PER_ACTUAL'], 2) . "</td>
                            <td class='text-right'>" . $row['PER_CHANGE'] . "</td>
                            <td class='text-right'>" . $row['RATIO'] . "</td>
                            <td class='text-right'>" . $row['WOE'] . "</td>
                            <td class='text-right'>" . $row['INDEX_'] . "</td>
                            <td class='text-right'>" . number_format($row['PER_APPROVE'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_REJECT'], 2) . "</td>
                        </tr>";
    } else {
        $table = $table."<tr>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . number_format($row['DEV'], 0) . "</td>
                            <td class='text-right'>" . number_format($row['PER_DEV'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['ACTUAL'], 0) . "</td>
                            <td class='text-right'>" . number_format($row['PER_ACTUAL'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_CHANGE'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['RATIO'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['WOE'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['INDEX_'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_APPROVE'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['PER_REJECT'], 2) . "</td>
                        </tr>";
    }

    $count++;
}

$table = $table. "</tbody></table>";

echo $table;
?>