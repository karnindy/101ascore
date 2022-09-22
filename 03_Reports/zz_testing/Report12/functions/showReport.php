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
                    <th rowspan='2' scope='col' class='text-center align-middle'>Grade Range</th>
                    <th colspan='2' scope='col' class='text-center align-middle'>Active account</th>
                    <th colspan='4' scope='col' class='text-center align-middle'>หนี้ที่ไม่ก่อรายได้ (NPLs)</th>
                    <th rowspan='2' scope='col' class='text-center align-middle'>% of Cumulative NPLs</th>
                </tr>
                <tr>
                    <th scope='col' class='text-center align-middle'>No. of Account</th>
                    <th scope='col' class='text-center align-middle'>Amount</th>
                    <th scope='col' class='text-center align-middle'>No. of Account</th>
                    <th scope='col' class='text-center align-middle'>% NPLs</th>
                    <th scope='col' class='text-center align-middle'>Amount</th>
                    <th scope='col' class='text-center align-middle'>%Amount</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['start_date'], $_POST['end_date'], $_POST['business_type']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if(strtolower($row['SCOREGRADE']) == "total"){
        $table = $table."<tr style='background-color:#feccff;font-weight: 700;'>
                            <td>" . $row['SCOREGRADE'] . "</td>
                            <td class='text-right'>" . $row['ACTIVE_ACCOUNT'] . "</td>
                            <td class='text-right'>" . $row['ACTIVE_AMOUNT'] . "</td>
                            <td class='text-right'>" . $row['NPLS_ACCOUNT'] . "</td>
                            <td class='text-right'>" . $row['PER_NPLS'] . "</td>
                            <td class='text-right'>" . $row['NCB_AMOUNT'] . "</td>
                            <td class='text-right'>" . $row['PER_NCB_AMOUNT'] . "</td>
                            <td class='text-right'>" . $row['PER_CUM_NPL'] . "</td>
                        </tr>";
    } else {
        $table = $table."<tr>
                        <td>" . $row['SCOREGRADE'] . "</td>
                        <td class='text-right'>" . $row['ACTIVE_ACCOUNT'] . "</td>
                            <td class='text-right'>" . $row['ACTIVE_AMOUNT'] . "</td>
                            <td class='text-right'>" . $row['NPLS_ACCOUNT'] . "</td>
                            <td class='text-right'>" . $row['PER_NPLS'] . "</td>
                            <td class='text-right'>" . $row['NCB_AMOUNT'] . "</td>
                            <td class='text-right'>" . $row['PER_NCB_AMOUNT'] . "</td>
                            <td class='text-right'>" . $row['PER_CUM_NPL'] . "</td>
                    </tr>";
    }
}

$table = $table. "</tbody></table>";

echo $table;
?>