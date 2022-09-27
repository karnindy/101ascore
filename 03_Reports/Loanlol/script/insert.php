<?php
include('../server/server.php');
$tab = $_POST['tab'];
$from_page = $_POST['from_page'];

$sql="select max(alldata) alldata
from 
(select 0 alldata from dual 
union
select nvl(iid,0) alldata from z_iinput) a
     ";
$query = oci_parse($conn, $sql);
oci_execute ($query,OCI_DEFAULT);
$row = oci_fetch_array($query,OCI_BOTH);
$alldata=$row['ALLDATA'];
$id=$alldata+1;

if ($from_page=='house') {
$total_loan = $_POST['total_loan'];
$total_salary = $_POST['total_salary'];
$total_payout = $_POST['total_payout'];
$total_asset = $_POST['total_asset'];
$total_worktime = $_POST['total_worktime'];
$total_addresstime = $_POST['total_addresstime'];
$age = $_POST['age'];
$education = $_POST['education'];
$type_job = $_POST['type_job'];
$region = $_POST['region'];

$desc[]=$total_loan;
$desc[]=$total_salary;
$desc[]=$total_payout;
$desc[]=$total_asset;
$desc[]=$total_worktime;
$desc[]=$total_addresstime;
$desc[]=$age;
$desc[]=$education;
$desc[]=$type_job;
$desc[]=$region;
if($total_loan!=null){$value[]='13_1';}
if($total_salary!=null){$value[]='12_2';}
if($total_payout!=null){$value[]='12_1';}
if($total_asset!=null){$value[]='13_2';}
if($total_worktime=='0 - <= 60 เดือน'){$value[]='111';}
if($total_worktime=='> 60 - <= 120 เดือน'){$value[]='112';}
if($total_worktime=='> 120 เดือน'){$value[]='113';}
if($total_addresstime=='0 - <= 60 เดือน'){$value[]='1411';}
if($total_addresstime=='> 60 - <= 120 เดือน'){$value[]='1412';}
if($total_addresstime=='> 120 - <= 300 เดือน'){$value[]='1413';}
if($total_addresstime=='> 300 เดือน'){$value[]='1414';}
if($age=='<= 33 ปี'){$value[]='1515';}
if($age=='> 33 - <= 50 ปี'){$value[]='1516';}
if($age=='> 50 ปี'){$value[]='1517';}
if($education=='มัธยมศึกษา, ประถมศึกษา, อื่นๆ'){$value[]='1618';}
if($education=='ป.ว.ส., ป.ว.ช.'){$value[]='1619';}
if($education=='ปริญญาตรี'){$value[]='1620';}
if($education=='ปริญญาเอก, ปริญญาโท'){$value[]='1621';}
if($type_job=='ราชการ/ รัฐวิสาหกิจ/ วิศวกร/แพทย์/พยาบาล/นักบัญชี'){$value[]='1722';}
if($type_job=='เอกชน'){$value[]='1723';}
if($type_job=='ทั่วไป'){$value[]='1724';}
if($type_job=='นักการเมือง กฎหมาย นักธุรกิจ'){$value[]='1725';}
if($type_job=='บริการ'){$value[]='1726';}
if($type_job=='อื่น ๆ'){$value[]='1727';}
if($region=='กรุงเทพและปริมณฑล'){$value[]='1828';}
if($region=='ภาคเหนือ'){$value[]='1829';}
if($region=='ภาคตะวันออกเฉียงเหนือ'){$value[]='1830';}
if($region=='ภาคตะวันตก'){$value[]='1831';}
if($region=='ภาคกลาง'){$value[]='1832';}
if($region=='ภาคตะวันออก'){$value[]='1833';}
if($region=='ภาคใต้'){$value[]='1834';}
$i=10;
}

