<?php
// require_once('dropdownsClass.php');
// $dropdown = new Dropdown();

function get_all_year($product_type, $model_name, $card_type, $model_version, $sales_channel, $region_name, $zone_name, $branch_name, $month, $year) {
$sql = "select a.sseq
,b.all_year
,a.month_detail||' '||b.all_year all_year
from master_quater a left join (select yyear all_year
from prepare_source_st11
group by yyear) b on 1 = 1
where all_year||' '||sseq not in (select aa.year_||' '||aa.sseq all_
from (select a.*, b.year_
from master_quater a left join (select yyear year_ 
from prepare_source_st11
group by yyear) b on 1 = 1) aa           
where aa.year_ =  (select min(yyear) year_ 
from prepare_source_st11)
and aa.sseq in (1,2,3)

union all
select aa.year_||' '||aa.sseq all_
from (select a.*, b.year_
from master_quater a left join (select yyear year_ 
from prepare_source_st11
group by yyear) b on 1 = 1) aa           
where aa.year_ =  (select max(yyear) year_ 
from prepare_source_st11)
and aa.sseq in (2,3,4)
and (select count(*)
from (select yyear 
from prepare_source_st11
group by yyear) a) >= 4)
group by a.month_detail||' '||b.all_year, a.sseq, b.all_year
order by b.all_year asc, a.sseq asc";
       // $sql = str_replace("#product_type#", $product_type, $sql);
       // $sql = str_replace("#model_name#", $model_name, $sql);
       // $sql = str_replace("#card_type#", $card_type, $sql);
       // $sql = str_replace("#model_version#", $model_version, $sql);
       // $sql = str_replace("#sales_channel#", $sales_channel, $sql);
       // $sql = str_replace("#region_name#", $region_name, $sql);
       // $sql = str_replace("#zone_name#", $zone_name, $sql);
       // $sql = str_replace("#branch_name#", $branch_name, $sql);
       // $sql = str_replace("#MM#", $month, $sql);
       // $sql = str_replace("#YYYY#", $year, $sql);

       return $sql;
}

function get_report_sql($product_type, $model_type, $card_type, $region_name, $zone_name, $branch_name, $model_version, $sales_channel, $month, $year, $all_year, $business_type) {
$sql = "with t as
(

select aaa.sseq
,aaa.all_year
,aaa.all_year_
,aaa.all_year approve_date
,nvl(bbb.delmore_90,0) delmore_90
,nvl(bbb.total_account,0) total_account
,nvl(bbb.total_account,0) total_account_
from
(select a.*
,a.month_detail||' '||b.all_year all_year
,b.all_year all_year_
from master_quater a left join (select yyear all_year
from prepare_source_st11
group by yyear) b on 1 = 1
where all_year||' '||sseq not in (select aa.year_||' '||aa.sseq all_
from (select a.*, b.year_
from master_quater a left join (select yyear year_ 
from prepare_source_st11
group by yyear) b on 1 = 1) aa           
where aa.year_ =  (select min(yyear) year_ 
from prepare_source_st11)
and aa.sseq in (1,2,3)

union all
select aa.year_||' '||aa.sseq all_
from (select a.*, b.year_
from master_quater a left join (select yyear year_ 
from prepare_source_st11
group by yyear) b on 1 = 1) aa           
where aa.year_ =  (select max(yyear) year_ 
from prepare_source_st11)
and aa.sseq in (2,3,4)
and (select count(*)
from (select yyear 
from prepare_source_st11
group by yyear) a) >= 4)
) aaa                               
left join
(select aa.month_detail||' '||bb.yyear all_q
,sum(nvl(actual,0)) total_account
,sum(nvl(bb.delmore_90_closed,0)) delmore_90
from master_quater aa inner join (select yyear
,mmonth
,delmore_90_closed
,actual
from prepare_source_st11
where product_type = '#product_type#'
and model_name = '#model_name#'
and ('#card_type#' = 'รวมทุกประเภทบัตร' or card_type = '#card_type#')
and model_version = '#model_version#'
and create_date <= last_day(to_date('01/'||'#MM#'||'#YYYY#','dd/mm/yyyy'))
and ('#sales_channel#' = 'รวมทุกช่องทาง' or sales_channel in ('#sales_channel#'))
and ('#business_type#' = 'รวมทุกสายงานกิจการ' or business_type in ('#business_type#'))
and ('#region_name#' = 'รวมทุกภาค' or region_name in ('#region_name#'))
and ('#zone_name#' = 'รวมทุกเขต' or zone_name in ('#zone_name#'))
and ('#branch_name#' = 'รวมทุกสาขา' or branch_name in ('#branch_name#'))
) bb on bb.mmonth between aa.min_month and aa.max_month
group by aa.month_detail||' '||bb.yyear) bbb on aaa.all_year = bbb.all_q
)
select * from t
pivot (sum(nvl(delmore_90,0))
for all_year in (#all_year#)
)
order by all_year_ asc, sseq asc";

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
       $sql = str_replace("#all_year#", $all_year, $sql);

       return $sql;
}

?>