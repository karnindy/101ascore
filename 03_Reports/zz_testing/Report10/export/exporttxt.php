<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report10_TXT.txt";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");


error_reporting(0); 
// $product_type=$_GET['product_type'];
// $model_type=$_GET['model_type'];
// $card_type=$_GET['card_type'];
// $model_version=$_GET['model_version'];
// $sales_channel=$_GET['sales_channel'];
// $business_type=$_GET['business_type'];
// $region_name=$_GET['region_name'];
// $zone_name=$_GET['zone_name'];
// $branch_name=$_GET['branch_name'];
// $start_mm=$_GET['start_mm'];
// $START_YYYY=$_GET['START_YYYY'];
// $end_mm=$_GET['end_mm'];
// $end_yyyy=$_GET['end_yyyy'];

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

$START_YYYY=substr($start_date, 0,4);
$start_mm=substr($start_date, 5,2);
$end_yyyy=substr($end_date, 0,4);
$end_mm=substr($end_date, 5,2);

require('sqlExport.php');
// echo  $sql;
$file = fopen("csv/".$FileNmae, "w");
fwrite($file, "|Score Range|% Accepted Accounts|% Active Accounts|% Current 1-30 Days|% Current 31-60 Days|% Current 61-90 Days|% Current More 90 Days| \r\n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['PER_ACCEPT_ACCT'], 2);
		$s3=number_format($row['PER_ACTIVE_ACCT'], 2);
		$s4=number_format($row['PER_CURRENT_1_30'], 2);
		$s5=number_format($row['PER_CURRENT_31_60'], 2);
		$s6=number_format($row['PER_CURRENT_61_90'], 2);
		$s7=number_format($row['PER_CURRENT_MORE_90'], 2);

	if(strtolower($row['SCORE_RANGE_DESC']) == "total"){


		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7| \r\n");

		} else {


		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7| \r\n");

		}

		$count++;
	}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

