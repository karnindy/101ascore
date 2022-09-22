<?php
include("../database/connect.php");
$id = $_POST['id'];

$logs="UPDATE rep301_13_logs SET flag = 'delete' where ID = '$id'";
$query_logs = oci_parse($conn, $logs);
$result_logs = oci_execute($query_logs, OCI_DEFAULT);
oci_commit($conn);
if (!$result_logs) {
	oci_rollback($conn);
    die;
    echo false;
}

$drop_data="delete from rep301_13 where ID = '$id'";
$query_drop = oci_parse($conn, $drop_data);
$result_drop = oci_execute($query_drop, OCI_DEFAULT);
oci_commit($conn);
if (!$result_drop) {
	oci_rollback($conn);
    die;
    echo false;
}else{
    echo true;
}
?>