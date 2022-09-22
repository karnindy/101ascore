<?php
$sql = "select all_.score_range_desc
,all_.dev
,all_.per_dev
,all_.actual
,all_.per_actual
,all_.per_change
,all_.ratio
,all_.woe
,all_.index_
,all_.per_approve
,all_.per_reject
from
(select aaa.score_range_id
,aaa.score_range_desc
,max(nvl(ccc.dev,0)) dev

,'('||max(nvl(ccc.dev,0)) ||'/'|| case when max(nvl(ccc.total_dev,0)) = 0 then 1 else  max(nvl(ccc.total_dev,0)) end ||') * 100' per_dev

,sum(nvl(bbb.actual,0)) actual
,'('||sum(nvl(bbb.actual,0)) ||'/'|| case when sum(nvl(bbb.total_actual,0)) = 0 then 1 else  sum(nvl(bbb.total_actual,0)) end||') * 100' per_actual

,'%Actual - %Dev' per_change


,'%Actual / %Dev' ratio

,'Ln(Ratio)' woe

,'(%Change /100) * Ln(Ratio)' index_

,to_char(max(nvl(ddd.per_approve,0))) per_approve
,to_char(max(nvl(ddd.per_reject,0))) per_reject

from score_range_master aaa left join (select a.score_range_desc
,sum(a.approve_rpt1 + a.reject_rpt1) actual
,max(b.actual) total_actual
from prepare_source_st4 a inner join (select sum(approve_rpt1+reject_rpt1) actual
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between to_date('#start_date#','dd/mm/yyyy') 
and to_date('#end_date#','dd/mm/yyyy')
) b on 1 = 1
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy') 
and to_date('#end_date#','dd/mm/yyyy')
group by a.score_range_desc
) bbb on  aaa.score_range_desc = bbb.score_range_desc

left join (select a.score_range_desc
,sum(a.bad) bad
,sum(a.good) good
,sum(a.dev) dev
,max(b.bad) total_bad
,max(b.good) total_good
,max(b.dev) total_dev
from prepare_source_st3 a inner join (select sum(bad) bad
,sum(good) good
,sum(dev) dev
from prepare_source_st3
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
) b on 1 = 1
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
group by a.score_range_desc
) ccc on aaa.score_range_desc = ccc.score_range_desc
left join (select a.score_range_desc
,to_char('('||a.approve||'/'||b.total_approve||')'||'*'||100) per_approve
,to_char('('||a.reject||'/'||c.total_reject||')'||'*'||100) per_reject
from

(select sum(approve_rpt1) approve
,sum(reject_rpt1) reject
,score_range_desc
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')
group by score_range_desc) a 

inner join

(select case when sum(approve_rpt1) = 0 then 1 else sum(approve_rpt1) end total_approve
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')
) b on 1 = 1

inner join

(select case when sum(reject_rpt1) = 0 then 1 else sum(reject_rpt1) end total_reject
from prepare_source_st4
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')
) c on 1 = 1) ddd 
on aaa.score_range_desc = ddd.score_range_desc
where aaa.flag = '#model_name#'
group by aaa.score_range_id, aaa.score_range_desc

) all_
order by all_.score_range_id";

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