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

$sql_all_year = get_all_year($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['model_version'], $_POST['sales_channel'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['month'], $_POST['year']);
$query_all_year = oci_parse($conn, $sql_all_year);
// echo $sql_all_year;
oci_execute($query_all_year,OCI_DEFAULT);

$numrows = oci_fetch_all($query_all_year, $res);
$table = "<table class='table table-bordered'>
            <thead style='background-color:#feccff;'>
                <tr>
                    <th rowspan='2' scope='col' class='text-center align-middle' style='width:200px;'>Approve Date</th>
                    <th rowspan='2' scope='col' class='text-center align-middle'>Total Account</th>
                    <th colspan='".$numrows."' scope='col' class='text-center align-middle'>Deliquency</th>
                </tr>
                <tr>";
$all_year = "";
$array_all_year = array();
$count_all_year = 1;
// print_r($res["ALL_YEAR"]);
foreach ($res["ALL_YEAR"] as $row_all_year) {
    array_push($array_all_year, $row_all_year);
    $table = $table . "<th scope='col' class='text-center align-middle'>". $row_all_year ."</th>";
    if($count_all_year == $numrows){
        $all_year = $all_year . "'" . $row_all_year . "'";
    } else {
        $all_year = $all_year . "'" . $row_all_year . "',";
    }
    $count_all_year++;
}

$table = $table."</tr></thead><tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['month'], $_POST['year'], $all_year, $_POST['business_type']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 0;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    $month = "'" . $array_all_year[$count] . "'";
    $table = $table."<tr>
                        <td>" . $array_all_year[$count] . "</td>
                        <td class='text-right'>" . number_format($row['TOTAL_ACCOUNT'], 0) . "</td>";
    for ($i=0; $i < $numrows; $i++) {
        if($count == $i){
            $table = $table. "<td class='text-right' style='".(number_format($row[$month], 2) != '0.00' ? 'background-color: darkgray' : '')."'>" . number_format($row[$month], 2) . "</td>";
        } else {
            $table = $table. "<td class='text-right'>0.00</td>";
        }
    }
    $table = $table. "</tr>";
    $count++;
}

$table = $table. "</tbody></table>";

echo $table;
?>