<table>
<?php 
$tab=$_POST['tab'];
$from_page=$_POST['from_page'];
if ($from_page=='house') {
?>
	<thead>
		<td colspan="2" align="center">
			สินเชื่อประเภทบ้าน
		</td>
	</thead>
	<tr>
		<td>
			<label>เงินที่ต้องการกู้ยืม (บาท)</label>
		</td>
		<td>
			<input type="text" id="total_loan" placeholder="หากไม่มีให้ใส่ 0">
		</td>
	</tr>
	<tr>
		<td>
			<label>รายได้รวมทั้งหมด (เดือน)</label>
		</td>
		<td>
			<input type="text" id="total_salary" placeholder="หากไม่มีให้ใส่ 0">
		</td>
	</tr>
	<tr>
		<td>
			<label>รายจ่ายรวมทั้งหมด (เดือน)</label>
		</td>
		<td>
			<input type="text" id="total_payout" placeholder="หากไม่มีให้ใส่ 0">
		</td>
	</tr>
	<tr>
		<td>
			<label>มูลค่าหลักทรัพย์คล้ำประกัน (บาท)</label>
		</td>
		<td>
			<input type="text" id="total_asset">
		</td>
	</tr>
	<tr>
		<td>
			<label>ระยะเวลาในการทำงาน ที่ทำงานปัจจุบัน (เดือน)</label>
		</td>
		<td>
			<select id="total_worktime">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="0 - <= 60 เดือน">0 - <= 60 เดือน</option>
				<option value="> 60 - <= 120 เดือน">> 60 - <= 120 เดือน</option>
				<option value="> 120 เดือน">> 120 เดือน</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label>ระยะเวลาที่พักอาศัย ณ ที่อยู่ปัจจุบัน (เดือน)</label>
		</td>
		<td>
			<select id="total_addresstime">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="0 - <= 60 เดือน" >0 - <= 60 เดือน</option>
				<option value="> 60 - <= 120 เดือน" >> 60 - <= 120 เดือน</option>
				<option value="> 120 - <= 300 เดือน" >> 120 - <= 300 เดือน</option>
				<option value="> 300 เดือน" >> 300 เดือน</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label>อายุ</label>
		</td>
		<td>
			<select id="age">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="<= 33 ปี"><= 33 ปี</option>
				<option value="> 33 - <= 50 ปี">> 33 - <= 50 ปี</option>
				<option value="> 50 ปี">> 50 ปี</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label>การศึกษา</label>
		</td>
		<td>
			<select id="education">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="มัธยมศึกษา, ประถมศึกษา, อื่นๆ">มัธยมศึกษา, ประถมศึกษา, อื่นๆ</option>
				<option value="ป.ว.ส., ป.ว.ช.">ป.ว.ส., ป.ว.ช.</option>
				<option value="ปริญญาตรี">ปริญญาตรี</option>
				<option value="ปริญญาเอก, ปริญญาโท">ปริญญาเอก, ปริญญาโท</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label>อาชีพ</label>
		</td>
		<td>
			<select id="type_job">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="ราชการ/ รัฐวิสาหกิจ/ วิศวกร/แพทย์/พยาบาล/นักบัญชี">ราชการ/ รัฐวิสาหกิจ/ วิศวกร/แพทย์/พยาบาล/นักบัญชี</option>
				<option value="เอกชน">เอกชน</option>
				<option value="ทั่วไป">ทั่วไป</option>
				<option value="นักการเมือง กฎหมาย นักธุรกิจ">นักการเมือง กฎหมาย นักธุรกิจ</option>
				<option value="บริการ">บริการ</option>
				<option value="อื่น ๆ">อื่น ๆ</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label>ภูมิภาคที่อาศัยปัจจุบัน</label>
		</td>
		<td>
			<select id="region">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="กรุงเทพและปริมณฑล">กรุงเทพและปริมณฑล</option>
				<option value="ภาคเหนือ">ภาคเหนือ</option>
				<option value="ภาคตะวันออกเฉียงเหนือ">ภาคตะวันออกเฉียงเหนือ</option>
				<option value="ภาคตะวันตก">ภาคตะวันตก</option>
				<option value="ภาคกลาง">ภาคกลาง</option>
				<option value="ภาคตะวันออก">ภาคตะวันออก</option>
				<option value="ภาคใต้">ภาคใต้</option>
			</select>

		</td>
	</tr>
<?php } ?>
<?php if ($from_page=='person') { ?>

<table>
	<thead>
		<td colspan="2" align="center">
			สินเชื่อประเภทบุคคล
		</td>
	</thead>
	<tr>
		<td>
			<label>ระยะเวลากู้ยืม</label>
		</td>
		<td>
			<select id="time_loan">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="0 - <= 84 เดือน">0 - <= 84 เดือน</option>
				<option value="> 84 เดือน - <= 180 เดือน">> 84 เดือน - <= 180 เดือน</option>
				<option value="> 180 เดือน">> 180 เดือน</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label>วัตถุประสงค์การกู้ยืม</label>
		</td>
		<td>
			<select id="type_loan">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="เพื่อการศึกษา">เพื่อการศึกษา</option>
				<option value="การซื้อทรัพย์สิน">การซื้อทรัพย์สิน</option>
				<!-- <option value="การท่องเที่ยว">การท่องเที่ยว</option> -->
				<option value="การพัฒนา">การพัฒนา</option>
				<option value="การอุปโภค">การอุปโภค</option>
				<option value="การซื้อหรือเช่าซื้อ">การซื้อหรือเช่าซื้อ</option>
				<option value="อื่นๆ">อื่นๆ</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label>รายจ่ายรวมทั้งหมด (เดือน)</label>
		</td>
		<td>
			<input type="text" id="total_payout" placeholder="หากไม่มีให้ใส่ 0">
		</td>
	</tr>
	<tr>
		<td>
			<label>ระยะเวลาในการทำงาน ที่ทำงานปัจจุบัน (เดือน)</label>
		</td>
		<td>
			<select id="worktime">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="0 - <= 60 เดือน">0 - <= 60 เดือน</option>
				<option value="> 60 - <= 120 เดือน">> 60 - <= 120 เดือน</option>
				<option value="> 120 เดือน">> 120 เดือน</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label>อายุ</label>
		</td>
		<td>
			<select id="age">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="<= 30 ปี"><= 30 ปี</option>
				<option value="> 30 - <= 50 ปี">> 30 - <= 50 ปี</option>
				<option value="> 50 ปี">> 50 ปี</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label>อาชีพ</label>
		</td>
		<td>
			<select id="type_job">
				<option selected value="ไม่ได้เลือก" disabled>กรุณาเลือก</option>
				<option value="ราชการ/ รัฐวิสาหกิจ/ วิศวกร/แพทย์/พยาบาล/นักบัญชี">ราชการ/ รัฐวิสาหกิจ/ วิศวกร/แพทย์/พยาบาล/นักบัญชี</option>
				<option value="เอกชน">เอกชน</option>
				<option value="ทั่วไป">ทั่วไป</option>
				<option value="นักการเมือง กฎหมาย นักธุรกิจ">นักการเมือง กฎหมาย นักธุรกิจ</option>
				<option value="บริการ">บริการ</option>
				<option value="อื่น ๆ">อื่น ๆ</option>
			</select>
		</td>
	</tr>
<?php } ?>
	<tr>
		<td colspan="2" align="right">
			<!-- <input type="button" onclick="se_nav_bar(1,'home')" value="กลับไปหน้าแรก" style="width:200px;" class="btn btn-light"> -->
			<input type="button" onclick="view_data(1,'<?php echo $from_page; ?>')" value="ส่งคำขอสินเชื่อ" style="width:200px;" class="btn btn-primary">
		</td>
	</tr>
</table>