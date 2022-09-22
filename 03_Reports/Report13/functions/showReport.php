
<div align="right">
        <input type="button" class="btn btn-outline-dark" onclick="export_txt()" value="export TXT">
        <input type="button" class="btn btn-outline-secondary" onclick="export_csv()" value="export CSV">
        <input type="button" class="btn btn-outline-success" onclick="export_xls()" value="export XLS">
        <input type="button" class="btn btn-outline-danger" onclick="export_pdf()" value="export PDF">
        <br><br>
</div>
<?php
include("../database/connect.php");
include("SQLReportClass.php");
error_reporting(E_ERROR | E_PARSE);

$table = "<table id='list-table' class='table table-striped table-bordered' style='width:100%'>
            <thead style='background-color:#feccff'>
                <tr>
                    <th class='text-center align-middle'>วันบันทึกข้อมูล</th>
                    <th class='text-center align-middle'>ประเภทสินเชื่อ</th>
                    <th class='text-center align-middle'>ประเภทโมเดล</th>
                    <th class='text-center align-middle'>ประเภทบัตร</th>
                    <th class='text-center align-middle'>เวอร์ชันโมเดล</th>
                    <th class='text-center align-middle'>วันที่เริ่มใช้งาน</th>
                    <th class='text-center align-middle'>Description</th>
                    <th class='text-center align-middle'></th>
                </tr>
            </thead>
            <tbody>";
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['start_date'], $_POST['end_date'], $_POST['business_type']);
// echo $sql;
$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
    $table = $table."<tr>
                        <td class='text-center'>" . $row['CREATE_DATE'] . "</td>
                        <td class='text-center'>" . $row['PRODUCT_TYPE'] . "</td>
                        <td class='text-center'>" . $row['MODEL_TYPE'] . "</td>
                        <td class='text-center'>" . $row['CARD_TYPE'] . "</td>
                        <td class='text-center'>" . $row['VERSION_MODEL'] . "</td>
                        <td class='text-center'>" . $row['START_DATE'] . "</td>
                        <td class='text-center'>" . $row['DESCRIPTION'] . "</td>
                        <td>
                            <button class='btn btn-warning' value='".$row['ID']."' data-toggle='modal' data-target='#editModal' onclick='onModalEdit(this)'>แก้ไข</button>
                            <button class='btn btn-danger' value='".$row['ID']."' onclick='onDeleteData(this)'>ลบ</button>
                            <button class='btn btn-outline-info' value='".$row['ID']."' onclick='onShowLog(this)'>log</button>
                        </td>
                    </tr>";
}

$table = $table. "</tbody></table>";

echo $table;
?>