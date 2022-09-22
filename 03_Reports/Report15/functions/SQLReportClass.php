<?php
// require_once('dropdownsClass.php');
// $dropdown = new Dropdown();

function get_report_sql($product_type, $model_type, $card_type, $region_name, $zone_name, $branch_name, $model_version, $sales_channel, $start_date, $end_date, $business_type) {
$sql = "select all2.score_range_desc
,all2.npls
,all2.pl
,all2.per_npls
,all2.per_pl
,all2.per_npls_cum
,all2.per_pl_cum
,all2.ks

from

(select all_.score_range_id
,all_.score_range_desc
,all_.npls
,all_.pl
,all_.per_npls
,all_.per_pl
,all_.per_npls_cum
,all_.per_pl_cum
,all_.ks

from

(select aaa.score_range_id
,aaa.score_range_desc
,round(max(aaa.npls),2) npls
,round(max(aaa.pl),2) pl
,round(max(aaa.per_npls),2) per_npls
,round(max(aaa.per_pl),2) per_pl
,round(sum(bbb.per_npls),2) per_npls_cum
,round(sum(bbb.per_pl),2) per_pl_cum
,abs(round(sum(bbb.per_npls),2) - round(sum(bbb.per_pl),2)) ks
from

(select aa.score_range_id
,aa.score_range_desc
,nvl(npls,0) npls
,nvl(pl,0) pl
,nvl(per_npls,0) per_npls
,nvl(per_pl,0) per_pl

from score_range_master aa
left join
(select a.score_range_desc
,sum(a.delmore_90) npls
,sum(a.pl) pl
,round((sum(a.delmore_90)/case when max(nvl(b.total_npls,0)) = 0 then 1 else max(nvl(b.total_npls,0)) end) * 100,3) per_npls
,round((sum(a.pl)/case when max(nvl(b.total_pl,0)) = 0 then 1 else max(nvl(b.total_pl,0)) end) * 100,3) per_pl
from prepare_source_st11 a inner join (select sum(delmore_90) total_npls
,sum(pl) total_pl
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
group by a.score_range_desc) bb on aa.score_range_desc = bb.score_range_desc
where aa.flag = '#model_name#') aaa 
inner join 
(select aa.score_range_id
,aa.score_range_desc
,nvl(npls,0) npls
,nvl(pl,0) pl
,nvl(per_npls,0) per_npls
,nvl(per_pl,0) per_pl

from score_range_master aa
left join
(select a.score_range_desc
,sum(a.delmore_90) npls
,sum(a.pl) pl
,round((sum(a.delmore_90)/case when max(nvl(b.total_npls,0)) = 0 then 1 else max(nvl(b.total_npls,0)) end) * 100,3) per_npls
,round((sum(a.pl)/case when max(nvl(b.total_pl,0)) = 0 then 1 else max(nvl(b.total_pl,0)) end) * 100,3) per_pl
from prepare_source_st11 a inner join (select sum(delmore_90) total_npls
,sum(pl) total_pl
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
group by a.score_range_desc) bb on aa.score_range_desc = bb.score_range_desc
where aa.flag = '#model_name#') bbb on aaa.score_range_id >= bbb.score_range_id
group by aaa.score_range_id, aaa.score_range_desc
) all_

union all

select 20 score_range_id
,'Total' score_range_desc
,round(sum(all_.npls),2) npls
,round(sum(all_.pl),2) pl
,round(sum(all_.per_npls),2) per_npls
,round(sum(all_.per_pl),2) per_pl
,null per_npls_cum
,null per_pl_cum
,round(max(all_.ks),2) ks

from

(select aaa.score_range_id
,aaa.score_range_desc
,round(max(aaa.npls),5) npls
,round(max(aaa.pl),5) pl
,round(max(aaa.per_npls),5) per_npls
,round(max(aaa.per_pl),5) per_pl
,round(sum(bbb.per_npls),5) per_npls_cum
,round(sum(bbb.per_pl),5) per_pl_cum
,abs(round(sum(bbb.per_npls),5) - round(sum(bbb.per_pl),5)) ks
from

(select aa.score_range_id
,aa.score_range_desc
,nvl(npls,0) npls
,nvl(pl,0) pl
,nvl(per_npls,0) per_npls
,nvl(per_pl,0) per_pl

from score_range_master aa
left join
(select a.score_range_desc
,sum(a.delmore_90) npls
,sum(a.pl) pl
,round((sum(a.delmore_90)/case when max(nvl(b.total_npls,0)) = 0 then 1 else max(nvl(b.total_npls,0)) end) * 100,3) per_npls
,round((sum(a.pl)/case when max(nvl(b.total_pl,0)) = 0 then 1 else max(nvl(b.total_pl,0)) end) * 100,3) per_pl
from prepare_source_st11 a inner join (select sum(delmore_90) total_npls
,sum(pl) total_pl
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
group by a.score_range_desc) bb on aa.score_range_desc = bb.score_range_desc
where aa.flag = '#model_name#') aaa 
inner join 
(select aa.score_range_id
,aa.score_range_desc
,nvl(npls,0) npls
,nvl(pl,0) pl
,nvl(per_npls,0) per_npls
,nvl(per_pl,0) per_pl

from score_range_master aa
left join
(select a.score_range_desc
,sum(a.delmore_90) npls
,sum(a.pl) pl
,round((sum(a.delmore_90)/case when max(nvl(b.total_npls,0)) = 0 then 1 else max(nvl(b.total_npls,0)) end) * 100,3) per_npls
,round((sum(a.pl)/case when max(nvl(b.total_pl,0)) = 0 then 1 else max(nvl(b.total_pl,0)) end) * 100,3) per_pl
from prepare_source_st11 a inner join (select sum(delmore_90) total_npls
,sum(pl) total_pl
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
group by a.score_range_desc) bb on aa.score_range_desc = bb.score_range_desc
where aa.flag = '#model_name#') bbb on aaa.score_range_id >= bbb.score_range_id
group by aaa.score_range_id, aaa.score_range_desc
) all_) all2
order by all2.score_range_id";

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