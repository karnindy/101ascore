<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report3_TXT.txt";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");

error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$business_type=$_GET['business_type'];
$sales_channel=$_GET['sales_channel'];
$region_name=$_GET['region_name'];
$zone_name=$_GET['zone_name'];
$branch_name=$_GET['branch_name'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$factors=$_GET['factors'];

require('sqlExport.php');
// echo  $sql;
$file = fopen("csv/".$FileNmae, "w");
fwrite($file, "|$factors|DEV|%DEV|Actual|%Actual|Change|Point|Point Diff| \r\n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
	if($row['ATTIBUTE'] == "Total"){
		$s1=$row['ATTIBUTE'];
		$s2=number_format($row['DEV'], 0);
		$s3=number_format($row['PER_DEV'], 2);
		$s4=number_format($row['ACTUAL'], 0);
		$s5=number_format($row['PER_ACTUAL'], 2);
		$s6=number_format($row['CHANGE'], 2);
		$s7=$row['POINT'];
		$s8=$row['POINT_DIFF'];

		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8| \r\n");

		} else {
			$s1=$row['ATTIBUTE'];
			$s2=number_format($row['DEV'], 0);
			$s3=number_format($row['PER_DEV'], 2);
			$s4=number_format($row['ACTUAL'], 0);
			$s5=number_format($row['PER_ACTUAL'], 2);
			$s6=number_format($row['CHANGE'], 2);
			$s7=number_format($row['POINT'], 0);
			$s8=number_format($row['POINT_DIFF'], 2);

		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8| \r\n");

		}

	}

fclose($file);
readfile('csv/'.$FileNmae);
?> 

