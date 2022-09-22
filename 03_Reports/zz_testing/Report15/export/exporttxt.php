<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report15_TXT.txt";
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
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$start_date="01-".$start_date;
$end_date="31-".$end_date;

require('sqlExport.php');
// echo  $sql;
$file = fopen("csv/".$FileNmae, "w");
fwrite($file, "|Score Range|NPLs (ราย)|PL (ราย)|%NPLs|%PL|Cum. %NPLs|Cum. %PL|KS| \r\n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
		$s1=$row['SCORE_RANGE_DESC'];
		if($row['NPLS'] ==''){$s2="";
		}else{$s2=number_format($row['NPLS'], 0);}
		if($row['PL'] ==''){$s3="";
		}else{$s3=number_format($row['PL'], 0);}
		if($row['PER_NPLS'] ==''){$s4="";
		}else{$s4=number_format($row['PER_NPLS'], 2);}
		if($row['PER_PL'] ==''){$s5="";
		}else{$s5=number_format($row['PER_PL'], 2);}
		if($row['PER_NPLS_CUM'] ==''){$s6="";
		}else{$s6=number_format($row['PER_NPLS_CUM'], 2);}
		if($row['PER_PL_CUM'] ==''){$s7="";
		}else{$s7=number_format($row['PER_PL_CUM'], 2);}
		if($row['KS'] ==''){$s8="";
		}else{$s8=number_format($row['KS'], 2);}

		// $s2=number_format($row['NPLS'], 0);
		// $s3=number_format($row['PL'], 0);
		// $s4=number_format($row['PER_NPLS'], 2);
		// $s5=number_format($row['PER_PL'], 2);
		// $s6=number_format($row['PER_NPLS_CUM'], 2);
		// $s7=number_format($row['PER_PL_CUM'], 2);
		// $s8=number_format($row['KS'], 2);

		if(strtolower($row['SCORE_RANGE_DESC']) == "total"){

		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8| \r\n");

		} else {


		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7|$s8| \r\n");

		}

	}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

