<?php
$tab=$_POST['tab'];
?>
<table>
	<thead>
		<td colspan="2" align="center">
			เลือกประเภทสินเชื่อ
		</td>
	</thead>
	<tr>
		<td>

		</td>
		<td>

		</td>
	</tr>
	<tr>
		<td>
			<input type="button" value="สินเชื่อบ้าน" onclick="se_nav_bar(<?php echo $tab; ?>,'house')" style="width:200px;" class="btn btn-primary">
		</td>
		<td>
			<input type="button" value="สินเชื่อส่วนบุคคล" onclick="se_nav_bar(<?php echo $tab; ?>,'person')" style="width:200px;" class="btn btn-primary">
		</td>
	</tr>
	<tr>
		<td>

		</td>
		<td>

		</td>
	</tr>
</table>