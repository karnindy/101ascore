<?php 
include('../server/server.php');
$tab = $_POST['tab'];
$from_page = $_POST['from_page'];
$id = $_POST['id'];

$sql="select *
from z_iinput
where iid = '$id'
";
$query = oci_parse($conn, $sql);
oci_execute ($query,OCI_DEFAULT);?>
<table border="1">
	<thead>
		<td colspan="1" align="center">
			ข้อมูลที่ส่งเข้ามา
		</td>
	</thead>

<?php
if ($from_page=='house') {
while($row = oci_fetch_array($query,OCI_BOTH)){ ?>
	<tr>
		<td>
			<?php echo $row['DDESC']; ?>
		</td>
	</tr>
<?php
}
}

if ($from_page=='person') {
while($row = oci_fetch_array($query,OCI_BOTH)){ ?>
	<tr>
		<td>
			<?php echo $row['DDESC']; ?>
		</td>
	</tr>
<?php
}
}
?>
</table>