<?php
// require_once('dropdownsClass.php');
// $dropdown = new Dropdown();

function get_report_sql($product_type, $model_type, $card_type, $region_name, $zone_name, $branch_name, $model_version, $sales_channel, $start_mm, $START_YYYY, $end_mm, $end_yyyy, $business_type) {
$sql = "select aaa.score_range_desc
,aaa.per_accept_acct
,aaa.per_active_acct
,aaa.per_current_1_30
,aaa.per_current_31_60
,aaa.per_current_61_90
,aaa.per_current_more_90
from
(select aa.score_range_id
,aa.score_range_desc
,nvl(bb.per_accept_acct,0) per_accept_acct
,nvl(bb.per_active_acct,0) per_active_acct
,nvl(bb.per_current_1_30,0) per_current_1_30
,nvl(bb.per_current_31_60,0) per_current_31_60
,nvl(bb.per_current_61_90,0) per_current_61_90
,nvl(bb.per_current_more_90,0) per_current_more_90
from score_range_master aa
left join
(select a.score_range_desc
,to_char('('||(sum(a.approve)||'/'||case when nvl(max(b.total_approve),0) = 0 then 1 else nvl(max(b.total_approve),0) end)||')*100') per_accept_acct
,to_char('('||(sum(a.active)||'/'||case when sum(a.approve) = 0 then 1 else sum(a.approve) end)||')*100') per_active_acct
,to_char('('||(sum(a.ever1_30)||'/'||case when sum(a.active) = 0 then 1 else sum(a.active) end)||')*100') per_current_1_30
,to_char('('||(sum(a.ever31_60)||'/'||case when sum(a.active) = 0 then 1 else sum(a.active) end)||')*100') per_current_31_60
,to_char('('||(sum(a.ever61_90)||'/'||case when sum(a.active) = 0 then 1 else sum(a.active) end)||')*100') per_current_61_90
,to_char('('||(sum(a.delmore_90)||'/'||case when sum(a.active) = 0 then 1 else sum(a.active) end)||')*100') per_current_more_90
from prepare_source_st11 a inner join (select sum(approve) total_approve
,sum(active) total_active
from prepare_source_st11
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between to_date('01/'||'#START_MM#'||'#START_YYYY#','dd/mm/yyyy') 
and last_day(to_date('01/'||'#END_MM#'||'#END_YYYY#','dd/mm/yyyy'))) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('01/'||'#START_MM#'||'#START_YYYY#','dd/mm/yyyy') 
and last_day(to_date('01/'||'#END_MM#'||'#END_YYYY#','dd/mm/yyyy'))
group by a.score_range_desc) bb on aa.score_range_desc = bb.score_range_desc 
where aa.flag = '#model_name#'

union all

select 20 score_range_id
,'Total'
,to_char('('||(sum(a.approve)||'/'||case when nvl(max(b.total_approve),0) = 0 then 1 else nvl(max(b.total_approve),0) end)||')*100') per_accept_acct
,to_char('('||(sum(a.active)||'/'||case when sum(a.approve) = 0 then 1 else sum(a.approve) end)||')*100') per_active_acct
,to_char('('||(sum(a.ever1_30)||'/'||case when sum(a.active) = 0 then 1 else sum(a.active) end)||')*100') per_current_1_30
,to_char('('||(sum(a.ever31_60)||'/'||case when sum(a.active) = 0 then 1 else sum(a.active) end)||')*100') per_current_31_60
,to_char('('||(sum(a.ever61_90)||'/'||case when sum(a.active) = 0 then 1 else sum(a.active) end)||')*100') per_current_61_90
,to_char('('||(sum(a.delmore_90)||'/'||case when sum(a.active) = 0 then 1 else sum(a.active) end)||')*100') per_current_more_90
from prepare_source_st11 a inner join (select sum(approve) total_approve
,sum(active) total_active
from prepare_source_st11
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between to_date('01/'||'#START_MM#'||'#START_YYYY#','dd/mm/yyyy') 
and last_day(to_date('01/'||'#END_MM#'||'#END_YYYY#','dd/mm/yyyy'))) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and create_date between to_date('01/'||'#START_MM#'||'#START_YYYY#','dd/mm/yyyy') 
and last_day(to_date('01/'||'#END_MM#'||'#END_YYYY#','dd/mm/yyyy'))
group by 'Total') aaa
order by aaa.score_range_id asc";

       $sql = str_replace("#product_type#", $product_type, $sql);
       $sql = str_replace("#model_name#", $model_type, $sql);
       $sql = str_replace("#card_type#", $card_type, $sql);
       $sql = str_replace("#model_version#", $model_version, $sql);
       $sql = str_replace("#sales_channel#", $sales_channel, $sql);
       $sql = str_replace("#business_type#", $business_type, $sql);
       $sql = str_replace("#region_name#", $region_name, $sql);
       $sql = str_replace("#zone_name#", $zone_name, $sql);
       $sql = str_replace("#branch_name#", $branch_name, $sql);
       $sql = str_replace("#START_MM#", $start_mm, $sql);
       $sql = str_replace("#START_YYYY#", $START_YYYY, $sql);
       $sql = str_replace("#END_MM#", $end_mm, $sql);
       $sql = str_replace("#END_YYYY#", $end_yyyy, $sql);

       return $sql;
}

?>