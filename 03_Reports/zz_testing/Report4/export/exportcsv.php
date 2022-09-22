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

require('sqlExport.php');
// echo  $sql;
$name="4";
$fileName = "csv/Report".$name."_CSV.csv";
$objWrite = fopen("csv/Report".$name."_CSV.csv", "w");
fwrite($objWrite, "\xEF\xBB\xBF");
fwrite($objWrite, "\"Score Range\",\"Approve\",\"Reject\",\"Total\",\"Approve %\" \n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
	if(strtolower($row['SCORE_RANGE_DESC']) == "total"){

		$s1=$row['SCORE_RANGE_DESC'];
		if($row['APPROVE'] == ""){
			$s2="";
		}else{$s2=number_format($row['APPROVE'], 0);}

		if($row['REJECT'] == ""){
			$s3="";
		}else{$s3=number_format($row['REJECT'], 0);}
		if($row['TOTAL'] == ""){
			$s4="";
		}else{$s4=number_format($row['TOTAL'], 0);}
		if($row['PER_APPROVE'] == ""){
			$s5="";
		}else{$s5=number_format($row['PER_APPROVE'], 2);}

		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\" \n");

		} else if(preg_match("/Overrides %/i", $row['SCORE_RANGE_DESC']) || preg_match("/Rate/i", $row['SCORE_RANGE_DESC'])) {
			$s1=$row['SCORE_RANGE_DESC'];
			if($row['APPROVE'] == ""){
				$s2="";
			}else{$s2=number_format($row['APPROVE'], 2);}
	
			if($row['REJECT'] == ""){
				$s3="";
			}else{$s3=number_format($row['REJECT'], 2);}
			if($row['TOTAL'] == ""){
				$s4="";
			}else{$s4=number_format($row['TOTAL'], 2);}
			if($row['PER_APPROVE'] == ""){
				$s5="";
			}else{$s5=number_format($row['PER_APPROVE'], 2);}

		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\" \n");

		} else {
			$s1=$row['SCORE_RANGE_DESC'];
		if($row['APPROVE'] == ""){
			$s2="";
		}else{$s2=number_format($row['APPROVE'], 0);}

		if($row['REJECT'] == ""){
			$s3="";
		}else{$s3=number_format($row['REJECT'], 0);}
		if($row['TOTAL'] == ""){
			$s4="";
		}else{$s4=number_format($row['TOTAL'], 0);}
		if($row['PER_APPROVE'] == ""){
			$s5="";
		}else{$s5=number_format($row['PER_APPROVE'], 2);}

		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\" \n");

    }

    $count++;
}


fclose($objWrite);
?>