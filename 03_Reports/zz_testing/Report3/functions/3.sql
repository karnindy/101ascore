select merge_.attibute
,nvl(merge_.dev,0) dev
,nvl(merge_.per_dev,0) per_dev
,nvl(merge_.actual,0) actual
,nvl(merge_.per_actual,0) per_actual
,nvl(merge_.change,0) change
,merge_.point point
,merge_.point_diff point_diff
from 
(select aa.factor_details_level_id
,aa.factor_details_level_desc attibute
,aa.dev                     
,round(aa.dev/case when nvl(aa.total_dev,0) = 0 then 1 else nvl(aa.total_dev,0) end * 100,2) per_dev
,bb.actual
,round(bb.actual/case when nvl(bb.total_actual,0) = 0 then 1 else nvl(bb.total_actual,0) end * 100,2) per_actual
,round((round(bb.actual/case when nvl(bb.total_actual,0) = 0 then 1 else nvl(bb.total_actual,0) end * 100,2) 
- round(aa.dev/case when nvl(aa.total_dev,0) = 0 then 1 else nvl(aa.total_dev,0) end * 100,2))/100,2) change
,to_char(aa.score)point
,to_char(round((round((round(bb.actual/case when nvl(bb.total_actual,0) = 0 then 1 else nvl(bb.total_actual,0) end * 100,2) 
- round(aa.dev/case when nvl(aa.total_dev,0) = 0 then 1 else nvl(aa.total_dev,0) end * 100,2))/100,2))*aa.score,2)) point_diff
from (select a.factor_display
,a.factor_details_level_id
,a.factor_details_level_descj                                  
,a.factor_details_level_desc
,a.score
,a.bad
,a.good
,a.woe
,a.dev
,b.total_dev total_dev
from (select factor_display
,factor_details_level_id
,factor_details_level_descj                                    
,factor_details_level_desc
,max(score) score
,sum(bad) bad
,sum(good) good
,sum(woe) woe
,sum(dev) dev
from prepare_source_st5
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type in ('#card_type#'))
and factor_display = '#factor#'
group by factor_display
,factor_details_level_id
,factor_details_level_descj                                    
,factor_details_level_desc) a inner join (select sum(dev) total_dev 
from prepare_source_st5
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type in ('#card_type#'))
and factor_display = '#factor#'
) b on 1 = 1) aa 
left join
(select a.factor
,a.factor_details_level_id
,sum(a.score) score
,sum(a.actual) actual
,max(b.total_actual) total_actual
from (select factor
,factor_details_level_id
,score
,sum(nvl(actual,0)) actual
from prepare_source_st6
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type in ('#card_type#'))
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')
and factor = '#factor#'
group by factor
,factor_details_level_id
,score) a inner join (select sum(actual) total_actual
from prepare_source_st6
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type in ('#card_type#'))
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')
and factor = '#factor#'
) b on 1 = 1
group by a.factor, a.factor_details_level_id
) bb on aa.factor_display = bb.factor and trim(aa.factor_details_level_id) = trim(bb.factor_details_level_id)

union all

/* display */
select 20 factor_details_level_id
,'Total'
,round(sum(total.dev),5) dev
,round(sum(total.per_dev),5) per_dev
,round(sum(total.actual),5) actual
,round(sum(total.per_actual),5) per_actual
,round(sum(total.change),5) change
,'' point
,'' point_diff
from (select aa.factor_details_level_id
,aa.factor_details_level_desc attibute
,aa.dev                     
,round(aa.dev/case when nvl(aa.total_dev,0) = 0 then 1 else nvl(aa.total_dev,0) end * 100,2) per_dev
,bb.actual
,round(bb.actual/case when nvl(bb.total_actual,0) = 0 then 1 else nvl(bb.total_actual,0) end * 100,5) per_actual
,round((round(bb.actual/case when nvl(bb.total_actual,0) = 0 then 1 else nvl(bb.total_actual,0) end * 100,5) 
- round(aa.dev/case when nvl(aa.total_dev,0) = 0 then 1 else nvl(aa.total_dev,0) end * 100,5))/100,5) change
,aa.score point
,round((round((round(bb.actual/case when nvl(bb.total_actual,0) = 0 then 1 else nvl(bb.total_actual,0) end * 100,5) 
- round(aa.dev/case when nvl(aa.total_dev,0) = 0 then 1 else nvl(aa.total_dev,0) end * 100,2))/100,5))*aa.score,5) point_diff
from (select a.factor_display
,a.factor_details_level_id
,a.factor_details_level_descj
,a.factor_details_level_desc
,a.score
,a.bad
,a.good
,a.woe
,a.dev
,b.total_dev total_dev
from (select factor_display
,factor_details_level_id
,factor_details_level_descj
,factor_details_level_desc
,sum(score) score
,sum(bad) bad
,sum(good) good
,sum(woe) woe
,sum(dev) dev
from prepare_source_st5
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type in ('#card_type#'))
and factor_display = '#factor#'
group by factor_display
,factor_details_level_id
,factor_details_level_descj
,factor_details_level_desc) a inner join (select sum(dev) total_dev 
from prepare_source_st5
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type in ('#card_type#'))
and factor_display = '#factor#'
) b on 1 = 1) aa 
left join
(select a.factor
,a.factor_details_level_id
,sum(a.score) score
,sum(a.actual) actual
,max(b.total_actual) total_actual
from (select factor
,factor_details_level_id
,score
,sum(actual) actual
from prepare_source_st6
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type in ('#card_type#'))
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')
and factor = '#factor#'
group by factor
,factor_details_level_id
,score) a inner join (select sum(actual) total_actual
from prepare_source_st6
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type in ('#card_type#'))
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type = '#business_type#')
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
and create_date between to_date('#start_date#','dd/mm/yyyy') and to_date('#end_date#','dd/mm/yyyy')
and factor = '#factor#'
) b on 1 = 1
group by a.factor, a.factor_details_level_id
) bb on aa.factor_display = bb.factor and trim(aa.factor_details_level_id) = trim(bb.factor_details_level_id)
) total
group by 20
,'Total') merge_
order by merge_.factor_details_level_id asc