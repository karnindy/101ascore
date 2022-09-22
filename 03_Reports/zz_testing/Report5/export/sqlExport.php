<?php
$sql = "select a.category
,nvl(b.app_in_range_3m,0) app_in_range_3m
,nvl(c.app_in_range_12m,0) app_in_range_12m
,nvl(d.app_in_range_more12m,0) app_in_range_more12m
,nvl(e.approval_3m,0) approval_3m
,nvl(f.approval_12m,0) approval_12m
,nvl(g.approval_more12m,0) approval_more12m
from
(select 'Low Side Approval' category from dual
union all 
select '% Approved' category from dual
union all 
select 'High Side Declined' category from dual
union all 
select '% Declined' category from dual) a
left join (select 'Low Side Approval' category, sum(below_cutoff_approve) app_in_range_3m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-3)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select '% Approved' category
,sum(nvl(below_cutoff_approve,0))*100/case when sum(approve_rpt1+reject_rpt1) = 0 then 1 else sum(approve_rpt1+reject_rpt1) end app_in_range_3m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-3)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select 'High Side Declined' category, sum(pass_cutoff_reject) app_in_range_3m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-3)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select '% Declined' category
,sum(nvl(pass_cutoff_reject,0))*100/case when sum(approve_rpt1+reject_rpt1) = 0 then 1 else sum(approve_rpt1+reject_rpt1) end app_in_range_3m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-3)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
) b on a.category = b.category               
left join (select 'Low Side Approval' category, sum(below_cutoff_approve) app_in_range_12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select '% Approved' category
,sum(nvl(below_cutoff_approve,0))*100/case when sum(approve_rpt1+reject_rpt1) = 0 then 1 else sum(approve_rpt1+reject_rpt1) end app_in_range_12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select 'High Side Declined' category, sum(pass_cutoff_reject) app_in_range_12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select '% Declined' category
,sum(nvl(pass_cutoff_reject,0))*100/case when sum(approve_rpt1+reject_rpt1) = 0 then 1 else sum(approve_rpt1+reject_rpt1) end app_in_range_12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))) c on a.category = c.category
left join (select 'Low Side Approval' category, sum(below_cutoff_approve) app_in_range_more12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date < add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
union all
select '% Approved' category
,sum(nvl(below_cutoff_approve,0))*100/case when sum(approve_rpt1+reject_rpt1) = 0 then 1 else sum(approve_rpt1+reject_rpt1) end app_in_range_more12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date < add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
union all
select 'High Side Declined' category, sum(pass_cutoff_reject) app_in_range_more12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date < add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
union all
select '% Declined' category
,sum(nvl(pass_cutoff_reject,0))*100/case when sum(approve_rpt1+reject_rpt1) = 0 then 1 else sum(approve_rpt1+reject_rpt1) end app_in_range_more12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date < add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1) d on a.category = d.category
left join (select 'Low Side Approval' category, sum(below_cutoff_approve) approval_3m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-3)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select '% Approved' category
,sum(nvl(below_cutoff_approve,0))*100/case when sum(approve_rpt1) = 0 then 1 else sum(approve_rpt1) end approval_3m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-3)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select 'High Side Declined' category, sum(pass_cutoff_reject) approval_3m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-3)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select '% Declined' category
,sum(nvl(pass_cutoff_reject,0))*100/case when sum(approve_rpt1) = 0 then 1 else sum(approve_rpt1) end approval_3m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-3)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))) e on a.category = e.category
left join (select 'Low Side Approval' category, sum(below_cutoff_approve) approval_12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select '% Approved' category
,sum(nvl(below_cutoff_approve,0))*100/case when sum(approve_rpt1) = 0 then 1 else sum(approve_rpt1) end approval_12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select 'High Side Declined' category, sum(pass_cutoff_reject) approval_12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))
union all
select '% Declined' category
,sum(nvl(pass_cutoff_reject,0))*100/case when sum(approve_rpt1) = 0 then 1 else sum(approve_rpt1) end approval_12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
and last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy'))) f on a.category = f.category
left join (select 'Low Side Approval' category, sum(below_cutoff_approve) approval_more12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date < add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
union all
select '% Approved' category
,sum(nvl(below_cutoff_approve,0))*100/case when sum(approve_rpt1) = 0 then 1 else sum(approve_rpt1) end approval_more12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date < add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
union all
select 'High Side Declined' category, sum(pass_cutoff_reject) approval_more12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date < add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1
union all
select '% Declined' category
,sum(nvl(pass_cutoff_reject,0))*100/case when sum(approve_rpt1) = 0 then 1 else sum(approve_rpt1) end approval_more12m
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date < add_months(last_day(to_date('01'||'/'||'#MM#'||'/'||'#YYYY#','dd/mm/yyyy')),-12)+1) g on a.category = g.category";

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