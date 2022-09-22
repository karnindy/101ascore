<?php
//tab1-300
//tab2
//tab3
//tab4
//tab5
?>
<?php 
include('../server/server.php');
include('../query/dropdown.php');
include('../query/query_tab1.php');
include('../query/query_tab2.php');
include('../query/query_tab3.php');
include('../query/query_tab4.php');
include('../query/query_tab5.php');

$tab=$_POST["tab"];
$nowpage=$_POST["page"];
$ref_id=$_POST['ref_id'];
$ref_card=$_POST['ref_card'];
$ref_sequence=$_POST['ref_sequence'];

$appl_id_aam=$_POST['appl_id_aam'];
if($appl_id_aam==''){
	$appl_id_aam='Donut@Poseidons!@';
}
$product_type=$_POST['product_type'];
$card_type=$_POST['card_type'];
$cid=$_POST['cid'];
if($cid==''){
	$cid='Donut@Poseidons!@';
}
$region_name=$_POST['region_name'];
$zone_name=$_POST['zone_name'];
$branch_name=$_POST['branch_name'];
$ca2_appl_result_code=$_POST['ca2_appl_result_code'];


$create_start_date=$_POST['create_start_date'];
$create_end_date=$_POST['create_end_date'];
$update_start_date=$_POST['update_start_date'];
$update_end_date=$_POST['update_end_date'];

