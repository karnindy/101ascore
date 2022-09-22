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

$name="2";
$fileName = "csv/Report".$name."_CSV.csv";
$objWrite = fopen("csv/Report".$name."_CSV.csv", "w");
fwrite($objWrite, "\xEF\xBB\xBF");
fwrite($objWrite, "\"\",\"\",\"Through-the-door Population\",\"\",\"\",\"Withdraw as % TTD in range\",\"\",\"\",\"Approve as % decisioned in range\",\"\",\"\",\"Other as % TTD in range\" \n");

fwrite($objWrite, "\"Score Range\",\"Past 3 Months\",\"Past 12 Months\",\"Year ago 12 months\",\"% Past 3 Months\",\"% Past 12 Months\",\"% Year ago 12 months\",\"% Past 3 Months\",\"% Past 12 Months\",\"% Year ago 12 months\",\"% Past 3 Months\",\"% Past 12 Months\",\"% Year ago 12 months\" \n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {

		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['ACTUAL_3M'], 0);
		$s3=number_format($row['ACTUAL_12M'], 0);
		$s4=number_format($row['ACTUAL_MORE12M'], 0);
		$s5=number_format($row['REJECT_3M'], 2);
		$s6=number_format($row['REJECT_12M'], 2);
		$s7=number_format($row['REJECT_MORE12M'], 2);
		$s8=number_format($row['APPROVE_3M'], 2);
		$s9=number_format($row['APPROVE_12M'], 2);
		$s10=number_format($row['APPROVE_MORE12M'], 2);
		$s11=number_format($row['OTHER_3M'], 2);
		$s12=number_format($row['OTHER_12M'], 2);
		$s13=number_format($row['OTHER_MORE12M'], 2);

    if($row['SCORE_RANGE_DESC'] =='No. of Loans'){


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\",\"$s12\",\"$s13\" \n");

	} else if(preg_match("/Avg/i", $row['SCORE_RANGE_DESC']) || preg_match("/%/i", $row['SCORE_RANGE_DESC'])) {
		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['ACTUAL_3M'], 2);
		$s3=number_format($row['ACTUAL_12M'], 2);
		$s4=number_format($row['ACTUAL_MORE12M'], 2);
		$s5=number_format($row['REJECT_3M'], 2);
		$s6=number_format($row['REJECT_12M'], 2);
		$s7=number_format($row['REJECT_MORE12M'], 2);
		$s8=number_format($row['APPROVE_3M'], 2);
		$s9=number_format($row['APPROVE_12M'], 2);
		$s10=number_format($row['APPROVE_MORE12M'], 2);
		$s11=number_format($row['OTHER_3M'], 2);
		$s12=number_format($row['OTHER_12M'], 2);
		$s13=number_format($row['OTHER_MORE12M'], 2);


		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\",\"$s12\",\"$s13\" \n");

	} else {

		
		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\",\"$s8\",\"$s9\",\"$s10\",\"$s11\",\"$s12\",\"$s13\" \n");

		}

	}

fclose($objWrite);
?>