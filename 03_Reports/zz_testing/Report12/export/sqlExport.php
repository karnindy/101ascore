<?php
$sql = "select total_all_order.scoregrade
,total_all_order.active_account
,total_all_order.active_amount
,total_all_order.npls_account
,total_all_order.per_npls
,total_all_order.ncb_amount
,total_all_order.per_ncb_amount
,total_all_order.per_cum_npl
from
(select max(total_all.score_range_id) score_range_id
,total_all.scoregrade
,total_all.active_account
,total_all.active_amount
,total_all.npls_account
,total_all.per_npls
,total_all.ncb_amount
,total_all.per_ncb_amount
,total_all.per_cum_npl
from
(select aaa.score_range_id
,aaa.scoregrade
,aaa.active_account
,aaa.active_amount
,aaa.npls_account
,aaa.per_npls
,aaa.ncb_amount
,aaa.per_ncb_amount
,nvl(bbb.per_cum_npl,0) per_cum_npl
from

(select aa.score_range_id
,aa.scoregrade
,nvl(active_account,0) active_account
,nvl(active_amount,0) active_amount
,nvl(npls_account,0) npls_account
,nvl(per_npls,0) per_npls
,nvl(ncb_amount,0) ncb_amount
,nvl(per_ncb_amount,0) per_ncb_amount
from (select max(score_range_id) score_range_id, flag, scoregrade from score_range_master group by scoregrade, flag) aa
left join
(select a.scoregrade
,sum(a.active) active_account
,sum(a.current_balance) active_amount
,sum(a.delmore_90) npls_account
,round((sum(a.delmore_90)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_npls
,sum(a.ncb_amount) ncb_amount
,round((sum(a.ncb_amount)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_ncb_amount
from prepare_source_st13 a inner join (select sum(active) total_active from prepare_source_st13) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy')
and last_day(to_date('#end_date#','dd/mm/yyyy'))
group by a.scoregrade) bb on aa.scoregrade = bb.scoregrade 
where aa.flag = '#model_name#') aaa

left join

(select pre.score_range_id score_range_id
,sum(post.npls_account) npls_account
,sum(post.active_account) active_account
,round((sum(post.npls_account)/case when nvl(sum(post.active_account),0) = 0 then 1 else nvl(sum(post.active_account),0) end)*100,2)per_cum_npl
from
(select aa.score_range_id
,nvl(npls_account,0) npls_account
,nvl(active_account,0) active_account
from score_range_master aa
left join
(select a.scoregrade
,sum(a.active) active_account
,sum(a.current_balance) current_balance
,sum(a.delmore_90) npls_account
,round((sum(a.delmore_90)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_npls
,sum(a.ncb_amount) ncb_amount
,round((sum(a.ncb_amount)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_ncb_amount
from prepare_source_st13 a inner join (select sum(active) total_active from prepare_source_st13) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy')
and last_day(to_date('#end_date#','dd/mm/yyyy'))
group by a.scoregrade) bb on aa.scoregrade = bb.scoregrade 
where aa.flag = '#model_name#'
and aa.score_range_id <= (select max(b.score_range_id) score_range_id
                                                 from prepare_source_st13 a inner join score_range_master b 
                                                 on a.scoregrade =  b.scoregrade
                                                 and a.model_name = b.flag
                                                 where a.product_type = '#product_type#'
                                                 and a.model_name = '#model_name#'
                                                 and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
                                                 and a.model_version = '#model_version#'
                                                 and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
                                                 and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
                                                 and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
                                                 and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
                                                 and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
                                                 and a.create_date between to_date('#start_date#','dd/mm/yyyy')
                                                 and last_day(to_date('#end_date#','dd/mm/yyyy'))
)
) pre
inner join

(select aa.score_range_id
,nvl(npls_account,0) npls_account
,nvl(active_account,0) active_account
from score_range_master aa
left join
(select a.scoregrade
,sum(a.active) active_account
,sum(a.current_balance) current_balance
,sum(a.delmore_90) npls_account
,round((sum(a.delmore_90)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_npls
,sum(a.ncb_amount) ncb_amount
,round((sum(a.ncb_amount)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_ncb_amount
from prepare_source_st13 a inner join (select sum(active) total_active from prepare_source_st13) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy')
and last_day(to_date('#end_date#','dd/mm/yyyy'))
group by a.scoregrade) bb on aa.scoregrade = bb.scoregrade 
where aa.flag = '#model_name#'
and aa.score_range_id <= (select max(b.score_range_id) score_range_id
                                                 from prepare_source_st13 a inner join score_range_master b 
                                                 on a.scoregrade =  b.scoregrade
                                                 and a.model_name = b.flag
                                                 where a.product_type = '#product_type#'
                                                 and a.model_name = '#model_name#'
                                                 and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
                                                 and a.model_version = '#model_version#'
                                                 and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
                                                 and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
                                                 and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
                                                 and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
                                                 and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
                                                 and a.create_date between to_date('#start_date#','dd/mm/yyyy')
                                                 and last_day(to_date('#end_date#','dd/mm/yyyy')))
) post on pre.score_range_id >= post.score_range_id
group by pre.score_range_id) bbb on aaa.score_range_id = bbb.score_range_id

union all

select total_1.score_range_id
,total_1.scoregrade
,total_1.active_account
,total_1.active_amount
,total_1.npls_account
,total_1.per_npls
,total_1.ncb_amount
,total_1.per_ncb_amount
,total_2.per_cum_npl

from

(select 20 score_range_id
,'Total' scoregrade
,sum(a.active) active_account
,sum(a.current_balance) active_amount
,sum(a.delmore_90) npls_account
,round((sum(a.delmore_90)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_npls
,sum(a.ncb_amount) ncb_amount
,round((sum(a.ncb_amount)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_ncb_amount
from prepare_source_st13 a inner join (select sum(active) total_active from prepare_source_st13) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy')
and last_day(to_date('#end_date#','dd/mm/yyyy'))
group by 20, 'Total') total_1

inner join

(select 20 score_range_id
,'Total' scoregrade
,max(round((sum(post.npls_account)/case when nvl(sum(post.active_account),0) = 0 then 1 else nvl(sum(post.active_account),0) end)*100,2)) per_cum_npl
from
(select aa.score_range_id
,nvl(npls_account,0) npls_account
,nvl(active_account,0) active_account
from score_range_master aa
left join
(select a.scoregrade
,sum(a.active) active_account
,sum(a.current_balance) current_balance
,sum(a.delmore_90) npls_account
,round((sum(a.delmore_90)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_npls
,sum(a.ncb_amount) ncb_amount
,round((sum(a.ncb_amount)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_ncb_amount
from prepare_source_st13 a inner join (select sum(active) total_active from prepare_source_st13) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy')
and last_day(to_date('#end_date#','dd/mm/yyyy'))
group by a.scoregrade) bb on aa.scoregrade = bb.scoregrade 
where aa.flag = '#model_name#'
and aa.score_range_id <= (select max(b.score_range_id) score_range_id
                                                 from prepare_source_st13 a inner join score_range_master b 
                                                 on a.scoregrade =  b.scoregrade
                                                 and a.model_name = b.flag
                                                 where a.product_type = '#product_type#'
                                                 and a.model_name = '#model_name#'
                                                 and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
                                                 and a.model_version = '#model_version#'
                                                 and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
                                                 and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
                                                 and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
                                                 and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
                                                 and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
                                                 and a.create_date between to_date('#start_date#','dd/mm/yyyy')
                                                 and last_day(to_date('#end_date#','dd/mm/yyyy')))
) pre

inner join

(select aa.score_range_id
,nvl(npls_account,0) npls_account
,nvl(active_account,0) active_account
from score_range_master aa
left join
(select a.scoregrade
,sum(a.active) active_account
,sum(a.current_balance) current_balance
,sum(a.delmore_90) npls_account
,round((sum(a.delmore_90)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_npls
,sum(a.ncb_amount) ncb_amount
,round((sum(a.ncb_amount)/case when max(nvl(b.total_active,0)) = 0 then 1 else max(nvl(b.total_active,0)) end) * 100,2) per_ncb_amount
from prepare_source_st13 a inner join (select sum(active) total_active from prepare_source_st13) b on 1 = 1
where a.product_type = '#product_type#'
and a.model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
and a.model_version = '#model_version#'
and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
and a.create_date between to_date('#start_date#','dd/mm/yyyy')
and last_day(to_date('#end_date#','dd/mm/yyyy'))
group by a.scoregrade) bb on aa.scoregrade = bb.scoregrade 
where aa.flag = '#model_name#'
and aa.score_range_id <= (select max(b.score_range_id) score_range_id
                                                 from prepare_source_st13 a inner join score_range_master b 
                                                 on a.scoregrade =  b.scoregrade
                                                 and a.model_name = b.flag
                                                 where a.product_type = '#product_type#'
                                                 and a.model_name = '#model_name#'
                                                 and ('#card_type#' = 'รวมทุกประเภทบัตร' or a.card_type = '#card_type#')
                                                 and a.model_version = '#model_version#'
                                                 and ('#sales_channel#' = 'รวมทุกช่องทาง' or a.sales_channel in ('#sales_channel#'))
                                                 and ('#business_type#' = 'รวมทุกสายงานกิจการ' or a.business_type in ('#business_type#'))
                                                 and ('#region_name#' = 'รวมทุกภาค' or a.region_name in ('#region_name#'))
                                                 and ('#zone_name#' = 'รวมทุกเขต' or a.zone_name in ('#zone_name#'))
                                                 and ('#branch_name#' = 'รวมทุกสาขา' or a.branch_name in ('#branch_name#'))
                                                 and a.create_date between to_date('#start_date#','dd/mm/yyyy')
                                                 and last_day(to_date('#end_date#','dd/mm/yyyy')))) post on pre.score_range_id >= post.score_range_id
group by 20,'Total') total_2 on total_1.score_range_id = total_2.score_range_id 
and total_1.scoregrade = total_2.scoregrade
) total_all
group by total_all.scoregrade
,total_all.active_account
,total_all.active_amount
,total_all.npls_account
,total_all.per_npls
,total_all.ncb_amount
,total_all.per_ncb_amount
,total_all.per_cum_npl) total_all_order
order by total_all_order.score_range_id asc";

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