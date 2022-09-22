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
                    <th scope='col' class='text-center align-middle'>". $_POST['factors'] ."</th>
                    <th scope='col' class='text-center align-middle'>DEV</th>
                    <th scope='col' class='text-center align-middle'>%DEV</th>
                    <th scope='col' class='text-center align-middle'>Actual</th>
                    <th scope='col' class='text-center align-middle'>%Actual</th>
                    <th scope='col' class='text-center align-middle'>Change</th>
                    <th scope='col' class='text-center align-middle'>Point</th>
                    <th scope='col' class='text-center align-middle'>Point Diff</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['start_date'], $_POST['end_date'], $_POST['factors'], $_POST['business_type']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if($row['ATTIBUTE'] == "Total"){
        $table = $table."<tr style='background-color:#feccff;font-weight: 700;'>
                            <td>" . $row['ATTIBUTE'] . "</td>
                            <td class='text-right'>" . number_format($row['DEV'], 0) . "</td>
                            <td class='text-right'>" . number_format($row['PER_DEV'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['ACTUAL'], 0) . "</td>
                            <td class='text-right'>" . number_format($row['PER_ACTUAL'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['CHANGE'], 2) . "</td>
						    <td class='text-right'>" . $row['POINT'] . "</td>
							<td class='text-right'>" . $row['POINT_DIFF'] . "</td>
                        </tr>";
    } else {
        $table = $table."<tr style='font-weight: 700;'>
                            <td>" . $row['ATTIBUTE'] . "</td>
                            <td class='text-right'>" . number_format($row['DEV'], 0) . "</td>
                            <td class='text-right'>" . number_format($row['PER_DEV'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['ACTUAL'], 0) . "</td>
                            <td class='text-right'>" . number_format($row['PER_ACTUAL'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['CHANGE'], 2) . "</td>
                            <td class='text-right'>" . number_format($row['POINT'], 0) . "</td>
                            <td class='text-right'>" . number_format($row['POINT_DIFF'], 2) . "</td>
                        </tr>";
    }
    
}

$table = $table. "</tbody></table>";

echo $table;
?>