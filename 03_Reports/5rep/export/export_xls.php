<?php
include('../server/server.php');
include('../query/dropdown.php');
include('../query/query_tab1.php');
include('../query/query_tab2.php');
include('../query/query_tab3.php');
include('../query/query_tab4.php');
include('../query/query_tab5.php');
// --------------------------
$FileNmae="Export_XLS.xls";
header("Content-Type: application/x-msexcel; name=\"$FileNmae\"");
header("Content-Disposition: inline; filename=\"$FileNmae\"");
header("Pragma:no-cache");
// --------------------------

// $tab=$_GET["tab"];
// $nowpage=$_GET["page"];
// $ref=$_GET['ref'];

$appl_id_aam=$_GET['appl_id_aam'];
if($appl_id_aam==''){
	$appl_id_aam='Donut@Poseidons!@';
}
$product_type=$_GET['product_type'];
$card_type=$_GET['card_type'];
$cid=$_GET['cid'];
if($cid==''){
	$cid='Donut@Poseidons!@';
}
$region_name=$_GET['region_name'];
$zone_name=$_GET['zone_name'];
$branch_name=$_GET['branch_name'];
$ca2_appl_result_code=$_GET['ca2_appl_result_code'];


$create_start_date=$_GET['create_start_date'];
$create_end_date=$_GET['create_end_date'];
$update_start_date=$_GET['update_start_date'];
$update_end_date=$_GET['update_end_date'];

$create_start_date=date("d/m/Y",strtotime($create_start_date));
$create_end_date=date("d/m/Y",strtotime($create_end_date));
$update_start_date=date("d/m/Y",strtotime($update_start_date));
$update_end_date=date("d/m/Y",strtotime($update_end_date));
$num=0;
?>
<br>
<table>
<tr>
	<td colspan="16">
		5.รายงานการค้นหาและแสดงผลใบคำขอสินเชื่อเพื่อส่งออกข้อมูล
	</td>
</tr>
<tr>
	<td colspan="16">
	</td>
</tr>
</table>

<?php


?>
<table class="table table-hover " border="1">
	<thead align="center" style="font-size: 14px; background-color: #feccff;">
	<tr>
		<td>
			ลำดับ
		</td>
		<td>
			เลขที่ใบสมัคร
		</td>
		<td>
			sequence
		</td>
		<td>
			วันที่บันทึกข้อมูล
		</td>
		<td>
			สาขา/หน่วย
		</td>
		<td>
			ประเภทสินเชื่อ
		</td>
		<td>
			ประเภทบัตร
		</td>
		<td>
			วงเงินบัตร/สินเชื่อ
		</td>
		<td>
			เลข CIF
		</td>
		<td>
			เลขที่บัตรประชาชน
		</td>
		<td>
			ชื่อ-นามสกุล ลูกค้า
		</td>
		<td>
			Score
		</td>
		<td>
			Grade
		</td>
		<td>
			วันที่คำนวณ
		</td>
		<td>
			วันที่ออกผลพิจรณา
		</td>
		<td>
			ผลพิจรณา
		</td>
	</tr>
</thead>
<?php
$sql=tab5($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
// echo $sql;
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
	while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>
<tbody style="font-size: 14px;">
	<tr>
		<td align="center">
			<?php echo $num=$num+1 ?>
		</td>
		<td>
			<a><?php echo $row['APPL_ID_AAM']; ?></a>
		</td>
		<td align="center">
			<?php echo $row['MAX_CALC_SEQUENCE']; ?>
		</td>
		<td align="center">
			<?php echo date("d/m/Y",strtotime($row['CREATE_DATE'])); ?>
		</td>
		<td>
			<?php echo $row['BRANCH_NAME']; ?>
		</td>
		<td>
			<?php echo $row['PRODUCT_TYPE']; ?>
		</td>
		<td>
			<?php echo $row['CARD_TYPE']; ?>
		</td>
		<td align="center">
			<?php echo number_format($row['CA2_CR_LIMIT_AMT'], 2); ?>

		</td>
		<td align="left">
			<?php echo $row['CIF']; ?>&nbsp
		</td>
		<td align="center">
			<?php echo $row['CID']; ?>&nbsp
		</td>
		<td>
			<?php echo $row['CUSTOMER_NAME']; ?>
		</td>
		<td align="center">
			<?php if($row['SCORE']!=null){echo $row['SCORE'];}else{echo "-";} ?>&nbsp
		</td>
		<td align="center">
			<?php echo $row['MAX_SEQ_TOTAL_GRADE']; ?>
		</td>
		<td align="center">
			<?php if($row['REQ_REQUEST_DATE']!=null){echo $row['REQ_REQUEST_DATE'];}else{echo "-";} ?>
		</td>
		<td align="center">
			<?php echo date("d/m/Y",strtotime($row['UPDATE_DATE_AAM'])); ?>
		</td>
		<td align="center">
			<?php echo $row['CA2_APPL_RESULT_CODE']; ?>&nbsp
		</td>
	</tr>

<?php
	}
?>
</tbody>
</table>

</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>
