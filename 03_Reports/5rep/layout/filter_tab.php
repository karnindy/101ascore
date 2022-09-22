<?php 
include('../server/server.php');
include('../query/dropdown.php');
date_default_timezone_set("Asia/Bangkok");
$tab=$_POST["tab"];
$ref_id=$_POST["ref_id"];
$ref_card=$_POST["ref_card"];
$ref_sequence=$_POST["ref_sequence"];

$appl_id_aam=$_POST['appl_id_aam'];

$product_type=$_POST['product_type'];


$card_type=$_POST['card_type'];


$cid=$_POST['cid'];


$region_name=$_POST['region_name'];


$zone_name=$_POST['zone_name'];


$branch_name=$_POST['branch_name'];


$ca2_appl_result_code=$_POST['ca2_appl_result_code'];


$create_start_date=$_POST['create_start_date'];
$create_start_date_std=$_POST['create_start_date'];

$create_end_date=$_POST['create_end_date'];
$create_end_date_std=$_POST['create_end_date'];

$update_start_date=$_POST['update_start_date'];
$update_start_date_std=$_POST['update_start_date'];

$update_end_date=$_POST['update_end_date'];
$update_end_date_std=$_POST['update_end_date'];

if ($create_start_date==null) {
	$create_start_date='1';
	$create_start_date_std=$create_start_date;
}
if ($create_end_date==null) {
	$create_end_date='1';
	// $create_end_date=date("Y-m-d");
	$create_end_date_std=$create_end_date;
}
if ($update_start_date==null) {
	$update_start_date='1';
	$update_start_date_std=$update_start_date;
}
if ($update_end_date==null) {
	$update_end_date='1';
	// $update_end_date=date("Y-m-d");
	$update_end_date_std=$update_end_date;
}

$create_start_date=date("d/m/Y",strtotime($create_start_date));
$create_end_date=date("d/m/Y",strtotime($create_end_date));
$update_start_date=date("d/m/Y",strtotime($update_start_date));
$update_end_date=date("d/m/Y",strtotime($update_end_date));
// echo $create_start_date;
// echo $create_end_date_std;
// echo $update_start_date;
// echo $update_end_date_std;
// if ($create_end_date=='') {
// $create_end_date= date("Y-m-d");
// }
// if ($update_end_date=='') {
// $update_end_date= date("Y-m-d");
// }


if ($ref_id!="" or $ref_id!=null) {
$sql=ref($ref_id,$ref_card,$ref_sequence,$tab);
$objParse = oci_parse($conn, $sql);
oci_execute ($objParse,OCI_DEFAULT);
$row = oci_fetch_array($objParse,OCI_BOTH);

$appl_id_aam=$row['APPL_ID_AAM'];
$product_type=$row['PRODUCT_TYPE'];
$card_type=$row['CARD_TYPE'];
$cid=$row['CID'];
$region_name=$row['REGION_NAME'];
$zone_name=$row['ZONE_NAME'];
$branch_name=$row['BRANCH_NAME'];
$ca2_appl_result_code=$row['CA2_APPL_RESULT_CODE'];

if ($row['UPDATE_DATE_AAM']!="") {
	$update_end_date=date("d/m/Y",strtotime($row['UPDATE_DATE_AAM']));
	$update_end_date_std=date("Y-m-d",strtotime($row['UPDATE_DATE_AAM']));
}

if ($row['CREATE_DATE']!="") {
	$create_end_date=date("d/m/Y",strtotime($row['CREATE_DATE']));
	$create_end_date_std=date("Y-m-d",strtotime($row['CREATE_DATE']));
}
}else{$ref_id="1";}

?>
<div <?php if ($tab=="2" or $tab=="4") { ?> style="display: none;" <?php } ?>>
<table border="0">
	<tr>
		<td colspan="6" align="left">
			ตัวกรองข้อมูล
		</td>
	</tr>

	<tr <?php if ($tab!="3") { ?> style="display: none;" <?php } ?>>
		<td align="right">
			เลขที่ใบสมัคร
		</td>
		<td>
			<input class="form-control" type="text" id="appl_id_aam" value="<?php echo $appl_id_aam; ?>" onkeyup="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')">
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
	</tr>

	<tr>
		<td align="right">
			ประเภทสินเชื่อ
		</td>
		<td>
			<select class="form-control" id="product_type" onchange="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')">
				<option  selected value="1">--เลือกค่า--</option>
<?php
	$sql=dd_product_type($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
	$objParse = oci_parse($conn, $sql);
	oci_execute ($objParse,OCI_DEFAULT);
	while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>
	<option <?php if($product_type==$row['PRODUCT_TYPE']){ ?> selected <?php } ?> value="<?php echo $row['PRODUCT_TYPE']; ?>"><?php echo $row['PRODUCT_TYPE']; ?></option>
<?php
}
?>
			</select>
		</td>
		<td align="right">
			ประเภทบัตร	

		</td>
		<td>
			<select class="form-control" id="card_type" onchange="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')">
				<option  selected value="1">--เลือกค่า--</option>
