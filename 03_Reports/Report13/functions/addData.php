<?php
include("../database/connect.php");

$product_type = $_POST['product_type'];
$card_type = $_POST['card_type'];
$model_type = $_POST['model_type'];
$model_version = $_POST['model_version'];
//$start_date = $_POST['start_date'];
$description = $_POST['description'];

$sql_id="select max(id) as max from rep301_13";
$query_id = oci_parse($conn, $sql_id);
oci_execute ($query_id,OCI_DEFAULT);
$row_id = oci_fetch_array($query_id,OCI_BOTH);
$id=$row_id['MAX']+1;
$description=str_replace("'","''",$description);

$sql_add_data = "INSERT INTO REP301_13(ID,PRODUCT_TYPE,MODEL_TYPE,CARD_TYPE,VERSION_MODEL,START_DATE,DESCRIPTION)
VALUES ('$id','$product_type','$model_type','$card_type','$model_version',to_date('15/11/2018','dd/mm/yyyy'),'$description')";
$query_add_data = oci_parse($conn, $sql_add_data);
$execute_add_data = oci_execute($query_add_data, OCI_DEFAULT);
oci_commit($conn);

if (!$execute_add_data) {
	oci_rollback($conn);
    echo "confirm('บันทึกข้อมูลไม่สำเร็จ');";
    die;
    header("location: ../insert.php");
} else {
    echo "confirm('บันทึกข้อมูลสำเร็จ');";
    header("location: ../insert.php");
}

$sql_logs="insert into rep301_13_logs
select id
,create_date
,product_type
,model_type
,card_type
,version_model
,start_date
,description
,CURRENT_TIMESTAMP update_date
,'new' flag
from rep301_13
where id = '$id'";
$query_logs = oci_parse($conn, $sql_logs);
$execute_logs = oci_execute($query_logs, OCI_DEFAULT);
oci_commit($conn);
if (!$execute_logs) {
	oci_rollback($conn);
    echo "alert('บันทึกข้อมูลไม่สำเร็จ');";
    die;
    header("location: ../insert.php");
}else{
    echo "alert('บันทึกข้อมูลสำเร็จ');";
    header("location: ../insert.php");
}
?>