else if($from_page=='person') {
$time_loan = $_POST['time_loan'];
$type_loan = $_POST['type_loan'];
$total_payout = $_POST['total_payout'];
$worktime = $_POST['worktime'];
$age = $_POST['age'];
$type_job = $_POST['type_job'];

$desc[]=$time_loan;
$desc[]=$type_loan;
$desc[]=$total_payout;
$desc[]=$worktime;
$desc[]=$age;
$desc[]=$type_job;
if($time_loan=='0 - <= 84 เดือน'){$value[]='2135';}
if($time_loan=='> 84 เดือน - <= 180 เดือน'){$value[]='2136';}
if($time_loan=='> 180 เดือน'){$value[]='2137';}
if($type_loan=='เพื่อการศึกษา'){$value[]='2550';}
if($type_loan=='การซื้อทรัพย์สิน'){$value[]='2551';}
// if($type_loan=='การท่องเที่ยว'){$value[]='2552';}
if($type_loan=='การพัฒนา'){$value[]='2553';}
if($type_loan=='การอุปโภค'){$value[]='2554';}
if($type_loan=='การซื้อหรือเช่าซื้อ'){$value[]='2555';}
if($type_loan=='อื่นๆ'){$value[]='2556';}
if($total_payout!=null){$value[]='26_1';}
if($worktime=='0 - <= 60 เดือน'){$value[]='2238';}
if($worktime=='> 60 - <= 120 เดือน'){$value[]='2239';}
if($worktime=='> 120 เดือน'){$value[]='2240';}
if($age=='<= 30 ปี'){$value[]='2341';}
if($age=='> 30 - <= 50 ปี'){$value[]='2342';}
if($age=='> 50 ปี'){$value[]='2343';}
if($type_job=='ราชการ/ รัฐวิสาหกิจ/ วิศวกร/แพทย์/พยาบาล/นักบัญชี'){$value[]='2444';}
if($type_job=='เอกชน'){$value[]='2445';}
if($type_job=='ทั่วไป'){$value[]='2446';}
if($type_job=='นักการเมือง กฎหมาย นักธุรกิจ'){$value[]='2447';}
if($type_job=='บริการ'){$value[]='2448';}
if($type_job=='อื่น ๆ'){$value[]='2449';}
$i=6;
}
for($num=0;$num<$i;$num++){
$sql="
insert into z_iinput(iid,ddesc,vvalue)
values ('$id', '$desc[$num]', '$value[$num]')
";
$insert = oci_parse($conn, $sql);
$save = oci_execute($insert, OCI_DEFAULT);
oci_commit($conn);
}

$sql="
insert into z_iinput_rej
select *
from z_iinput
where vvalue in ('12_1','12_2','13_1','13_2','26_1')
and case when trim(translate(ddesc, '0123456789-,.', ' ')) is null then 'numeric' else 'alpha' end = 'alpha'
and iid = '$id'
union all
select *
from z_iinput
where vvalue in ('12_1','12_2','13_1','13_2','26_1')
and ddesc is null
and iid = '$id'
";
$insert = oci_parse($conn, $sql);
$save = oci_execute($insert, OCI_DEFAULT);
oci_commit($conn);

$sql="
insert into z_iinput_1
select *
from z_iinput
where vvalue in ('12_1','12_2','13_1','13_2','26_1')
and case when trim(translate(ddesc, '0123456789-,.', ' ')) is null then 'numeric' else 'alpha' end = 'numeric'
and iid = '$id'
union all
select *
from z_iinput
where vvalue not in ('12_1','12_2','13_1','13_2','26_1')
and iid = '$id'
";
$insert = oci_parse($conn, $sql);
$save = oci_execute($insert, OCI_DEFAULT);
oci_commit($conn);

$sql="
insert into z_calc_detail_1

/* mortgage, personal */
select a.iid, b.loan_type_eng, b.factor_eng, b.factor_th, b.loan_type_th, b.factor_value, b.score
from z_iinput_1 a inner join z_master_map1 b on a.vvalue = b.loan_code||b.factor_code||b.factor_v_code
where a.iid = '$id'

union all

