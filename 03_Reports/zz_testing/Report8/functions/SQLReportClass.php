<?php
// require_once('dropdownsClass.php');
// $dropdown = new Dropdown();

function get_report_sql($product_type, $model_type, $card_type, $region_name, $zone_name, $branch_name, $model_version, $sales_channel, $month, $year, $business_type) {
$sql = "select all_total.score_range_desc
,all_total.bad1_30past3months
,all_total.bad1_30past12months
,all_total.bad1_30pastmore12
,all_total.bad31_60past3months
,all_total.bad31_60past12months
,all_total.bad31_60pastmore12
,all_total.bad61_90past3months
,all_total.bad61_90past12months
,all_total.bad61_90pastmore12
from
(select aaa.score_range_id
,aaa.score_range_desc
,to_char('('||nvl(approve_3m.ever1_30,0)||'/'||case when nvl(approve_3m.approve,0) = 0 then 0 else approve_3m.approve end ||')* 100') bad1_30past3months
,to_char('('||nvl(approve_12m.ever1_30,0)||'/'||case when nvl(approve_12m.approve,0) = 0 then 0 else approve_12m.approve end ||')* 100') bad1_30past12months
,to_char('('||nvl(approve_more12m.ever1_30,0)||'/'||case when nvl(approve_more12m.approve,0) = 0 then 0 else approve_more12m.approve end ||')* 100') bad1_30pastmore12

,to_char('('||nvl(approve_3m.ever31_60,0)||'/'||case when nvl(approve_3m.approve,0) = 0 then 0 else approve_3m.approve end ||')* 100') bad31_60past3months
,to_char('('||nvl(approve_12m.ever31_60,0)||'/'||case when nvl(approve_12m.approve,0) = 0 then 0 else approve_12m.approve end ||')* 100') bad31_60past12months
,to_char('('||nvl(approve_more12m.ever31_60,0)||'/'||case when nvl(approve_more12m.approve,0) = 0 then 0 else approve_more12m.approve end ||')* 100') bad31_60pastmore12

,to_char('('||nvl(approve_3m.ever61_90,0)||'/'||case when nvl(approve_3m.approve,0) = 0 then 0 else approve_3m.approve end ||')* 100') bad61_90past3months
,to_char('('||nvl(approve_12m.ever61_90,0)||'/'||case when nvl(approve_12m.approve,0) = 0 then 0 else approve_12m.approve end ||')* 100') bad61_90past12months
,to_char('('||nvl(approve_more12m.ever61_90,0)||'/'||case when nvl(approve_more12m.approve,0) = 0 then 0 else approve_more12m.approve end ||')* 100') bad61_90pastmore12
from score_range_master aaa
left join (select a.score_range_desc
                     ,a.product_type
                     ,'#model_name#' flag
                     ,sum(a.approve_rpt1) approve
                     ,sum(nvl(b.ever1_30,0)) ever1_30
                     ,sum(nvl(b.ever31_60,0)) ever31_60
                     ,sum(nvl(b.ever61_90,0)) ever61_90
                     from prepare_source_st10 a left join prepare_source_st9 b on a.appl_id = b.appl_id and substr(a.card_type,1,3) = b.account_type
                     where product_type = '#product_type#'
                     and model_name = '#model_name#'
                     and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                     and model_version = '#model_version#'
                     and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                     and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                     and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                     and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                     and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                     and create_date between last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-1))
                     and last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-4))+1
                     group by a.score_range_desc
                     ,a.product_type
                     ,'#model_name#'
                     ) approve_3m on aaa.score_range_desc = approve_3m.score_range_desc and aaa.flag = approve_3m.flag

left join (select a.score_range_desc
                     ,a.product_type
                     ,'#model_name#' flag
                     ,sum(a.approve_rpt1) approve
                     ,sum(nvl(b.ever1_30,0)) ever1_30
                     ,sum(nvl(b.ever31_60,0)) ever31_60
                     ,sum(nvl(b.ever61_90,0)) ever61_90
                     from prepare_source_st10 a left join prepare_source_st9 b on a.appl_id = b.appl_id and substr(a.card_type,1,3) = b.account_type
                     where product_type = '#product_type#'
                     and model_name = '#model_name#'
                     and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                     and model_version = '#model_version#'
                     and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                     and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                     and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                     and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                     and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                     and create_date between last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-1))
                     and last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-13))+1
                     group by a.score_range_desc
                     ,a.product_type
                     ,'#model_name#'
                      ) approve_12m on aaa.score_range_desc = approve_12m.score_range_desc and aaa.flag = approve_12m.flag
left join (select a.score_range_desc
                     ,a.product_type
                     ,'#model_name#' flag
                     ,sum(a.approve_rpt1) approve
                     ,sum(nvl(b.ever1_30,0)) ever1_30
                     ,sum(nvl(b.ever31_60,0)) ever31_60
                     ,sum(nvl(b.ever61_90,0)) ever61_90
                     from prepare_source_st10 a left join prepare_source_st9 b on a.appl_id = b.appl_id and substr(a.card_type,1,3) = b.account_type
                     where product_type = '#product_type#'
                     and model_name = '#model_name#'
                     and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                     and model_version = '#model_version#'
                     and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                     and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                     and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                     and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                     and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                     and create_date < last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-13))+1
                     group by a.score_range_desc
                     ,a.product_type
                     ,'#model_name#'
                     ) approve_more12m on aaa.score_range_desc = approve_more12m.score_range_desc and aaa.flag = approve_more12m.flag
