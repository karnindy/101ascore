<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report2_TXT.txt";
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
fwrite($file, "| | |Through-the-door Population| | |Withdraw as % TTD in range| | |Approve as % decisioned in range|||Other as % TTD in range| \r\n");

fwrite($file, "|Score Range|Past 3 Months|Past 12 Months|Year ago 12 months|% Past 3 Months|% Past 12 Months|% Year ago 12 months|% Past 3 Months|% Past 12 Months|% Year ago 12 months|% Past 3 Months|% Past 12 Months|% Year ago 12 months| \r\n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {

		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['ACTUAL_3M'], 0);
		$s3=number_format($row['ACTUAL_12M'], 0);
		$s4=number_format($row['ACTUAL_MORE12M'], 0);
		$s5=number_format($row['APPROVE_3M'], 2);
		$s6=number_format($row['APPROVE_12M'], 2);
		$s7=number_format($row['APPROVE_MORE12M'], 2);
		$s8=number_format($row['REJECT_3M'], 2);
		$s9=number_format($row['REJECT_12M'], 2);
		$s10=number_format($row['REJECT_MORE12M'], 2);
		$s11=number_format($row['OTHER_3M'], 2);
		$s12=number_format($row['OTHER_12M'], 2);
		$s13=number_format($row['OTHER_MORE12M'], 2);

    if($row['SCORE_RANGE_DESC'] =='No. of Loans'){


		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8|$s9|$s10|$s11|$s12|$s13| \r\n");

	} else if(preg_match("/Avg/i", $row['SCORE_RANGE_DESC']) || preg_match("/%/i", $row['SCORE_RANGE_DESC'])) {


		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8|$s9|$s10|$s11|$s12|$s13| \r\n");

	} else {

		
		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8|$s9|$s10|$s11|$s12|$s13| \r\n");

		}

	}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