/* mortgage_1 */
select aa.iid, bb.loan_type_eng, bb.factor_eng, bb.factor_th, bb.loan_type_th, bb.factor_value, bb.score
from
(select a.iid
, case when a.ddesc/b.ddesc*100 >= 0 and a.ddesc/b.ddesc*100 <= 45 then '0 - <= 45%'
       when a.ddesc/b.ddesc*100 > 45 and a.ddesc/b.ddesc*100 <= 75 then '> 45% - <= 75%'
       else '> 75%' end factor_value
from
(
select iid, ddesc 
from z_iinput_1 where vvalue in ('12_1')
and iid = '$id'
) a
inner join
(
select iid, case when to_number(ddesc) = 0 then 1 else to_number(ddesc) end ddesc 
from z_iinput_1 
where vvalue in ('12_2')
and iid = '$id'
) b on a.iid = b.iid) aa
inner join
(select * from z_master_map1 where loan_code||factor_code||factor_v_code in ('124','125','126')) bb on aa.factor_value = bb.factor_value

union all

/* mortgage_2 */
select aa.iid, bb.loan_type_eng, bb.factor_eng, bb.factor_th, bb.loan_type_th, bb.factor_value, bb.score
from
(select a.iid
, case when a.ddesc/b.ddesc*100 >= 0 and a.ddesc/b.ddesc*100 <= 80 then '0 - <= 80%'
       when a.ddesc/b.ddesc*100 > 80 and a.ddesc/b.ddesc*100 <= 90 then '> 80% - <= 90%'
       when a.ddesc/b.ddesc*100 > 90 and a.ddesc/b.ddesc*100 <= 100 then '> 90% - <= 100%'
	   when a.ddesc/b.ddesc*100 > 90 and a.ddesc/b.ddesc*100 <= 100 then '> 100% - <= 200%'
  else '> 200%' end factor_value
from
(
select iid, ddesc 
from z_iinput_1 
where vvalue in ('13_1')
and iid = '$id'
) a
inner join
(
select iid, case when to_number(ddesc) = 0 then 1 else to_number(ddesc) end ddesc 
from z_iinput_1 
where vvalue in ('13_2')
and iid = '$id'
) b on a.iid = b.iid) aa
inner join
(select * from z_master_map1 where loan_code||factor_code||factor_v_code in ('137','138','139','1310')) bb on aa.factor_value = bb.factor_value

union all

/* personal */
select a.iid, b.loan_type_eng, b.factor_eng, b.factor_th, b.loan_type_th, b.factor_value, b.score
from
(select * 
from z_iinput_1 
where vvalue = '26_1'
and iid = '$id') a
inner join
(select * from z_master_map1 where loan_code||factor_code||factor_v_code = '2660') b on 1 = 1
";
$insert = oci_parse($conn, $sql);
$save = oci_execute($insert, OCI_DEFAULT);
oci_commit($conn);

$sql="
insert into z_calc_detail_2
select a.iid
, a.ccode1
, a.loan_type_eng
, b.range_desc
, b.mmin
, b.mmax
, a.score
, b.return1
, b.return2
from
(select iid, loan_type_eng
, case when loan_type_eng = 'mortgage' then 1
       when loan_type_eng = 'personal' then 2
  else 3 end ccode1
, sum(score) score
from z_calc_detail_1
where iid = '$id'
group by iid
, case when loan_type_eng = 'mortgage' then 1
       when loan_type_eng = 'personal' then 2
  else 3 end
, loan_type_eng) a inner join z_master_map2 b 
on a.ccode1 = b.ccode1
and a.score between b.mmin and b.mmax
";
$insert = oci_parse($conn, $sql);
$save = oci_execute($insert, OCI_DEFAULT);
oci_commit($conn);

if (!$save) {
	oci_rollback($conn);
?> 
<script>alert('ส่งคำร้องผิดพลาด');</script>
<?php
    die;
}else{
?> 
<script>test('<?php echo $tab; ?>','<?php echo $from_page; ?>','<?php echo $id; ?>');</script>
<?php
}
?>