where aaa.flag = '#model_name#'

union all

select 20
,'Total'
,'('||to_char(sum(nvl(approve_3m.ever1_30,0)))||'/'||max(nvl(approve_3m.approve,0))||')*100' bad1_30past3months
,'('||to_char(sum(nvl(approve_12m.ever1_30,0)))||'/'||max(nvl(approve_12m.approve,0))||')*100' bad1_30past12months
,'('||to_char(sum(nvl(approve_more12m.ever1_30,0)))||'/'||max(nvl(approve_more12m.approve,0))||')*100' bad1_30pastmore12



,'('||to_char(sum(nvl(approve_3m.ever31_60,0)))||'/'||max(nvl(approve_3m.approve,0))||')*100' bad31_60past3months
,'('||to_char(sum(nvl(approve_12m.ever31_60,0)))||'/'||max(nvl(approve_12m.approve,0))||')*100' bad31_60past12months
,'('||to_char(sum(nvl(approve_more12m.ever31_60,0)))||'/'||max(nvl(approve_more12m.approve,0))||')*100' bad31_60pastmore12

,'('||to_char(sum(nvl(approve_3m.ever61_90,0)))||'/'||max(nvl(approve_3m.approve,0))||')*100' bad61_90past3months
,'('||to_char(sum(nvl(approve_12m.ever61_90,0)))||'/'||max(nvl(approve_12m.approve,0))||')*100' bad61_90past12months
,'('||to_char(sum(nvl(approve_more12m.ever61_90,0)))||'/'||max(nvl(approve_more12m.approve,0))||')*100' bad61_90pastmore12
from score_range_master aaa
left join (select a.score_range_desc
                     ,a.product_type
                     ,'#model_name#' flag
                     ,sum(a.approve_rpt1) approve
                     ,sum(nvl(b.ever1_30,0)) ever1_30
                     ,sum(nvl(b.ever31_60,0)) ever31_60
                     ,sum(nvl(b.ever61_90,0)) ever61_90
                     from prepare_source_st10 a left join prepare_source_st9 b on a.appl_id = b.appl_id and substr(a.card_type,1,3) = b.account_type
                     where product_type = '#product_type#'
                     and model_name = '#model_name#'
                     and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                     and model_version = '#model_version#'
                     and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                     and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                     and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                     and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                     and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                     and create_date between last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-1))
                     and last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-4))+1
                     group by a.score_range_desc
                     ,a.product_type
                     ,'#model_name#'
                     ) approve_3m on aaa.score_range_desc = approve_3m.score_range_desc and aaa.flag = approve_3m.flag

left join (select a.score_range_desc
                     ,a.product_type
                     ,'#model_name#' flag
                     ,sum(a.approve_rpt1) approve
                     ,sum(nvl(b.ever1_30,0)) ever1_30
                     ,sum(nvl(b.ever31_60,0)) ever31_60
                     ,sum(nvl(b.ever61_90,0)) ever61_90
                     from prepare_source_st10 a left join prepare_source_st9 b on a.appl_id = b.appl_id and substr(a.card_type,1,3) = b.account_type
                     where product_type = '#product_type#'
                     and model_name = '#model_name#'
                     and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                     and model_version = '#model_version#'
                     and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                     and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                     and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                     and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                     and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                     and create_date between last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-1))
                     and last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-13))+1
                     group by a.score_range_desc
                     ,a.product_type
                     ,'#model_name#'
                      ) approve_12m on aaa.score_range_desc = approve_12m.score_range_desc and aaa.flag = approve_12m.flag
left join (select a.score_range_desc
                     ,a.product_type
                     ,'#model_name#' flag
                     ,sum(a.approve_rpt1) approve
                     ,sum(nvl(b.ever1_30,0)) ever1_30
                     ,sum(nvl(b.ever31_60,0)) ever31_60
                     ,sum(nvl(b.ever61_90,0)) ever61_90
                     from prepare_source_st10 a left join prepare_source_st9 b on a.appl_id = b.appl_id and substr(a.card_type,1,3) = b.account_type
                     where product_type = '#product_type#'
                     and model_name = '#model_name#'
                     and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                     and model_version = '#model_version#'
                     and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                     and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                     and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                     and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                     and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                     and create_date < last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-13))+1
                     group by a.score_range_desc
                     ,a.product_type
                     ,'#model_name#'
                     ) approve_more12m on aaa.score_range_desc = approve_more12m.score_range_desc and aaa.flag = approve_more12m.flag
where aaa.flag = '#model_name#'

union all

