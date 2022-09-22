<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report5_TXT.txt";
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
fwrite($file, "| | |As % of Applications in Range| | |As % of Approved| \r\n");
fwrite($file, "|Category|Past 3 Months|Past 12 Months|Year ago 12 Months|Past 3 Months|Past 12 Months|Year ago 12 Months| \r\n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {

    if(preg_match("/%/i", $row['CATEGORY'])){
		$s1=$row['CATEGORY'];
		$s2=number_format($row['APP_IN_RANGE_3M'], 2);
		$s3=number_format($row['APP_IN_RANGE_12M'], 2);
		$s4=number_format($row['APP_IN_RANGE_MORE12M'], 2);
		$s5=number_format($row['APPROVAL_3M'], 2);
		$s6=number_format($row['APPROVAL_12M'], 2);
		$s7=number_format($row['APPROVAL_MORE12M'], 2);

		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7| \r\n");

		} else {
			$s1=$row['CATEGORY'];
			$s2=number_format($row['APP_IN_RANGE_3M'], 0);
			$s3=number_format($row['APP_IN_RANGE_12M'], 0);
			$s4=number_format($row['APP_IN_RANGE_MORE12M'], 0);
			$s5=number_format($row['APPROVAL_3M'], 0);
			$s6=number_format($row['APPROVAL_12M'], 0);
			$s7=number_format($row['APPROVAL_MORE12M'], 0);

		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7| \r\n");

		}

	}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

