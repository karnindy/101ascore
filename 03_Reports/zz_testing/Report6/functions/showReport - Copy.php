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
            <thead style='background-color:#feccff;'>
                <tr>
                    <th rowspan='2' scope='col' class='text-center align-middle' style='width:350px;'>Category</th>
                    <th colspan='2' scope='col' class='text-center align-middle'>Past 3 Months</th>
                    <th colspan='2' scope='col' class='text-center align-middle'>Past 6 Months</th>
                    <th colspan='2' scope='col' class='text-center align-middle'>Past 12 Months</th>
                </tr>
                <tr>
                    <th scope='col' class='text-center align-middle'>Number of Loans</th>
                    <th scope='col' class='text-center align-middle'>% of Total Overrides</th>
                    <th scope='col' class='text-center align-middle'>Number of Loans</th>
                    <th scope='col' class='text-center align-middle'>% of Total Overrides</th>
                    <th scope='col' class='text-center align-middle'>Number of Loans</th>
                    <th scope='col' class='text-center align-middle'>% of Total Overrides</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['month'], $_POST['year'], $_POST['business_type']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    $table = $table."<tr>
                    <td>" . $row['CATEGORY'] . "</td>
                    <td class='text-right' style='".(number_format($row['TOTAL_ACTUAL_3M'], 0) != '0' ? 'background-color: darkgray' : '') ."'>" . number_format($row['TOTAL_ACTUAL_3M'], 0) . "</td>
                    <td class='text-right' style='".(number_format($row['OPER_OVERRIDE_3M'], 2) != '0.00' ? 'background-color: darkgray' : '') ."'>" . number_format($row['OPER_OVERRIDE_3M'], 2) . "</td>
                    <td class='text-right' style='".(number_format($row['TOTAL_ACTUAL_6M'], 0) != '0' ? 'background-color: darkgray' : '') ."'>" . number_format($row['TOTAL_ACTUAL_6M'], 0) . "</td>
                    <td class='text-right' style='".(number_format($row['PER_OVERRIDE_6M'], 2) != '0.00' ? 'background-color: darkgray' : '') ."'>" . number_format($row['PER_OVERRIDE_6M'], 2) . "</td>
                    <td class='text-right' style='".(number_format($row['TOTAL_ACTUAL_12M'], 0) != '0' ? 'background-color: darkgray' : '') ."'>" . number_format($row['TOTAL_ACTUAL_12M'], 0) . "</td>
                    <td class='text-right' style='".(number_format($row['PER_OVERRIDE_12M'], 2) != '0.00' ? 'background-color: darkgray' : '') ."'>" . number_format($row['PER_OVERRIDE_12M'], 2) . "</td>
                </tr>";
    
}

$table = $table. "</tbody></table>";

echo $table;
?>