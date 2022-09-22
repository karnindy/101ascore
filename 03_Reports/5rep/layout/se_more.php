<?php 
include('../server/server.php');
$ref_id=$_POST["ref_id"];
$ref_card=$_POST["ref_card"];
$ref_sequence=$_POST["ref_sequence"];
?>
<table>
	<tr>
		<td align="center">
			<?php echo "เลขที่ใบสมัคร ".$ref_id; ?>
		</td>
	</tr>
	<tr>
		<td>
			<button class="btn btn-outline-success" type="button"  onclick="se_ref('<?php echo $ref_id; ?>','<?php echo $ref_card; ?>','<?php echo $ref_sequence; ?>'),se_tab(2)" data-toggle="modal" data-target="#myModal"> 
				<i class="fa-solid fa-person-running"></i>  ข้อมูลใบคำขอสินเชื่อ 
			</button>
			<button class="btn btn-outline-success" type="button" onclick="se_ref('<?php echo $ref_id; ?>','<?php echo $ref_card; ?>','<?php echo $ref_sequence; ?>'),se_tab(3)" data-toggle="modal" data-target="#myModal">
				<i class="fa-solid fa-person-running"></i>  ข้อมูลใบคำขอทุก Sequence
			</button>
		</td>
	</tr>
</table>

