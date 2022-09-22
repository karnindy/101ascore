<?php
function tab2_1($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
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
,all_.update_date_aam||' '||'00:00:00' update_date
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
(select *
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
and ('#product_type#' = '--เลือกค่า--' or product_type = '#product_type#')
and ('#card_type#' = '--เลือกค่า--' or card_type = '#card_type#')
and ('#cid#' = 'Donut@Poseidons!@' or cid = '#cid#')
and ('#region_name#' = '--เลือกค่า--' or region_name = '#region_name#')
and ('#branch_name#' = '--เลือกค่า--' or branch_name = '#branch_name#')
and ('#zone_name#' = '--เลือกค่า--' or zone_name = '#zone_name#')

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

function tab2_2($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
$sql="
select b.factor_name
,b.factor_code
,b.factor_desc
,b.factor_score
from
(select appl_id_aam
,card_type
,max_calc_sequence
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
where rownum <= 1) a inner join vw_aps_factor b 
on a.appl_id_aam = b.appl_id_aam
and a.card_type = b.card_type
and a.max_calc_sequence = b.calc_sequence
";

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

function tab2_3($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
$sql="
select distinct appl_id_aam
,product_type
,create_date||' '||'00:00:00' create_date
,card_type
,ca2_cr_limit_amt
,appl_status
,region_name
,zone_name
,branch_name
,product_program
,payment_method
,sales_channel
,req_request_date
,max_calc_sequence
,score
,max_seq_total_grade
,max_seq_total_grade_desc
,score_grade
,update_by
,update_date_aam||' '||'00:00:00' update_date
,ca2_appl_result_code
,ca1_approve_by
,ca2_approve_by
,ca2_total_dti_perc
,vip_flag
,ca2_dvtn_rej_reason_code
,cif
,gender
,first_name_th||' '||last_name_th customer_name
,'' dob
,floor(nvl(age,0)/12)||' ปี '||mod(nvl(age,0),12)||' เดือน' age
,education_level
,cid
,marital_status
,current_province
,legal_home_number
,legal_province
,office_number
,legal_mobile_number
,current_residential_status
,no_of_children
,source_of_asset
,estimate_asset_value
,emploment_status_code
,occupation_code
,professional_code
,business_type_code
,sub_business_type_code
,floor(nvl(time_in_job,0)/12)||' ปี '||mod(nvl(time_in_job,0),12)||' เดือน' time_in_job
,estimate_income_per_month
,salary_amt
,ot_m1_amt
,ot_m2_amt
,ot_m3_amt
,final_mnth_inc_amt
,total_mnth_inc_amt
,total_debt_amt
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
and card_type = '#card_type#'
and appl_id_aam = '#appl_id_aam#'
and max_calc_sequence = '#max_calc_sequence#'
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

function tab2_4($calc_sequence,$appl_id_aam,$product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
$sql="
select b.factor_name
,b.factor_code
,b.factor_desc
,b.factor_score
from
(select appl_id_aam
,card_type
,max_calc_sequence
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
and card_type = '#card_type#'
and appl_id_aam = '#appl_id_aam#'
and max_calc_sequence = '#max_calc_sequence#'
group by appl_id_aam,card_type,max_calc_sequence) a inner join vw_aps_factor b 
on a.appl_id_aam = b.appl_id_aam
and a.card_type = b.card_type
and a.max_calc_sequence = b.calc_sequence
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