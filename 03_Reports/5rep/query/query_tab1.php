<?php
function tab1($product_type,$card_type,$cid,$region_name,$branch_name,$zone_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
$sql="
select rownum no_
,all_.appl_id_aam
,all_.max_calc_sequence
,all_.create_date
,all_.branch_name
,all_.product_type
,all_.card_type
,all_.ca2_cr_limit_amt
,all_.cif
,all_.cid
,all_.customer_name
,all_.score
,all_.max_seq_total_grade
,all_.req_request_date
,all_.update_date_aam
,all_.ca2_appl_result_code
from
(
select distinct appl_id_aam
,max_calc_sequence
,create_date
,branch_name
,product_type
,card_type
,ca2_cr_limit_amt
,cif
,cid
,first_name_th||' '||last_name_th customer_name
,score
,max_seq_total_grade
,req_request_date
,update_date_aam
,ca2_appl_result_code
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
?>