select 30
,'Average Bad Rate'
,'('||to_char(sum(nvl(approve_3m.ever1_30,0)))||'/'||max(nvl(approve_3m.approve,0))||')' bad1_30past3months
,'('||to_char(sum(nvl(approve_12m.ever1_30,0)))||'/'||max(nvl(approve_12m.approve,0))||')' bad1_30past12months
,'('||to_char(sum(nvl(approve_more12m.ever1_30,0)))||'/'||max(nvl(approve_more12m.approve,0))||')' bad1_30pastmore12



,'('||to_char(sum(nvl(approve_3m.ever31_60,0)))||'/'||max(nvl(approve_3m.approve,0))||')' bad31_60past3months
,'('||to_char(sum(nvl(approve_12m.ever31_60,0)))||'/'||max(nvl(approve_12m.approve,0))||')' bad31_60past12months
,'('||to_char(sum(nvl(approve_more12m.ever31_60,0)))||'/'||max(nvl(approve_more12m.approve,0))||')' bad31_60pastmore12

,'('||to_char(sum(nvl(approve_3m.ever61_90,0)))||'/'||max(nvl(approve_3m.approve,0))||')' bad61_90past3months
,'('||to_char(sum(nvl(approve_12m.ever61_90,0)))||'/'||max(nvl(approve_12m.approve,0))||')' bad61_90past12months
,'('||to_char(sum(nvl(approve_more12m.ever61_90,0)))||'/'||max(nvl(approve_more12m.approve,0))||')' bad61_90pastmore12
from score_range_master aaa
left join (select a.score_range_desc
                     ,a.product_type
                     ,'#model_name#' flag
                     ,sum(a.approve_rpt1) approve
                     ,sum(nvl(b.ever1_30,0)) ever1_30
                     ,sum(nvl(b.ever31_60,0)) ever31_60
                     ,sum(nvl(b.ever61_90,0)) ever61_90
                     from prepare_source_st10 a left join prepare_source_st9 b on a.appl_id = b.appl_id and substr(a.card_type,1,3) = b.account_type
                     where product_type = '#product_type#'
                     and model_name = '#model_name#'
                     and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                     and model_version = '#model_version#'
                     and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                     and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                     and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                     and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                     and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                     and create_date between last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-1))
                     and last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-4))+1
                     group by a.score_range_desc
                     ,a.product_type
                     ,'#model_name#'
                     ) approve_3m on aaa.score_range_desc = approve_3m.score_range_desc and aaa.flag = approve_3m.flag

left join (select a.score_range_desc
                     ,a.product_type
                     ,'#model_name#' flag
                     ,sum(a.approve_rpt1) approve
                     ,sum(nvl(b.ever1_30,0)) ever1_30
                     ,sum(nvl(b.ever31_60,0)) ever31_60
                     ,sum(nvl(b.ever61_90,0)) ever61_90
                     from prepare_source_st10 a left join prepare_source_st9 b on a.appl_id = b.appl_id and substr(a.card_type,1,3) = b.account_type
                     where product_type = '#product_type#'
                     and model_name = '#model_name#'
                     and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                     and model_version = '#model_version#'
                     and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                     and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                     and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                     and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                     and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                     and create_date between last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-1))
                     and last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-13))+1
                     group by a.score_range_desc
                     ,a.product_type
                     ,'#model_name#'
                      ) approve_12m on aaa.score_range_desc = approve_12m.score_range_desc and aaa.flag = approve_12m.flag
left join (select a.score_range_desc
                     ,a.product_type
                     ,'#model_name#' flag
                     ,sum(a.approve_rpt1) approve
                     ,sum(nvl(b.ever1_30,0)) ever1_30
                     ,sum(nvl(b.ever31_60,0)) ever31_60
                     ,sum(nvl(b.ever61_90,0)) ever61_90
                     from prepare_source_st10 a left join prepare_source_st9 b on a.appl_id = b.appl_id and substr(a.card_type,1,3) = b.account_type
                     where product_type = '#product_type#'
                     and model_name = '#model_name#'
                     and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                     and model_version = '#model_version#'
                     and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                     and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                     and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                     and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                     and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                     and create_date < last_day(add_months(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'),-13))+1
                     group by a.score_range_desc
                     ,a.product_type
                     ,'#model_name#'
                     ) approve_more12m on aaa.score_range_desc = approve_more12m.score_range_desc and aaa.flag = approve_more12m.flag
where aaa.flag = '#model_name#'
                             
) all_total
order by all_total.score_range_id asc";

$sql = str_replace("#product_type#", $product_type, $sql);
$sql = str_replace("#model_name#", $model_type, $sql);
$sql = str_replace("#card_type#", $card_type, $sql);
$sql = str_replace("#model_version#", $model_version, $sql);
$sql = str_replace("#sales_channel#", $sales_channel, $sql);
$sql = str_replace("#business_type#", $business_type, $sql);
$sql = str_replace("#region_name#", $region_name, $sql);
$sql = str_replace("#zone_name#", $zone_name, $sql);
$sql = str_replace("#branch_name#", $branch_name, $sql);
$sql = str_replace("#MM#", $month, $sql);
$sql = str_replace("#YYYY#", $year, $sql);

return $sql;
}

?>