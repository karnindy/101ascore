<?php
include('../server/server.php');
$tab = $_POST['tab'];
$from_page = $_POST['from_page'];
$id = $_POST['id'];

$sql="
INSERT INTO Z_A (IID)
VALUES ('$id')
";

$insert = oci_parse($conn, $sql);
$save = oci_execute($insert, OCI_DEFAULT);
oci_commit($conn);
?>