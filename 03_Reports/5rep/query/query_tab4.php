<?php
function tab4_1($appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
$sql="
select distinct all_.appl_id_aam
,all_.product_type
,all_.create_date||' '||'00:00:00' create_date
,all_.card_type
,all_.ca2_cr_limit_amt
,all_.appl_status
,all_.region_name
,all_.zone_name
,all_.branch_name
,all_.product_program
,all_.payment_method
,all_.sales_channel
,all_.req_request_date
,all_.max_calc_sequence
,all_.score
,all_.max_seq_total_grade
,all_.max_seq_total_grade_desc
,all_.score_grade
,all_.update_by
,all_.update_date_aam||' '||'00:00:00' update_date_aam
,all_.ca2_appl_result_code
,all_.ca1_approve_by
,all_.ca2_approve_by
,all_.ca2_total_dti_perc
,all_.vip_flag
,all_.ca2_dvtn_rej_reason_code
,all_.cif
,all_.gender
,all_.first_name_th||' '||all_.last_name_th customer_name
,'' dob
,floor(nvl(all_.age,0)/12)||' ปี '||mod(nvl(all_.age,0),12)||' เดือน' age
,all_.education_level
,all_.cid
,all_.marital_status
,all_.current_province
,all_.legal_home_number
,all_.legal_province
,all_.office_number
,all_.legal_mobile_number
,all_.current_residential_status
,all_.no_of_children
,all_.source_of_asset
,all_.estimate_asset_value
,all_.emploment_status_code
,all_.occupation_code
,all_.professional_code
,all_.business_type_code
,all_.sub_business_type_code
,floor(nvl(all_.time_in_job,0)/12)||' ปี '||mod(nvl(all_.time_in_job,0),12)||' เดือน' time_in_job
,all_.estimate_income_per_month
,all_.salary_amt
,all_.ot_m1_amt
,all_.ot_m2_amt
,all_.ot_m3_amt
,all_.final_mnth_inc_amt
,all_.total_mnth_inc_amt
,all_.total_debt_amt
from
(
select *
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
and ('#product_type#' = '--เลือกค่า--' or product_type = '#product_type#')
and ('#card_type#' = '--เลือกค่า--' or card_type = '#card_type#')
and ('#cid#' = 'Donut@Poseidons!@' or cid = '#cid#')
and ('#region_name#' = '--เลือกค่า--' or region_name = '#region_name#')
and ('#branch_name#' = '--เลือกค่า--' or branch_name = '#branch_name#')
and ('#zone_name#' = '--เลือกค่า--' or zone_name = '#zone_name#')
and ('#appl_id_aam#' = 'Donut@Poseidons!@' or appl_id_aam = '#appl_id_aam#')

and 
((
'#create_start_date#' = 'วว/ดด/ปปปป' 
and '#create_end_date#' = 'วว/ดด/ปปปป' )
or
(create_date between to_date(case when '#create_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_start_date#' end,'dd/mm/yyyy') 
and to_date(case when '#create_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_end_date#' end,'dd/mm/yyyy')))

and

((
'#update_start_date#' = 'วว/ดด/ปปปป' 
and '#update_end_date#' = 'วว/ดด/ปปปป' )
or
(update_date_aam between to_date(case when '#update_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_start_date#' end,'dd/mm/yyyy') 
and to_date(case when '#update_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_end_date#' end,'dd/mm/yyyy')))

and ('#ca2_appl_result_code#' = '--เลือกค่า--' or ca2_appl_result_code = '#ca2_appl_result_code#')
order by card_type asc, appl_id_aam asc, max_calc_sequence desc) all_
where rownum <= 1
";

$sql=str_replace("#appl_id_aam#",$appl_id_aam,$sql);
$sql=str_replace("#product_type#",$product_type,$sql);
$sql=str_replace("#card_type#",$card_type,$sql);
$sql=str_replace("#cid#",$cid,$sql);
$sql=str_replace("#region_name#",$region_name,$sql);
$sql=str_replace("#branch_name#",$branch_name,$sql);
$sql=str_replace("#zone_name#",$zone_name,$sql);
$sql=str_replace("#create_start_date#",$create_start_date,$sql);
$sql=str_replace("#create_end_date#",$create_end_date,$sql);
$sql=str_replace("#update_start_date#",$update_start_date,$sql);
$sql=str_replace("#update_end_date#",$update_end_date,$sql);
$sql=str_replace("#ca2_appl_result_code#",$ca2_appl_result_code,$sql);
$sql=str_replace('--เลือกค่า--','1',$sql);
$sql=str_replace('วว/ดด/ปปปป','01/01/1970',$sql);
return $sql;
}

