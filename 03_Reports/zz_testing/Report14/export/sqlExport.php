<?php
// require_once('dropdownsClass.php');
// $dropdown = new Dropdown();

function get_report_sql($product_type, $model_type, $card_type, $region_name, $zone_name, $branch_name, $model_version, $sales_channel, $start_date, $end_date, $business_type, $report_id) {
$sql1 = "select bureau_score
,pl_A
,npl_A
,total_A
,pl_B
,npl_B
,total_B
,pl_C
,npl_C
,total_C
,pl_D
,npl_D
,total_D
,total_pl
,total_npl
,total_all

from

(select b0.sseq
,b0.bureau_score

,trim(to_char(b0.pl_A,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.pl_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.pl_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.pl_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.pl_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end pl_A

,trim(to_char(b0.npl_A,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.npl_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.npl_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.npl_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.npl_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end npl_A

,trim(to_char(b0.total_A,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.total_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.total_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.total_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.total_A/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end total_A

,trim(to_char(b0.pl_B,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.pl_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.pl_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.pl_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.pl_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end pl_B

,trim(to_char(b0.npl_B,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.npl_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.npl_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.npl_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.npl_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end npl_B

,trim(to_char(b0.total_B,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.total_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.total_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.total_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.total_B/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end total_B

,trim(to_char(b0.pl_C,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.pl_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.pl_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.pl_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.pl_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end pl_C

,trim(to_char(b0.npl_C,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.npl_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.npl_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.npl_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.npl_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end npl_C

,trim(to_char(b0.total_C,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.total_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.total_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.total_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.total_C/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end total_C

,trim(to_char(b0.pl_D,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.pl_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.pl_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.pl_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.pl_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end pl_D

,trim(to_char(b0.npl_D,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.npl_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.npl_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.npl_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.npl_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end npl_D

,trim(to_char(b0.total_D,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.total_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.total_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.total_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.total_D/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end total_D

,trim(to_char(b0.total_pl,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.total_pl/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.total_pl/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.total_pl/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.total_pl/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end total_pl

,trim(to_char(b0.total_npl,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.total_npl/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'||trim(to_char(round((b0.total_npl/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round((b0.total_npl/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round((b0.total_npl/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))||'%)' end total_npl

,trim(to_char(b0.total_all,'999,999,999,999,999'))
||' ('
||case when substr(round((b0.total_all/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.' 
then '0'
||trim(to_char(round((b0.total_all/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))
||'%)'
when round((b0.total_all/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'
||'%)'
else trim(to_char(round((b0.total_all/case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99'))
||'%)' end total_all

from

(select a0.sseq
,a0.bureau_score
,nvl(a1.pl,0) pl_A
,nvl(a1.npl,0) npl_A
,nvl(a1.total,0) total_A
,nvl(a2.pl,0) pl_B
,nvl(a2.npl,0) npl_B
,nvl(a2.total,0) total_B
,nvl(a3.pl,0) pl_C
,nvl(a3.npl,0) npl_C
,nvl(a3.total,0) total_C
,nvl(a4.pl,0) pl_D
,nvl(a4.npl,0) npl_D
,nvl(a4.total,0) total_D
,nvl(a1.pl,0) + nvl(a2.pl,0) + nvl(a3.pl,0) + nvl(a4.pl,0) total_pl
,nvl(a1.npl,0) + nvl(a2.npl,0) + nvl(a3.npl,0) + nvl(a4.npl,0) total_npl
,nvl(a1.total,0) + nvl(a2.total,0) + nvl(a3.total,0) + nvl(a4.total,0) total_all

from master_bure_score a0 

left join

(select score_grade
,sum(pl) pl
,sum(delmore_90) npl
,sum(pl) + sum(delmore_90) total
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
and grade_desc = 'ระดับความเสี่ยงต่ำ'
group by score_grade
) a1 on a0.flag = a1.score_grade

left join

(select score_grade
,sum(pl) pl
,sum(delmore_90) npl
,sum(pl) + sum(delmore_90) total
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
and grade_desc = 'ระดับความเสี่ยงปานกลาง'
group by score_grade
) a2 on a0.flag = a2.score_grade

left join

(select score_grade
,sum(pl) pl
,sum(delmore_90) npl
,sum(pl) + sum(delmore_90) total
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
and grade_desc = 'ระดับความเสี่ยงค่อนข้างสูง'
group by score_grade
) a3 on a0.flag = a3.score_grade

left join

(select score_grade
,sum(pl) pl
,sum(delmore_90) npl
,sum(pl) + sum(delmore_90) total
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
and grade_desc = 'ระดับความเสี่ยงสูง'
group by score_grade
) a4 on a0.flag = a4.score_grade) b0

inner join

(select sum(pl) + sum(delmore_90) total
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))) b1 on 1 = 1

union all

select 20 sseq
,'Total' bureau_score

,trim(to_char(sum(b0.pl_A),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.pl_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.pl_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.pl_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.pl_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_pl_A

,trim(to_char(sum(b0.npl_A),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.npl_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.npl_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.npl_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.npl_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_npl_A

,trim(to_char(sum(b0.total_A),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.total_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.total_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.total_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.total_A)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_total_A

,trim(to_char(sum(b0.pl_B),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.pl_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.pl_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.pl_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.pl_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_pl_B

,trim(to_char(sum(b0.npl_B),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.npl_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.npl_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.npl_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.npl_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_npl_B

,trim(to_char(sum(b0.total_B),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.total_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.total_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.total_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.total_B)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_total_B

,trim(to_char(sum(b0.pl_C),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.pl_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.pl_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.pl_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.pl_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_pl_C

,trim(to_char(sum(b0.npl_C),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.npl_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.npl_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.npl_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.npl_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_npl_C

,trim(to_char(sum(b0.total_C),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.total_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.total_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.total_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.total_C)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_total_C

,trim(to_char(sum(b0.pl_D),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.pl_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.pl_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.pl_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.pl_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_pl_D

,trim(to_char(sum(b0.npl_D),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.npl_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.npl_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.npl_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.npl_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_npl_D

,trim(to_char(sum(b0.total_D),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.total_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.total_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.total_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.total_D)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_total_D

,trim(to_char(sum(b0.total_pl),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.total_pl)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.total_pl)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.total_pl)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.total_pl)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_total_pl

,trim(to_char(sum(b0.total_npl),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.total_npl)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.total_npl)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.total_npl)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.total_npl)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'999.99')||'%)') end per_total_npl

,trim(to_char(sum(b0.total_all),'999,999,999,999,999'))
||' ('
||case when substr(round(sum(b0.total_all)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),1,1) = '.'
then '0'||trim(to_char(round(sum(b0.total_all)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2),'.99'))||'%)'
when round(sum(b0.total_all)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,2) = 0 then '0.00'||'%)'
else trim(to_char(round(sum(b0.total_all)/sum(case when b0.total_all = 0 then 1 else b0.total_all end)*100,0),'999.99')||'%)') end per_total_all
from

(select a0.sseq
,a0.bureau_score
,nvl(a1.pl,0) pl_A
,nvl(a1.npl,0) npl_A
,nvl(a1.total,0) total_A
,nvl(a2.pl,0) pl_B
,nvl(a2.npl,0) npl_B
,nvl(a2.total,0) total_B
,nvl(a3.pl,0) pl_C
,nvl(a3.npl,0) npl_C
,nvl(a3.total,0) total_C
,nvl(a4.pl,0) pl_D
,nvl(a4.npl,0) npl_D
,nvl(a4.total,0) total_D
,nvl(a1.pl,0) + nvl(a2.pl,0) + nvl(a3.pl,0) + nvl(a4.pl,0) total_pl
,nvl(a1.npl,0) + nvl(a2.npl,0) + nvl(a3.npl,0) + nvl(a4.npl,0) total_npl
,nvl(a1.total,0) + nvl(a2.total,0) + nvl(a3.total,0) + nvl(a4.total,0) total_all

from (select * from master_bure_score where flag = 'Other') a0 

left join

(select 'Other' score_grade
,sum(pl) pl
,sum(delmore_90) npl
,sum(pl) + sum(delmore_90) total
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
and grade_desc = 'ระดับความเสี่ยงต่ำ'
group by 'Other'
) a1 on a0.flag = a1.score_grade

left join

(select 'Other' score_grade
,sum(pl) pl
,sum(delmore_90) npl
,sum(pl) + sum(delmore_90) total
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
and grade_desc = 'ระดับความเสี่ยงปานกลาง'
group by 'Other'
) a2 on a0.flag = a2.score_grade

left join

(select 'Other' score_grade
,sum(pl) pl
,sum(delmore_90) npl
,sum(pl) + sum(delmore_90) total
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
and grade_desc = 'ระดับความเสี่ยงค่อนข้างสูง'
group by 'Other'
) a3 on a0.flag = a3.score_grade

left join

(select 'Other' score_grade
,sum(pl) pl
,sum(delmore_90) npl
,sum(pl) + sum(delmore_90) total
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
and grade_desc = 'ระดับความเสี่ยงสูง'
group by 'Other'
) a4 on a0.flag = a4.score_grade) b0

inner join

(select sum(pl) + sum(delmore_90) total
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))) b1 on 1 = 1

group by 'Total') all_full

order by all_full.sseq asc";

$sql2 = "select all_.grade_desc
,all_.approve_rpt2
,all_.per_approve_rpt2
,all_.reject_rpt2
,all_.per_reject_rpt2
,all_.cancel_rpt2
,all_.per_cancel_rpt2
,all_.incompleted
,all_.per_incompleted

,all_.pending
,all_.per_pending

,all_.other
,all_.per_other
,all_.total_status
,all_.per_total_status
,all_.pl
,all_.per_pl
,all_.npl
,all_.per_npl
from
(select aa.score_range_id
,aa.grade_desc
,nvl(approve_rpt2,0) approve_rpt2
,nvl(per_approve_rpt2,0) per_approve_rpt2
,nvl(reject_rpt2,0) reject_rpt2
,nvl(per_reject_rpt2,0) per_reject_rpt2
,nvl(cancel_rpt2,0) cancel_rpt2
,nvl(per_cancel_rpt2,0) per_cancel_rpt2
,nvl(incompleted,0) incompleted
,nvl(per_incompleted,0) per_incompleted

,nvl(pending,0) pending
,nvl(per_pending,0) per_pending

,nvl(other,0) other
,nvl(per_other,0) per_other
,nvl(total_status,0) total_status
,nvl(per_total_status,0) per_total_status
,nvl(pl,0) pl
,nvl(per_pl,0) per_pl
,nvl(npl,0) npl
,nvl(per_npl,0) per_npl
from
(select grade_desc, max(score_range_id) score_range_id
from score_range_master
group by grade_desc) aa

left join

(select a.grade_desc
,sum(a.approve_rpt2) approve_rpt2
,round((sum(a.approve_rpt2)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_approve_rpt2
,sum(a.reject_rpt2) reject_rpt2
,round((sum(a.reject_rpt2)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_reject_rpt2
,sum(a.cancel_rpt2) cancel_rpt2
,round((sum(a.cancel_rpt2)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_cancel_rpt2
,sum(a.incompleted) incompleted
,round((sum(a.incompleted)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_incompleted

,sum(a.pending) pending
,round((sum(a.pending)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_pending

,sum(a.other) other
,round((sum(a.other)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_other
,sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) total_status
,round((sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other)/case when max(b.total_status) = 0 then 1 else max(b.total_status) end) * 100,2) per_total_status
,sum(a.pl) pl
,round((sum(a.pl)/case when sum(a.pl)+sum(a.delmore_90) = 0 then 1 else sum(a.pl)+sum(a.delmore_90) end) * 100,2) per_pl
,sum(a.delmore_90) npl
,round((sum(a.delmore_90)/case when sum(a.pl)+sum(a.delmore_90) = 0 then 1 else sum(a.pl)+sum(a.delmore_90) end) * 100,2) per_npl
from prepare_source_st15 a inner join (select sum(approve_rpt2 + reject_rpt2 + cancel_rpt2 + incompleted + pending + other) total_status
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
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
and create_date between to_date('#start_date#','dd/mm/yyyy')
and last_day(to_date('#end_date#','dd/mm/yyyy'))                                                            
group by a.grade_desc
) bb on aa.grade_desc = bb.grade_desc

union all

select 0 score_range_id
,'Total' grade_desc
,sum(a.approve_rpt2) approve_rpt2
,round((sum(a.approve_rpt2)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_approve_rpt2
,sum(a.reject_rpt2) reject_rpt2
,round((sum(a.reject_rpt2)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_reject_rpt2
,sum(a.cancel_rpt2) cancel_rpt2
,round((sum(a.cancel_rpt2)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_cancel_rpt2
,sum(a.incompleted) incompleted
,round((sum(a.incompleted)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_incompleted

,sum(a.pending) pending
,round((sum(a.pending)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_pending

,sum(a.other) other
,round((sum(a.other)/case when sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) = 0 then 1 else sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) end) * 100,2) per_other
,sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other) total_status
,round((sum(a.approve_rpt2 + a.reject_rpt2 + a.cancel_rpt2 + a.incompleted + a.pending + a.other)/case when max(b.total_status) = 0 then 1 else max(b.total_status) end) * 100,2) per_total_status
,sum(a.pl) pl
,round((sum(a.pl)/case when sum(a.pl)+sum(a.delmore_90) = 0 then 1 else sum(a.pl)+sum(a.delmore_90) end) * 100,2) per_pl
,sum(a.delmore_90) npl
,round((sum(a.delmore_90)/case when sum(a.pl)+sum(a.delmore_90) = 0 then 1 else sum(a.pl)+sum(a.delmore_90) end) * 100,2) per_npl
from prepare_source_st15  a inner join (select sum(approve_rpt2 + reject_rpt2 + cancel_rpt2 + incompleted + pending + other) total_status
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
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
and create_date between to_date('#start_date#','dd/mm/yyyy')
and last_day(to_date('#end_date#','dd/mm/yyyy'))
) all_
order by all_.score_range_id desc";

$sql3 = "select all_.grade_desc
,all_.ever0
,all_.per_ever0
,all_.ever1_30
,all_.per_ever1_30
,all_.ever31_60
,all_.per_ever31_60
,all_.ever61_90
,all_.per_ever61_90
,all_.delmore_90
,all_.per_ever_more90
,all_.total_active
,all_.per_active
from

(select aa.score_range_id
,aa.grade_desc grade_desc
,nvl(bb.ever0,0) ever0
,nvl(bb.per_ever0,0) per_ever0
,nvl(bb.ever1_30,0) ever1_30
,nvl(bb.per_ever1_30,0) per_ever1_30
,nvl(bb.ever31_60,0) ever31_60
,nvl(bb.per_ever31_60,0) per_ever31_60
,nvl(bb.ever61_90,0) ever61_90
,nvl(bb.per_ever61_90,0) per_ever61_90
,nvl(bb.delmore_90,0) delmore_90
,nvl(bb.per_ever_more90,0) per_ever_more90
,nvl(bb.total_active,0) total_active
,nvl(bb.per_active,0) per_active
from 

(select grade_desc, max(score_range_id) score_range_id
from score_range_master
group by grade_desc) aa

left join

(select grade_desc
,sum(a.ever0) ever0
,round((sum(a.ever0)/case when sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) = 0 then 1 else sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) end)*100,2) per_ever0
,sum(a.ever1_30) ever1_30
,round((sum(a.ever1_30)/case when sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) = 0 then 1 else sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) end)*100,2) per_ever1_30
,sum(a.ever31_60) ever31_60
,round((sum(a.ever31_60)/case when sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) = 0 then 1 else sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) end)*100,2) per_ever31_60
,sum(a.ever61_90) ever61_90
,round((sum(a.ever61_90)/case when sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) = 0 then 1 else sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) end)*100,2) per_ever61_90
,sum(a.delmore_90) delmore_90
,round((sum(a.delmore_90)/case when sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) = 0 then 1 else sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) end)*100,2) per_ever_more90
,sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) total_active
,round(((sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90))
/case when max(b.active) = 0 then 1 else max(b.active) end)*100,2) per_active
from prepare_source_st15 a inner join (select sum(ever0) + sum(ever1_30) + sum(ever31_60) + sum(ever61_90) + sum(delmore_90) active
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))) b on 1 = 1
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
group by a.grade_desc) bb on aa.grade_desc = bb.grade_desc

union all

select 0 score_range_id
,'Total' grade_desc
,sum(a.ever0) ever0
,round((sum(a.ever0)/case when sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) = 0 then 1 else sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) end)*100,2) per_ever0
,sum(a.ever1_30) ever1_30
,round((sum(a.ever1_30)/case when sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) = 0 then 1 else sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) end)*100,2) per_ever1_30
,sum(a.ever31_60) ever31_60
,round((sum(a.ever31_60)/case when sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) = 0 then 1 else sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) end)*100,2) per_ever31_60
,sum(a.ever61_90) ever61_90
,round((sum(a.ever61_90)/case when sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) = 0 then 1 else sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) end)*100,2) per_ever61_90
,sum(a.delmore_90) delmore_90
,round((sum(a.delmore_90)/case when sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) = 0 then 1 else sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) end)*100,2) per_ever_more90
,sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90) total_active
,round(((sum(a.ever0) + sum(a.ever1_30) + sum(a.ever31_60) + sum(a.ever61_90) + sum(a.delmore_90))
/case when max(b.active) = 0 then 1 else max(b.active) end)*100,2) per_active
from prepare_source_st15 a inner join (select sum(ever0) + sum(ever1_30) + sum(ever31_60) + sum(ever61_90) + sum(delmore_90) active 
from prepare_source_st15
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))) b on 1 = 1
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
and last_day(to_date('#end_date#','dd/mm/yyyy'))
) all_

order by all_.score_range_id desc";

switch ($report_id) {
case 'รายงานติดตามประเมินผลการใช้คะแนนเครดิต(Credit Bureau Score) ประกอบการพิจารณาอนุมัติบัตรเครดิตและสินเชื่อบัตรเงินสด':
$sql = $sql1;
break;
case 'รายงานแสดงร้อยละของลูกค้าบัตรเครดิตสินเชื่อบัตรเงินสด แยกตามระดับความเสี่ยงและสถานะของลูกค้า':
$sql = $sql2;
break;
case 'รายงานติดตามการชำระหนี้สำหรับลูกค้าบัตรเครดิต/สินเชื่อบัตรเงินสด แยกตามระดับความเสี่ยง(เกรด)':
$sql = $sql3;
break;
default:
$sql = $sql1;
break;
}
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

return $sql;
}

?>