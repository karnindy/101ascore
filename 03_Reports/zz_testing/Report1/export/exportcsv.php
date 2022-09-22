<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
error_reporting(0); 
$product_type=$_POST['product_type'];
$model_type=$_POST['model_type'];
$card_type=$_POST['card_type'];
$region_name=$_POST['region_name'];
$zone_name=$_POST['zone_name'];
$branch_name=$_POST['branch_name'];
$model_version=$_POST['model_version'];
$sales_channel=$_POST['sales_channel'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
$business_type=$_POST['business_type'];

require('sqlExport.php');
// echo  $sql;
$name="1";
$fileName = "csv/Report".$name."_CSV.csv";
$objWrite = fopen("csv/Report".$name."_CSV.csv", "w");
fwrite($objWrite, "\xEF\xBB\xBF");
fwrite($objWrite, "\"Score Range\",\"DEV\",\"% DEV\",\"Actual\",\"% Actual\",\"% Change\",\"Ratio\",\"WOE\",\"Index\",\"% Approve\",\"% Reject\" \n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
		
	if(strtolower($row['SCORE_RANGE_DESC']) == "total"){
		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['DEV'], 0);
		$s3=number_format($row['PER_DEV'], 2);
		$s4=number_format($row['ACTUAL'], 0);
		$s5=number_format($row['PER_ACTUAL'], 2);
		$s6=$row['PER_CHANGE'];
		$s7=$row['RATIO'];
		$s8=$row['WOE'];
		$s9=$row['INDEX_'];
		$s10=number_format($row['PER_APPROVE'], 2);
		$s11=number_format($row['PER_REJECT'], 2);


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\" \n");

		} else {
		$s1=$row['SCORE_RANGE_DESC'];
        $s2=number_format($row['DEV'], 0);
        $s3=number_format($row['PER_DEV'], 2);
        $s4=number_format($row['ACTUAL'], 0);
        $s5=number_format($row['PER_ACTUAL'], 2);
        $s6=number_format($row['PER_CHANGE'], 2);
        $s7=number_format($row['RATIO'], 2);
        $s8=number_format($row['WOE'], 2);
        $s9=number_format($row['INDEX_'], 2);
        $s10=number_format($row['PER_APPROVE'], 2);
        $s11=number_format($row['PER_REJECT'], 2);

		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\" \n");

		}

		$count++;
	}

fclose($objWrite);
?>