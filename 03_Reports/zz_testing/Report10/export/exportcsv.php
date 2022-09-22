<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
error_reporting(0); 
// $product_type=$_POST['product_type'];
// $model_type=$_POST['model_type'];
// $card_type=$_POST['card_type'];
// $model_version=$_POST['model_version'];
// $sales_channel=$_POST['sales_channel'];
// $business_type=$_POST['business_type'];
// $region_name=$_POST['region_name'];
// $zone_name=$_POST['zone_name'];
// $branch_name=$_POST['branch_name'];
// $start_mm=$_POST['start_mm'];
// $START_YYYY=$_POST['START_YYYY'];
// $end_mm=$_POST['end_mm'];
// $end_yyyy=$_POST['end_yyyy'];

$product_type=$_POST['product_type'];
$model_type=$_POST['model_type'];
$card_type=$_POST['card_type'];
$model_version=$_POST['model_version'];
$sales_channel=$_POST['sales_channel'];
$business_type=$_POST['business_type'];
$region_name=$_POST['region_name'];
$zone_name=$_POST['zone_name'];
$branch_name=$_POST['branch_name'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
// echo $start_date."<br>";
// echo $end_date."<br>";
$START_YYYY=substr($start_date, 0,4);
$start_mm=substr($start_date, 5,2);
$end_yyyy=substr($end_date, 0,4);
$end_mm=substr($end_date, 5,2);

// echo $start_mm."<br>";
// echo $START_YYYY."<br>";
// echo $end_mm."<br>";
// echo $end_yyyy."<br>";
require('sqlExport.php');
// echo  $sql;
$name="10";
$fileName = "csv/Report".$name."_CSV.csv";
$objWrite = fopen("csv/Report".$name."_CSV.csv", "w");
fwrite($objWrite, "\xEF\xBB\xBF");
fwrite($objWrite, "\"Score Range\",\"% Accepted Accounts\",\"% Active Accounts\",\"% Current 1-30 Days\",\"% Current 31-60 Days\",\"% Current 61-90 Days\",\"% Current More 90 Days\" \n");

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


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\" \n");

		} else {


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\" \n");

		}

		$count++;
	}

fclose($objWrite);
?>