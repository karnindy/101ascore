<?php
include("../database/connect.php");
// --------------------------
$FileNmae="Report10_XLS.xls";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");
// --------------------------

error_reporting(0); 
// $product_type=$_GET['product_type'];
// $model_type=$_GET['model_type'];
// $card_type=$_GET['card_type'];
// $model_version=$_GET['model_version'];
// $sales_channel=$_GET['sales_channel'];
// $business_type=$_GET['business_type'];
// $region_name=$_GET['region_name'];
// $zone_name=$_GET['zone_name'];
// $branch_name=$_GET['branch_name'];
// $start_mm=$_GET['start_mm'];
// $START_YYYY=$_GET['START_YYYY'];
// $end_mm=$_GET['end_mm'];
// $end_yyyy=$_GET['end_yyyy'];

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

$START_YYYY=substr($start_date, 0,4);
$start_mm=substr($start_date, 5,2);
$end_yyyy=substr($end_date, 0,4);
$end_mm=substr($end_date, 5,2);

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
<td align="center" valign="middle" ><strong>Score Range</strong></td>
<td align="center" valign="middle" ><strong>% Accepted Accounts</strong></td>
<td align="center" valign="middle" ><strong>% Active Accounts</strong></td>
<td align="center" valign="middle" ><strong>% Current 1-30 Days</strong></td>
<td align="center" valign="middle" ><strong>% Current 31-60 Days</strong></td>
<td align="center" valign="middle" ><strong>% Current 61-90 Days</strong></td>
<td align="center" valign="middle" ><strong>% Current More 90 Days</strong></td>

</tr>

<?php
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['PER_ACCEPT_ACCT'], 2);
		$s3=number_format($row['PER_ACTIVE_ACCT'], 2);
		$s4=number_format($row['PER_CURRENT_1_30'], 2);
		$s5=number_format($row['PER_CURRENT_31_60'], 2);
		$s6=number_format($row['PER_CURRENT_61_90'], 2);
		$s7=number_format($row['PER_CURRENT_MORE_90'], 2);

		if(strtolower($row['SCORE_RANGE_DESC']) == "total"){ ?>
<tr>
<td align="center" valign="middle" ><?php echo $s1; ?></td>
<td align="center" valign="middle" ><?php echo $s2; ?></td>
<td align="center" valign="middle" ><?php echo $s3; ?></td>
<td align="center" valign="middle" ><?php echo $s4; ?></td>
<td align="center" valign="middle" ><?php echo $s5; ?></td>
<td align="center" valign="middle" ><?php echo $s6; ?></td>
<td align="center" valign="middle" ><?php echo $s7; ?></td>

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

</tr>
<?php
}
$count++;
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
