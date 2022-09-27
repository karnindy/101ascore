<?php
include("../database/connect.php");

$id = $_POST['id'];
if($_POST['status'] == 'update'){
    $sql_update = "UPDATE rep301_13 
    SET DESCRIPTION = '".$_POST['description']."' 
    where ID = '".$id."'";
    $query_update = oci_parse($conn, $sql_update);
    $result_update = oci_execute($query_update, OCI_DEFAULT);
    oci_commit($conn);

    if (!$result_update) {
        oci_rollback($conn);
        die;
        echo false;
    }

    $sql_insert = "insert into rep301_13_logs
    select id
    ,create_date
    ,product_type
    ,model_type
    ,card_type
    ,version_model
    ,start_date
    ,description
    ,CURRENT_TIMESTAMP update_date
    ,'update' flag
    from rep301_13
    where id = '$id'";
    $query_insert = oci_parse($conn, $sql_insert);
    $result_insert = oci_execute($query_insert, OCI_DEFAULT);
    oci_commit($conn);
    if (!$result_insert) {
        oci_rollback($conn);
        die;
        echo false;
    } else {
        echo true;
    }

}

if($_POST['status'] == 'getData'){
    $sql = "select * from rep301_13 where id = '$id'";
    $query = oci_parse($conn, $sql);
    oci_execute($query, OCI_DEFAULT);
    $result = oci_fetch_array($query,OCI_BOTH);

    $rep = new stdClass();
    $rep->id = $id;
    $rep->create_date = $result['CREATE_DATE'];
    $rep->product_type = $result['PRODUCT_TYPE'];
    $rep->model_type = $result['MODEL_TYPE'];
    $rep->card_type = $result['CARD_TYPE'];
    $rep->version_model = $result['VERSION_MODEL'];
    $rep->start_date = $result['START_DATE'];
    $rep->description = $result['DESCRIPTION'];

    echo json_encode($rep);
}


?>