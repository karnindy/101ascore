<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
$FileNmae="Report13_TXT.txt";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");


error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$region_FileName=$_GET['region_FileName'];
$zone_FileName=$_GET['zone_FileName'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];

require('sqlExport.php');
// echo  $sql;
$file = fopen("csv/".$FileNmae, "w");
fwrite($file, "|วันบันทึกข้อมูล|ประเภทสินเชื่อ|ประเภทโมเดล|ประเภทบัตร|เวอร์ชันโมเดล|วันที่เริ่มใช้งาน|Description| \r\n");

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
		
		fwrite($file, "|$s1|$s2|$s3|$s4|$s5|$s6|$s7| \r\n");
}
fclose($file);
readfile('csv/'.$FileNmae);
?> 

