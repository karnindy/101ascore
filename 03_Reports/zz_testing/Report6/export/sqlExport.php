<?php
$sql = "select aa.category
,aa.total_actual_3m
,round(aa.total_actual_3m/case when bb.total_actual_3m = 0 then 1 else bb.total_actual_3m end *100,2) oper_override_3m
,aa.total_actual_6m
,round(aa.total_actual_6m/case when bb.total_actual_6m = 0 then 1 else bb.total_actual_6m end *100,2) per_override_6m
,aa.total_actual_12m
,round(aa.total_actual_12m/case when bb.total_actual_12m = 0 then 1 else bb.total_actual_12m end *100,2) per_override_12m
from
(select a.reason_code_desc_2 category
,nvl(b.total_actual,0) total_actual_3m
,nvl(c.total_actual,0) total_actual_6m
,nvl(d.total_actual,0) total_actual_12m
from master_reason_desc a left join (select reason_code_desc
                                                                             ,sum(nvl(pass_cutoff_reject,0)) pass_cutoff_reject
                                                                             ,sum(nvl(below_cutoff_approve,0)) below_cutoff_approve
                                                                             ,sum(nvl(approve_rpt1,0)+nvl(reject_rpt1,0)) total_actual
                                                                             from prepare_source_st7
                                                                             where product_type = '#product_type#'
                                                                             and model_name = '#model_name#'
                                                                             and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                                                                             and model_version = '#model_version#'
                                                                             and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                                                                             and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                                                                             and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                                                                             and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                                                                             and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                                                                             and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-3)+1
                                                                             and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
                                                                             group by reason_code_desc) b on a.reason_code_desc_2 = b.reason_code_desc
                                            left join (select reason_code_desc
                                                                             ,sum(nvl(pass_cutoff_reject,0)) pass_cutoff_reject
                                                                             ,sum(nvl(below_cutoff_approve,0)) below_cutoff_approve
                                                                             ,sum(nvl(approve_rpt1,0)+nvl(reject_rpt1,0)) total_actual
                                                                             from prepare_source_st7
                                                                             where product_type = '#product_type#'
                                                                             and model_name = '#model_name#'
                                                                             and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                                                                             and model_version = '#model_version#'
                                                                             and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                                                                             and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                                                                             and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                                                                             and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                                                                             and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                                                                             and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-6)+1
                                                                             and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
                                                                             group by reason_code_desc) c on a.reason_code_desc_2 = c.reason_code_desc
                                            left join (select reason_code_desc
                                                                             ,sum(nvl(pass_cutoff_reject,0)) pass_cutoff_reject
                                                                             ,sum(nvl(below_cutoff_approve,0)) below_cutoff_approve
                                                                             ,sum(nvl(approve_rpt1,0)+nvl(reject_rpt1,0)) total_actual
                                                                             from prepare_source_st7
                                                                             where product_type = '#product_type#'
                                                                             and model_name = '#model_name#'
                                                                             and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                                                                             and model_version = '#model_version#'
                                                                             and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                                                                             and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                                                                             and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                                                                             and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                                                                             and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                                                                             and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
                                                                             and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
                                                                             group by reason_code_desc) d on a.reason_code_desc_2 = d.reason_code_desc) aa
inner join
(select sum(nvl(b.total_actual,0)) total_actual_3m
,sum(nvl(c.total_actual,0)) total_actual_6m
,sum(nvl(d.total_actual,0)) total_actual_12m
from master_reason_desc a left join (select reason_code_desc
                                                                             ,sum(nvl(pass_cutoff_reject,0)) pass_cutoff_reject
                                                                             ,sum(nvl(below_cutoff_approve,0)) below_cutoff_approve
                                                                             ,sum(nvl(approve_rpt1,0)+nvl(reject_rpt1,0)) total_actual
                                                                             from prepare_source_st7
                                                                             where product_type = '#product_type#'
                                                                             and model_name = '#model_name#'
                                                                             and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                                                                             and model_version = '#model_version#'
                                                                             and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                                                                             and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                                                                             and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                                                                             and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                                                                             and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                                                                             and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-3)+1
                                                                             and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
                                                                             group by reason_code_desc) b on a.reason_code_desc_2 = b.reason_code_desc
                                            left join (select reason_code_desc
                                                                             ,sum(nvl(pass_cutoff_reject,0)) pass_cutoff_reject
                                                                             ,sum(nvl(below_cutoff_approve,0)) below_cutoff_approve
                                                                             ,sum(nvl(approve_rpt1,0)+nvl(reject_rpt1,0)) total_actual
                                                                             from prepare_source_st7
                                                                             where product_type = '#product_type#'
                                                                             and model_name = '#model_name#'
                                                                             and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                                                                             and model_version = '#model_version#'
                                                                             and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                                                                             and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                                                                             and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                                                                             and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                                                                             and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                                                                             and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-6)+1
                                                                             and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
                                                                             group by reason_code_desc) c on a.reason_code_desc_2 = c.reason_code_desc
                                            left join (select reason_code_desc
                                                                             ,sum(nvl(pass_cutoff_reject,0)) pass_cutoff_reject
                                                                             ,sum(nvl(below_cutoff_approve,0)) below_cutoff_approve
                                                                             ,sum(nvl(approve_rpt1,0)+nvl(reject_rpt1,0)) total_actual
                                                                             from prepare_source_st7
                                                                             where product_type = '#product_type#'
                                                                             and model_name = '#model_name#'
                                                                             and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
                                                                             --and model_version = '#model_version#'
                                                                             and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
                                                                             and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
                                                                             and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
                                                                             and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
                                                                             and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
                                                                             and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
                                                                             and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
                                                                             group by reason_code_desc) d on a.reason_code_desc_2 = d.reason_code_desc) bb on 1 = 1								
order by aa.category asc";

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
   ?>