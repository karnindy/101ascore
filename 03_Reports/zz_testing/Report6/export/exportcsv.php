<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
error_reporting(0); 
$product_type=$_POST['product_type'];
$model_type=$_POST['model_type'];
$card_type=$_POST['card_type'];
$model_version=$_POST['model_version'];
$sales_channel=$_POST['sales_channel'];
$business_type=$_POST['business_type'];
$region_name=$_POST['region_name'];
$zone_name=$_POST['zone_name'];
$branch_name=$_POST['branch_name'];
$month=$_POST['month'];
$year=$_POST['year'];

require('sqlExport.php');
// echo  $sql;
$name="6";
$fileName = "csv/Report".$name."_CSV.csv";
$objWrite = fopen("csv/Report".$name."_CSV.csv", "w");
fwrite($objWrite, "\xEF\xBB\xBF");
fwrite($objWrite, "\"\",\"Past 3 Months\",\"\",\"Past 6 Months\",\"\",\"Past 12 Months\" \n");
fwrite($objWrite, "\"Category\",\"Number of Loans\",\"% of Total Overrides\",\"Number of Loans\",\"% of Total Overrides\",\"Number of Loans\",\"% of Total Overrides\" \n");

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


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\" \n");


	}

fclose($objWrite);
?>