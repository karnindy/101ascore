<?php
    error_reporting(0); 
    // $username = "Admin1";
    $username = "Admin2";
    $password = "Password123456";
    $host = "10.10.98.120:1521/ORCL";
    // $character_set = "AL32UTF8";
    $character_set = "UTF8";

    $conn = oci_connect($username,$password,$host,$character_set);

    if(!$conn){
        $message = oci_error();
        echo "Could not connect to database : ".$message;
    }


?>