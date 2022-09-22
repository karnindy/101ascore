<?php
    include("database/connect.php");

    $id = $_GET['id'];
    $status = $_GET['status'];
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="font/all.min.css">
    <script src="js/bootstrap.bundle-4.5.2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <title>Document</title>
</head>
<body>


    <style>
        /* .ui-datepicker-calendar {
            display: none;
        } */
    </style>
    <div class="container-fluid mt-5">
        <div id="report_area">
            <h3 class="text-center font-weight-bold mb-5"><?= $status == "update"? "ประวัติการกรอกข้อมูล" : "ประวัติข้อมูลที่ถูกลบ" ?></h3>
            <table id="list-table" class="table table-striped table-bordered" style="width:100%">
                <thead style='background-color:#feccff'>
                    <tr>
                        <th>วันที่บันทึกข้อมูล</th>
                        <th>ประเภทสินเชื่อ</th>
                        <th>ประเภทโมเดล</th>
                        <th>ประเภทบัตร</th>
                        <th>เวอร์ชั่นโมเดล</th>
                        <th>วันที่เริ่มใช้งาน</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					
                        if($status == "update"){
                            $sql="select * from rep301_13_logs where ('$id' = 'All' or id = '$id') and flag <> 'delete' order by id asc, update_date desc";
                        } else {
                            $sql="select * from rep301_13_logs where ('$id' = 'All' or id = '$id') and flag = 'delete' order by id asc, update_date desc";
                        }
                        error_reporting(0);
						ini_set('display_errors', 0);
                        $query = oci_parse($conn, $sql);
                        oci_execute ($query,OCI_DEFAULT);
                        while($row = oci_fetch_array($query,OCI_BOTH)){ 
                            $create_date=$row['CREATE_DATE'];
                            $start_date=$row['START_DATE'];
                            $time=substr($create_date,10,8);
                            $apm=substr($create_date,-2,2);
                            $create_date=substr($create_date,0,10);
                            $create_date=strtotime($create_date);
                            $create_date=date('d/m/Y',$create_date);
                            $start_date=substr($start_date,0,10);
                            $start_date=strtotime($start_date);
                            $start_date=date('d/m/Y',$start_date);
                    ?>
                        <tr>
                            <td><?= $create_date."<br>".$time." ".$apm ?></td>
                            <td><?= $row['PRODUCT_TYPE'] ?></td>
                            <td><?= $row['MODEL_TYPE'] ?></td>
                            <td><?= $row['VERSION_MODEL'] ?></td>
                            <td><?= $row['CARD_TYPE'] ?></td>
                            <td><?= $start_date ?></td>
                            <td><?= $row['DESCRIPTION'] ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#list-table').DataTable();
        } );
    </script>
</body>
</html>