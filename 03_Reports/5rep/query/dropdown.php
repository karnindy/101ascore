<?php

function ref($ref_id,$ref_card,$ref_sequence,$tab){
$sql = "select 
distinct appl_id_aam
,product_type
,card_type
,cid
,region_name
,zone_name
,branch_name
,ca2_appl_result_code
,update_date_aam
,create_date 
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
and appl_id_aam = '$ref_id'
and card_type = '$ref_card' ";
if ($tab!=4) {
	$sql=$sql."and max_calc_sequence = '$ref_sequence' ";
}
$sql=$sql."";
return $sql;
}

function dd_product_type($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
// 	$create_start_date=str_replace('1970','2001',$create_start_date);
// $update_start_date=str_replace('1970','2001',$update_start_date);
// $create_start_date=date("d/m/y",strtotime($create_start_date));
// $create_end_date=date("d/m/y",strtotime($create_end_date));
// $update_start_date=date("d/m/y",strtotime($update_start_date));
// $update_end_date=date("d/m/y",strtotime($update_end_date));
if ($appl_id_aam==null) {
	$appl_id_aam='Donut@Poseidons!@';
}
if ($cid==null) {
	$cid='Donut@Poseidons!@';
}
if ($product_type==null) {
	$product_type='1';
}
if ($card_type==null) {
	$card_type='1';
}
if ($region_name==null) {
	$region_name='1';
}
if ($zone_name==null) {
	$zone_name='1';
}
if ($branch_name==null) {
	$branch_name='1';
}
if ($ca2_appl_result_code==null) {
	$ca2_appl_result_code='1';
}

$sql="select product_type 
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
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
(create_date between to_date(case when '#create_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_start_date#' end,'dd/mm/yyyy') and to_date(case when '#create_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_end_date#' end,'dd/mm/yyyy'))) /* #create_start_date#, #create_end_date# */

and

((
'#update_start_date#' = 'วว/ดด/ปปปป' 
and '#update_end_date#' = 'วว/ดด/ปปปป' )
or
(update_date_aam between to_date(case when '#update_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_start_date#' end,'dd/mm/yyyy') and to_date(case when '#update_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_end_date#' end,'dd/mm/yyyy'))) /* #update_start_date#, #update_end_date# */

and ('#ca2_appl_result_code#' = '--เลือกค่า--' or ca2_appl_result_code = '#ca2_appl_result_code#')

group by product_type 
order by product_type asc
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

