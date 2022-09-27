<?php
include('../server/server.php');
include('../script/report.php');
// $tab = $_POST['tab'];
$from_page = $_GET['from_page'];
$id = $_GET['id'];
// $id='1';
// $from_page='2';
$sql=report($id,$from_page);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute ($query,OCI_DEFAULT);?>
<table border="0" align="center">
<?php
while($row = oci_fetch_array($query,OCI_BOTH)){ ?>
	<tr>
		<td>
			<?php echo $row['RETURN1']; ?>
		</td>
	</tr>

<?php
	}
?>
</table>

