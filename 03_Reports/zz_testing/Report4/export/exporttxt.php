<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report4_TXT.txt";
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


require('sqlExport.php');
// echo  $sql;
$file = fopen("csv/".$FileNmae, "w");
fwrite($file, "|Score Range|Approve|Reject|Total|Approve %| \r\n");

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

		fwrite($file, "|$s1|$s2|$s3|$s4|$s5| \r\n");

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

		fwrite($file, "|$s1|$s2|$s3|$s4|$s5| \r\n");

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

		fwrite($file, "|$s1|$s2|$s3|$s4|$s5| \r\n");

    }

    $count++;
}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

