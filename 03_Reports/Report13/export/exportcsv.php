<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
error_reporting(0); 
$product_type=$_POST['product_type'];
$model_type=$_POST['model_type'];
$card_type=$_POST['card_type'];
$region_FileName=$_POST['region_FileName'];
$zone_FileName=$_POST['zone_FileName'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];


require('sqlExport.php');
// echo  $sql;
$FileName="Report13_CSV.csv";
$fileFileName = "csv/".$FileName;
$objWrite = fopen("csv/".$FileName, "w");
fwrite($objWrite, "\xEF\xBB\xBF");
fwrite($objWrite, "\"วันบันทึกข้อมูล\",\"ประเภทสินเชื่อ\",\"ประเภทโมเดล\",\"ประเภทบัตร\",\"เวอร์ชันโมเดล\",\"วันที่เริ่มใช้งาน\",\"Description\" \n");

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {

		$s1=$row['CREATE_DATE'];
		$s2=$row['PRODUCT_TYPE'];
		$s3=$row['MODEL_TYPE'];
		$s4=$row['CARD_TYPE'];
		$s5=$row['VERSION_MODEL'];
		$s6=$row['START_DATE'];
		$s7=$row['DESCRIPTION'];
		
		fwrite($objWrite, "\"$s1\",\"$s2\",\"$s3\",\"$s4\",\"$s5\",\"$s6\",\"$s7\" \n");
}

fclose($objWrite);
?>