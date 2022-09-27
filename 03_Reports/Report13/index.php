<?php
    include("database/connect.php");
    require_once('functions/dropdownsClass.php');
    require_once('functions/SQLReportClass.php');

    $dropdown = new Dropdown();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="css/bootstrap-4.5.2.min.css" />
    <link rel="stylesheet" href="css/bootstrap-multiselect.min.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="font/all.min.css">
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.bundle-4.5.2.min.js"></script>
    <script src="js/bootstrap-multiselect.min.js"></script>
    <script src="js/dropdowns.js"></script>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-ui.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
	<script src="js/js.js"></script>
    <title>Document</title>
</head>
<body>
    <style>
        /* .ui-datepicker-calendar {
            display: none;
        } */
    </style>
    <div class="container">
        <div class="row justify-content-center mt-5">
        <div class="col-md-8 form-group row">
            <label for="" class="col-md-4 text-right font-weight-bold">*ประเภทสินเชื่อ : </label>
            <select class="col-md-8 form-control"  name="product_type" id="product_type" onchange="getValueDropdown(this)" target="model_type">
                <option disabled selected>--โปรดเลือก--</option>
                <option value="รวมทุกประเภทสินเชื่อ">รวมทุกประเภทสินเชื่อ</option>
                <?php
                        $sql = $dropdown->get_product_type_names();
                        $query = oci_parse($conn, $sql);
                        oci_execute ($query,OCI_DEFAULT);
                        while ($row = oci_fetch_array($query,OCI_BOTH)) {
                        ?>
                            <option value="<?= $row['PRODUCT_TYPE_DISPLAY'] ?>"><?= $row['PRODUCT_TYPE_DISPLAY'] ?></option>
                        <?php
                        }
                    ?>
            </select>
        </div>
        <div class="col-md-8 form-group row">
            <label for="" class="col-md-4 text-right font-weight-bold">*ประเภทโมเดล : </label>
            <select class="col-md-8 form-control"  name="model_type" id="model_type" onchange="getValueDropdown(this)" target="card_type">
                <option disabled selected>--โปรดเลือก--</option>
            </select>
        </div>
        <div class="col-md-8 form-group row">
            <label for="" class="col-md-4 text-right font-weight-bold">*ประเภทบัตร : </label>
            <select class="col-md-8 form-control"  name="card_type" id="card_type">
                <option disabled selected>--โปรดเลือก--</option>
            </select>
        </div>
        <div class="col-md-8 form-group row">
            <label class="col-md-4 col-form-label text-right font-weight-bold" for="create_date">* วันที่บันทึกข้อมูล:</label>
            <div class="col-md-3 p-0">
                <input class="form-control datepicker" type="text" name="start_date" id="start_date" placeholder="DD/MM/YYYY" onchange="check_date_between()">
            </div>
            <div class="col-md-1 text-center align-self-center">ถึง</div>
                <div class="col-md-3 p-0">
                    <input class="form-control datepicker" type="text" name="end_date" id="end_date" placeholder="DD/MM/YYYY" onchange="check_date_between()">
                </div>
                <div class="col-md-3 text-right text-danger font-weight-bold d-none" id="check_date">* เลือกวันที่ไม่ถูกต้อง</div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button class="col-md-2 btn btn-primary mr-3" type="submit" onclick="onSubmit(this)">แสดงรายงาน</button>
            <button class="col-md-1 btn btn-danger mr-3" type="btn" onclick="refreshPage()">รีเซ็ต</button>
            <button class="col-md-1 btn btn-info mr-3" type="btn" onclick="window.location.href = 'insert.php'">เพิ่มข้อมูล</button>
            <button class="col-md-2 btn btn-outline-danger" type="btn" onclick="window.open('log.php?id=All&status=delete', '_blank')">รายการที่ถูกลบ</button>
        </div>
    </div>
    <div class="container-fluid">
        <div id="report_area" style="display:none">
            <h3 class="text-center font-weight-bold">ธนาคารออมสิน</h3>
            <p class="text-center font-weight-bold">รายงานเหตุการณ์</p>
            <!-- <br> -->
            <p class="text-center font-weight-bold">Portfolio Chronology logs Report(REP13)</p>
            <div class="row mb-5">
                <div class="col-md-4">
                    <span class="font-weight-bold">ประเภทสินเชื่อ:</span> <span id="product_type_show"></span>
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold">ประเภทโมเดล:</span> <span id="model_type_show"></span>
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold">ประเภทบัตร:</span> <span id="card_type_show"></span>
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold">วันที่สร้างใบสมัคร:</span> <span id="start_date_show" class="pl-5 pr-4"></span><b class="pl-3 pr-3">ถึง</b><span id="end_date_type_show">
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold">ผู้ออกรายงาน:</span> <span id="">ascbiadmin</span>
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold">วันที่ออกรายงาน:</span> <span id="current_date"></span>
                </div>
            </div>
            <div id="report" class="mb-5">
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-body px-4">
                <div class="form-group row">
                    <div class="col-4 font-weight-bold text-right">วันที่บันทึกข้อมูล :</div>
                    <div class="col-8" id="save_date_edit"></div>
                </div>
                <div class="form-group row">
                    <div class="col-4 font-weight-bold text-right">ประเภทสินเชื่อ :</div>
                    <div class="col-8 " id="product_type_edit"></div>
                </div>
                <div class="form-group row">
                    <div class="col-4 font-weight-bold text-right">ประเภทโมเดล :</div>
                    <div class="col-8" id="model_type_edit"></div>
                </div>
                <div class="form-group row">
                    <div class="col-4 font-weight-bold text-right">ประเภทบัตร :</div>
                    <div class="col-8" id="card_type_edit"></div>
                </div>
                <div class="form-group row">
                    <div class="col-4 font-weight-bold text-right">เวอร์ชั่นโมเดล</div>
                    <div class="col-8" id="model_version_edit"></div>
                </div>
                <div class="form-group row">
                    <div class="col-4 font-weight-bold text-right">วันที่เริ่มใช้งาน</div>
                    <div class="col-8" id="start_date_edit"></div>
                </div>
                <div class="form-group row">
                    <div class="col-4 font-weight-bold text-right">รายละเอียด :</div>
                    <textarea class="col-8 form-control" id="description_edit"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="edit_btn" onclick="onEditData(this)">บันทึก</button>
            </div>
            </div>
        </div>
    </div>
	<div id="export"></div>
</body>
</html>