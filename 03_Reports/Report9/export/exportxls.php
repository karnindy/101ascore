<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("../database/connect.php");
// --------------------------
$FileNmae="Report9_XLS.xls";
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
$month=$_GET['month'];
$year=$_GET['year'];
$all_year=$_GET['all_year'];

require('sqlExport.php');
// echo  $sql;

$sql_all_year = get_all_year($_GET['product_type'], $_GET['model_type'], $_GET['card_type'], $_GET['model_version'], $_GET['sales_channel'], $_GET['region_name'], $_GET['zone_name'], $_GET['branch_name'], $_GET['month'], $_GET['year']);
$query_all_year = oci_parse($conn, $sql_all_year);
// echo $sql_all_year;
oci_execute($query_all_year,OCI_DEFAULT);

$numrows = oci_fetch_all($query_all_year, $res);
?>
<table>
<tr>
<td rowspan='2'>Approve Date</td>
<td rowspan='2'>Total Account</td>
<td colspan='<?php echo $numrows; ?>' scope='col'>Deliquency</td>
</tr>
<tr>
<?php
$all_year = "";
$array_all_year = array();
$count_all_year = 1;
// print_r($res["ALL_YEAR"]);
foreach ($res["ALL_YEAR"] as $row_all_year) {
    array_push($array_all_year, $row_all_year);
?>
<td><?php echo $row_all_year; ?></td>
<?php
    if($count_all_year == $numrows){
        $all_year = $all_year . "'" . $row_all_year . "'";
    } else {
        $all_year = $all_year . "'" . $row_all_year . "',";
    }
    $count_all_year++;
}
?></tr><?php
$sql = get_report_sql($_GET['product_type'], $_GET['model_type'], $_GET['card_type'], $_GET['region_name'], $_GET['zone_name'], $_GET['branch_name'], $_GET['model_version'], $_GET['sales_channel'], $_GET['month'], $_GET['year'], $all_year, $_GET['business_type']);
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 0;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
	$month = "'" . $array_all_year[$count] . "'";

		$s1=$array_all_year[$count];
		$s2=number_format($row['TOTAL_ACCOUNT'], 0);
		$s3=number_format($row[$month], 2);

?>
<tr>
<td><?php echo $s1; ?></td>
<td><?php echo $s2; ?></td>

<?php

    for ($i=0; $i < $numrows; $i++) {
        if($count == $i){
        	?><td><?php echo $s3; ?></td><?php
        } else {
            ?><td>0.00</td><?php
        }
        
    }
    ?></tr><?php
    $count++;
}
?>
</table>
</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>
