<?php
// require_once('dropdownsClass.php');
// $dropdown = new Dropdown();

function get_report_sql($product_type, $model_type, $card_type, $region_name, $zone_name, $branch_name, $model_version, $sales_channel, $month, $year, $business_type) {
$sql = "select a.score_range_desc
,a.actual_3m
,a.actual_12m
,a.actual_more12m
,a.reject_3m
,a.reject_12m
,a.reject_more12m
,a.approve_3m
,a.approve_12m
,a.approve_more12m
,a.other_3m
,a.other_12m
,a.other_more12m
from (select aaa.score_range_id
, aaa.score_range_desc
,to_char(sum(nvl(eee.total_all,0))) actual_3m
,to_char(sum(nvl(fff.total_all,0))) actual_12m
,to_char(sum(nvl(ggg.total_all,0))) actual_more12m

,'('||sum(nvl(eee.reject,0))||'/'||case when sum(nvl(eee.total_all,0)) = 0 then 0 else sum(nvl(eee.total_all,0)) end||')*100' reject_3m

,'('||sum(nvl(fff.reject,0))||'/'||case when sum(nvl(fff.total_all,0)) = 0 then 0 else sum(nvl(fff.total_all,0)) end||')*100' reject_12m

,'('||sum(nvl(ggg.reject,0))||'/'||case when sum(nvl(ggg.total_all,0)) = 0 then 0 else sum(nvl(ggg.total_all,0)) end||')*100' reject_more12m

,'('||sum(nvl(eee.approve,0))||'/'||case when sum(nvl(eee.total_all,0)) = 0 then 0 else sum(nvl(eee.total_all,0)) end||')*100' approve_3m

,'('||sum(nvl(fff.approve,0))||'/'||case when sum(nvl(fff.total_all,0)) = 0 then 0 else sum(nvl(fff.total_all,0)) end||')*100' approve_12m

,'('||sum(nvl(ggg.approve,0))||'/'||case when sum(nvl(ggg.total_all,0)) = 0 then 0 else sum(nvl(ggg.total_all,0)) end||')*100' approve_more12m

,'('||sum(nvl(eee.other,0))||'/'||case when sum(nvl(eee.total_all,0)) = 0 then 0 else sum(nvl(eee.total_all,0)) end||')*100' other_3m

,'('||sum(nvl(fff.other,0))||'/'||case when sum(nvl(fff.total_all,0)) = 0 then 0 else sum(nvl(fff.total_all,0)) end||')*100' other_12m

,'('||sum(nvl(ggg.other,0))||'/'||case when sum(nvl(ggg.total_all,0)) = 0 then 0 else sum(nvl(ggg.total_all,0)) end||')*100' other_more12m

from score_range_master aaa 

left join 

(select score_range_desc
,sum(approve_rpt2+reject_rpt2+other_rpt2) actual                 
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
group by score_range_desc) bbb on  aaa.score_range_desc = bbb.score_range_desc

left join (select score_range_desc
,sum(approve_rpt2+reject_rpt2+other_rpt2) actual
from prepare_source_st4 a
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
group by score_range_desc) ccc on aaa.score_range_desc = ccc.score_range_desc
left join (select score_range_desc
,sum(approve_rpt2+reject_rpt2+other_rpt2) actual
from prepare_source_st4 a
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
group by score_range_desc) ddd on aaa.score_range_desc = ddd.score_range_desc
left join (select sum(approve_rpt2) approve
,sum(reject_rpt2) reject
,sum(other_rpt2) other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_all
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
group by score_range_desc) eee on aaa.score_range_desc = eee.score_range_desc
left join (select sum(approve_rpt2) approve
,sum(reject_rpt2) reject
,sum(other_rpt2) other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_all											 
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
group by score_range_desc) fff on aaa.score_range_desc = fff.score_range_desc
left join (select sum(approve_rpt2) approve
,sum(reject_rpt2) reject
,sum(other_rpt2) other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_all											 
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
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
group by score_range_desc) ggg on aaa.score_range_desc = ggg.score_range_desc							
where aaa.flag = '#model_name#'
group by aaa.score_range_id, aaa.score_range_desc

union all

select 20 score_range_id
,'No. of Loans' score_range_desc
,to_char(sum(nvl(bbb.actual,0))) actual_3m
,to_char(sum(nvl(ccc.actual,0))) actual_12m
,to_char(sum(nvl(ddd.actual,0))) actual_more12m
,'('||sum(nvl(bbb.reject,0))||'/'||case when sum(nvl(bbb.actual,0)) = 0 then 0 else sum(nvl(bbb.actual,0)) end||')*100' reject_3m
,'('||sum(nvl(ccc.reject,0))||'/'||case when sum(nvl(ccc.actual,0)) = 0 then 0 else sum(nvl(ccc.actual,0)) end||')*100' reject_12m
,'('||sum(nvl(ddd.reject,0))||'/'||case when sum(nvl(ddd.actual,0)) = 0 then 0 else sum(nvl(ddd.actual,0)) end||')*100' reject_more12m
,'('||sum(nvl(bbb.approve,0))||'/'||case when sum(nvl(bbb.actual,0)) = 0 then 0 else sum(nvl(bbb.actual,0)) end||')*100' approve_3m
,'('||sum(nvl(ccc.approve,0))||'/'||case when sum(nvl(ccc.actual,0)) = 0 then 0 else sum(nvl(ccc.actual,0)) end||')*100' approve_12m
,'('||sum(nvl(ddd.approve,0))||'/'||case when sum(nvl(ddd.actual,0)) = 0 then 0 else sum(nvl(ddd.actual,0)) end||')*100' approve_more12m
,'('||sum(nvl(bbb.other,0))||'/'||case when sum(nvl(bbb.actual,0)) = 0 then 0 else sum(nvl(bbb.actual,0)) end||')*100' other_3m
,'('||sum(nvl(ccc.other,0))||'/'||case when sum(nvl(ccc.actual,0)) = 0 then 0 else sum(nvl(ccc.actual,0)) end||')*100' other_12m
,'('||sum(nvl(ddd.other,0))||'/'||case when sum(nvl(ddd.actual,0)) = 0 then 0 else sum(nvl(ddd.actual,0)) end||')*100' other_more12m

from dual aaa 
left join 
(select sum(approve_rpt2+reject_rpt2+other_rpt2) actual
,sum(approve_rpt2) approve
,sum(reject_rpt2) reject
,sum(other_rpt2) other										  
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
) bbb on 1 = 1

left join 

(select sum(approve_rpt2+reject_rpt2+other_rpt2) actual
,sum(approve_rpt2) approve
,sum(reject_rpt2) reject
,sum(other_rpt2) other								
from prepare_source_st4 a
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
) ccc on 1 = 1

left join 

(select sum(approve_rpt2+reject_rpt2+other_rpt2) actual
,sum(approve_rpt2) approve
,sum(reject_rpt2) reject
,sum(other_rpt2) other								
from prepare_source_st4 a
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
) ddd on 1 = 1
group by 20,'No. of Loans'

union all

select 30 score_range_id
,'Avg. Score' score_range_desc
,sum(nvl(bbb.total_score,0))||'/'||sum(case when nvl(bbb.total_all,0) = 0 then 0 else nvl(bbb.total_all,0) end) actual_3m
,sum(nvl(ccc.total_score,0))||'/'||sum(case when nvl(ccc.total_all,0) = 0 then 0 else nvl(ccc.total_all,0) end) actual_12m
,sum(nvl(ddd.total_score,0))||'/'||sum(case when nvl(ddd.total_all,0) = 0 then 0 else nvl(ddd.total_all,0) end) actual_more12m
,sum(nvl(bbb.reject_score,0))||'/'||sum(case when nvl(bbb.total_reject,0) = 0 then 0 else nvl(bbb.total_reject,0) end) reject_3m
,sum(nvl(ccc.reject_score,0))||'/'||sum(case when nvl(ccc.total_reject,0) = 0 then 0 else nvl(ccc.total_reject,0) end) reject_12m
,sum(nvl(ddd.reject_score,0))||'/'||sum(case when nvl(ddd.total_reject,0) = 0 then 0 else nvl(ddd.total_reject,0) end) reject_more12m
,sum(nvl(bbb.approve_score,0))||'/'||sum(case when nvl(bbb.total_approve,0) = 0 then 0 else nvl(bbb.total_approve,0) end) approve_3m
,sum(nvl(ccc.approve_score,0))||'/'||sum(case when nvl(ccc.total_approve,0) = 0 then 0 else nvl(ccc.total_approve,0) end) approve_12m
,sum(nvl(ddd.approve_score,0))||'/'||sum(case when nvl(ddd.total_approve,0) = 0 then 0 else nvl(ddd.total_approve,0) end) approve_more12m
,sum(nvl(bbb.other_score,0))||'/'||sum(case when nvl(bbb.total_other,0) = 0 then 0 else nvl(bbb.total_other,0) end) other_3m
,sum(nvl(ccc.other_score,0))||'/'||sum(case when nvl(ccc.total_other,0) = 0 then 0 else nvl(ccc.total_other,0) end) other_12m
,sum(nvl(ddd.other_score,0))||'/'||sum(case when nvl(ddd.total_other,0) = 0 then 0 else nvl(ddd.total_other,0) end) other_more12m
from dual aaa 
left join 
(select a.total_score, a.approve_score, a.reject_score, a.other_score, b.actual
,c.total_approve, c.total_reject, c.total_other, c.total_all
from (select sum(score) total_score
	,sum(score_approve) approve_score
	,sum(score_reject) reject_score
	,sum(score_other) other_score
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
) a 
inner join 
(select sum(approve_rpt2+reject_rpt2+other_rpt2) actual                                  
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
) b on 1 = 1
inner join (select sum(approve_rpt2) total_approve
,sum(reject_rpt2) total_reject
,sum(other_rpt2) total_other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_all
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
) c on 1 = 1
) bbb on 1 = 1

left join 

(select a.total_score, a.approve_score, a.reject_score, a.other_score, b.actual
,c.total_approve, c.total_reject, c.total_other, c.total_all
from (select sum(score) total_score
,sum(score_approve) approve_score
,sum(score_reject) reject_score
,sum(score_other) other_score
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
) a 
inner join (select sum(approve_rpt2+reject_rpt2+other_rpt2) actual                                       
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
) b on 1 = 1
inner join (select sum(approve_rpt2) total_approve
,sum(reject_rpt2) total_reject
,sum(other_rpt2) total_other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_all
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end
) c on 1 = 1
) ccc on 1 = 1
left join 
(select a.total_score, a.approve_score, a.reject_score, a.other_score, b.actual
,c.total_approve, c.total_reject, c.total_other, c.total_all
from (select sum(score) total_score
,sum(score_approve) approve_score
,sum(score_reject) reject_score
,sum(score_other) other_score
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
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 
else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end) a 
inner join (select sum(approve_rpt2+reject_rpt2+other_rpt2) actual                                       
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
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 
else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
) b on 1 = 1
inner join (select sum(approve_rpt2) total_approve
,sum(reject_rpt2) total_reject
,sum(other_rpt2) total_other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_all
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
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 
else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
) c on 1 = 1
) ddd on 1 = 1
group by 30,'Avg. Score'

union all

select 40 score_range_id
,'% Below Cutoff' score_range_desc
,'('||sum(nvl(bbb.below_cutoff,0))||'/'||sum(case when nvl(bbb.total_below_cutoff,0) = 0 then 0 else nvl(bbb.total_below_cutoff,0) end)||')*100' actual_3m
,'('||sum(nvl(ccc.below_cutoff,0))||'/'||sum(case when nvl(ccc.total_below_cutoff,0) = 0 then 0 else nvl(ccc.total_below_cutoff,0) end)||')*100' actual_12m
,'('||sum(nvl(ddd.below_cutoff,0))||'/'||sum(case when nvl(ddd.total_below_cutoff,0) = 0 then 0 else nvl(ddd.total_below_cutoff,0) end)||')*100' actual_more12m
,'('||sum(nvl(bbb.below_cutoff_reject,0))||'/'||sum(case when nvl(bbb.total_below_cutoff_reject,0) = 0 then 0 else nvl(bbb.total_below_cutoff_reject,0) end)||')*100' reject_3m
,'('||sum(nvl(ccc.below_cutoff_reject,0))||'/'||sum(case when nvl(ccc.total_below_cutoff_reject,0) = 0 then 0 else nvl(ccc.total_below_cutoff_reject,0) end)||')*100' reject_12m
,'('||sum(nvl(ddd.below_cutoff_reject,0))||'/'||sum(case when nvl(ddd.total_below_cutoff_reject,0) = 0 then 0 else nvl(ddd.total_below_cutoff_reject,0) end)||')*100' reject_more12m
,'('||sum(nvl(bbb.below_cutoff_approve,0))||'/'||sum(case when nvl(bbb.total_below_cutoff_approve,0) = 0 then 0 else nvl(bbb.total_below_cutoff_approve,0) end)||')*100' approve_3m
,'('||sum(nvl(ccc.below_cutoff_approve,0))||'/'||sum(case when nvl(ccc.total_below_cutoff_approve,0) = 0 then 0 else nvl(ccc.total_below_cutoff_approve,0) end)||')*100' approve_12m
,'('||sum(nvl(ddd.below_cutoff_approve,0))||'/'||sum(case when nvl(ddd.total_below_cutoff_approve,0) = 0 then 0 else nvl(ddd.total_below_cutoff_approve,0) end)||')*100' approve_more12m
,'('||sum(nvl(bbb.below_cutoff_other,0))||'/'||sum(case when nvl(bbb.total_below_cutoff_other,0) = 0 then 0 else nvl(bbb.total_below_cutoff_other,0) end)||')*100' other_3m
,'('||sum(nvl(ccc.below_cutoff_other,0))||'/'||sum(case when nvl(ccc.total_below_cutoff_other,0) = 0 then 0 else nvl(ccc.total_below_cutoff_other,0) end)||')*100' other_12m
,'('||sum(nvl(ddd.below_cutoff_other,0))||'/'||sum(case when nvl(ddd.total_below_cutoff_other,0) = 0 then 0 else nvl(ddd.total_below_cutoff_other,0) end)||')*100' other_more12m

from dual aaa 
left join 
(select a.below_cutoff, a.below_cutoff_approve, a.below_cutoff_reject, a.below_cutoff_other, b.actual
,c.total_below_cutoff_approve, c.total_below_cutoff_reject, c.total_below_cutoff_other, c.total_below_cutoff
from (select sum(below_cutoff) below_cutoff
,sum(below_cutoff_approve) below_cutoff_approve
,sum(below_cutoff_reject) below_cutoff_reject
,sum(below_cutoff_other) below_cutoff_other													
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) a 
inner join 
(select sum(approve_rpt2+reject_rpt2+other_rpt2) actual                                       
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) b on 1 = 1
inner join 
(select sum(approve_rpt2) total_below_cutoff_approve
,sum(reject_rpt2) total_below_cutoff_reject
,sum(other_rpt2) total_below_cutoff_other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_below_cutoff																									
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) c on 1 = 1
) bbb on 1 = 1
left join 
(select a.below_cutoff, a.below_cutoff_approve, a.below_cutoff_reject, a.below_cutoff_other, b.actual
,c.total_below_cutoff_approve, c.total_below_cutoff_reject, c.total_below_cutoff_other, c.total_below_cutoff
from (select sum(below_cutoff) below_cutoff
,sum(below_cutoff_approve) below_cutoff_approve
,sum(below_cutoff_reject) below_cutoff_reject
,sum(below_cutoff_other) below_cutoff_other													
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) a 
inner join 
(select sum(approve_rpt2+reject_rpt2+other_rpt2) actual                                       
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) b on 1 = 1
inner join 
(select sum(approve_rpt2) total_below_cutoff_approve
,sum(reject_rpt2) total_below_cutoff_reject
,sum(other_rpt2) total_below_cutoff_other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_below_cutoff																									
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) c on 1 = 1
) ccc on 1 = 1
left join 
(select a.below_cutoff, a.below_cutoff_approve, a.below_cutoff_reject, a.below_cutoff_other, b.actual
,c.total_below_cutoff_approve, c.total_below_cutoff_reject, c.total_below_cutoff_other, c.total_below_cutoff
from (select sum(below_cutoff) below_cutoff
,sum(below_cutoff_approve) below_cutoff_approve
,sum(below_cutoff_reject) below_cutoff_reject
,sum(below_cutoff_other) below_cutoff_other													
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
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 
else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end) a 
inner join 
(select sum(approve_rpt2+reject_rpt2+other_rpt2) actual                                       
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
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 
else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end) b on 1 = 1
inner join (select sum(approve_rpt2) total_below_cutoff_approve
,sum(reject_rpt2) total_below_cutoff_reject
,sum(other_rpt2) total_below_cutoff_other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_below_cutoff																									
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
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 
else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end) c on 1 = 1
) ddd on 1 = 1
group by 40,'% Below Cutoff'

union all

select 50 score_range_id
,'% Pass Cutoff' score_range_desc
,'('||sum(nvl(bbb.pass_cutoff,0))||'/'||sum(case when nvl(bbb.total_pass_cutoff,0) = 0 then 0 else nvl(bbb.total_pass_cutoff,0) end)||')*100' actual_3m

,'('||sum(nvl(ccc.pass_cutoff,0))||'/'||sum(case when nvl(ccc.total_pass_cutoff,0) = 0 then 0 else nvl(ccc.total_pass_cutoff,0) end)||')*100' actual_12m

,'('||sum(nvl(ddd.pass_cutoff,0))||'/'||sum(case when nvl(ddd.total_pass_cutoff,0) = 0 then 0 else nvl(ddd.total_pass_cutoff,0) end)||')*100' actual_more12m

,'('||sum(nvl(bbb.pass_cutoff_reject,0))||'/'||sum(case when nvl(bbb.total_pass_cutoff_reject,0) = 0 then 0 else nvl(bbb.total_pass_cutoff_reject,0) end)||')*100' reject_3m

,'('||sum(nvl(ccc.pass_cutoff_reject,0))||'/'||sum(case when nvl(ccc.total_pass_cutoff_reject,0) = 0 then 0 else nvl(ccc.total_pass_cutoff_reject,0) end)||')*100' reject_12m

,'('||sum(nvl(ddd.pass_cutoff_reject,0))||'/'||sum(case when nvl(ddd.total_pass_cutoff_reject,0) = 0 then 0 else nvl(ddd.total_pass_cutoff_reject,0) end)||')*100' reject_more12m

,'('||sum(nvl(bbb.pass_cutoff_approve,0))||'/'||sum(case when nvl(bbb.total_pass_cutoff_approve,0) = 0 then 0 else nvl(bbb.total_pass_cutoff_approve,0) end)||')*100' approve_3m

,'('||sum(nvl(ccc.pass_cutoff_approve,0))||'/'||sum(case when nvl(ccc.total_pass_cutoff_approve,0) = 0 then 0 else nvl(ccc.total_pass_cutoff_approve,0) end)||')*100' approve_12m

,'('||sum(nvl(ddd.pass_cutoff_approve,0))||'/'||sum(case when nvl(ddd.total_pass_cutoff_approve,0) = 0 then 0 else nvl(ddd.total_pass_cutoff_approve,0) end)||')*100' approve_more12m

,'('||sum(nvl(bbb.pass_cutoff_other,0))||'/'||sum(case when nvl(bbb.total_pass_cutoff_other,0) = 0 then 0 else nvl(bbb.total_pass_cutoff_other,0) end)||')*100' other_3m

,'('||sum(nvl(ccc.pass_cutoff_other,0))||'/'||sum(case when nvl(ccc.total_pass_cutoff_other,0) = 0 then 0 else nvl(ccc.total_pass_cutoff_other,0) end)||')*100' other_12m

,'('||sum(nvl(ddd.pass_cutoff_other,0))||'/'||sum(case when nvl(ddd.total_pass_cutoff_other,0) = 0 then 0 else nvl(ddd.total_pass_cutoff_other,0) end)||')*100' other_more12m

from dual aaa 
left join 
(select a.pass_cutoff, a.pass_cutoff_approve, a.pass_cutoff_reject, a.pass_cutoff_other, b.actual
,c.total_pass_cutoff_approve, c.total_pass_cutoff_reject, c.total_pass_cutoff_other, c.total_pass_cutoff
from (select sum(pass_cutoff) pass_cutoff
,sum(pass_cutoff_approve) pass_cutoff_approve
,sum(pass_cutoff_reject) pass_cutoff_reject
,sum(pass_cutoff_other) pass_cutoff_other													
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) a 
inner join 
(select sum(approve_rpt2+reject_rpt2+other_rpt2) actual                                       
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) b on 1 = 1
inner join 
(select sum(approve_rpt2) total_pass_cutoff_approve
,sum(reject_rpt2) total_pass_cutoff_reject
,sum(other_rpt2) total_pass_cutoff_other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_pass_cutoff																									
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-2))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-3)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) c on 1 = 1
) bbb on 1 = 1
left join 
(select a.pass_cutoff, a.pass_cutoff_approve, a.pass_cutoff_reject, a.pass_cutoff_other, b.actual
,c.total_pass_cutoff_approve, c.total_pass_cutoff_reject, c.total_pass_cutoff_other, c.total_pass_cutoff
from (select sum(pass_cutoff) pass_cutoff
,sum(pass_cutoff_approve) pass_cutoff_approve
,sum(pass_cutoff_reject) pass_cutoff_reject
,sum(pass_cutoff_other) pass_cutoff_other
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) a 
inner join (select sum(approve_rpt2+reject_rpt2+other_rpt2) actual                                       
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) b on 1 = 1
inner join (select sum(approve_rpt2) total_pass_cutoff_approve
,sum(reject_rpt2) total_pass_cutoff_reject
,sum(other_rpt2) total_pass_cutoff_other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_pass_cutoff																								
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
and create_date >= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then last_day(add_months(current_date,-11))+1 else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end
and create_date <= case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0
then last_day(add_months(current_date,-1)) else last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) end) c on 1 = 1
) ccc on 1 = 1
left join 
(select a.pass_cutoff, a.pass_cutoff_approve, a.pass_cutoff_reject, a.pass_cutoff_other, b.actual
,c.total_pass_cutoff_approve, c.total_pass_cutoff_reject, c.total_pass_cutoff_other, c.total_pass_cutoff
from (select sum(pass_cutoff) pass_cutoff
,sum(pass_cutoff_approve) pass_cutoff_approve
,sum(pass_cutoff_reject) pass_cutoff_reject
,sum(pass_cutoff_other) pass_cutoff_other
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
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 
else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end) a 
inner join 
(select sum(approve_rpt2+reject_rpt2+other_rpt2) actual                                       
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
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 
else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end) b on 1 = 1
inner join 
(select sum(approve_rpt2) total_pass_cutoff_approve
,sum(reject_rpt2) total_pass_cutoff_reject
,sum(other_rpt2) total_pass_cutoff_other
,sum(approve_rpt2+reject_rpt2+other_rpt2) total_pass_cutoff																							
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
and create_date < case when months_between(current_date,to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')) < 0 
then add_months(last_day(add_months(current_date,-1)),-12)+1 
else add_months(last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy')),-12)+1 end) c on 1 = 1
) ddd on 1 = 1
group by 50,'% Pass Cutoff'

) a
order by a.score_range_id";

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