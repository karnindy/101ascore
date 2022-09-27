<?php
include("../database/connect.php");
// --------------------------
$FileNmae="Report7_XLS.xls";
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
<td align="center" valign="middle" rowspan='2' ><strong>Score Range</strong></td>
<td align="center" valign="middle" colspan='4' ><strong>Currentt Validation Sample(%)</strong></td>
<td align="center" valign="middle" colspan='4' ><strong>Development Sample(%)</strong></td>

</tr>
<tr>

<td align="center" valign="middle" ><strong>% Cum_G</strong></td>
<td align="center" valign="middle" ><strong>% Cum_B</strong></td>
<td align="center" valign="middle" ><strong>Sep_BG</strong></td>
<td align="center" valign="middle" ><strong>% BadRate(Current)</strong></td>
<td align="center" valign="middle" ><strong>% Cum_G</strong></td>
<td align="center" valign="middle" ><strong>% Cum_B</strong></td>
<td align="center" valign="middle" ><strong>Sep_BG</strong></td>
<td align="center" valign="middle" ><strong>% BadRate(Dev)</strong></td>
</tr>

<?php
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    
    	$s1=$row['SCORE_RANGE_DESC'];
		// $s2=number_format($row['PER_CUM_G_CURR'], 2);
		// $s3=number_format($row['PER_CUM_B_CURR'], 2);
		// $s4=number_format($row['SEP_BG_CURR'], 2);
		// $s5=number_format($row['PER_BAD_RATE_CURR'], 2);
		// $s6=number_format($row['PER_GOOD_DEV'], 2);
		// $s7=number_format($row['PER_BAD_DEV'], 2);
		// $s8=number_format($row['SEP_BG_DEV'], 2);
		// $s9=number_format($row['PER_BAD_RATE_DEV'], 2);

		if ($row['PER_CUM_G_CURR']== '') {
			$s2="";
		}else{$s2=number_format($row['PER_CUM_G_CURR'], 2);}

		if ($row['PER_CUM_B_CURR']== '') {
			$s3="";
		}else{$s3=number_format($row['PER_CUM_B_CURR'], 2);}

		if ($row['SEP_BG_CURR']== '') {
			$s4="";
		}else{$s4=number_format($row['SEP_BG_CURR'], 2);}

		if ($row['PER_BAD_RATE_CURR']== '') {
			$s5="";
		}else{$s5=number_format($row['PER_BAD_RATE_CURR'], 2);}

		if ($row['PER_GOOD_DEV']== '') {
			$s6="";
		}else{$s6=number_format($row['PER_GOOD_DEV'], 2);}

		if ($row['PER_BAD_DEV']== '') {
			$s7="";
		}else{$s7=number_format($row['PER_BAD_DEV'], 2);}

		if ($row['SEP_BG_DEV']== '') {
			$s8="";
		}else{$s8=number_format($row['SEP_BG_DEV'], 2);}

		if ($row['PER_BAD_RATE_DEV']== '') {
			$s9="";
		}else{$s9=number_format($row['PER_BAD_RATE_DEV'], 2);}

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
