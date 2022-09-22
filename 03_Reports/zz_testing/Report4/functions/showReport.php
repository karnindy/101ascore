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
                    <th class='text-center' scope='col'>Score Range</th>
                    <th class='text-center' scope='col'>Approve</th>
                    <th class='text-center' scope='col'>Reject</th>
                    <th class='text-center' scope='col'>Total</th>
                    <th class='text-center' scope='col'>Approve %</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['start_date'], $_POST['end_date'], $_POST['business_type']);
 // echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if(strtolower($row['SCORE_RANGE_DESC']) == "total"){
        $table = $table."<tr style='background-color:#feccff;font-weight: 700;'>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . (($row['APPROVE'] == "")? '' : $row['APPROVE']) . "</td>
                            <td class='text-right'>" . (($row['REJECT'] == "")? '' : $row['REJECT']) . "</td>
                            <td class='text-right'>" . (($row['TOTAL'] == "")? '' : $row['TOTAL']) . "</td>
                            <td class='text-right'>" . (($row['PER_APPROVE'] == "")? '' : $row['PER_APPROVE']) . "</td>
                        </tr>";
    } else if(preg_match("/Overrides %/i", $row['SCORE_RANGE_DESC']) || preg_match("/Rate/i", $row['SCORE_RANGE_DESC'])) {
        $table = $table."<tr>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . (($row['APPROVE'] == "")? '' :$row['APPROVE']) . "</td>
                            <td class='text-right'>" . (($row['REJECT'] == "")? '' :$row['REJECT']) . "</td>
                            <td class='text-right'>" . (($row['TOTAL'] == "")? '' :$row['TOTAL']) . "</td>
                            <td class='text-right'>" . (($row['PER_APPROVE'] == "")? '' :$row['PER_APPROVE']) . "</td>
                        </tr>";
    } else {
        $table = $table."<tr>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . (($row['APPROVE'] == "")? '' : $row['APPROVE']) . "</td>
                            <td class='text-right'>" . (($row['REJECT'] == "")? '' : $row['REJECT'])  . "</td>
                            <td class='text-right'>" . (($row['TOTAL'] == "")? '' : $row['TOTAL']) . "</td>
                            <td class='text-right'>" . (($row['PER_APPROVE'] == "")? '' : $row['PER_APPROVE']) . "</td>
                        </tr>";
    }

    $count++;
}

$table = $table. "</tbody></table>";

echo $table;
?>