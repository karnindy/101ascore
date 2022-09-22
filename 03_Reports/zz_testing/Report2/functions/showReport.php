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
                    <th colspan='3' scope='col' class='text-center align-middle'>Through-the-door Population</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>Withdraw as % TTD in range</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>Approve as % decisioned in range</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>Other as % TTD in range</th>
                </tr>
                <tr>
                    <th scope='col' class='text-center align-middle'>Past 3 Months</th>
                    <th scope='col' class='text-center align-middle'>Past 12 Months</th>
                    <th scope='col' class='text-center align-middle'>Year ago 12 months</th>
                    <th scope='col' class='text-center align-middle'>% Past 3 Months</th>
                    <th scope='col' class='text-center align-middle'>% Past 12 Months</th>
                    <th scope='col' class='text-center align-middle'>% Year ago 12 months</th>
                    <th scope='col' class='text-center align-middle'>% Past 3 Months</th>
                    <th scope='col' class='text-center align-middle'>% Past 12 Months</th>
                    <th scope='col' class='text-center align-middle'>% Year ago 12 months</th>
                    <th scope='col' class='text-center align-middle'>% Past 3 Months</th>
                    <th scope='col' class='text-center align-middle'>% Past 12 Months</th>
                    <th scope='col' class='text-center align-middle'>% Year ago 12 months</th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['month'], $_POST['year'], $_POST['business_type']);
//echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if($row['SCORE_RANGE_DESC'] =='No. of Loans'){
        $table = $table."<tr style='background-color:#feccff;'>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . $row['ACTUAL_3M'] . "</td>
                            <td class='text-right'>" . $row['ACTUAL_12M'] . "</td>
                            <td class='text-right'>" . $row['ACTUAL_MORE12M'] . "</td>
                            <td class='text-right'>" . $row['REJECT_3M'] . "</td>
                            <td class='text-right'>" . $row['REJECT_12M'] . "</td>
                            <td class='text-right'>" . $row['REJECT_MORE12M'] . "</td>							
                            <td class='text-right'>" . $row['APPROVE_3M'] . "</td>
                            <td class='text-right'>" . $row['APPROVE_12M'] . "</td>
                            <td class='text-right'>" . $row['APPROVE_MORE12M'] . "</td>
                            <td class='text-right'>" . $row['OTHER_3M'] . "</td>
                            <td class='text-right'>" . $row['OTHER_12M'] . "</td>
                            <td class='text-right'>" . $row['OTHER_MORE12M'] . "</td>
                        </tr>";
    } else if(preg_match("/Avg/i", $row['SCORE_RANGE_DESC']) || preg_match("/%/i", $row['SCORE_RANGE_DESC'])) {
        $table = $table."<tr>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . $row['ACTUAL_3M'] . "</td>
                            <td class='text-right'>" . $row['ACTUAL_12M'] . "</td>
                            <td class='text-right'>" . $row['ACTUAL_MORE12M'] . "</td>
                            <td class='text-right'>" . $row['REJECT_3M'] . "</td>
                            <td class='text-right'>" . $row['REJECT_12M'] . "</td>
                            <td class='text-right'>" . $row['REJECT_MORE12M'] . "</td>							
                            <td class='text-right'>" . $row['APPROVE_3M'] . "</td>
                            <td class='text-right'>" . $row['APPROVE_12M'] . "</td>
                            <td class='text-right'>" . $row['APPROVE_MORE12M'] . "</td>
                            <td class='text-right'>" . $row['OTHER_3M'] . "</td>
                            <td class='text-right'>" . $row['OTHER_12M'] . "</td>
                            <td class='text-right'>" . $row['OTHER_MORE12M'] . "</td>
                        </tr>";
    } else {
        $table = $table."<tr>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . $row['ACTUAL_3M'] . "</td>
                            <td class='text-right'>" . $row['ACTUAL_12M'] . "</td>
                            <td class='text-right'>" . $row['ACTUAL_MORE12M'] . "</td>
                            <td class='text-right'>" . $row['REJECT_3M'] . "</td>
                            <td class='text-right'>" . $row['REJECT_12M'] . "</td>
                            <td class='text-right'>" . $row['REJECT_MORE12M'] . "</td>							
                            <td class='text-right'>" . $row['APPROVE_3M'] . "</td>
                            <td class='text-right'>" . $row['APPROVE_12M'] . "</td>
                            <td class='text-right'>" . $row['APPROVE_MORE12M'] . "</td>
                            <td class='text-right'>" . $row['OTHER_3M'] . "</td>
                            <td class='text-right'>" . $row['OTHER_12M'] . "</td>
                            <td class='text-right'>" . $row['OTHER_MORE12M'] . "</td>
                        </tr>";
    }
    
}

$table = $table. "</tbody></table>";

echo $table;
?>