<?php
	$sql=dd_card_type($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
	$objParse = oci_parse($conn, $sql);
	oci_execute ($objParse,OCI_DEFAULT);
	while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>
	<option <?php if($card_type==$row['CARD_TYPE']){ ?> selected <?php } ?> ><?php echo $row['CARD_TYPE']; ?></option>
<?php
}
?>
			</select>
		</td>
		<td align="right">
			เลขที่บัตรประชาชน
		</td>
		<td>
			<input class="form-control" type="text" id="cid" maxlength="13" value="<?php echo $cid; ?>" onkeyup="re_ref(),check_13(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')">
		</td>
	</tr>
	<tr>
		<td align="right">
			ภาค/ฝ่าย
		</td>
		<td>
			<select class="form-control" id="region_name" onchange="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')">
				<option  selected value="1">--เลือกค่า--</option>
<?php
	$sql=dd_region_name($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
	$objParse = oci_parse($conn, $sql);
	oci_execute ($objParse,OCI_DEFAULT);
	while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>
	<option <?php if($region_name==$row['REGION_NAME']){ ?> selected <?php } ?> value="<?php echo $row['REGION_NAME']; ?>"><?php echo $row['REGION_NAME']; ?></option>
<?php
}
?>
				

			</select>
		</td>
		<td align="right">
			เขต/ส่วน
		</td>
		<td>
			<select class="form-control" id="zone_name" onchange="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')">
				<option  selected value="1">--เลือกค่า--</option>
<?php
	$sql=dd_zone_name($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
	$objParse = oci_parse($conn, $sql);
	oci_execute ($objParse,OCI_DEFAULT);
	while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>
	<option <?php if($zone_name==$row['ZONE_NAME']){ ?> selected <?php } ?> value="<?php echo $row['ZONE_NAME']; ?>"><?php echo $row['ZONE_NAME']; ?></option>
<?php
}
?>
				

			</select>
		</td>
		<td align="right">
			สาขา/หน่วย
		</td>
		<td>
			<select class="form-control" id="branch_name" onchange="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')">
				<option  selected value="1">--เลือกค่า--</option>
<?php
	$sql=dd_branch_name($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
	$objParse = oci_parse($conn, $sql);
	oci_execute ($objParse,OCI_DEFAULT);
	while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>
	<option <?php if($branch_name==$row['BRANCH_NAME']){ ?> selected <?php } ?> value="<?php echo $row['BRANCH_NAME']; ?>"><?php echo $row['BRANCH_NAME']; ?></option>
<?php
}
?>
				

			</select>
		</td>
	</tr>
		<tr>
		<td align="right">
			ผลการพิจารณา
		</td>
		<td>
			<select class="form-control" onchange="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')" id="ca2_appl_result_code">
				<option  selected value="1">--เลือกค่า--</option>
<?php
	$sql=dd_ca2_appl_result_code($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code);
	$objParse = oci_parse($conn, $sql);
	oci_execute ($objParse,OCI_DEFAULT);
	while($row = oci_fetch_array($objParse,OCI_BOTH)){ ?>
	<option <?php if($ca2_appl_result_code==$row['CA2_APPL_RESULT_CODE']){ ?> selected <?php } ?> value="<?php echo $row['CA2_APPL_RESULT_CODE']; ?>"><?php echo $row['CA2_APPL_RESULT_CODE']; ?></option>
<?php
}
?>
				

			</select>
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
	</tr>
	<tr>
		<td align="right">
			วันที่บันทึกข้อมูล
		</td>
		<td >
			<input  type="date" value="<?php echo $create_start_date_std; ?>" id="create_start_date" onchange="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')"> 
			ถึง <input  type="date" value="<?php echo $create_end_date_std; ?>" id="create_end_date" onchange="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')">
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
		<td align="right">
			<input class="btn btn-danger" type="button" onclick="re_ref(),re(<?php echo $tab ?>,1)" value="รีเฟรช">
		</td>
	</tr>
	<tr>
		<td align="right">
			วันที่ออกผลพิจารณา
		</td>
		<td>
			<input type="date" value="<?php echo $update_start_date_std; ?>" id="update_start_date" onchange="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')"> 
			ถึง <input type="date" value="<?php echo $update_end_date_std; ?>" id="update_end_date" onchange="re_ref(),se_filter_tab(<?php echo $tab ?>,'<?php echo $ref_id ?>','<?php echo $ref_card ?>','<?php echo $ref_sequence ?>')">
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
		<td align="right">
<?php if($tab=="5"){ ?>


		<input type="button" class="btn btn-outline-danger" onclick="export_pdf()" value="export PDF">
		<input type="button" class="btn btn-outline-dark" onclick="export_txt()" value="export TXT">
        <input type="button" class="btn btn-outline-secondary" onclick="export_csv()" value="export CSV">
        <input type="button" class="btn btn-outline-success" onclick="export_xls()" value="export XLS">
        
<!-- <section>
  <div  class="wrapper">
    <div class="buttonxx" onclick="export_pdf()">
      <div class="icon">
        <i class="fa-solid fa-file-pdf"></i>
      </div>
      <span>Export PDF</span>
    </div>
    <div class="buttonxx" onclick="export_xls()">
      <div class="icon">
        <i class="fa-solid fa-file-excel"></i>
      </div>
      <span>Export XLS</span>
    </div>
    <div class="buttonxx" onclick="export_txt()">
      <div class="icon">
        <i class="fa-solid fa-file-lines"></i>
      </div>
      <span>Export TXT</span>
    </div>
    <div class="buttonxx" onclick="export_csv()">
      <div class="icon">
        <i class="fa-solid fa-file-csv"></i>
      </div>
      <span>Export CSV</span>
    </div>
  
</section> -->


<?php }?>
		</td>

	</tr>
</table>
</div>