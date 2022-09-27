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
$name="7";
$fileName = "csv/Report".$name."_CSV.csv";
$objWrite = fopen("csv/Report".$name."_CSV.csv", "w");
fwrite($objWrite, "\xEF\xBB\xBF");
fwrite($objWrite, "\"\",\"\",\"Currentt Validation Sample(%)\",\"\",\"\",\"Development Sample(%)\",\"\",\"\",\"\" \n");
fwrite($objWrite, "\"Score Range\",\"% Cum_G\",\"% Cum_B\",\"Sep_BG\",\"% BadRate(Current)\",\"% Cum_G\",\"% Cum_B\",\"Sep_BG\",\"% BadRate(Dev)\" \n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
    	$s1=$row['SCORE_RANGE_DESC'];

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


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\" \n");

		} else {


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\" \n");

		}

	}

fclose($objWrite);
?>