function dd_card_type($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
// 	$create_start_date=str_replace('1970','2001',$create_start_date);
// $update_start_date=str_replace('1970','2001',$update_start_date);
// $create_start_date=date("d/m/y",strtotime($create_start_date));
// $create_end_date=date("d/m/y",strtotime($create_end_date));
// $update_start_date=date("d/m/y",strtotime($update_start_date));
// $update_end_date=date("d/m/y",strtotime($update_end_date));
if ($appl_id_aam==null) {
	$appl_id_aam='Donut@Poseidons!@';
}
if ($cid==null) {
	$cid='Donut@Poseidons!@';
}
if ($product_type==null) {
	$product_type='1';
}
if ($card_type==null) {
	$card_type='1';
}
if ($region_name==null) {
	$region_name='1';
}
if ($zone_name==null) {
	$zone_name='1';
}
if ($branch_name==null) {
	$branch_name='1';
}
if ($ca2_appl_result_code==null) {
	$ca2_appl_result_code='1';
}
// $create_start_date=date("d/m/Y",strtotime($create_start_date));
// $create_end_date=date("d/m/Y",strtotime($create_end_date));
// $update_start_date=date("d/m/Y",strtotime($update_start_date));
// $update_end_date=date("d/m/Y",strtotime($update_end_date));
$sql="select card_type 
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
and ('#product_type#' = '--เลือกค่า--' or product_type = '#product_type#') /* #product_type# */
and ('#cid#' = 'Donut@Poseidons!@' or cid = '#cid#') /* #cid# */
and ('#region_name#' = '--เลือกค่า--' or region_name = '#region_name#') /* #region_name# */
and ('#branch_name#' = '--เลือกค่า--' or branch_name = '#branch_name#') /* #branch_name# */
and ('#zone_name#' = '--เลือกค่า--' or zone_name = '#zone_name#') /* #zone_name# */
and
((
'#create_start_date#' = 'วว/ดด/ปปปป' 
and '#create_end_date#' = 'วว/ดด/ปปปป' )
or
(create_date between to_date(case when '#create_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_start_date#' end,'dd/mm/yyyy') and to_date(case when '#create_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_end_date#' end,'dd/mm/yyyy'))) /* #create_start_date#, #create_end_date# */

and

((
'#update_start_date#' = 'วว/ดด/ปปปป' 
and '#update_end_date#' = 'วว/ดด/ปปปป' )
or
(update_date_aam between to_date(case when '#update_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_start_date#' end,'dd/mm/yyyy') and to_date(case when '#update_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_end_date#' end,'dd/mm/yyyy'))) /* #update_start_date#, #update_end_date# */

and ('#ca2_appl_result_code#' = '--เลือกค่า--' or ca2_appl_result_code = '#ca2_appl_result_code#') /* #ca2_appl_result_code# */

group by card_type 
order by card_type asc";


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

function dd_region_name($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
// 	$create_start_date=str_replace('1970','2001',$create_start_date);
// $update_start_date=str_replace('1970','2001',$update_start_date);
// $create_start_date=date("d/m/y",strtotime($create_start_date));
// $create_end_date=date("d/m/y",strtotime($create_end_date));
// $update_start_date=date("d/m/y",strtotime($update_start_date));
// $update_end_date=date("d/m/y",strtotime($update_end_date));
if ($appl_id_aam==null) {
	$appl_id_aam='Donut@Poseidons!@';
}
if ($cid==null) {
	$cid='Donut@Poseidons!@';
}
if ($product_type==null) {
	$product_type='1';
}
if ($card_type==null) {
	$card_type='1';
}
if ($region_name==null) {
	$region_name='1';
}
if ($zone_name==null) {
	$zone_name='1';
}
if ($branch_name==null) {
	$branch_name='1';
}
if ($ca2_appl_result_code==null) {
	$ca2_appl_result_code='1';
}

$sql="select region_name 
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
and ('#product_type#' = '--เลือกค่า--' or product_type = '#product_type#') /* #product_type# */
and ('#card_type#' = '--เลือกค่า--' or card_type = '#card_type#') /* #card_type# */
and ('#cid#' = 'Donut@Poseidons!@' or cid = '#cid#') /* #cid# */
and ('#branch_name#' = '--เลือกค่า--' or branch_name = '#branch_name#') /* #branch_name# */
and ('#zone_name#' = '--เลือกค่า--' or zone_name = '#zone_name#') /* #zone_name# */
and
((
'#create_start_date#' = 'วว/ดด/ปปปป' 
and '#create_end_date#' = 'วว/ดด/ปปปป' )
or
(create_date between to_date(case when '#create_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_start_date#' end,'dd/mm/yyyy') and to_date(case when '#create_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_end_date#' end,'dd/mm/yyyy'))) /* #create_start_date#, #create_end_date# */

and

((
'#update_start_date#' = 'วว/ดด/ปปปป' 
and '#update_end_date#' = 'วว/ดด/ปปปป' )
or
(update_date_aam between to_date(case when '#update_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_start_date#' end,'dd/mm/yyyy') and to_date(case when '#update_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_end_date#' end,'dd/mm/yyyy'))) /* #update_start_date#, #update_end_date# */

and ('#ca2_appl_result_code#' = '--เลือกค่า--' or ca2_appl_result_code = '#ca2_appl_result_code#') /* #ca2_appl_result_code# */

group by region_name 
order by region_name asc"
;


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

function dd_zone_name($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
// 	$create_start_date=str_replace('1970','2001',$create_start_date);
// $update_start_date=str_replace('1970','2001',$update_start_date);
// $create_start_date=date("d/m/y",strtotime($create_start_date));
// $create_end_date=date("d/m/y",strtotime($create_end_date));
// $update_start_date=date("d/m/y",strtotime($update_start_date));
// $update_end_date=date("d/m/y",strtotime($update_end_date));
if ($appl_id_aam==null) {
	$appl_id_aam='Donut@Poseidons!@';
}
if ($cid==null) {
	$cid='Donut@Poseidons!@';
}
if ($product_type==null) {
	$product_type='1';
}
if ($card_type==null) {
	$card_type='1';
}
if ($region_name==null) {
	$region_name='1';
}
if ($zone_name==null) {
	$zone_name='1';
}
if ($branch_name==null) {
	$branch_name='1';
}
if ($ca2_appl_result_code==null) {
	$ca2_appl_result_code='1';
}

$sql="select zone_name 
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
and ('#product_type#' = '--เลือกค่า--' or product_type = '#product_type#') /* #product_type# */
and ('#card_type#' = '--เลือกค่า--' or card_type = '#card_type#') /* #card_type# */
and ('#cid#' = 'Donut@Poseidons!@' or cid = '#cid#') /* #cid# */
and ('#region_name#' = '--เลือกค่า--' or region_name = '#region_name#') /* #region_name# */
and ('#branch_name#' = '--เลือกค่า--' or branch_name = '#branch_name#') /* #branch_name# */
and
((
'#create_start_date#' = 'วว/ดด/ปปปป' 
and '#create_end_date#' = 'วว/ดด/ปปปป' )
or
(create_date between to_date(case when '#create_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_start_date#' end,'dd/mm/yyyy') and to_date(case when '#create_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_end_date#' end,'dd/mm/yyyy'))) /* #create_start_date#, #create_end_date# */

and

((
'#update_start_date#' = 'วว/ดด/ปปปป' 
and '#update_end_date#' = 'วว/ดด/ปปปป' )
or
(update_date_aam between to_date(case when '#update_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_start_date#' end,'dd/mm/yyyy') and to_date(case when '#update_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_end_date#' end,'dd/mm/yyyy'))) /* #update_start_date#, #update_end_date# */

and ('#ca2_appl_result_code#' = '--เลือกค่า--' or ca2_appl_result_code = '#ca2_appl_result_code#') /* #ca2_appl_result_code# */

group by zone_name 
order by zone_name asc"

;


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

function dd_branch_name($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
// 	$create_start_date=str_replace('1970','2001',$create_start_date);
// $update_start_date=str_replace('1970','2001',$update_start_date);
// $create_start_date=date("d/m/y",strtotime($create_start_date));
// $create_end_date=date("d/m/y",strtotime($create_end_date));
// $update_start_date=date("d/m/y",strtotime($update_start_date));
// $update_end_date=date("d/m/y",strtotime($update_end_date));
if ($appl_id_aam==null) {
	$appl_id_aam='Donut@Poseidons!@';
}
if ($cid==null) {
	$cid='Donut@Poseidons!@';
}
if ($product_type==null) {
	$product_type='1';
}
if ($card_type==null) {
	$card_type='1';
}
if ($region_name==null) {
	$region_name='1';
}
if ($zone_name==null) {
	$zone_name='1';
}
if ($branch_name==null) {
	$branch_name='1';
}
if ($ca2_appl_result_code==null) {
	$ca2_appl_result_code='1';
}

$sql="select branch_name 
from vw_aps_validate 
where borrower_type = 'บัตรหลัก'
and ('#product_type#' = '--เลือกค่า--' or product_type = '#product_type#') /* #product_type# */
and ('#card_type#' = '--เลือกค่า--' or card_type = '#card_type#') /* #card_type# */
and ('#cid#' = 'Donut@Poseidons!@' or cid = '#cid#') /* #cid# */
and ('#region_name#' = '--เลือกค่า--' or region_name = '#region_name#') /* #region_name# */
and ('#zone_name#' = '--เลือกค่า--' or zone_name = '#zone_name#') /* #zone_name# */
and
((
'#create_start_date#' = 'วว/ดด/ปปปป' 
and '#create_end_date#' = 'วว/ดด/ปปปป' )
or
(create_date between to_date(case when '#create_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_start_date#' end,'dd/mm/yyyy') and to_date(case when '#create_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_end_date#' end,'dd/mm/yyyy'))) /* #create_start_date#, #create_end_date# */

and

((
'#update_start_date#' = 'วว/ดด/ปปปป' 
and '#update_end_date#' = 'วว/ดด/ปปปป' )
or
(update_date_aam between to_date(case when '#update_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_start_date#' end,'dd/mm/yyyy') and to_date(case when '#update_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_end_date#' end,'dd/mm/yyyy'))) /* #update_start_date#, #update_end_date# */

and ('#ca2_appl_result_code#' = '--เลือกค่า--' or ca2_appl_result_code = '#ca2_appl_result_code#') /* #ca2_appl_result_code# */
group by branch_name 
order by branch_name asc
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

function dd_ca2_appl_result_code($product_type,$card_type,$cid,$region_name,$zone_name,$branch_name,$create_start_date,$create_end_date,$update_start_date,$update_end_date,$ca2_appl_result_code){
// 	$create_start_date=str_replace('1970','2001',$create_start_date);
// $update_start_date=str_replace('1970','2001',$update_start_date);
// $create_start_date=date("d/m/y",strtotime($create_start_date));
// $create_end_date=date("d/m/y",strtotime($create_end_date));
// $update_start_date=date("d/m/y",strtotime($update_start_date));
// $update_end_date=date("d/m/y",strtotime($update_end_date));
if ($appl_id_aam==null) {
	$appl_id_aam='Donut@Poseidons!@';
}
if ($cid==null) {
	$cid='Donut@Poseidons!@';
}
if ($product_type==null) {
	$product_type='1';
}
if ($card_type==null) {
	$card_type='1';
}
if ($region_name==null) {
	$region_name='1';
}
if ($zone_name==null) {
	$zone_name='1';
}
if ($branch_name==null) {
	$branch_name='1';
}
if ($ca2_appl_result_code==null) {
	$ca2_appl_result_code='1';
}

$sql="select ca2_appl_result_code 
from vw_aps_validate
where borrower_type = 'บัตรหลัก'
and ('#product_type#' = '--เลือกค่า--' or product_type = '#product_type#') /* #product_type# */
and ('#card_type#' = '--เลือกค่า--' or card_type = '#card_type#') /* #card_type# */
and ('#cid#' = 'Donut@Poseidons!@' or cid = '#cid#') /* #cid# */
and ('#region_name#' = '--เลือกค่า--' or region_name = '#region_name#') /* #region_name# */
and ('#branch_name#' = '--เลือกค่า--' or branch_name = '#branch_name#') /* #branch_name# */
and ('#zone_name#' = '--เลือกค่า--' or zone_name = '#zone_name#') /* #zone_name# */
and
((
'#create_start_date#' = 'วว/ดด/ปปปป' 
and '#create_end_date#' = 'วว/ดด/ปปปป' )
or
(create_date between to_date(case when '#create_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_start_date#' end,'dd/mm/yyyy') and to_date(case when '#create_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#create_end_date#' end,'dd/mm/yyyy'))) /* #create_start_date#, #create_end_date# */

and

((
'#update_start_date#' = 'วว/ดด/ปปปป' 
and '#update_end_date#' = 'วว/ดด/ปปปป' )
or
(update_date_aam between to_date(case when '#update_start_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_start_date#' end,'dd/mm/yyyy') and to_date(case when '#update_end_date#' = 'วว/ดด/ปปปป' then '01/01/1900' else '#update_end_date#' end,'dd/mm/yyyy'))) /* #update_start_date#, #update_end_date# */

group by ca2_appl_result_code 
order by ca2_appl_result_code asc"
;


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

