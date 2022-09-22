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
$name="8";
$fileName = "csv/Report".$name."_CSV.csv";
$objWrite = fopen("csv/Report".$name."_CSV.csv", "w");
fwrite($objWrite, "\xEF\xBB\xBF");
fwrite($objWrite, "\"Early Performance\",\" \",\"Bad: Ever 1-30\",\" \",\" \",\"Bad: Ever 31-60\",\" \",\" \",\"Bad: Ever 61-90\" \n");
fwrite($objWrite, "\"Score Range\",\"Past 3 Months\",\"Past 12 Months\",\"Year ago 12 months\",\"% Past 3 Months\",\"% Past 12 Months\",\"% Year ago 12 months\",\"% Past 3 Months\",\"% Past 12 Months\",\"% Year ago 12 months\" \n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['BAD1_30PAST3MONTHS'], 2);
		$s3=number_format($row['BAD1_30PAST12MONTHS'], 2);
		$s4=number_format($row['BAD1_30PASTMORE12'], 2);
		$s5=number_format($row['BAD31_60PAST3MONTHS'], 2);
		$s6=number_format($row['BAD31_60PAST12MONTHS'], 2);
		$s7=number_format($row['BAD31_60PASTMORE12'], 2);
		$s8=number_format($row['BAD61_90PAST3MONTHS'], 2);
		$s9=number_format($row['BAD61_90PAST12MONTHS'], 2);
		$s10=number_format($row['BAD61_90PASTMORE12'], 2);

	if(preg_match("/Total/i", $row['SCORE_RANGE_DESC'])){

		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\" \n");

		} else if(preg_match("/Average Bad Rate/i", $row['SCORE_RANGE_DESC'])){


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\" \n");

		} else {


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\" \n");

		}

	}

fclose($objWrite);
?>