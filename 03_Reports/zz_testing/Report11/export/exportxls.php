<?php
include("../database/connect.php");
// --------------------------
$FileNmae="Report11_XLS.xls";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");
// --------------------------

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
<td align="center" valign="middle" rowspan='2' ><strong>Score Range</strong></td>
<td align="center" valign="middle" colspan='2' ><strong>Active account</strong></td>
<td align="center" valign="middle" colspan='4' ><strong>หนี้ที่ไม่ก่อรายได้ (NPLs)</strong></td>
<td align="center" valign="middle" rowspan='2' ><strong>% of Cumulative NPLs</strong></td>
</tr>
<tr>
<td align="center" valign="middle" ><strong>No. of Account</strong></td>
<td align="center" valign="middle" ><strong>Amount</strong></td>
<td align="center" valign="middle" ><strong>No. of Account</strong></td>
<td align="center" valign="middle" ><strong>% NPLs</strong></td>
<td align="center" valign="middle" ><strong>Amount</strong></td>
<td align="center" valign="middle" ><strong>%Amount</strong></td>

</tr>

<?php
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['ACTIVE_ACCOUNT'], 0);
		$s3=number_format($row['ACTIVE_AMOUNT'], 0);
		$s4=number_format($row['NPLS_ACCOUNT'], 0);
		$s5=number_format($row['PER_NPLS'], 2);
		$s6=number_format($row['NCB_AMOUNT'], 0);
		$s7=number_format($row['PER_NCB_AMOUNT'], 2);
		$s8=number_format($row['PER_CUM_NPL'], 2);

	if(strtolower($row['SCORE_RANGE_DESC']) == "total"){ ?>
<tr>
<td align="center" valign="middle" ><?php echo $s1; ?></td>
<td align="center" valign="middle" ><?php echo $s2; ?></td>
<td align="center" valign="middle" ><?php echo $s3; ?></td>
<td align="center" valign="middle" ><?php echo $s4; ?></td>
<td align="center" valign="middle" ><?php echo $s5; ?></td>
<td align="center" valign="middle" ><?php echo $s6; ?></td>
<td align="center" valign="middle" ><?php echo $s7; ?></td>
<td align="center" valign="middle" ><?php echo $s8; ?></td>

</tr>
<?php
} else {
?>
<tr>
<td align="center" valign="middle" ><?php echo $s1; ?></td>
<td align="center" valign="middle" ><?php echo $s2; ?></td>
<td align="center" valign="middle" ><?php echo $s3; ?></td>
<td align="center" valign="middle" ><?php echo $s4; ?></td>
<td align="center" valign="middle" ><?php echo $s5; ?></td>
<td align="center" valign="middle" ><?php echo $s6; ?></td>
<td align="center" valign="middle" ><?php echo $s7; ?></td>
<td align="center" valign="middle" ><?php echo $s8; ?></td>

</tr>
<?php
}
}
?>
</table>
</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>
