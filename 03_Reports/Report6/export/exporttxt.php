<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report6_TXT.txt";
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

require('sqlExport.php');
// echo  $sql;
$file = fopen("csv/".$FileNmae, "w");
fwrite($file, "| |Past 3 Months| |Past 6 Months| |Past 12 Months| \r\n");
fwrite($file, "|Category|Number of Loans|% of Total Overrides|Number of Loans|% of Total Overrides|Number of Loans|% of Total Overrides| \r\n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {

		$s1=$row['CATEGORY'];
		$s2=number_format($row['TOTAL_ACTUAL_3M'], 0);
		$s3=number_format($row['OPER_OVERRIDE_3M'], 2);
		$s4=number_format($row['TOTAL_ACTUAL_6M'], 0);
		$s5=number_format($row['PER_OVERRIDE_6M'], 2);
		$s6=number_format($row['TOTAL_ACTUAL_12M'], 0);
		$s7=number_format($row['PER_OVERRIDE_12M'], 2);


		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7| \r\n");


	}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

