<?php
// require_once('dropdownsClass.php');
// $dropdown = new Dropdown();

function get_report_sql($product_type, $model_type, $card_type, $region_name, $zone_name, $branch_name, $model_version, $sales_channel, $month, $year, $business_type) {
$sql = "/* 
insert into prepare_source_st9
select appl_id, account_type, 1 good, 0 bad
from prepare_source_st8
where account_type like '8%'
union all
select appl_id, account_type, 0 good, 1 bad
from prepare_source_st8
where account_type like '3%'; commit;
*/

select final.score_range_desc
,final.per_cum_g_curr
,final.per_cum_b_curr
,final.sep_bg_curr
,final.per_bad_rate_curr
,final.per_good_dev
,final.per_bad_dev
,final.sep_bg_dev
,final.per_bad_rate_dev
from
(select curr.score_range_id
,curr.score_range_desc
,curr.per_cum_g_curr
,curr.per_cum_b_curr
,curr.sep_bg_curr
,curr.per_bad_rate_curr
,dev.per_good_dev
,dev.per_bad_dev
,dev.sep_bg_dev
,dev.per_bad_rate_dev
from
(
select aaa.score_range_id
,aaa.score_range_desc
,nvl(bbb.per_cum_g_curr,0) per_cum_g_curr
,nvl(ccc.per_cum_b_curr,0) per_cum_b_curr
,nvl(bbb.per_cum_g_curr,0) - nvl(ccc.per_cum_b_curr,0) sep_bg_curr
,nvl(ddd.per_bad_rate_curr,0) per_bad_rate_curr
from score_range_master aaa left join (select aa.score_range_desc
,round(actived_good/(case when bb.total_actived_good = 0 then 1 else bb.total_actived_good end)*100,2) per_cum_g_curr
from 
(select a.score_range_desc
,count(*) actived_good
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.good = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#'
group by a.score_range_desc) aa 

inner join

(select count(*) total_actived_good
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.good = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#') bb on 1 = 1) bbb on aaa.score_range_desc = bbb.score_range_desc
left join (select aa.score_range_desc
,round(actived_bad/(case when bb.total_actived_bad = 0 then 1 else bb.total_actived_bad end)*100,2) per_cum_b_curr
from 
(select a.score_range_desc
,count(*) actived_bad
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.bad = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#'
group by a.score_range_desc) aa 

inner join

(select count(*) total_actived_bad
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.bad = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#') bb on 1 = 1) ccc on aaa.score_range_desc = ccc.score_range_desc
left join (select aa.score_range_desc
,round(actived_bad/(case when aa.total_actived = 0 then 1 else aa.total_actived end)*100,2) per_bad_rate_curr
from 
(select a.score_range_desc
,sum(case when b.bad = 1 then 1 else 0 end) actived_bad
,count(*) total_actived
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#'
group by a.score_range_desc) aa 

inner join

(select count(*) total_actived
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.good = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#') bb on 1 = 1) ddd on aaa.score_range_desc = ddd.score_range_desc
where aaa.flag = '#model_name#'
) curr 
inner join 
(
select aa.score_range_desc
,round(aa.good/(case when bb.total_good = 0 then 1 else bb.total_good end) * 100,2) per_good_dev
,round(aa.bad/(case when bb.total_bad = 0 then 1 else bb.total_bad end) * 100,2) per_bad_dev
,round((aa.good/(case when bb.total_good = 0 then 1 else bb.total_good end) * 100) 
- (aa.bad/(case when bb.total_bad = 0 then 1 else bb.total_bad end) * 100),2) sep_bg_dev
,round(aa.bad/(case when aa.good+aa.bad = 0 then 1 else aa.good+aa.bad end) * 100,2) per_bad_rate_dev
from
(
select a.score_range_desc
,sum(nvl(b.good,0)) good
,sum(nvl(b.bad,0)) bad
,sum(nvl(b.development,0)) development
from score_range_master a left join psi_template b 
on b.score between a.score_min and a.score_max
and a.flag = b.cardtype_srm_key
where a.flag = '#model_name#'
group by a.score_range_desc
) aa
inner join
(
select sum(nvl(b.good,0)) total_good
,sum(nvl(b.bad,0)) total_bad
,sum(nvl(b.development,0)) development
from score_range_master a left join psi_template b 
on b.score between a.score_min and a.score_max
and a.flag = b.cardtype_srm_key
where a.flag = '#model_name#'
) bb on 1 = 1

) dev on curr.score_range_desc = dev.score_range_desc

union all

select 20
,'KS'
,null
,null
,max(abs(curr.sep_bg_curr))
,null
,null
,null
,max(abs(dev.sep_bg_dev))
,null
from
(
select aaa.score_range_desc
,nvl(bbb.per_cum_g_curr,0) per_cum_g_curr
,nvl(ccc.per_cum_b_curr,0) per_cum_b_curr
,nvl(bbb.per_cum_g_curr,0) - nvl(ccc.per_cum_b_curr,0) sep_bg_curr
,nvl(ddd.per_bad_rate_curr,0) per_bad_rate_curr
from score_range_master aaa left join (select aa.score_range_desc
,round(actived_good/(case when bb.total_actived_good = 0 then 1 else bb.total_actived_good end)*100,2) per_cum_g_curr
from 
(select a.score_range_desc
,count(*) actived_good
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.good = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#'
group by a.score_range_desc) aa 

inner join

(select count(*) total_actived_good
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.good = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#') bb on 1 = 1) bbb on aaa.score_range_desc = bbb.score_range_desc
left join (select aa.score_range_desc
,round(actived_bad/(case when bb.total_actived_bad = 0 then 1 else bb.total_actived_bad end)*100,2) per_cum_b_curr
from 
(select a.score_range_desc
,count(*) actived_bad
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.bad = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#'
group by a.score_range_desc) aa 

inner join

(select count(*) total_actived_bad
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.bad = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#') bb on 1 = 1) ccc on aaa.score_range_desc = ccc.score_range_desc
left join (select aa.score_range_desc
,round(actived_bad/(case when aa.total_actived = 0 then 1 else aa.total_actived end)*100,2) per_bad_rate_curr
from 
(select a.score_range_desc
,sum(case when b.bad = 1 then 1 else 0 end) actived_bad
,count(*) total_actived
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#'
group by a.score_range_desc) aa 

inner join

(select count(*) total_actived
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.good = 1 
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#') bb on 1 = 1) ddd on aaa.score_range_desc = ddd.score_range_desc
where aaa.flag = '#model_name#'
) curr 
inner join 
(
select aa.score_range_desc
,round(aa.good/(case when bb.total_good = 0 then 1 else bb.total_good end) * 100,2) per_good_dev
,round(aa.bad/(case when bb.total_bad = 0 then 1 else bb.total_bad end) * 100,2) per_bad_dev
,round((aa.good/(case when bb.total_good = 0 then 1 else bb.total_good end) * 100) 
- (aa.bad/(case when bb.total_bad = 0 then 1 else bb.total_bad end) * 100),2) sep_bg_dev
,round(aa.bad/(case when bb.development = 0 then 1 else bb.development end) * 100,2) per_bad_rate_dev
from
(
select a.score_range_desc
,sum(nvl(b.good,0)) good
,sum(nvl(b.bad,0)) bad
,sum(nvl(b.development,0)) development
from score_range_master a left join psi_template b 
on b.score between a.score_min and a.score_max
and a.flag = b.cardtype_srm_key
where a.flag = '#model_name#'
group by a.score_range_desc
) aa
inner join
(
select sum(nvl(b.good,0)) total_good
,sum(nvl(b.bad,0)) total_bad
,sum(nvl(b.development,0)) development
from score_range_master a left join psi_template b 
on b.score between a.score_min and a.score_max
and a.flag = b.cardtype_srm_key
where a.flag = '#model_name#'
) bb on 1 = 1

) dev on curr.score_range_desc = dev.score_range_desc

union all

select 30
,'Total'
,round(sum(aaaa.per_cum_g_curr),0) per_cum_g_curr
,round(sum(aaaa.per_cum_b_curr),0) per_cum_b_curr
,round(sum(aaaa.sep_bg_curr),0) sep_bg_curr
--,round(sum(aaaa.per_bad_rate_curr1),2) per_bad_rate_curr
,round((sum(aaaa.per_bad_rate_curr1)/case when sum(aaaa.per_bad_rate_curr2) = 0 then 1 else sum(aaaa.per_bad_rate_curr2) end)*100,2) per_bad_rate_curr
,round(sum(aaaa.per_good_dev),2) per_good_dev
,round(sum(aaaa.per_bad_dev),2) per_bad_dev
,round(sum(aaaa.sep_bg_dev),2) sep_bg_dev
--,round(sum(aaaa.per_bad_rate_dev),2) per_bad_rate_dev
,round((sum(aaaa.per_bad_rate_dev1)/case when sum(aaaa.per_bad_rate_dev2) = 0 then 1 else sum(aaaa.per_bad_rate_dev2) end)*100,2) per_bad_rate_dev
from
(select curr.score_range_id
,curr.score_range_desc
,curr.per_cum_g_curr
,curr.per_cum_b_curr
,curr.sep_bg_curr
,curr.per_bad_rate_curr1
,curr.per_bad_rate_curr2
,dev.per_good_dev
,dev.per_bad_dev
,dev.sep_bg_dev
,dev.per_bad_rate_dev1
,dev.per_bad_rate_dev2
from
(
select aaa.score_range_id
,aaa.score_range_desc
,nvl(bbb.per_cum_g_curr,0) per_cum_g_curr
,nvl(ccc.per_cum_b_curr,0) per_cum_b_curr
,nvl(bbb.per_cum_g_curr,0) - nvl(ccc.per_cum_b_curr,0) sep_bg_curr
,nvl(ddd.per_bad_rate_curr1,0) per_bad_rate_curr1
,nvl(ddd.per_bad_rate_curr2,0) per_bad_rate_curr2
from score_range_master aaa left join (select aa.score_range_desc
,round(actived_good/(case when bb.total_actived_good = 0 then 1 else bb.total_actived_good end)*100,2) per_cum_g_curr
from 
(select a.score_range_desc
,count(*) actived_good
from prepare_source_st8 a left join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.good = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#'
group by a.score_range_desc) aa 

inner join

(select count(*) total_actived_good
from prepare_source_st8 a left join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.good = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#') bb on 1 = 1) bbb on aaa.score_range_desc = bbb.score_range_desc
left join (select aa.score_range_desc
,round(actived_bad/(case when bb.total_actived_bad = 0 then 1 else bb.total_actived_bad end)*100,2) per_cum_b_curr
from 
(select a.score_range_desc
,count(*) actived_bad
from prepare_source_st8 a left join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.bad = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#'
group by a.score_range_desc) aa 

inner join

(select count(*) total_actived_bad
from prepare_source_st8 a left join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.bad = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#') bb on 1 = 1) ccc on aaa.score_range_desc = ccc.score_range_desc
left join (select aa.score_range_desc
,actived_bad per_bad_rate_curr1
,aa.total_actived per_bad_rate_curr2
from 
(select a.score_range_desc
,sum(case when b.bad = 1 then 1 else 0 end) actived_bad
,count(*) total_actived
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#'
group by a.score_range_desc) aa 

inner join

(select count(*) total_actived
from prepare_source_st8 a inner join prepare_source_st9 b
on trim(a.appl_id) = b.appl_id
and trim(a.account_type) = b.account_type
where b.good = 1
and a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and extract(year from a.create_date) = '#YYYY#'
and extract(month from a.create_date) = '#MM#') bb on 1 = 1) ddd on aaa.score_range_desc = ddd.score_range_desc
where aaa.flag = '#model_name#'
) curr 
left join 
(
select aa.score_range_desc
,round(aa.good/(case when bb.total_good = 0 then 1 else bb.total_good end) * 100,5) per_good_dev
,round(aa.bad/(case when bb.total_bad = 0 then 1 else bb.total_bad end) * 100,5) per_bad_dev
,round((aa.good/(case when bb.total_good = 0 then 1 else bb.total_good end) * 100) 
- (aa.bad/(case when bb.total_bad = 0 then 1 else bb.total_bad end) * 100),5) sep_bg_dev
,aa.bad per_bad_rate_dev1
,aa.good+aa.bad per_bad_rate_dev2
from
(
select a.score_range_desc
,sum(nvl(b.good,0)) good
,sum(nvl(b.bad,0)) bad
,sum(nvl(b.development,0)) development
from score_range_master a left join psi_template b 
on b.score between a.score_min and a.score_max
and a.flag = b.cardtype_srm_key
where a.flag = '#model_name#'
group by a.score_range_desc
) aa
inner join
(
select sum(nvl(b.good,0)) total_good
,sum(nvl(b.bad,0)) total_bad
,sum(nvl(b.development,0)) development
from score_range_master a left join psi_template b 
on b.score between a.score_min and a.score_max
and a.flag = b.cardtype_srm_key
where a.flag = '#model_name#'
) bb on 1 = 1

) dev on curr.score_range_desc = dev.score_range_desc) aaaa
group by 30,'Total') final

order by final.score_range_id";

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