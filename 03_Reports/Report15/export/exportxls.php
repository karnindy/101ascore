<?php
include("../database/connect.php");
// --------------------------
$FileNmae="Report15_XLS.xls";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");
// --------------------------

error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$model_version=$_GET['model_version'];
$sales_channel=$_GET['sales_channel'];
$business_type=$_GET['business_type'];
$region_name=$_GET['region_name'];
$zone_name=$_GET['zone_name'];
$branch_name=$_GET['branch_name'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$start_date="01-".$start_date;
$end_date="31-".$end_date;

require('sqlExport.php');
$table = "<table class='table table-bordered'>
            <thead >
                <tr>
                    <th scope='col' class='text-center align-middle'>Score Range</th>
                    <th scope='col' class='text-center align-middle'>NPLs (ราย)</th>
                    <th scope='col' class='text-center align-middle'>PL (ราย)</th>
                    <th scope='col' class='text-center align-middle'>%NPLs</th>
                    <th scope='col' class='text-center align-middle'>%PL</th>
                    <th scope='col' class='text-center align-middle'>Cum. %NPLs</th>
                    <th scope='col' class='text-center align-middle'>Cum. %PL</th>
                    <th scope='col' class='text-center align-middle'>KS</th>
                </tr>
            </thead>
            <tbody>";

// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    if(strtolower($row['SCORE_RANGE_DESC']) == "total"){
        $table = $table."<tr >
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . (($row['NPLS'] == "")? '' : number_format($row['NPLS'], 0)) . "</td>
                            <td class='text-right'>" . (($row['PL'] == "")? '' : number_format($row['PL'], 0)) . "</td>
                            <td class='text-right'>" . (($row['PER_NPLS'] == "")? '' : number_format($row['PER_NPLS'], 2)) . "</td>
                            <td class='text-right'>" . (($row['PER_PL'] == "")? '' : number_format($row['PER_PL'], 2)) . "</td>
                            <td class='text-right'>" . (($row['PER_NPLS_CUM'] == "")? '' : number_format($row['PER_NPLS_CUM'], 2)) . "</td>
                            <td class='text-right'>" . (($row['PER_PL_CUM'] == "")? '' : number_format($row['PER_PL_CUM'], 2)) . "</td>
                            <td class='text-right'>" . (($row['KS'] == "")? '' : number_format($row['KS'], 2)) . "</td>
                        </tr>";
    } else {
        $table = $table."<tr>
                            <td>" . $row['SCORE_RANGE_DESC'] . "</td>
                            <td class='text-right'>" . (($row['NPLS'] == "")? '' : number_format($row['NPLS'], 0)) . "</td>
                            <td class='text-right'>" . (($row['PL'] == "")? '' : number_format($row['PL'], 0)) . "</td>
                            <td class='text-right'>" . (($row['PER_NPLS'] == "")? '' : number_format($row['PER_NPLS'], 2)) . "</td>
                            <td class='text-right'>" . (($row['PER_PL'] == "")? '' : number_format($row['PER_PL'], 2)) . "</td>
                            <td class='text-right'>" . (($row['PER_NPLS_CUM'] == "")? '' : number_format($row['PER_NPLS_CUM'], 2)) . "</td>
                            <td class='text-right'>" . (($row['PER_PL_CUM'] == "")? '' : number_format($row['PER_PL_CUM'], 2)) . "</td>
                            <td class='text-right'>" . (($row['KS'] == "")? '' : number_format($row['KS'], 2)) . "</td>
                    </tr>";
    }
}

$table = $table. "</tbody></table>";

echo $table;
?>

<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