$create_start_date=date("d/m/Y",strtotime($create_start_date));
$create_end_date=date("d/m/Y",strtotime($create_end_date));
$update_start_date=date("d/m/Y",strtotime($update_start_date));
$update_end_date=date("d/m/Y",strtotime($update_end_date));
//เพิ่ม
//$create_start_date=str_replace('1970','2001',$create_start_date);
//$update_start_date=str_replace('1970','2001',$update_start_date);
//$create_start_date=date("d/m/y",strtotime($create_start_date));
//$create_end_date=date("d/m/y",strtotime($create_end_date));
//$update_start_date=date("d/m/y",strtotime($update_start_date));
//$update_end_date=date("d/m/y",strtotime($update_end_date));
//เพิ่มถึงนี่
?>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- =========================================================================== TAB 1 ============================================================================ -->
<!-- =========================================================================== TAB 1 ============================================================================ -->
<!-- =========================================================================== TAB 1 ============================================================================ -->
<!-- =========================================================================== TAB 1 ============================================================================ -->
<!-- =========================================================================== TAB 1 ============================================================================ -->
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<?php
switch ($tab) {
case "1":
$i=0;
$check=0;

$sql=tab1($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
$objParse = oci_parse($conn, $sql);
// echo $sql;
oci_execute ($objParse,OCI_DEFAULT);
while($row = oci_fetch_array($objParse,OCI_BOTH)){
$i++;
}
$alldata=$i;
$perpage=25;
// $alldata=$row['ALLDATA'];
$allpage=ceil($alldata/$perpage);
$firstdata=$nowpage*$perpage-24;
$firstquery=$firstdata-1;
$lastdata=$nowpage*$perpage;
$backpage=$nowpage-1;
$nextpage=$nowpage+1;
if ($nowpage==$allpage) {
$lastdata=$nowpage*$perpage-$alldata;
$lastdata=$nowpage*$perpage-$lastdata;
}
if($alldata==0){
$nowpage=0;
$allpage=0;
$firstdata=0;
$firstquery=0;
$lastdata=0;
$backpage=0;
$nextpage=0;
}
$num=$firstquery;
?>
<br>
<tr>
	<td>
		<h3 align="left" style="background-color: #feccff;"><b>&nbsp;&nbsp;1.รายงานการค้นหาและแสดงผลใบคำขอสินเชื่อ</b></h3>
	</td>
</tr>
<table style="width: 90%;" border="0">
		<tr>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','1')" value="หน้าแรก">
			</li>
			</ul>
			</nav>
			</td>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $backpage ?>')" value="ก่อนหน้า">
			</li>
			</ul>
			</nav>
			</td>
			<td class="font-weight-bold " style="width: 80%;" align="right">
				<?php echo "หน้าทั้งหมด: ".$allpage." "; ?>
				<?php echo "หน้าปัจจุบัน: ".$nowpage." "; ?>
				<?php echo "ข้อมูลปัจจุบัน: ".$firstdata."-".$lastdata."/".$alldata; ?>
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $nextpage ?>')" value="ถัดไป">
			</li>				
			</ul>
			</nav>			
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $allpage ?>')" value="หน้าสุดท้าย">
			</li>
			</ul>
			</nav>
			</td>
		</tr>
	</table>



<?php
// echo $sql;

?>
<table class="table table-hover ">
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
$check=1;
// include('../query/query.php');
// $sql=tab1($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
// echo $sql;
if($check=="1"){
	$sql=$sql."OFFSET $firstquery ROWS FETCH NEXT $perpage ROWS ONLY";
}
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
	while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>
<tbody style="font-size: 14px;">
	<tr>
		<td align="center">
			<?php echo $num=$num+1 ?>
		</td>
		<td style="cursor:pointer; color: blue;" data-toggle="modal" data-target="#myModal" onclick="se_more('<?php echo $row['APPL_ID_AAM']; ?>','<?php echo $row['CARD_TYPE']; ?>','<?php echo $row['MAX_CALC_SEQUENCE']; ?>')">
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
			<?php echo $row['CIF']; ?>
		</td>
		<td align="center">
			<?php echo $row['CID']; ?>
		</td>
		<td>
			<?php echo $row['CUSTOMER_NAME']; ?>
		</td>
		<td align="center">
			<?php if($row['SCORE']!=null){echo $row['SCORE'];}else{echo "-";} ?>
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
			<?php echo $row['CA2_APPL_RESULT_CODE']; ?>
		</td>
	</tr>

<?php
	}
?>
</tbody>
</table>

<table style="width: 90%;" border="0">
		<tr>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','1')" value="หน้าแรก">
			</li>
			</ul>
			</nav>
			</td>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $backpage ?>')" value="ก่อนหน้า">
			</li>
			</ul>
			</nav>
			</td>
			<td class="font-weight-bold " style="width: 80%;" align="center">
				<?php echo "หน้าทั้งหมด: ".$allpage." "; ?>
				<?php echo "หน้าปัจจุบัน: ".$nowpage." "; ?>
				<?php echo "ข้อมูลปัจจุบัน: ".$firstdata."-".$lastdata."/".$alldata; ?>
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $nextpage ?>')" value="ถัดไป">
			</li>				
			</ul>
			</nav>			
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $allpage ?>')" value="หน้าสุดท้าย">
			</li>
			</ul>
			</nav>
			</td>
		</tr>
	</table>

<?php
break;
?>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- =========================================================================== TAB 2 ============================================================================ -->
<!-- =========================================================================== TAB 2 ============================================================================ -->
<!-- =========================================================================== TAB 2 ============================================================================ -->
<!-- =========================================================================== TAB 2 ============================================================================ -->
<!-- =========================================================================== TAB 2 ============================================================================ -->
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<?php
case "2":
// echo "TAB 2";
// 
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
	$appl_id_aam=$ref_id;
	$card_type=$ref_card;
	$calc_sequence=$ref_sequence;
	$sql=tab2_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
	$sql=tab2_1($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}

$objParse = oci_parse($conn, $sql);
// echo $sql;
oci_execute ($objParse,OCI_DEFAULT);
$row = oci_fetch_array($objParse,OCI_BOTH); 
?>
<h3 align="left" style="background-color: #feccff;"><b>&nbsp;&nbsp;2.รายงานข้อมูลใบคำขอสินเชื่อ</b></h3>
<table style="width:70%" class="table" border="0">
	<thead>
		<tr>
			<td colspan="4" style="background-color: #feccff;">
				<h4>ข้อมูลใบคำขอสินเชื่อ</h4>
			</td>
		</tr>
	</thead>
	<tr>
		<td style="width:25%">
			เลขที่ใบสมัคร
		</td>
		<td style="width:25%">
			<?php if($row['APPL_ID_AAM']!=null){echo $row['APPL_ID_AAM'];}else{echo "-";}  ?>
		</td>
		<td style="width:25%">
			ประเภทสินเชื่อ
		</td>
		<td style="width:25%">
			<?php if($row['PRODUCT_TYPE']!=null){echo $row['PRODUCT_TYPE'];}else{echo "-";}  ?>
		</td>
	</tr>
	<tr>
		<td>
			วันที่บันทึกข้อมูล
		</td>
		<td>
			<?php if($row['CREATE_DATE']!=null){echo date("d/m/Y",strtotime($row['CREATE_DATE']));}else{echo "-";}  ?>
		</td>
		<td>
			ประเภทบัตร
		</td>
		<td>
			<?php if($row['CARD_TYPE']!=null){echo $row['CARD_TYPE'];}else{echo "-";}  ?>
		</td>
	</tr>
	<tr>
		<td>
			วงเงินบัตร/สินเชื่อ
		</td>
		<td>
			<?php if($row['CA2_CR_LIMIT_AMT']!=null){echo $row['CA2_CR_LIMIT_AMT'];}else{echo "-";}  ?>
		</td>
		<td>
			สถานะใบสมัคร
		</td>
		<td>
			<?php if($row['APPL_STATUS']!=null){echo $row['APPL_STATUS'];}else{echo "-";}  ?>
		</td>
	</tr>
	<tr>
		<td>
			ภาค/ฝ่าย
		</td>
		<td>
			<?php if($row['REGION_NAME']!=null){echo $row['REGION_NAME'];}else{echo "-";}  ?>
		</td>
		<td>
			เขต/ส่วน
		</td>
		<td>
			<?php if($row['ZONE_NAME']!=null){echo $row['ZONE_NAME'];}else{echo "-";}  ?>
		</td>
	</tr>
	<tr>
		<td>
			สาขา/หน่วย
		</td>
		<td>
			<?php if($row['BRANCH_NAME']!=null){echo $row['BRANCH_NAME'];}else{echo "-";}  ?>
		</td>
		<td>
			โปรแกรมผลิตภัณฑ์
		</td>
		<td>
			<?php if($row['PRODUCT_PROGRAM']!=null){echo $row['PRODUCT_PROGRAM'];}else{echo "-";}  ?>
		</td>
	</tr>
	<tr>
		<td>
			วิธีการชำระเงิน
		</td>
		<td>
			<?php if($row['PAYMENT_METHOD']!=null){echo $row['PAYMENT_METHOD'];}else{echo "-";}  ?>
		</td>
		<td>
			ช่องทางการขาย
		</td>
		<td>
			<?php if($row['SALES_CHANNEL']!=null){echo $row['SALES_CHANNEL'];}else{echo "-";}  ?>
		</td>
	</tr>
</table>
<?php
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
	$sql=tab2_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
	$sql=tab2_1($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
$objParse = oci_parse($conn, $sql);
// echo $sql;
oci_execute ($objParse,OCI_DEFAULT);
$row = oci_fetch_array($objParse,OCI_BOTH); ?>
<table style="width:70%" class="table" border="0">
	<thead>
		<tr>
			<td colspan="4" style="background-color: #feccff;">
				<h4 >ข้อมูลคะแนน</h4>
			</td>
		</tr>
	</thead>
		<tr>
			<td style="width:25%">
				วันที่คำนวณ
			</td>
			<td style="width:25%">
				<?php if($row['REQ_REQUEST_DATE']!=null){echo $row['REQ_REQUEST_DATE'];}else{echo "-";} ?>
			</td>
			<td style="width:25%">
				Seqeunce
			</td>
			<td style="width:25%">
				<?php if($row['MAX_CALC_SEQUENCE']!=null){echo $row['MAX_CALC_SEQUENCE'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				Score
			</td>
			<td>
				<?php if($row['SCORE']!=null){echo $row['SCORE'];}else{echo "-";} ?>
			</td>
			<td>
				Grade
			</td>
			<td>
				<?php if($row['MAX_SEQ_TOTAL_GRADE']!=null){echo $row['MAX_SEQ_TOTAL_GRADE'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				คำอธิบาย
			</td>
			<td>
				<?php if($row['MAX_SEQ_TOTAL_GRADE_DESC']!=null){echo $row['MAX_SEQ_TOTAL_GRADE_DESC'];}else{echo "-";} ?>
			</td>
			<td>
				NCB Score
			</td>
			<td>
				<?php if($row['SCORE_GRADE']!=null){echo $row['SCORE_GRADE'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				ผู้ประมวลผลคะแนน
			</td>
			<td>
				<?php if($row['UPDATE_BY']!=null){echo $row['UPDATE_BY'];}else{echo "-";} ?>
			</td>
			<td>
				
			</td>
			<td>

			</td>
		</tr>
</table>
<?php
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
	$sql=tab2_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
	$sql=tab2_1($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
$row = oci_fetch_array($objParse,OCI_BOTH); ?>
<table style="width:70%" class="table" border="0">
	<thead>
		<tr>
			<td colspan="4" style="background-color: #feccff;">
				<h4>ข้อมูลการพิจารณาสินเชื่อ</h4>
			</td>
		</tr>
	</thead>
		<tr>
			<td style="width:25%">
				วันที่พิจารณา
			</td>
			<td style="width:25%">
				<?php if($row['UPDATE_DATE']!=null){echo date("d/m/Y",strtotime($row['UPDATE_DATE']));}else{echo "-";} ?>
			</td>
			<td style="width:25%">
				ผลการพิจารณา
			</td>
			<td style="width:25%">
				<?php if($row['CA2_APPL_RESULT_CODE']!=null){echo $row['CA2_APPL_RESULT_CODE'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				ผู้วิเคราะห์ 1 (CA1)
			</td>
			<td>
				<?php if($row['CA1_APPROVE_BY']!=null){echo $row['CA1_APPROVE_BY'];}else{echo "-";} ?>
			</td>
			<td>
				ผู้วิเคราะห์ 2 (CA2)
			</td>
			<td>
				<?php if($row['CA2_APPROVE_BY']!=null){echo $row['CA2_APPROVE_BY'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				DTI (%) ที่คำนวนได้
			</td>
			<td>
				<?php if($row['CA2_TOTAL_DTI_PERC']!=null){echo $row['CA2_TOTAL_DTI_PERC'];}else{echo "-";} ?>
			</td>
			<td>
				VIP
			</td>
			<td>
				<?php if($row['VIP_FLAG']!=null){echo $row['VIP_FLAG'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				เหตุผลประกอบ
			</td>
			<td>
				<?php if($row['CA2_DVTN_REJ_REASON_CODE']!=null){echo $row['CA2_DVTN_REJ_REASON_CODE'];}else{echo "-";} ?>
			</td>
			<td>
				
			</td>
			<td>

			</td>
		</tr>
</table>
<?php
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
	$sql=tab2_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
	$sql=tab2_1($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
$row = oci_fetch_array($objParse,OCI_BOTH); ?>
<table style="width:70%" class="table" border="0">
	<thead>
		<tr>
			<td colspan="4" style="background-color: #feccff;">
				<h4>ข้อมูลผู้สมัครสินเชื่อ</h4>
			</td>
		</tr>
	</thead>
	<tr>
		<td style="width:25%">CIF</td>
		<td style="width:25%">
			<?php if($row['CIF']!=''){ echo $row['CIF'];}else{ echo '-';} ?>
		</td>
		<td style="width:25%">เพศ</td>
		<td style="width:25%">
			<?php if($row['GENDER']!=''){ echo $row['GENDER'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>ชื่อ-นามสกุล</td>
		<td>
			<?php if($row['CUSTOMER_NAME']!=''){ echo $row['CUSTOMER_NAME'];}else{ echo '-';} ?>
		</td>
		<td>วัน/เดือน/ปีเกิด</td>
		<td>
			<?php if($row['AGE']==''){ echo $row['AGE'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>อายุ</td>
		<td>
			<?php if($row['AGE']!=''){ echo $row['AGE'];}else{ echo '-';} ?>
		</td>
		<td>ระดับการศึกษา</td>
		<td>
			<?php if($row['EDUCATION_LEVEL']!=''){ echo $row['EDUCATION_LEVEL'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>บัตรประจำตัวประชาชน</td>
		<td>
			<?php if($row['CID']!=''){ echo $row['CID'];}else{ echo '-';} ?>
		</td>
		<td>สถานภาพสมรส</td>
		<td>
			<?php if($row['MARITAL_STATUS']!=''){ echo $row['MARITAL_STATUS'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>ที่อยู่ปัจจุบัน</td>
		<td>
			<?php if($row['CURRENT_PROVINCE']!=''){ echo $row['CURRENT_PROVINCE'];}else{ echo '-';} ?>
		</td>
		<td>โทรศัพท์บ้าน</td>
		<td>
			<?php if($row['LEGAL_HOME_NUMBER']!=''){ echo $row['LEGAL_HOME_NUMBER'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>ที่อยู่ตามทะเบียนบ้าน</td>
		<td>
			<?php if($row['LEGAL_PROVINCE']!=''){ echo $row['LEGAL_PROVINCE'];}else{ echo '-';} ?>
		</td>
		<td>โทรศัพท์ที่ทำงาน</td>
		<td>
			<?php if($row['OFFICE_NUMBER']!=''){ echo $row['OFFICE_NUMBER'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>โทรศัพท์มือถือ</td>
		<td>
			<?php if($row['LEGAL_MOBILE_NUMBER']!=''){ echo $row['LEGAL_MOBILE_NUMBER'];}else{ echo '-';} ?>
		</td>
		<td>สถานะที่อยู่อาศัย</td>
		<td>
			<?php if($row['CURRENT_RESIDENTIAL_STATUS']!=''){ echo $row['CURRENT_RESIDENTIAL_STATUS'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>จำนวนบุตร</td>
		<td>
			<?php if($row['NO_OF_CHILDREN']!=''){ echo $row['NO_OF_CHILDREN'];}else{ echo '-';} ?>
		</td>
		<td>แหล่งที่มาของสินทรัพย์</td>
		<td>
			<?php if($row['SOURCE_OF_ASSET']!=''){ echo $row['SOURCE_OF_ASSET'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>มูลค่าสินทรัพย์รวมสุทธิโดยประมาณ</td>
		<td>
			<?php if($row['ESTIMATE_ASSET_VALUE']!=''){ echo $row['ESTIMATE_ASSET_VALUE'];}else{ echo '-';} ?>
		</td>
		<td>สถานะภาพการทำงาน</td>
		<td>
			<?php if($row['EMPLOMENT_STATUS_CODE']!=''){ echo $row['EMPLOMENT_STATUS_CODE'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>อาชีพ</td>
		<td>
			<?php if($row['OCCUPATION_CODE']!=''){ echo $row['OCCUPATION_CODE'];}else{ echo '-';} ?>
		</td>
		<td>สาขาอาชีพ</td>
		<td>
			<?php if($row['PROFESSIONAL_CODE']!=''){ echo $row['PROFESSIONAL_CODE'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>ประเภทธุรกิจ</td>
		<td>
			<?php if($row['BUSINESS_TYPE_CODE']!=''){ echo $row['BUSINESS_TYPE_CODE'];}else{ echo '-';} ?>
		</td>
		<td>ประเภทธุรกิจย่อย</td>
		<td>
			<?php if($row['SUB_BUSINESS_TYPE_CODE']!='SUB_BUSINESS_TYPE_CODE'){ echo $row['SUB_BUSINESS_TYPE_CODE'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>อายุงาน</td>
		<td>
			<?php if($row['TIME_IN_JOB']!=''){ echo $row['TIME_IN_JOB'];}else{ echo '-';} ?>
		</td>
		<td>ประมาณการรายได้ต่อเดือน (บาท)</td>
		<td>
			<?php if($row['ESTIMATE_INCOME_PER_MONTH']!=''){ echo $row['ESTIMATE_INCOME_PER_MONTH'];}else{ echo '-';} ?>
		</td>		
</tr>
<tr>
		<td>เงินเดือน (บาท)</td>
		<td>
			<?php if($row['SALARY_AMT']!=''){ echo $row['SALARY_AMT'];}else{ echo '-';} ?>
		</td>
		<td>ค่าครองชีพ/ค่าตำแหน่ง/รายได้ประจำอื่น ๆ (บาท)</td>
		<td>
			<?php if($row['OT_M1_AMT']!=''){ echo $row['OT_M1_AMT'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>ค่าล่วงเวลา (บาท)</td>
		<td>
			<?php if($row['OT_M2_AMT']!=''){ echo $row['OT_M2_AMT'];}else{ echo '-';} ?>
		</td>
		<td>ค่าคอมมิชชั่น (บาท)</td>
		<td>
			<?php if($row['OT_M3_AMT']!=''){ echo $row['OT_M3_AMT'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>รวมรายได้ทั้งหมด (บาท)</td>
		<td>
			<?php if($row['FINAL_MNTH_INC_AMT']!=''){ echo $row['FINAL_MNTH_INC_AMT'];}else{ echo '-';} ?>
		</td>
		<td>รวมรายได้ตามเกณฑ์ทั้งหมด (บาท)</td>
		<td>
			<?php if($row['TOTAL_MNTH_INC_AMT']!=''){ echo $row['TOTAL_MNTH_INC_AMT'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>รวมภาระหนี้เดิมทั้งหมดต่อเดือน (บาท)</td>
		<td>
			<?php if($row['TOTAL_DEBT_AMT']!=''){ echo $row['TOTAL_DEBT_AMT'];}else{ echo '-';} ?>
		</td>
		<td></td>
		<td>
			
		</td>
		
</tr>
</table>
<table style="width:70%" class="table" align="canter">
	<thead>
		<tr>
			<td colspan="4" style="background-color: #feccff;">
				<h4>ข้อมูลปัจจัยสำหรับ Score</h4>
			</td>
		</tr>
	</thead>
	<tr style="background-color: #feccff; font-weight: bold;" align="center">
		<td style="width:25%">
			ชื่อปัจจัย
		</td>
		<td style="width:25%">
			code
		</td>
		<td style="width:25%">
			รายละเอียด
		</td>
		<td style="width:25%">
			คะแนน
		</td>
	</tr>
<?php
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
	$sql=tab2_4($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
	$sql=tab2_2($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>

	<tr>
		<td>
			<?php if($row['FACTOR_NAME']!=null){echo $row['FACTOR_NAME'];}else{echo "-";} ?>
		</td>
		<td align="center">
			<?php if($row['FACTOR_CODE']!=null){echo $row['FACTOR_CODE'];}else{echo "-";} ?>
		</td>		
		<td>
			<?php if($row['FACTOR_DESC']!=null){echo $row['FACTOR_DESC'];}else{echo "-";} ?>
		</td>
		<td align="center">
			<?php if($row['FACTOR_SCORE']!=null){echo $row['FACTOR_SCORE'];}else{echo "-";} ?>
		</td>
	</tr>
<?php } ?>
</table>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- =========================================================================== TAB 3 ============================================================================ -->
<!-- =========================================================================== TAB 3 ============================================================================ -->
<!-- =========================================================================== TAB 3 ============================================================================ -->
<!-- =========================================================================== TAB 3 ============================================================================ -->
<!-- =========================================================================== TAB 3 ============================================================================ -->
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<?php
break;
case "3":
$i=0;
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
	$appl_id_aam=$ref_id;
	$card_type=$ref_card;
	$calc_sequence=$ref_sequence;
$sql=tab3_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
$sql=tab3_1($appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
$objParse = oci_parse($conn, $sql);
// echo $sql;
oci_execute ($objParse,OCI_DEFAULT);
while($row = oci_fetch_array($objParse,OCI_BOTH)){
$i++;
}
$alldata=$i;
$perpage=25;
// $alldata=$row['ALLDATA'];
$allpage=ceil($alldata/$perpage);
$firstdata=$nowpage*$perpage-24;
$firstquery=$firstdata-1;
$lastdata=$nowpage*$perpage;
$backpage=$nowpage-1;
$nextpage=$nowpage+1;
if ($nowpage==$allpage) {
$lastdata=$nowpage*$perpage-$alldata;
$lastdata=$nowpage*$perpage-$lastdata;
}
if($alldata==0){
$nowpage=0;
$allpage=0;
$firstdata=0;
$firstquery=0;
$lastdata=0;
$backpage=0;
$nextpage=0;
}
$num=$firstquery;
?>
<br>
<table style="width: 90%;" border="0">
		<tr>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','1')" value="หน้าแรก">
			</li>
			</ul>
			</nav>
			</td>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $backpage ?>')" value="ก่อนหน้า">
			</li>
			</ul>
			</nav>
			</td>
			<td class="font-weight-bold " style="width: 80%;" align="right">
				<?php echo "หน้าทั้งหมด: ".$allpage." "; ?>
				<?php echo "หน้าปัจจุบัน: ".$nowpage." "; ?>
				<?php echo "ข้อมูลปัจจุบัน: ".$firstdata."-".$lastdata."/".$alldata; ?>
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $nextpage ?>')" value="ถัดไป">
			</li>				
			</ul>
			</nav>			
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $allpage ?>')" value="หน้าสุดท้าย">
			</li>
			</ul>
			</nav>
			</td>
		</tr>
	</table>
<h3 align="left" style="background-color: #feccff;"><b>&nbsp;&nbsp;3.รายงานข้อมูลใบคำขอทุก Sequence</b></h3>
<table class="table table-hover">
	<thead style="font-size: 14px; background-color: #feccff;">
		<tr>
			<td>
				ลำดับ
			</td>
			<td>
				เลขที่ใบสมัคร
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
				Sequence
			</td>
			<td>
				วันที่คำนวณ
			</td>
			<td>
				วันที่ออกผลพิจารณา
			</td>
			<td>
				ผลการพิจารณา
			</td>
		</tr>
	</thead>
<?php
// $num='0';
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
	$appl_id_aam=$ref_id;
	$card_type=$ref_card;
	$calc_sequence=$ref_sequence;
$sql=tab3_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
$sql=tab3_1($appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
	$sql=$sql."OFFSET $firstquery ROWS FETCH NEXT $perpage ROWS ONLY";
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
while($row = oci_fetch_array($objParse,OCI_BOTH)){ 
	$ary_id[]=$row['APPL_ID_AAM'];
	$ary_card[]=$row['CARD_TYPE'];
	// $ary_sequence[]=$row['MAX_CALC_SEQUENCE'];
	?>
	<tr style="font-size: 14px;">
		<td align="center">
			<?php echo $num=$num+1 ?>
		</td>
		<td>
			<?php if($row['APPL_ID_AAM']!=null){echo $row['APPL_ID_AAM'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['CREATE_DATE']!=null){echo date("d/m/Y",strtotime($row['CREATE_DATE']));}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['BRANCH_NAME']!=null){echo $row['BRANCH_NAME'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['PRODUCT_TYPE']!=null){echo $row['PRODUCT_TYPE'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['CARD_TYPE']!=null){echo $row['CARD_TYPE'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['CA2_CR_LIMIT_AMT']!=null){echo number_format($row['CA2_CR_LIMIT_AMT'], 2);}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['CIF']!=null){echo $row['CIF'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['CID']!=null){echo $row['CID'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['CUSTOMER_NAME']!=null){echo $row['CUSTOMER_NAME'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['SCORE']!=null){echo $row['SCORE'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['MAX_SEQ_TOTAL_GRADE']!=null){echo $row['MAX_SEQ_TOTAL_GRADE'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['MAX_CALC_SEQUENCE']!=null){echo $row['MAX_CALC_SEQUENCE'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['REQ_REQUEST_DATE']!=null){echo $row['REQ_REQUEST_DATE'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['UPDATE_DATE_AAM']!=null){echo date("d/m/Y",strtotime($row['UPDATE_DATE_AAM']));}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['CA2_APPL_RESULT_CODE']!=null){echo $row['CA2_APPL_RESULT_CODE'];}else{echo "-";} ?>
		</td>
	</tr>
<?php } ?>
	</table>

	<table align="left" style="width: 50%;">
<tr align="center" style="background-color: #feccff; font-weight: bold;">
	<td>
		เลขที่ใบสมัคร
	</td>
	<td>
		Sequence
	</td>
	<td>
		วันที่คำนวณ
	</td>
	<td>
		Score
	</td>
	<td>
		Grade
	</td>
	<td>
		วันที่ออกผลพิจารณา
	</td>
	<td>
		ผลพิจารณา
	</td>
</tr>
<?php
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
$sql=tab3_4($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
while($row = oci_fetch_array($objParse,OCI_BOTH)){ 
	?>
<tr align="center">
	<td>
		<?php if($row['APPL_ID_AAM']!=null){echo $row['APPL_ID_AAM'];}else{echo "-";} ?>
	</td>
	<td style="cursor:pointer; color: blue;" onclick="se_ref('<?php echo $row['APPL_ID_AAM']; ?>','<?php echo $row['CARD_TYPE']; ?>','<?php echo $row['CALC_SEQUENCE']; ?>'),se_tab(4)">
		<a><?php if($row['CALC_SEQUENCE']!=null){echo $row['CALC_SEQUENCE'];}else{echo "-";} ?></a>
	</td>
	<td>
		<?php if($row['REQ_REQUEST_DATE']!=null){echo date("d/m/Y",strtotime($row['REQ_REQUEST_DATE']));}else{echo "-";} ?>
	</td>
	<td>
		<?php if($row['SCORE']!=null){echo $row['SCORE'];}else{echo "-";} ?>
	</td>
	<td>
		<?php if($row['MAX_SEQ_TOTAL_GRADE']!=null){echo $row['MAX_SEQ_TOTAL_GRADE'];}else{echo "-";} ?>
	</td>
	<td>
		<?php if($row['UPDATE_DATE_AAM']!=null){echo date("d/m/Y",strtotime($row['UPDATE_DATE_AAM']));}else{echo "-";} ?>
	</td>
	<td>
		<?php if($row['CA2_APPL_RESULT_CODE']!=null){echo $row['CA2_APPL_RESULT_CODE'];}else{echo "-";} ?>
	</td>
</tr>
<?php 
} ?>
</table>

<?php
}else{

	for($nat=0;$nat<$num;$nat++){
	// echo $nat;
	$appl_id_aam=$ary_id[$nat];
	// echo $num;
	$card_type=$ary_card[$nat];
		$sql=tab3_2($appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
while($row = oci_fetch_array($objParse,OCI_BOTH)){ 
	?>
<tr align="center">
	<td>
		<?php if($row['APPL_ID_AAM']!=null){echo $row['APPL_ID_AAM'];}else{echo "-";} ?>
	</td>
	<td style="cursor:pointer; color: blue;" onclick="se_ref('<?php echo $row['APPL_ID_AAM']; ?>','<?php echo $row['CARD_TYPE']; ?>','<?php echo $row['CALC_SEQUENCE']; ?>'),se_tab(4)">
		<a><?php if($row['CALC_SEQUENCE']!=null){echo $row['CALC_SEQUENCE'];}else{echo "-";} ?></a>
	</td>
	<td>
		<?php if($row['REQ_REQUEST_DATE']!=null){echo date("d/m/Y",strtotime($row['REQ_REQUEST_DATE']));}else{echo "-";} ?>
	</td>
	<td>
		<?php if($row['SCORE']!=null){echo $row['SCORE'];}else{echo "-";} ?>
	</td>
	<td>
		<?php if($row['MAX_SEQ_TOTAL_GRADE']!=null){echo $row['MAX_SEQ_TOTAL_GRADE'];}else{echo "-";} ?>
	</td>
	<td>
		<?php if($row['UPDATE_DATE_AAM']!=null){echo date("d/m/Y",strtotime($row['UPDATE_DATE_AAM']));}else{echo "-";} ?>
	</td>
	<td>
		<?php if($row['CA2_APPL_RESULT_CODE']!=null){echo $row['CA2_APPL_RESULT_CODE'];}else{echo "-";} ?>
	</td>
</tr>
<?php 
} ?>
<?php
}
}
// echo $sql;
?>
</table>
<table style="width: 90%;" border="0">
		<tr>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','1')" value="หน้าแรก">
			</li>
			</ul>
			</nav>
			</td>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $backpage ?>')" value="ก่อนหน้า">
			</li>
			</ul>
			</nav>
			</td>
			<td class="font-weight-bold " style="width: 80%;" align="center">
				<?php echo "หน้าทั้งหมด: ".$allpage." "; ?>
				<?php echo "หน้าปัจจุบัน: ".$nowpage." "; ?>
				<?php echo "ข้อมูลปัจจุบัน: ".$firstdata."-".$lastdata."/".$alldata; ?>
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $nextpage ?>')" value="ถัดไป">
			</li>				
			</ul>
			</nav>			
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $allpage ?>')" value="หน้าสุดท้าย">
			</li>
			</ul>
			</nav>
			</td>
		</tr>
	</table>
<!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- ============================================================================= TAB 4 =========================================================================== -->
<!-- ============================================================================= TAB 4 =========================================================================== -->
<!-- ============================================================================= TAB 4 =========================================================================== -->
<!-- ============================================================================= TAB 4 =========================================================================== -->
<!-- ============================================================================= TAB 4 =========================================================================== -->
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<?php
break;
case "4":
// echo "TAB 4";
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
	$appl_id_aam=$ref_id;
	$card_type=$ref_card;
	$calc_sequence=$ref_sequence;
$sql=tab4_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
$sql=tab4_1($appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
$objParse = oci_parse($conn, $sql);
// echo $sql;
oci_execute ($objParse,OCI_DEFAULT);
$row = oci_fetch_array($objParse,OCI_BOTH); 
?>
<h3 align="left" style="background-color: #feccff;"><b>&nbsp;&nbsp;4.รายงานข้อมูลการคำนวณ</b></h3>
<table style="width:70%" class="table" border="0">
	<thead>
		<tr>
			<td colspan="4" style="background-color: #feccff;">
				<h4>ข้อมูลใบคำขอสินเชื่อ</h4>
			</td>
		</tr>
	</thead>
	<tr>
		<td style="width:25%">
			เลขที่ใบสมัคร
		</td>
		<td style="width:25%">
			<?php if($row['APPL_ID_AAM']!=null){echo $row['APPL_ID_AAM'];}else{echo "-";}  ?>
		</td>
		<td style="width:25%">
			ประเภทสินเชื่อ
		</td>
		<td style="width:25%">
			<?php if($row['PRODUCT_TYPE']!=null){echo $row['PRODUCT_TYPE'];}else{echo "-";}  ?>
		</td>
	</tr>
	<tr>
		<td>
			วันที่บันทึกข้อมูล
		</td>
		<td>
			<?php if($row['CREATE_DATE']!=null){echo date("d/m/Y",strtotime($row['CREATE_DATE']));}else{echo "-";}  ?>
		</td>
		<td>
			ประเภทบัตร
		</td>
		<td>
			<?php if($row['CARD_TYPE']!=null){echo $row['CARD_TYPE'];}else{echo "-";}  ?>
		</td>
	</tr>
	<tr>
		<td>
			วงเงินบัตร/สินเชื่อ
		</td>
		<td>
			<?php if($row['CA2_CR_LIMIT_AMT']!=null){echo $row['CA2_CR_LIMIT_AMT'];}else{echo "-";}  ?>
		</td>
		<td>
			สถานะใบสมัคร
		</td>
		<td>
			<?php if($row['APPL_STATUS']!=null){echo $row['APPL_STATUS'];}else{echo "-";}  ?>
		</td>
	</tr>
	<tr>
		<td>
			ภาค/ฝ่าย
		</td>
		<td>
			<?php if($row['REGION_NAME']!=null){echo $row['REGION_NAME'];}else{echo "-";}  ?>
		</td>
		<td>
			เขต/ส่วน
		</td>
		<td>
			<?php if($row['ZONE_NAME']!=null){echo $row['ZONE_NAME'];}else{echo "-";}  ?>
		</td>
	</tr>
	<tr>
		<td>
			สาขา/หน่วย
		</td>
		<td>
			<?php if($row['BRANCH_NAME']!=null){echo $row['BRANCH_NAME'];}else{echo "-";}  ?>
		</td>
		<td>
			โปรแกรมผลิตภัณฑ์
		</td>
		<td>
			<?php if($row['PRODUCT_PROGRAM']!=null){echo $row['PRODUCT_PROGRAM'];}else{echo "-";}  ?>
		</td>
	</tr>
	<tr>
		<td>
			วิธีการชำระเงิน
		</td>
		<td>
			<?php if($row['PAYMENT_METHOD']!=null){echo $row['PAYMENT_METHOD'];}else{echo "-";}  ?>
		</td>
		<td>
			ช่องทางการขาย
		</td>
		<td>
			<?php if($row['SALES_CHANNEL']!=null){echo $row['SALES_CHANNEL'];}else{echo "-";}  ?>
		</td>
	</tr>
</table>
<?php
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
$sql=tab4_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
$sql=tab4_1($appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
$objParse = oci_parse($conn, $sql);
// echo $sql;
oci_execute ($objParse,OCI_DEFAULT);
$row = oci_fetch_array($objParse,OCI_BOTH); ?>
<table style="width:70%" class="table" border="0">
	<thead>
		<tr>
			<td colspan="4" style="background-color: #feccff;">
				<h4>ข้อมูลคะแนน</h4>
			</td>
		</tr>
	</thead>
		<tr>
			<td style="width:25%">
				วันที่คำนวณ
			</td>
			<td style="width:25%">
				<?php if($row['REQ_REQUEST_DATE']!=null){echo $row['REQ_REQUEST_DATE'];}else{echo "-";} ?>
			</td>
			<td style="width:25%">
				Seqeunce
			</td>
			<td style="width:25%">
				<?php if($row['MAX_CALC_SEQUENCE']!=null){echo $row['MAX_CALC_SEQUENCE'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				Score
			</td>
			<td>
				<?php if($row['SCORE']!=null){echo $row['SCORE'];}else{echo "-";} ?>
			</td>
			<td>
				Grade
			</td>
			<td>
				<?php if($row['MAX_SEQ_TOTAL_GRADE']!=null){echo $row['MAX_SEQ_TOTAL_GRADE'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				คำอธิบาย
			</td>
			<td>
				<?php if($row['MAX_SEQ_TOTAL_GRADE_DESC']!=null){echo $row['MAX_SEQ_TOTAL_GRADE_DESC'];}else{echo "-";} ?>
			</td>
			<td>
				NCB Score
			</td>
			<td>
				<?php if($row['SCORE_GRADE']!=null){echo $row['SCORE_GRADE'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				ผู้ประมวลผลคะแนน
			</td>
			<td>
				<?php if($row['UPDATE_BY']!=null){echo $row['UPDATE_BY'];}else{echo "-";} ?>
			</td>
			<td>
				
			</td>
			<td>

			</td>
		</tr>
</table>
<?php
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
$sql=tab4_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
$sql=tab4_1($appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
$row = oci_fetch_array($objParse,OCI_BOTH); ?>
<table style="width:70%" class="table" border="0">
	<thead>
		<tr>
			<td colspan="4" style="background-color: #feccff;">
				<h4>ข้อมูลการพิจารณาสินเชื่อ</h4>
			</td>
		</tr>
	</thead>
		<tr>
			<td style="width:25%">
				วันที่พิจารณา
			</td>
			<td style="width:25%">
				<?php if($row['UPDATE_DATE']!=null){echo date("d/m/Y",strtotime($row['UPDATE_DATE']));}else{echo "-";} ?>
			</td>
			<td style="width:25%">
				ผลการพิจารณา
			</td>
			<td style="width:25%">
				<?php if($row['CA2_APPL_RESULT_CODE']!=null){echo $row['CA2_APPL_RESULT_CODE'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				ผู้วิเคราะห์ 1 (CA1)
			</td>
			<td>
				<?php if($row['CA1_APPROVE_BY']!=null){echo $row['CA1_APPROVE_BY'];}else{echo "-";} ?>
			</td>
			<td>
				ผู้วิเคราะห์ 2 (CA2)
			</td>
			<td>
				<?php if($row['CA2_APPROVE_BY']!=null){echo $row['CA2_APPROVE_BY'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				DTI (%) ที่คำนวนได้
			</td>
			<td>
				<?php if($row['CA2_TOTAL_DTI_PERC']!=null){echo $row['CA2_TOTAL_DTI_PERC'];}else{echo "-";} ?>
			</td>
			<td>
				VIP
			</td>
			<td>
				<?php if($row['VIP_FLAG']!=null){echo $row['VIP_FLAG'];}else{echo "-";} ?>
			</td>
		</tr>
		<tr>
			<td>
				เหตุผลประกอบ
			</td>
			<td>
				<?php if($row['CA2_DVTN_REJ_REASON_CODE']!=null){echo $row['CA2_DVTN_REJ_REASON_CODE'];}else{echo "-";} ?>
			</td>
			<td>
				
			</td>
			<td>

			</td>
		</tr>
</table>
<?php
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
$sql=tab4_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
$sql=tab4_1($appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
$row = oci_fetch_array($objParse,OCI_BOTH); ?>
<table style="width:70%" class="table" border="0">
	<thead>
		<tr>
			<td colspan="4" style="background-color: #feccff;">
				<h4>ข้อมูลผู้สมัครสินเชื่อ</h4>
			</td>
		</tr>
	</thead>
	<tr>
		<td style="width:25%">CIF</td>
		<td style="width:25%">
			<?php if($row['CIF']!=''){ echo $row['CIF'];}else{ echo '-';} ?>
		</td>
		<td style="width:25%">เพศ</td>
		<td style="width:25%">
			<?php if($row['GENDER']!=''){ echo $row['GENDER'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>ชื่อ-นามสกุล</td>
		<td>
			<?php if($row['CUSTOMER_NAME']!=''){ echo $row['CUSTOMER_NAME'];}else{ echo '-';} ?>
		</td>
		<td>วัน/เดือน/ปีเกิด</td>
		<td>
			<?php if($row['AGE']==''){ echo $row['AGE'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>อายุ</td>
		<td>
			<?php if($row['AGE']!=''){ echo $row['AGE'];}else{ echo '-';} ?>
		</td>
		<td>ระดับการศึกษา</td>
		<td>
			<?php if($row['EDUCATION_LEVEL']!=''){ echo $row['EDUCATION_LEVEL'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>บัตรประจำตัวประชาชน</td>
		<td>
			<?php if($row['CID']!=''){ echo $row['CID'];}else{ echo '-';} ?>
		</td>
		<td>สถานภาพสมรส</td>
		<td>
			<?php if($row['MARITAL_STATUS']!=''){ echo $row['MARITAL_STATUS'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>ที่อยู่ปัจจุบัน</td>
		<td>
			<?php if($row['CURRENT_PROVINCE']!=''){ echo $row['CURRENT_PROVINCE'];}else{ echo '-';} ?>
		</td>
		<td>โทรศัพท์บ้าน</td>
		<td>
			<?php if($row['LEGAL_HOME_NUMBER']!=''){ echo $row['LEGAL_HOME_NUMBER'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>ที่อยู่ตามทะเบียนบ้าน</td>
		<td>
			<?php if($row['LEGAL_PROVINCE']!=''){ echo $row['LEGAL_PROVINCE'];}else{ echo '-';} ?>
		</td>
		<td>โทรศัพท์ที่ทำงาน</td>
		<td>
			<?php if($row['OFFICE_NUMBER']!=''){ echo $row['OFFICE_NUMBER'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>โทรศัพท์มือถือ</td>
		<td>
			<?php if($row['LEGAL_MOBILE_NUMBER']!=''){ echo $row['LEGAL_MOBILE_NUMBER'];}else{ echo '-';} ?>
		</td>
		<td>สถานะที่อยู่อาศัย</td>
		<td>
			<?php if($row['CURRENT_RESIDENTIAL_STATUS']!=''){ echo $row['CURRENT_RESIDENTIAL_STATUS'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>จำนวนบุตร</td>
		<td>
			<?php if($row['NO_OF_CHILDREN']!=''){ echo $row['NO_OF_CHILDREN'];}else{ echo '-';} ?>
		</td>
		<td>แหล่งที่มาของสินทรัพย์</td>
		<td>
			<?php if($row['SOURCE_OF_ASSET']!=''){ echo $row['SOURCE_OF_ASSET'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>มูลค่าสินทรัพย์รวมสุทธิโดยประมาณ</td>
		<td>
			<?php if($row['ESTIMATE_ASSET_VALUE']!=''){ echo $row['ESTIMATE_ASSET_VALUE'];}else{ echo '-';} ?>
		</td>
		<td>สถานะภาพการทำงาน</td>
		<td>
			<?php if($row['EMPLOMENT_STATUS_CODE']!=''){ echo $row['EMPLOMENT_STATUS_CODE'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>อาชีพ</td>
		<td>
			<?php if($row['OCCUPATION_CODE']!=''){ echo $row['OCCUPATION_CODE'];}else{ echo '-';} ?>
		</td>
		<td>สาขาอาชีพ</td>
		<td>
			<?php if($row['PROFESSIONAL_CODE']!=''){ echo $row['PROFESSIONAL_CODE'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>ประเภทธุรกิจ</td>
		<td>
			<?php if($row['BUSINESS_TYPE_CODE']!=''){ echo $row['BUSINESS_TYPE_CODE'];}else{ echo '-';} ?>
		</td>
		<td>ประเภทธุรกิจย่อย</td>
		<td>
			<?php if($row['SUB_BUSINESS_TYPE_CODE']!='SUB_BUSINESS_TYPE_CODE'){ echo $row['SUB_BUSINESS_TYPE_CODE'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>อายุงาน</td>
		<td>
			<?php if($row['TIME_IN_JOB']!=''){ echo $row['TIME_IN_JOB'];}else{ echo '-';} ?>
		</td>
		<td>ประมาณการรายได้ต่อเดือน (บาท)</td>
		<td>
			<?php if($row['ESTIMATE_INCOME_PER_MONTH']!=''){ echo $row['ESTIMATE_INCOME_PER_MONTH'];}else{ echo '-';} ?>
		</td>		
</tr>
<tr>
		<td>เงินเดือน (บาท)</td>
		<td>
			<?php if($row['SALARY_AMT']!=''){ echo $row['SALARY_AMT'];}else{ echo '-';} ?>
		</td>
		<td>ค่าครองชีพ/ค่าตำแหน่ง/รายได้ประจำอื่น ๆ (บาท)</td>
		<td>
			<?php if($row['OT_M1_AMT']!=''){ echo $row['OT_M1_AMT'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>ค่าล่วงเวลา (บาท)</td>
		<td>
			<?php if($row['OT_M2_AMT']!=''){ echo $row['OT_M2_AMT'];}else{ echo '-';} ?>
		</td>
		<td>ค่าคอมมิชชั่น (บาท)</td>
		<td>
			<?php if($row['OT_M3_AMT']!=''){ echo $row['OT_M3_AMT'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>รวมรายได้ทั้งหมด (บาท)</td>
		<td>
			<?php if($row['FINAL_MNTH_INC_AMT']!=''){ echo $row['FINAL_MNTH_INC_AMT'];}else{ echo '-';} ?>
		</td>
		<td>รวมรายได้ตามเกณฑ์ทั้งหมด (บาท)</td>
		<td>
			<?php if($row['TOTAL_MNTH_INC_AMT']!=''){ echo $row['TOTAL_MNTH_INC_AMT'];}else{ echo '-';} ?>
		</td>
</tr>
<tr>
		<td>รวมภาระหนี้เดิมทั้งหมดต่อเดือน (บาท)</td>
		<td>
			<?php if($row['TOTAL_DEBT_AMT']!=''){ echo $row['TOTAL_DEBT_AMT'];}else{ echo '-';} ?>
		</td>
		<td></td>
		<td>
			
		</td>
		
</tr>
</table>
<table style="width:70%" class="table" border="0">
	<thead>
		<tr>
			<td colspan="5" style="background-color: #feccff;">
				<h4>ข้อมูลปัจจัยสำหรับ Score</h4>
			</td>
		</tr>
	</thead>
	<tr style="background-color: #feccff; font-weight: bold;" align="center">
		<td style="width:10%">
			Sequence
		</td>
		<td style="width:25%">
			ชื่อปัจจัย
		</td>
		<td style="width:25%">
			code
		</td>
		<td style="width:25%">
			รายละเอียด
		</td>
		<td style="width:15%">
			คะแนน
		</td>
	</tr>
<?php
if ($ref_id!=null and $ref_card!=null and $ref_sequence!=null) {
$sql=tab4_4($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}else{
$sql=tab4_2($appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
}
// echo $sql;
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>

	<tr>
		<td align="center">
			<?php if($row['CALC_SEQUENCE']!=null){echo $row['CALC_SEQUENCE'];}else{echo "-";} ?>
		</td>
		<td>
			<?php if($row['FACTOR_NAME']!=null){echo $row['FACTOR_NAME'];}else{echo "-";} ?>
		</td>
		<td align="center">
			<?php if($row['FACTOR_CODE']!=null){echo $row['FACTOR_CODE'];}else{echo "-";} ?>
		</td>		
		<td>
			<?php if($row['FACTOR_DESC']!=null){echo $row['FACTOR_DESC'];}else{echo "-";} ?>
		</td>
		<td align="center">
			<?php if($row['FACTOR_SCORE']!=null){echo $row['FACTOR_SCORE'];}else{echo "-";} ?>
		</td>
	</tr>
<?php } ?>
</table>
<script type="text/javascript">
 re_ref();
</script>
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- ============================================================================= TAB 5 =========================================================================== -->
<!-- ============================================================================= TAB 5 =========================================================================== -->
<!-- ============================================================================= TAB 5 =========================================================================== -->
<!-- ============================================================================= TAB 5 =========================================================================== -->
<!-- ============================================================================= TAB 5 =========================================================================== -->
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<?php
break;
case "5":
// echo "TAB 5";
$i=0;
$check=0;
$sql=tab5($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
while($row = oci_fetch_array($objParse,OCI_BOTH)){
$i++;
}
$alldata=$i;
$perpage=25;
// $alldata=$row['ALLDATA'];
$allpage=ceil($alldata/$perpage);
$firstdata=$nowpage*$perpage-24;
$firstquery=$firstdata-1;
$lastdata=$nowpage*$perpage;
$backpage=$nowpage-1;
$nextpage=$nowpage+1;
if ($nowpage==$allpage) {
$lastdata=$nowpage*$perpage-$alldata;
$lastdata=$nowpage*$perpage-$lastdata;
}
if($alldata==0){
$nowpage=0;
$allpage=0;
$firstdata=0;
$firstquery=0;
$lastdata=0;
$backpage=0;
$nextpage=0;
}
$num=$firstquery;
?>
<br>
<tr>
	<td>
		<h3 align="left" style="background-color: #feccff;"><b>&nbsp;&nbsp;5.รายงานการค้นหาและแสดงผลใบคำขอสินเชื่อเพื่อส่งออกข้อมูล</b></h3>
	</td>
</tr>
<table style="width: 90%;" border="0">
		<tr>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','1')" value="หน้าแรก">
			</li>
			</ul>
			</nav>
			</td>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $backpage ?>')" value="ก่อนหน้า">
			</li>
			</ul>
			</nav>
			</td>
			<td class="font-weight-bold " style="width: 80%;" align="right">
				<?php echo "หน้าทั้งหมด: ".$allpage." "; ?>
				<?php echo "หน้าปัจจุบัน: ".$nowpage." "; ?>
				<?php echo "ข้อมูลปัจจุบัน: ".$firstdata."-".$lastdata."/".$alldata; ?>
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $nextpage ?>')" value="ถัดไป">
			</li>				
			</ul>
			</nav>			
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $allpage ?>')" value="หน้าสุดท้าย">
			</li>
			</ul>
			</nav>
			</td>
		</tr>
	</table>



<?php


?>
<table class="table table-hover ">
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
$check=1;
// include('../query/query.php');
// $sql=tab1($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
// echo $sql;
if($check=="1"){
	$sql=$sql."OFFSET $firstquery ROWS FETCH NEXT $perpage ROWS ONLY";
}
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
	while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>
<tbody style="font-size: 14px;">
	<tr>
		<td align="center">
			<?php echo $num=$num+1 ?>
		</td>
		<td <?php if($tab!='5'){?> style="cursor:pointer; color: blue;" data-toggle="modal" data-target="#myModal" onclick="se_more('<?php echo $row['APPL_ID_AAM']; ?>')" <?php } ?> >
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
			<?php echo $row['CIF']; ?>
		</td>
		<td align="center">
			<?php echo $row['CID']; ?>
		</td>
		<td>
			<?php echo $row['CUSTOMER_NAME']; ?>
		</td>
		<td align="center">
			<?php if($row['SCORE']!=null){echo $row['SCORE'];}else{echo "-";} ?>
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
			<?php echo $row['CA2_APPL_RESULT_CODE']; ?>
		</td>
	</tr>

<?php
	}
?>
</tbody>
</table>

<table style="width: 90%;" border="0">
		<tr>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','1')" value="หน้าแรก">
			</li>
			</ul>
			</nav>
			</td>
			<td align="left">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage<=1){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $backpage ?>')" value="ก่อนหน้า">
			</li>
			</ul>
			</nav>
			</td>
			<td class="font-weight-bold " style="width: 80%;" align="center">
				<?php echo "หน้าทั้งหมด: ".$allpage." "; ?>
				<?php echo "หน้าปัจจุบัน: ".$nowpage." "; ?>
				<?php echo "ข้อมูลปัจจุบัน: ".$firstdata."-".$lastdata."/".$alldata; ?>
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $nextpage ?>')" value="ถัดไป">
			</li>				
			</ul>
			</nav>			
			</td>
			<td align="right">
			<nav aria-label="Page navigation example">
			<ul class="pagination">
			<li class="page-item">
				<input class="page-link" type="button"<?php if($nowpage>=$allpage){ ?> disabled="" <?php } ?> onclick="changepage('<?php echo $tab ?>','<?php echo $allpage ?>')" value="หน้าสุดท้าย">
			</li>
			</ul>
			</nav>
			</td>
		</tr>
	</table>

<?php
break;

default:
}
?>