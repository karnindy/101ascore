<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report1_TXT.txt";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");


error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$region_name=$_GET['region_name'];
$zone_name=$_GET['zone_name'];
$branch_name=$_GET['branch_name'];
$model_version=$_GET['model_version'];
$sales_channel=$_GET['sales_channel'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$business_type=$_GET['business_type'];

require('sqlExport.php');
// echo  $sql;
$file = fopen("csv/".$FileNmae, "w");
fwrite($file, "|Score Range|DEV|% DEV|Actual|% Actual|% Change|Ratio|WOE|Index|% Approve|% Reject| \r\n");

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

		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8|$s9|$s10|$s11| \r\n");

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

		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8|$s9|$s10|$s11| \r\n");

		}

		$count++;
	}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

