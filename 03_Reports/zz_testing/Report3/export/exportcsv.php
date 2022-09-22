<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
error_reporting(0); 
$product_type=$_POST['product_type'];
$model_type=$_POST['model_type'];
$card_type=$_POST['card_type'];
$business_type=$_POST['business_type'];
$sales_channel=$_POST['sales_channel'];
$region_name=$_POST['region_name'];
$zone_name=$_POST['zone_name'];
$branch_name=$_POST['branch_name'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
$factors=$_POST['factors'];

require('sqlExport.php');
// echo  $sql;
$name="3";
$fileName = "csv/Report".$name."_CSV.csv";
$objWrite = fopen("csv/Report".$name."_CSV.csv", "w");
fwrite($objWrite, "\xEF\xBB\xBF");
fwrite($objWrite, "\"$factors\",\"DEV\",\"%DEV\",\"Actual\",\"%Actual\",\"Change\",\"Point\",\"Point Diff\" \n");

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

		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\" \n");

		} else {
			$s1=$row['ATTIBUTE'];
			$s2=number_format($row['DEV'], 0);
			$s3=number_format($row['PER_DEV'], 2);
			$s4=number_format($row['ACTUAL'], 0);
			$s5=number_format($row['PER_ACTUAL'], 2);
			$s6=number_format($row['CHANGE'], 2);
			$s7=number_format($row['POINT'], 0);
			$s8=number_format($row['POINT_DIFF'], 2);

		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\" \n");

		}

	}

fclose($objWrite);
?>