<?php
include("../database/connect.php");
// --------------------------
$FileNmae="Report4_XLS.xls";
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
<td align="center" valign="middle" ><strong>Approve</strong></td>
<td align="center" valign="middle" ><strong>Reject</strong></td>
<td align="center" valign="middle" ><strong>Total</strong></td>
<td align="center" valign="middle" ><strong>Approve %</strong></td>
</tr>

<?php
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
		}else{$s5=number_format($row['PER_APPROVE'], 2);}?>

<tr>
<td align="center" valign="middle" ><?php echo $s1; ?></td>
<td align="center" valign="middle" ><?php echo $s2; ?></td>
<td align="center" valign="middle" ><?php echo $s3; ?></td>
<td align="center" valign="middle" ><?php echo $s4; ?></td>
<td align="center" valign="middle" ><?php echo $s5; ?></td>

</tr>
<?php

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
?>

<tr>
<td align="center" valign="middle" ><?php echo $s1; ?></td>
<td align="center" valign="middle" ><?php echo $s2; ?></td>
<td align="center" valign="middle" ><?php echo $s3; ?></td>
<td align="center" valign="middle" ><?php echo $s4; ?></td>
<td align="center" valign="middle" ><?php echo $s5; ?></td>

</tr>

<?php
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
?>
<tr>
<td align="center" valign="middle" ><?php echo $s1; ?></td>
<td align="center" valign="middle" ><?php echo $s2; ?></td>
<td align="center" valign="middle" ><?php echo $s3; ?></td>
<td align="center" valign="middle" ><?php echo $s4; ?></td>
<td align="center" valign="middle" ><?php echo $s5; ?></td>

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
