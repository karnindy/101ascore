<?php
include("../database/connect.php");
// --------------------------
$FileNmae="Report8_XLS.xls";
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
$month=$_GET['month'];
$year=$_GET['year'];

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
<td align="center" valign="middle" ><strong>Early Performance</strong></td>
<td colspan='3' align="center" valign="middle" ><strong>Bad: Ever 1-30</strong></td>
<td colspan='3' align="center" valign="middle" ><strong>Bad: Ever 31-60</strong></td>
<td colspan='3' align="center" valign="middle" ><strong>Bad: Ever 61-90</strong></td>
</tr>
<tr>
<td align="center" valign="middle" ><strong>Score Range</strong></td>
<td align="center" valign="middle" ><strong>Past 3 Months</strong></td>
<td align="center" valign="middle" ><strong>Past 12 Months</strong></td>
<td align="center" valign="middle" ><strong>Year ago 12 months</strong></td>
<td align="center" valign="middle" ><strong>Past 3 Months</strong></td>
<td align="center" valign="middle" ><strong>Past 12 Months</strong></td>
<td align="center" valign="middle" ><strong>Year ago 12 months</strong></td>
<td align="center" valign="middle" ><strong>Past 3 Months</strong></td>
<td align="center" valign="middle" ><strong>Past 12 Months</strong></td>
<td align="center" valign="middle" ><strong>Year ago 12 months</strong></td>
</tr>

<?php
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
		$s1=$row['SCORE_RANGE_DESC'];
		$s2=number_format($row['BAD1_30PAST3MONTHS'], 2);
		$s3=number_format($row['BAD1_30PAST12MONTHS'], 2);
		$s4=number_format($row['BAD1_30PASTMORE12'], 2);
		$s5=number_format($row['BAD31_60PAST3MONTHS'], 2);
		$s6=number_format($row['BAD31_60PAST12MONTHS'], 2);
		$s7=number_format($row['BAD31_60PASTMORE12'], 2);
		$s8=number_format($row['BAD61_90PAST3MONTHS'], 2);
		$s9=number_format($row['BAD61_90PAST12MONTHS'], 2);
		$s10=number_format($row['BAD61_90PASTMORE12'], 2);

	if(preg_match("/Total/i", $row['SCORE_RANGE_DESC'])){ ?>
<tr>
<td align="center" valign="middle" ><?php echo $s1; ?></td>
<td align="center" valign="middle" ><?php echo $s2; ?></td>
<td align="center" valign="middle" ><?php echo $s3; ?></td>
<td align="center" valign="middle" ><?php echo $s4; ?></td>
<td align="center" valign="middle" ><?php echo $s5; ?></td>
<td align="center" valign="middle" ><?php echo $s6; ?></td>
<td align="center" valign="middle" ><?php echo $s7; ?></td>
<td align="center" valign="middle" ><?php echo $s8; ?></td>
<td align="center" valign="middle" ><?php echo $s9; ?></td>
<td align="center" valign="middle" ><?php echo $s10; ?></td>

</tr>
<?php
	} else if(preg_match("/Average Bad Rate/i", $row['SCORE_RANGE_DESC'])){
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
<td align="center" valign="middle" ><?php echo $s9; ?></td>
<td align="center" valign="middle" ><?php echo $s10; ?></td>

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
<td align="center" valign="middle" ><?php echo $s9; ?></td>
<td align="center" valign="middle" ><?php echo $s10; ?></td>

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
