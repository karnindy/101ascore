<?php
include("../database/connect.php");
// --------------------------
$FileNmae="Report1_XLS.xls";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");
// --------------------------

error_reporting(0); 
$product_type=$_GET['product_type'];
$model_type=$_GET['model_type'];
$card_type=$_GET['card_type'];
$region_name=$_GET['region_name'];
$zone_name=$_GET['zone_name'];
$branch_name=$_GET['branch_name'];
$model_version=$_GET['model_version'];
$sales_channel=$_GET['sales_channel'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$business_type=$_GET['business_type'];

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
<td width="94" height="30" align="center" valign="middle" ><strong>Score Range</strong></td>
<td width="200" align="center" valign="middle" ><strong>DEV</strong></td>
<td width="181" align="center" valign="middle" ><strong>% DEV</strong></td>
<td width="181" align="center" valign="middle" ><strong>Actual</strong></td>
<td width="181" align="center" valign="middle" ><strong>% Actual</strong></td>
<td width="185" align="center" valign="middle" ><strong>% Change</strong></td>
<td width="185" align="center" valign="middle" ><strong>Ratio</strong></td>
<td width="185" align="center" valign="middle" ><strong>WOE</strong></td>
<td width="185" align="center" valign="middle" ><strong>Index</strong></td>
<td width="185" align="center" valign="middle" ><strong>% Approve</strong></td>
<td width="185" align="center" valign="middle" ><strong>% Reject</strong></td>
</tr>

<?php
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 1;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
		
	if(strtolower($row['SCORE_RANGE_DESC']) == "total"){ 
		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['DEV'], 0);
		$s3=number_format($row['PER_DEV'], 2);
		$s4=number_format($row['ACTUAL'], 0);
		$s5=number_format($row['PER_ACTUAL'], 2);
		$s6=$row['PER_CHANGE'];
		$s7=$row['RATIO'];
		$s8=$row['WOE'];
		$s9=$row['INDEX_'];
		$s10=number_format($row['PER_APPROVE'], 2);
		$s11=number_format($row['PER_REJECT'], 2);
		?>
<tr>
<td width="200" align="center" valign="middle" ><?php echo $s1; ?></td>
<td width="181" align="center" valign="middle" ><?php echo $s2; ?></td>
<td width="181" align="center" valign="middle" ><?php echo $s3; ?></td>
<td width="181" align="center" valign="middle" ><?php echo $s4; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s5; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s6; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s7; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s8; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s9; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s10; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s11; ?></td>
</tr>
<?php
} else {
		$s1=$row['SCORE_RANGE_DESC'];
        $s2=number_format($row['DEV'], 0);
        $s3=number_format($row['PER_DEV'], 2);
        $s4=number_format($row['ACTUAL'], 0);
        $s5=number_format($row['PER_ACTUAL'], 2);
        $s6=number_format($row['PER_CHANGE'], 2);
        $s7=number_format($row['RATIO'], 2);
        $s8=number_format($row['WOE'], 2);
        $s9=number_format($row['INDEX_'], 2);
        $s10=number_format($row['PER_APPROVE'], 2);
        $s11=number_format($row['PER_REJECT'], 2);
?>
<tr>
<td width="200" align="center" valign="middle" ><?php echo $s1; ?></td>
<td width="181" align="center" valign="middle" ><?php echo $s2; ?></td>
<td width="181" align="center" valign="middle" ><?php echo $s3; ?></td>
<td width="181" align="center" valign="middle" ><?php echo $s4; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s5; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s6; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s7; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s8; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s9; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s10; ?></td>
<td width="185" align="center" valign="middle" ><?php echo $s11; ?></td>
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
