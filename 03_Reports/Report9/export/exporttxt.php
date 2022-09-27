<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report9_TXT.txt";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");


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
$file = fopen("csv/".$FileNmae, "w");

$sql_all_year = get_all_year($_GET['product_type'], $_GET['model_type'], $_GET['card_type'], $_GET['model_version'], $_GET['sales_channel'], $_GET['region_name'], $_GET['zone_name'], $_GET['branch_name'], $_GET['month'], $_GET['year']);
$query_all_year = oci_parse($conn, $sql_all_year);
// echo $sql_all_year;
oci_execute($query_all_year,OCI_DEFAULT);

$numrows = oci_fetch_all($query_all_year, $res);

fwrite($file, "| | |Deliquency|");
for ($x = 1; $x <= $numrows-1; $x++) {
  fwrite($file, "|");
} 
fwrite($file, "\r\n");
fwrite($file, "|Approve Date|Total Account|");

$all_year = "";
$array_all_year = array();
$count_all_year = 1;
// print_r($res["ALL_YEAR"]);
foreach ($res["ALL_YEAR"] as $row_all_year) {
    array_push($array_all_year, $row_all_year);

  fwrite($file, "$row_all_year|");

    if($count_all_year == $numrows){
        $all_year = $all_year . "'" . $row_all_year . "'";
    } else {
        $all_year = $all_year . "'" . $row_all_year . "',";
    }
    $count_all_year++;
}
fwrite($file, "\r\n");
$sql = get_report_sql($_GET['product_type'], $_GET['model_type'], $_GET['card_type'], $_GET['region_name'], $_GET['zone_name'], $_GET['branch_name'], $_GET['model_version'], $_GET['sales_channel'], $_GET['month'], $_GET['year'], $all_year, $_GET['business_type']);
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 0;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
	$month = "'" . $array_all_year[$count] . "'";

		$s1=$array_all_year[$count];
		$s2=number_format($row['TOTAL_ACCOUNT'], 0);
		$s3=number_format($row[$month], 2);

			fwrite($file, "|$s1|$s2|");

    for ($i=0; $i < $numrows; $i++) {
        if($count == $i){
        	fwrite($file, "$s3|");
        } else {
            fwrite($file, "0.00|");
        }
    }
    fwrite($file, "\r\n");
    $count++;
}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

