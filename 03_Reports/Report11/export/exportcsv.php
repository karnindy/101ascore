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
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
$start_date="01-".$start_date;
$end_date="31-".$end_date;

require('sqlExport.php');
// echo  $sql;
$FileName="Report11_CSV.csv";
$fileFileName = "csv/".$FileName;
$objWrite = fopen("csv/".$FileName, "w");
fwrite($objWrite, "\xEF\xBB\xBF");
fwrite($objWrite, "\" \",\"Active account\",\" \",\" \",\"หนี้ที่ไม่ก่อรายได้ (NPLs)\",\" \",\" \",\" \" \n");

fwrite($objWrite, "\"Score Range\",\"No. of Account\",\"Amount\",\"No. of Account\",\"% NPLs\",\"Amount\",\"%Amount\",\"% of Cumulative NPLs\" \n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['ACTIVE_ACCOUNT'], 0);
		$s3=number_format($row['ACTIVE_AMOUNT'], 2);
		$s4=number_format($row['NPLS_ACCOUNT'], 0);
		$s5=number_format($row['PER_NPLS'], 2);
		$s6=number_format($row['NCB_AMOUNT'], 2);
		$s7=number_format($row['PER_NCB_AMOUNT'], 2);
		$s8=number_format($row['PER_CUM_NPL'], 2);

	if(strtolower($row['SCORE_RANGE_DESC']) == "total"){


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\" \n");

		} else {


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\" \n");

    }
}

fclose($objWrite);
?>