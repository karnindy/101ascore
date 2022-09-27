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
                    <th rowspan='2' scope='col' class='text-center align-middle' style='width:200px;'>Score Range</th>
                    <th colspan='4' scope='col' class='text-center align-middle'>Current Validation Sample(%)</th>
                    <th colspan='4' scope='col' class='text-center align-middle'>Development Sample(%)</th>
                    
                </tr>
                <tr>
                    <th scope='col' class='text-center align-middle'>% Cum_G</th>
                    <th scope='col' class='text-center align-middle'>% Cum_B</th>
                    <th scope='col' class='text-center align-middle'>Sep_BG</th>
                    <th scope='col' class='text-center align-middle'>% BadRate(Current)</th>
                    <th scope='col' class='text-center align-middle'>% Cum_G</th>
                    <th scope='col' class='text-center align-middle'>% Cum_B</th>
                    <th scope='col' class='text-center align-middle'>Sep_BG</th>
                    <th scope='col' class='text-center align-middle'>% BadRate(Dev)</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['month'], $_POST['year'], $_POST['business_type']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if(preg_match("/Total/i", $row['SCORE_RANGE_DESC'])){
        $table = $table."<tr style='background-color:#feccff;'>
                    <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                    <td class='text-right'>" . (($row['PER_CUM_G_CURR'] == "")? '' : number_format($row['PER_CUM_G_CURR'], 2)) . "</td>
                    <td class='text-right'>" . (($row['PER_CUM_B_CURR'] == "")? '' : number_format($row['PER_CUM_B_CURR'], 2)) . "</td>
                    <td class='text-right'>" . (($row['SEP_BG_CURR'] == "")? '' : number_format($row['SEP_BG_CURR'], 2)) . "</td>
                    <td class='text-right'>" . (($row['PER_BAD_RATE_CURR'] == "")? '' : number_format($row['PER_BAD_RATE_CURR'], 2)) . "</td>
                    <td class='text-right'>" . (($row['PER_GOOD_DEV'] == "")? '' : number_format($row['PER_GOOD_DEV'], 2)) . "</td>
                    <td class='text-right'>" . (($row['PER_BAD_DEV'] == "")? '' : number_format($row['PER_BAD_DEV'], 2)) . "</td>
                    <td class='text-right'>" . (($row['SEP_BG_DEV'] == "")? '' : number_format($row['SEP_BG_DEV'], 2)) . "</td>
                    <td class='text-right'>" . (($row['PER_BAD_RATE_DEV'] == "")? '' : number_format($row['PER_BAD_RATE_DEV'], 2)) . "</td>
                </tr>";
    } else {
        $table = $table."<tr>
                    <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                    <td class='text-right'>" . (($row['PER_CUM_G_CURR'] == "")? '' : number_format($row['PER_CUM_G_CURR'], 2)) . "</td>
                    <td class='text-right'>" . (($row['PER_CUM_B_CURR'] == "")? '' : number_format($row['PER_CUM_B_CURR'], 2)) . "</td>
                    <td class='text-right'>" . (($row['SEP_BG_CURR'] == "")? '' : number_format($row['SEP_BG_CURR'], 2)) . "</td>
                    <td class='text-right'>" . (($row['PER_BAD_RATE_CURR'] == "")? '' : number_format($row['PER_BAD_RATE_CURR'], 2)) . "</td>
                    <td class='text-right'>" . (($row['PER_GOOD_DEV'] == "")? '' : number_format($row['PER_GOOD_DEV'], 2)) . "</td>
                    <td class='text-right'>" . (($row['PER_BAD_DEV'] == "")? '' : number_format($row['PER_BAD_DEV'], 2)) . "</td>
                    <td class='text-right'>" . (($row['SEP_BG_DEV'] == "")? '' : number_format($row['SEP_BG_DEV'], 2)) . "</td>
                    <td class='text-right'>" . (($row['PER_BAD_RATE_DEV'] == "")? '' : number_format($row['PER_BAD_RATE_DEV'], 2)) . "</td>
                </tr>";
    }
    
}

$table = $table. "</tbody></table>";

echo $table;
?>