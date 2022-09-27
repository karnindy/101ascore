<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report7_TXT.txt";
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
fwrite($file, "| | |Currentt Validation Sample(%)| | |Development Sample(%)| | \r\n");
fwrite($file, "|Score Range|% Cum_G|% Cum_B|Sep_BG|% BadRate(Current)|% Cum_G|% Cum_B|Sep_BG|% BadRate(Dev)| \r\n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
    	$s1=$row['SCORE_RANGE_DESC'];
		// $s2=number_format($row['PER_CUM_G_CURR'], 2);
		// $s3=number_format($row['PER_CUM_B_CURR'], 2);
		// $s4=number_format($row['SEP_BG_CURR'], 2);
		// $s5=number_format($row['PER_BAD_RATE_CURR'], 2);
		// $s6=number_format($row['PER_GOOD_DEV'], 2);
		// $s7=number_format($row['PER_BAD_DEV'], 2);
		// $s8=number_format($row['SEP_BG_DEV'], 2);
		// $s9=number_format($row['PER_BAD_RATE_DEV'], 2);

		if ($row['PER_CUM_G_CURR']== '') {
			$s2="";
		}else{$s2=number_format($row['PER_CUM_G_CURR'], 2);}

		if ($row['PER_CUM_B_CURR']== '') {
			$s3="";
		}else{$s3=number_format($row['PER_CUM_B_CURR'], 2);}

		if ($row['SEP_BG_CURR']== '') {
			$s4="";
		}else{$s4=number_format($row['SEP_BG_CURR'], 2);}

		if ($row['PER_BAD_RATE_CURR']== '') {
			$s5="";
		}else{$s5=number_format($row['PER_BAD_RATE_CURR'], 2);}

		if ($row['PER_GOOD_DEV']== '') {
			$s6="";
		}else{$s6=number_format($row['PER_GOOD_DEV'], 2);}

		if ($row['PER_BAD_DEV']== '') {
			$s7="";
		}else{$s7=number_format($row['PER_BAD_DEV'], 2);}

		if ($row['SEP_BG_DEV']== '') {
			$s8="";
		}else{$s8=number_format($row['SEP_BG_DEV'], 2);}

		if ($row['PER_BAD_RATE_DEV']== '') {
			$s9="";
		}else{$s9=number_format($row['PER_BAD_RATE_DEV'], 2);}

	if(preg_match("/Total/i", $row['SCORE_RANGE_DESC'])){


		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8|$s9| \r\n");

		} else {


		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8|$s9| \r\n");

		}

	}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

