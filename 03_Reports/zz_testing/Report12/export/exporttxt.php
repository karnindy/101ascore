<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report12_TXT.txt";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");


error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$region_FileName=$_GET['region_FileName'];
$zone_FileName=$_GET['zone_FileName'];
$branch_FileName=$_GET['branch_FileName'];
$model_version=$_GET['model_version'];
$sales_channel=$_GET['sales_channel'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$business_type=$_GET['business_type'];
$region_name=$_GET['region_name'];
$zone_name=$_GET['zone_name'];
$branch_name=$_GET['branch_name'];
$start_date="01-".$start_date;
$end_date="31-".$end_date;

require('sqlExport.php');
// echo  $sql;
$file = fopen("csv/".$FileNmae, "w");
fwrite($file, "| |Active account| | |หนี้ที่ไม่ก่อรายได้ (NPLs)| | | | \r\n");

fwrite($file, "|Grade Range|No. of Account|Amount|No. of Account|% NPLs|Amount|%Amount|% of Cumulative NPLs| \r\n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
		$s1=$row['SCOREGRADE'];
		$s2=number_format($row['ACTIVE_ACCOUNT'], 0);
		$s3=number_format($row['ACTIVE_AMOUNT'], 0);
		$s4=number_format($row['NPLS_AMOUNT'], 0);
		$s5=number_format($row['PER_NPLS'], 2);
		$s6=number_format($row['NCB_AMOUNT'], 0);
		$s7=number_format($row['PER_NCB_AMOUNT'], 2);
		$s8=number_format($row['PER_CUM_NPL'], 2);

	if(strtolower($row['SCOREGRADE']) == "total"){


		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8| \r\n");

		} else {


		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8| \r\n");

		}

	}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

