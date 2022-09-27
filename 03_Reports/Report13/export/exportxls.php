<?php
include("../database/connect.php");
// --------------------------
$FileNmae="Report13_XLS.xls";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");
// --------------------------

error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$region_FileName=$_GET['region_FileName'];
$zone_FileName=$_GET['zone_FileName'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];

require('sqlExport.php');
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
<table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
<tr>
<td align="center" valign="middle" ><strong>วันบันทึกข้อมูล</strong></td>
<td align="center" valign="middle" ><strong>ประเภทสินเชื่อ</strong></td>
<td align="center" valign="middle" ><strong>ประเภทโมเดล</strong></td>
<td align="center" valign="middle" ><strong>ประเภทบัตร</strong></td>
<td align="center" valign="middle" ><strong>เวอร์ชันโมเดล</strong></td>
<td align="center" valign="middle" ><strong>วันที่เริ่มใช้งาน</strong></td>
<td align="center" valign="middle" ><strong>Description</strong></td>

</tr>

<?php
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {

		$s1=$row['CREATE_DATE'];
		$s2=$row['PRODUCT_TYPE'];
		$s3=$row['MODEL_TYPE'];
		$s4=$row['CARD_TYPE'];
		$s5=$row['VERSION_MODEL'];
		$s6=$row['START_DATE'];
		$s7=$row['DESCRIPTION']; ?>
<tr>
<td align="center" valign="middle" ><?php echo $s1; ?></td>
<td align="center" valign="middle" ><?php echo $s2; ?></td>
<td align="center" valign="middle" ><?php echo $s3; ?></td>
<td align="center" valign="middle" ><?php echo $s4; ?></td>
<td align="center" valign="middle" ><?php echo $s5; ?></td>
<td align="center" valign="middle" ><?php echo $s6; ?></td>
<td align="center" valign="middle" ><?php echo $s7; ?></td>

</tr>
<?php } ?>
</table>
</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>