function tab4_2($appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
$sql="
select b.calc_sequence
,b.factor_name
,b.factor_code
,b.factor_desc
,b.factor_score
from
(select a0.*
from 
(select *
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
and ('#product_type#' = '--เลือกค่า--' or product_type = '#product_type#')
and ('#card_type#' = '--เลือกค่า--' or card_type = '#card_type#')
and ('#cid#' = 'Donut@Poseidons!@' or cid = '#cid#')
and ('#region_name#' = '--เลือกค่า--' or region_name = '#region_name#')
and ('#branch_name#' = '--เลือกค่า--' or branch_name = '#branch_name#')
and ('#zone_name#' = '--เลือกค่า--' or zone_name = '#zone_name#')
and ('#appl_id_aam#' = 'Donut@Poseidons!@' or appl_id_aam = '#appl_id_aam#')
and 
((
'#create_start_date#' = 'วว/ดด/ปปปป' 
and '#create_end_date#' = 'วว/ดด/ปปปป' )
or
(create_date between to_date(case when '#create_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_start_date#' end,'dd/mm/yyyy') 
and to_date(case when '#create_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_end_date#' end,'dd/mm/yyyy')))

and

((
'#update_start_date#' = 'วว/ดด/ปปปป' 
and '#update_end_date#' = 'วว/ดด/ปปปป' )
or
(update_date_aam between to_date(case when '#update_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_start_date#' end,'dd/mm/yyyy') 
and to_date(case when '#update_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_end_date#' end,'dd/mm/yyyy')))

and ('#ca2_appl_result_code#' = '--เลือกค่า--' or ca2_appl_result_code = '#ca2_appl_result_code#')
order by card_type asc, appl_id_aam asc, max_calc_sequence desc) a0 
where rownum <= 1) a inner join vw_aps_factor b 
on a.appl_id_aam = b.appl_id_aam
and a.card_type = b.card_type
group by b.card_type
,b.appl_id_aam
,b.calc_sequence
,b.factor_name
,b.factor_code
,b.factor_desc
,b.factor_score
order by b.card_type asc
,b.appl_id_aam asc
,b.calc_sequence desc
,b.factor_name asc
,b.factor_code asc
,b.factor_desc asc
,b.factor_score asc
";

$sql=str_replace("#appl_id_aam#",$appl_id_aam,$sql);
$sql=str_replace("#product_type#",$product_type,$sql);
$sql=str_replace("#card_type#",$card_type,$sql);
$sql=str_replace("#cid#",$cid,$sql);
$sql=str_replace("#region_name#",$region_name,$sql);
$sql=str_replace("#branch_name#",$branch_name,$sql);
$sql=str_replace("#zone_name#",$zone_name,$sql);
$sql=str_replace("#create_start_date#",$create_start_date,$sql);
$sql=str_replace("#create_end_date#",$create_end_date,$sql);
$sql=str_replace("#update_start_date#",$update_start_date,$sql);
$sql=str_replace("#update_end_date#",$update_end_date,$sql);
$sql=str_replace("#ca2_appl_result_code#",$ca2_appl_result_code,$sql);
$sql=str_replace('--เลือกค่า--','1',$sql);
$sql=str_replace('วว/ดด/ปปปป','01/01/1970',$sql);
return $sql;
}

