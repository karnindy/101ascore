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
                    <th rowspan='2' scope='col' class='text-center align-middle' style='width:200px;'>Category</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>As % of Applications in Range</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>As % of Approved</th>
                </tr>
                <tr>
                    <th scope='col' class='text-center align-middle'>Past 3 Months</th>
                    <th scope='col' class='text-center align-middle'>Past 12 Months</th>
                    <th scope='col' class='text-center align-middle'>Year ago 12 Months</th>
                    <th scope='col' class='text-center align-middle'>Past 3 Months</th>
                    <th scope='col' class='text-center align-middle'>Past 12 Months</th>
                    <th scope='col' class='text-center align-middle'>Year ago 12 Months</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['month'], $_POST['year'], $_POST['business_type']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if(preg_match("/%/i", $row['CATEGORY'])){
        $table = $table."<tr>
                    <td>" . $row['CATEGORY'] . "</td>
                    <td class='text-right'>" . $row['APP_IN_RANGE_3M'] . "</td>
                    <td class='text-right'>" . $row['APP_IN_RANGE_12M'] . "</td>
                    <td class='text-right'>" . $row['APP_IN_RANGE_MORE12M'] . "</td>
                    <td class='text-right'>" . $row['APPROVAL_3M'] . "</td>
                    <td class='text-right'>" . $row['APPROVAL_12M'] . "</td>
                    <td class='text-right'>" . $row['APPROVAL_MORE12M'] . "</td>
                </tr>";
    } else {
        $table = $table."<tr>
                    <td>" . $row['CATEGORY'] . "</td>
                    <td class='text-right'>" . $row['APP_IN_RANGE_3M'] . "</td>
                    <td class='text-right'>" . $row['APP_IN_RANGE_12M'] . "</td>
                    <td class='text-right'>" . $row['APP_IN_RANGE_MORE12M'] . "</td>
                    <td class='text-right'>" . $row['APPROVAL_3M'] . "</td>
                    <td class='text-right'>" . $row['APPROVAL_12M'] . "</td>
                    <td class='text-right'>" . $row['APPROVAL_MORE12M'] . "</td>
                </tr>";
    }
    
}

$table = $table. "</tbody></table>";

echo $table;
?>