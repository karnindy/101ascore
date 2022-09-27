<?php
include("../database/connect.php");
require_once('dropdownsClass.php');

$dropdown = new Dropdown();

if($_POST['id'] == 'business_type'){
    $options = "";
    $sql = "select region_name_display
            from prepare_master_step2
            where business_type = '#business_type#'
            group by region_name_display
            order by region_name_display asc";
    $sql = str_replace('#business_type#', $_POST['value'], $sql);
    $query = oci_parse($conn, $sql);
    oci_execute ($query,OCI_DEFAULT);
    $options = $options."<option value='รวมทุกภาค' selected>รวมทุกภาค</option>";
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
        $str = "<option value='" . $row['REGION_NAME_DISPLAY'] . "'>" . $row['REGION_NAME_DISPLAY'] . "</option>";
        $options = $options.$str;
    }
    // $dropdown->set_model_type($_POST['value']);

    echo $options;
} else if($_POST['id'] == 'product_type'){
    $options = "";
    $sql = "select model_type_display
            from prepare_master_step2
            where 1=1 
            and  ('#product_type_display#' = 'รวมทุกประเภทสินเชื่อ' 
            or product_type_display = '#product_type_display#')
            group by model_type_display
            order by model_type_display asc";
    $sql = str_replace('#product_type_display#', $_POST['value'], $sql);
    
    echo $sql;

    $query = oci_parse($conn, $sql);
    oci_execute ($query,OCI_DEFAULT);
    $options = $options."<option disabled selected value=''>--โปรดเลือก--</option>";
    if($_POST['value'] == "รวมทุกประเภทสินเชื่อ"){
        $options = $options."<option value='รวมทุกประเภทโมเดล'>รวมทุกประเภทโมเดล</option>";
    }
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
        $str = "<option value='" . $row['MODEL_TYPE_DISPLAY'] . "'>" . $row['MODEL_TYPE_DISPLAY'] . "</option>";
        $options = $options.$str;
    }
    $dropdown->set_model_type($_POST['value']);

    echo $options;

} else if($_POST['id'] == 'model_type'){
    $options = "";
    $sql = "select card_type_display
            from prepare_master_step2
            where 1=1 
            and  ('#model_type_display#' = 'รวมทุกประเภทโมเดล' 
            or model_type_display = '#model_type_display#')
            group by card_type_display
            order by card_type_display asc";
    $sql = str_replace('#model_type_display#', $_POST['value'], $sql);
    $query = oci_parse($conn, $sql);
    oci_execute ($query,OCI_DEFAULT);
    if($_POST['type'] == "insert"){
        $options = $options."<option disabled selected value=''>--โปรดเลือก--</option>";
    } else {
        $options = $options."<option value='รวมทุกประเภทบัตร' selected>รวมทุกประเภทบัตร</option>";
    }
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
        $str = "<option value='" . $row['CARD_TYPE_DISPLAY'] . "'>" . $row['CARD_TYPE_DISPLAY'] . "</option>";
        $options = $options.$str;
    }
    $dropdown->set_product_type_name($_POST['value']);

    echo $options;

} else if ($_POST['id'] == 'region_name') {
	$options = "";
	$sql = "select zone_name_display
            from prepare_master_step2
            where region_name_display in ('#region_name_display#')
            group by zone_name_display
            order by zone_name_display asc";
    $sql = str_replace("#region_name_display#", $_POST['value'], $sql);
    $query = oci_parse($conn, $sql);
    oci_execute ($query,OCI_DEFAULT);
    $options = $options."<option value='รวมทุกเขต' selected value=''>รวมทุกเขต</option>";
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
    	$str = "<option value='" . $row['ZONE_NAME_DISPLAY'] . "'>" . $row['ZONE_NAME_DISPLAY'] . "</option>";
        $options = $options.$str;
    }
    $dropdown->set_region_name($_POST['value']);

    echo $options;

} else if ($_POST['id'] == "zone_name") {
	$options = "";
    $sql = "select branch_name_display
        from prepare_master_step2
        where region_name_display in ('#region_name_display#')
        and zone_name_display in ('#zone_name_display#')
        group by branch_name_display
        order by branch_name_display asc";
        $sql = str_replace("#region_name_display#", $_GET['region'], $sql);
    $sql = str_replace("#zone_name_display#", $_POST['value'], $sql);
    $query = oci_parse($conn, $sql);
    oci_execute ($query,OCI_DEFAULT);
    $options = $options."<option value='รวมทุกสาขา' selected value=''>รวมทุกสาขา</option>";
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
    	$str = "<option value='" . $row['BRANCH_NAME_DISPLAY'] . "'>" . $row['BRANCH_NAME_DISPLAY'] . "</option>";
        $options = $options.$str;
    }
    $dropdown->set_zone_name($_POST['value']);

    echo $options;
} else {
    if($_POST['id'] == 'card_type'){
        $dropdown->set_card_type($_POST['value']);
    } else if ($_POST['id'] == 'model_type'){
        $dropdown->set_model_type($_POST['value']);
    } else if ($_POST['id'] == 'branch_name'){
        $dropdown->set_branch_name($_POST['value']);
    } else if ($_POST['id'] == 'model_version'){
        $dropdown->set_model_version($_POST['value']);
    } else if ($_POST['id'] == 'sales_channel'){
        $dropdown->set_sales_channel($_POST['value']);
    }
}
?>