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
                    <th scope='col' class='text-center align-middle' style='width:200px;'>Early Performance</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>Bad: Ever 1-30</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>Bad: Ever 31-60</th>
                    <th colspan='3' scope='col' class='text-center align-middle'>Bad: Ever 61-90</th>
                </tr>
                <tr>
                    <th scope='col' class='text-center align-middle'>Score Range</th>
                    <th scope='col' class='text-center align-middle'>Past 3 Months</th>
                    <th scope='col' class='text-center align-middle'>Past 12 Months</th>
                    <th scope='col' class='text-center align-middle'>Year ago 12 Months</th>
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
//echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if(preg_match("/Total/i", $row['SCORE_RANGE_DESC'])){
        $table = $table."<tr style='background-color:#feccff;'>
                    <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                    <td class='text-right'>" . number_format($row['BAD1_30PAST3MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD1_30PAST12MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD1_30PASTMORE12'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD31_60PAST3MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD31_60PAST12MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD31_60PASTMORE12'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD61_90PAST3MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD61_90PAST12MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD61_90PASTMORE12'], 2) . "</td>
                </tr>";
    } else if(preg_match("/Average Bad Rate/i", $row['SCORE_RANGE_DESC'])){
        $table = $table."<tr>
                    <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                    <td class='text-right'>" . number_format($row['BAD1_30PAST3MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD1_30PAST12MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD1_30PASTMORE12'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD31_60PAST3MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD31_60PAST12MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD31_60PASTMORE12'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD61_90PAST3MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD61_90PAST12MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD61_90PASTMORE12'], 2) . "</td>
                </tr>";
    } else {
        $table = $table."<tr>
                    <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                    <td class='text-right'>" . number_format($row['BAD1_30PAST3MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD1_30PAST12MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD1_30PASTMORE12'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD31_60PAST3MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD31_60PAST12MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD31_60PASTMORE12'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD61_90PAST3MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD61_90PAST12MONTHS'], 2) . "</td>
                    <td class='text-right'>" . number_format($row['BAD61_90PASTMORE12'], 2) . "</td>
                </tr>";
    }
    
}

$table = $table. "</tbody></table>";

echo $table;
?>