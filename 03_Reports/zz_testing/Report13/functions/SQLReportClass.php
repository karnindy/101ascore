<?php
// require_once('dropdownsClass.php');
// $dropdown = new Dropdown();

function get_report_sql($product_type, $model_type, $card_type, $region_name, $zone_name, $branch_name, $model_version, $sales_channel, $start_date, $end_date, $business_type) {
       $sql = "select * 
       from rep301_13 
       where create_date >= to_date('#start_date#','dd/mm/yyyy') 
       and create_date <= to_date('#end_date#','dd/mm/yyyy') + 1 
       and ('#product_type#' = 'รวมทุกประเภทสินเชื่อ' or product_type = '#product_type#' )
       and ('#model_name#' = 'รวมทุกประเภทโมเดล' or model_type = '#model_name#')
       and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#') 
       order by create_date desc";

       $sql = str_replace("#product_type#", $product_type, $sql);
       $sql = str_replace("#model_name#", $model_type, $sql);
       $sql = str_replace("#card_type#", $card_type, $sql);
       // $sql = str_replace("#model_version#", $model_version, $sql);
       $sql = str_replace("#start_date#", $start_date, $sql);
       $sql = str_replace("#end_date#", $end_date, $sql);

       return $sql;
}

?>