function tab4_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
$sql="
select distinct all_.appl_id_aam
,all_.product_type
,all_.create_date||' '||'00:00:00' create_date
,all_.card_type
,all_.ca2_cr_limit_amt
,all_.appl_status
,all_.region_name
,all_.zone_name
,all_.branch_name
,all_.product_program
,all_.payment_method
,all_.sales_channel
,all_.req_request_date
,all_.max_calc_sequence
,all_.score
,all_.max_seq_total_grade
,all_.max_seq_total_grade_desc
,all_.score_grade
,all_.update_by
,all_.update_date_aam||' '||'00:00:00' update_date_aam
,all_.ca2_appl_result_code
,all_.ca1_approve_by
,all_.ca2_approve_by
,all_.ca2_total_dti_perc
,all_.vip_flag
,all_.ca2_dvtn_rej_reason_code
,all_.cif
,all_.gender
,all_.first_name_th||' '||all_.last_name_th customer_name
,'' dob
,floor(nvl(all_.age,0)/12)||' ปี '||mod(nvl(all_.age,0),12)||' เดือน' age
,all_.education_level
,all_.cid
,all_.marital_status
,all_.current_province
,all_.legal_home_number
,all_.legal_province
,all_.office_number
,all_.legal_mobile_number
,all_.current_residential_status
,all_.no_of_children
,all_.source_of_asset
,all_.estimate_asset_value
,all_.emploment_status_code
,all_.occupation_code
,all_.professional_code
,all_.business_type_code
,all_.sub_business_type_code
,floor(nvl(all_.time_in_job,0)/12)||' ปี '||mod(nvl(all_.time_in_job,0),12)||' เดือน' time_in_job
,all_.estimate_income_per_month
,all_.salary_amt
,all_.ot_m1_amt
,all_.ot_m2_amt
,all_.ot_m3_amt
,all_.final_mnth_inc_amt
,all_.total_mnth_inc_amt
,all_.total_debt_amt
from vw_aps_validate all_
where borrower_type = 'บัตรหลัก'
and card_type = '#card_type#'
and appl_id_aam = '#appl_id_aam#'
";

$sql=str_replace("#max_calc_sequence#",$calc_sequence,$sql);
$sql=str_replace("#appl_id_aam#",$appl_id_aam,$sql);
$sql=str_replace("#product_type#",$product_type,$sql);
$sql=str_replace("#card_type#",$card_type,$sql);
$sql=str_replace("#cid#",$cid,$sql);
$sql=str_replace("#region_name#",$region_name,$sql);
$sql=str_replace("#branch_name#",$branch_name,$sql);
$sql=str_replace("#zone_name#",$zone_name,$sql);
$sql=str_replace("#create_start_date#",$create_start_date,$sql);
$sql=str_replace("#create_end_date#",$create_end_date,$sql);
$sql=str_replace("#update_start_date#",$update_start_date,$sql);
$sql=str_replace("#update_end_date#",$update_end_date,$sql);
$sql=str_replace("#ca2_appl_result_code#",$ca2_appl_result_code,$sql);
$sql=str_replace('--เลือกค่า--','1',$sql);
$sql=str_replace('วว/ดด/ปปปป','01/01/1970',$sql);
return $sql;
}

function tab4_4($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
$sql="
select b.calc_sequence 
,b.factor_name 
,b.factor_code 
,b.factor_desc 
,b.factor_score 
from 
(select distinct appl_id_aam
,card_type 
from vw_aps_validate 
where borrower_type = 'บัตรหลัก' 
and card_type = '#card_type#' 
and appl_id_aam = '#appl_id_aam#') a 
inner join 
(select * 
from vw_aps_factor 
where calc_sequence = '#max_calc_sequence#') b 
on a.appl_id_aam = b.appl_id_aam 
and a.card_type = b.card_type 
order by b.card_type asc 
,b.appl_id_aam asc 
,b.calc_sequence desc 
,b.factor_name asc 
,b.factor_code asc 
,b.factor_desc asc 
,b.factor_score asc
";

$sql=str_replace("#max_calc_sequence#",$calc_sequence,$sql);
$sql=str_replace("#appl_id_aam#",$appl_id_aam,$sql);
$sql=str_replace("#product_type#",$product_type,$sql);
$sql=str_replace("#card_type#",$card_type,$sql);
$sql=str_replace("#cid#",$cid,$sql);
$sql=str_replace("#region_name#",$region_name,$sql);
$sql=str_replace("#branch_name#",$branch_name,$sql);
$sql=str_replace("#zone_name#",$zone_name,$sql);
$sql=str_replace("#create_start_date#",$create_start_date,$sql);
$sql=str_replace("#create_end_date#",$create_end_date,$sql);
$sql=str_replace("#update_start_date#",$update_start_date,$sql);
$sql=str_replace("#update_end_date#",$update_end_date,$sql);
$sql=str_replace("#ca2_appl_result_code#",$ca2_appl_result_code,$sql);
$sql=str_replace('--เลือกค่า--','1',$sql);
$sql=str_replace('วว/ดด/ปปปป','01/01/1970',$sql);
return $sql;
}

?>