<?php
include("../database/connect.php");
require_once('dropdownsClass.php');

$dropdown = new Dropdown();

function factors_query() {
    $options = "";
    $sql = "select factor_display 
            from factor_master_map
            where product_type = '#product_type_display#'
            and model_name = '#model_type_display#'
            and ('รวมทุกประเภทบัตร' = 'รวมทุกประเภทบัตร' and card_type = '#card_type_display#')
            group by factor_display";
	$sql = str_replace('#product_type_display#', $_GET['product_type'], $sql);
	$sql = str_replace('#model_type_display#', $_GET['model_type'], $sql);
	$sql = str_replace('#card_type_display#', $_GET['card_type'], $sql);
    $query = oci_parse($conn, $sql);
    oci_execute ($query,OCI_DEFAULT);
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
    	$str = "<option value='" . $row['FACTOR_DISPLAY'] . "'>" . $row['FACTOR_DISPLAY'] . "</option>";
        $options = $options.$str;
    }

    return $options;
}

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
            where product_type_display in ('#product_type_display#')
            group by model_type_display
            order by model_type_display asc";
	$sql = str_replace('#product_type_display#', $_POST['value'], $sql);
    $query = oci_parse($conn, $sql);
    oci_execute ($query,OCI_DEFAULT);
    $options = $options."<option disabled selected>--โปรดเลือก--</option>";
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
    	$str = "<option value='" . $row['MODEL_TYPE_DISPLAY'] . "'>" . $row['MODEL_TYPE_DISPLAY'] . "</option>";
        $options = $options.$str;
    }
    $dropdown->set_model_type($_POST['value']);
    
    echo $options;
} else if($_POST['id'] == 'model_type'){
	$options = "";
	$options_factor = "";
	$sql = "select card_type_display
            from prepare_master_step2
            where model_type_display in ('#model_type_display#')
            group by card_type_display
            order by card_type_display asc";
	$sql = str_replace('#model_type_display#', $_POST['value'], $sql);
    $query = oci_parse($conn, $sql);
    oci_execute ($query,OCI_DEFAULT);
    $options = $options."<option value='รวมทุกประเภทบัตร' selected>รวมทุกประเภทบัตร</option>";
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
    	$str = "<option value='" . $row['CARD_TYPE_DISPLAY'] . "'>" . $row['CARD_TYPE_DISPLAY'] . "</option>";
        $options = $options.$str;
    }
    $dropdown->set_product_type_name($_POST['value']);

    $sql_factor = "select factor_display
                    from factor_master_map
                    where (1 = 1 or '#product_type_display#' = '' or product_type = '#product_type_display#')
                    and ('#product_type_display#' = '' 
                        or '#card_type_display#' = '' 
                        or card_type = '#card_type_display#')
                    group by factor_display
                    union all
                    select factor_display
                    from factor_master_map
                    where card_type = case when '#model_type_display#' = 'PEOPLE CARD' 
                                    and '#card_type_display#' = 'รวมทุกประเภทบัตร' then '821-PEOPLE CARD'
                                        when '#model_type_display#' = 'PRIMA CARD' 
                                    and '#card_type_display#' = 'รวมทุกประเภทบัตร' then '801-PRIMA CARD'
                                        when '#model_type_display#' = 'CREDIT CARD' 
                                        and '#card_type_display#' = 'รวมทุกประเภทบัตร' 
                                        then '301-GSB PREMIUM (GOLD)' else '' end
                    group by factor_display";
    
    $sql_factor = str_replace('#product_type_display#', $_GET['product_type'], $sql_factor);
    $sql_factor = str_replace('#card_type_display#', 'รวมทุกประเภทบัตร', $sql_factor);
    $sql_factor = str_replace('#model_type_display#', $_GET['model_type'], $sql_factor);
    $query_factor = oci_parse($conn, $sql_factor);
    oci_execute ($query_factor,OCI_DEFAULT);
    $options_factor = $options_factor."<option disabled selected>--โปรดเลือก--</option>";
    while ($row_factor = oci_fetch_array($query_factor,OCI_BOTH)) {
        $str_factor = "<option value='" . $row_factor['FACTOR_DISPLAY'] . "'>" . $row_factor['FACTOR_DISPLAY'] . "</option>";
        $options_factor = $options_factor.$str_factor;
    }

    echo json_encode(array($options, $options_factor));

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
    $options = $options."<option value='รวมทุกเขต' selected>รวมทุกเขต</option>";
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
    $options = $options."<option value='รวมทุกสาขา' selected>รวมทุกสาขา</option>";
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
    	$str = "<option value='" . $row['BRANCH_NAME_DISPLAY'] . "'>" . $row['BRANCH_NAME_DISPLAY'] . "</option>";
        $options = $options.$str;
    }
    $dropdown->set_zone_name($_POST['value']);

    echo $options;
} else if($_POST['id'] == "card_type") {
    $options = "";
    $sql = "select factor_display
            from factor_master_map
            where (1 = 1 or '#product_type_display#' = '' or product_type = '#product_type_display#')
            and ('#product_type_display#' = '' 
                 or '#card_type_display#' = '' 
                 or card_type = '#card_type_display#')
            group by factor_display
            union all
            select factor_display
            from factor_master_map
            where card_type = case when '#model_type_display#' = 'PEOPLE CARD' 
                              and '#card_type_display#' = 'รวมทุกประเภทบัตร' then '821-PEOPLE CARD'
                                   when '#model_type_display#' = 'PRIMA CARD' 
                              and '#card_type_display#' = 'รวมทุกประเภทบัตร' then '801-PRIMA CARD'
                                   when '#model_type_display#' = 'CREDIT CARD' 
                                   and '#card_type_display#' = 'รวมทุกประเภทบัตร' 
                                   then '301-GSB PREMIUM (GOLD)' else '' end
            group by factor_display";
            
	$sql = str_replace('#product_type_display#', $_GET['product_type'], $sql);
	$sql = str_replace('#card_type_display#', $_POST['value'], $sql);
    $query = oci_parse($conn, $sql);
    oci_execute ($query,OCI_DEFAULT);
    $options = $options."<option disabled selected>--โปรดเลือก--</option>";
    while ($row = oci_fetch_array($query,OCI_BOTH)) {
    	$str = "<option value='" . $row['FACTOR_DISPLAY'] . "'>" . $row['FACTOR_DISPLAY'] . "</option>";
        $options = $options.$str;
    }

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