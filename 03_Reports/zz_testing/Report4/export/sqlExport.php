<?php
$sql = "select aaa.score_range_desc
,aaa.approve
,aaa.reject
,aaa.total
,aaa.per_approve
from
(select aa.score_range_id 
,aa.score_range_desc
,nvl(approve,0) approve
,nvl(reject,0) reject
,nvl(total,0) total
,nvl(per_approve,0) per_approve
from score_range_master aa left join (select a.score_range_desc
,sum(a.approve_rpt1) approve
,sum(a.reject_rpt1) reject
,sum(a.approve_rpt1) + sum(reject_rpt1) total
,round(sum(a.approve_rpt1)*100/case when max(total_approve) = 0 then 1 else max(total_approve) end,2) per_approve
from prepare_source_st4 a inner join (select sum(nvl(approve_rpt1,0)) total_approve 
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
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')                                                              
group by a.score_range_desc) bb on aa.score_range_desc = bb.score_range_desc
where aa.flag = '#model_name#'

union all
select 20 score_range_id
,'Total' score_range_desc
,sum(aa.approve) approve
,sum(aa.reject) reject
,sum(aa.total) total
,round(sum(aa.per_approve),2) per_approve
from
(select aa.score_range_id 
,aa.score_range_desc
,nvl(approve,0) approve
,nvl(reject,0) reject
,nvl(total,0) total
,nvl(per_approve,0) per_approve
from score_range_master aa left join (select a.score_range_desc
,sum(a.approve_rpt1) approve
,sum(a.reject_rpt1) reject
,sum(a.approve_rpt1) + sum(reject_rpt1) total
,round(sum(a.approve_rpt1)*100/case when max(total_approve) = 0 then 1 else max(total_approve) end,5) per_approve
from prepare_source_st4 a inner join (select sum(nvl(approve_rpt1,0)) total_approve 
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
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')                                                              
group by a.score_range_desc) bb on aa.score_range_desc = bb.score_range_desc
where aa.flag = '#model_name#') aa
group by 20
,'Total'

union all

select 30 iid
,'Low Side Overrides Count' des
,round(sum(below_cutoff_approve),2) low_side_overides
,null
,null
,null
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
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')


union all

select 40 iid
,'Low Side Overrides %' des
,round((sum(a.below_cutoff_approve)*100)/(case when max(b.total_below_cutoff) = 0 then 1 else max(b.total_below_cutoff) end),2) per_low_side_overides
,null
,null
,null
from prepare_source_st4 a inner join (select sum(nvl(below_cutoff,0)) total_below_cutoff
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
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')

union all

select 50 iid
,'High Side Overrides Count' des
,round(sum(pass_cutoff_reject),2) pass_cutoff_reject
,null
,null
,null
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
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')

union all

select 60 iid
,'High Side Overrides %' des
,round((sum(a.pass_cutoff_reject)*100)/(case when max(b.total_pass_cutoff_reject) = 0 then 1 else max(b.total_pass_cutoff_reject) end),2) per_low_side_overides
,null
,null
,null
from prepare_source_st4 a inner join (select sum(nvl(pass_cutoff_reject,0)) total_pass_cutoff_reject
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
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')

union all

select 70 iid
,'Approval Rate Potential' des
,round((sum(a.pass_cutoff)*100)/(case when max(b.total_approval) = 0 then 1 else max(b.total_approval) end),2) per_total_approval
,null
,null
,null
from prepare_source_st4 a inner join (select sum(nvl(approve_rpt1,0)+nvl(reject_rpt1,0)) total_approval
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
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')

union all

select 80 iid
,'Approval Rate Actual' des
,round((sum(a.approve_rpt1)*100)/(case when max(b.total_approval) = 0 then 1 else max(b.total_approval) end),2) per_total_approval
,null
,null
,null
from prepare_source_st4 a inner join (select sum(nvl(approve_rpt1,0)+nvl(reject_rpt1,0)) total_approval
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
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')) aaa
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
       $sql = str_replace("#start_date#", $start_date, $sql);
       $sql = str_replace("#end_date#", $end_date, $sql);

   ?>