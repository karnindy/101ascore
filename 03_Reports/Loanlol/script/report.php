<?php
function report($id,$from_page){
$sql="select case when return2 in ('A','B') and ccode1 = 1 then 'คุณ  Id: '||iid||' ได้   Grade '||return2||' ขอแสดงความยินดีสินเชื่อบ้านได้รับการอนุมัติแล้ว'
when return2 in ('C','D') and ccode1 = 1 then 'คุณ  Id: '||iid||' ได้   Grade '||return2||' ขอแสดงความเสียใจสินเชื่อบ้านไม่ได้รับการอนุมัติ คุณสามารถยื่นใหม่อีกครั้ง'			 
when return2 in ('A','B') and ccode1 = 2 then 'คุณ  Id: '||iid||' ได้   Grade '||return2||' ขอแสดงความยินดีสินเชื่อบุคคลได้รับการอนุมัติแล้ว กรุณาระบุจำนวนเงินที่ต้องการขอกู้'
when return2 in ('C','D') and ccode1 = 2 then 'คุณ  Id: '||iid||' ได้   Grade '||return2||' ขอแสดงความเสียใจสินเชื่อบุคคลไม่ได้รับการอนุมัติ  คุณสามารถยื่นใหม่อีกครั้ง'
else '' end return1
from z_calc_detail_2
where iid = '#iid#'
and ccode1 = '#vvalue#'

union all

select rownum||') '||a.detail return1
from
(select case when vvalue = '12_1' then 'คุณกรอกรายจ่ายรวมทั้งหมดไม่ถูกต้อง กรุณากรอกข้อมูลใหม่อีกครั้ง'
            when vvalue = '12_2' then 'คุณกรอกรายได้รวมทั้งหมดไม่ถูกต้อง กรุณากรอกข้อมูลใหม่อีกครั้ง'
            when vvalue = '13_1' then 'คุณกรอกเงินที่ต้องการกู้ยืมไม่ถูกต้อง กรุณากรอกข้อมูลใหม่อีกครั้ง'
            when vvalue = '13_2' then 'คุณกรอกมูลค่าหลักทรัพย์คล้ำประกัน กรุณากรอกข้อมูลใหม่อีกครั้ง' 
            when vvalue = '26_1' then 'คุณกรอกรายจ่ายรวมทั้งหมด ไม่ถูกต้อง กรุณากรอกข้อมูลใหม่อีกครั้ง' end detail
from z_iinput_rej
where iid = '#iid#'
and substr(vvalue,1,1) = '#vvalue#'
order by vvalue asc) a

union all

select 'ปรับข้อมูล '||a.factor_th return1
from
(select * 
from z_calc_detail_1 
where iid = '#iid#'
and case when loan_type_eng = 'mortgage' then 1 else 2 end = '#vvalue#'
) a 
inner join 
(select model_detail, fvariable, min(fscore) min_fscore, max(fscore) max_fscore
from z_mg_master_avar
group by model_detail, fvariable) b
on a.loan_type_eng = b.model_detail
and a.factor_eng = b.fvariable
inner join 
(select * 
from z_calc_detail_2 
where iid = '#iid#'
and case when loan_type_eng = 'mortgage' then 1 else 2 end = '#vvalue#'
) c on a.iid = c.iid
where case when c.return2 in ('C','D') and round(a.score/b.max_fscore*100,2) < 80 then 'F' else 'T' end = 'F'
";

if ($from_page=='house') {$from_page=1;
}

if ($from_page=='person') {$from_page=2;
}
$sql=str_replace("#iid#",$id,$sql);
$sql=str_replace("#vvalue#",$from_page,$sql);

return $sql;
}
?>



