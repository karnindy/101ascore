<?php
    include("database/connect.php");
    require_once('functions/dropdownsClass.php');
    require_once('functions/SQLReportClass.php');

    $dropdown = new Dropdown();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="css/bootstrap-4.5.2.min.css" />
    <link rel="stylesheet" href="css/bootstrap-multiselect.min.css" />
    <link rel="stylesheet" href="font/all.min.css">
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.bundle-4.5.2.min.js"></script>
    <script src="js/bootstrap-multiselect.min.js"></script>
    <script src="js/dropdowns.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery-ui.js"></script>
	<script src="js/js.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 form-group row">
                <label class="col-md-4 col-form-label text-right font-weight-bold" for="product_type">* ประเภทสินเชื่อ</label>
                <div class="col-md-8">
                    <select class="form-control" name="product_type" id="product_type" onchange="getValueDropdown(this)" target="model_type">
                    <option disabled selected>--โปรดเลือก--</option>
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
            </div>
            <div class="col-md-6 form-group row">
                <label class="col-md-4 col-form-label text-right font-weight-bold" for="business_type">สายงานธุรกิจ</label>
                <div class="col-md-8">
                    <select class="form-control" name="business_type" id="business_type" onchange="getValueDropdown(this)" target="region_name">
                        <option value='รวมทุกสายงานกิจการ' selected>รวมทุกสายงานกิจการ</option>
                    <?php
                        $sql = "select business_type
                            from prepare_master_step2
                            group by business_type
                            order by business_type asc";
                        $query = oci_parse($conn, $sql);
                        oci_execute ($query,OCI_DEFAULT);
                        while ($row = oci_fetch_array($query,OCI_BOTH)) {
                        ?>
                            <option value="<?= $row['BUSINESS_TYPE'] ?>"><?= $row['BUSINESS_TYPE'] ?></option>
                        <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group row">
                <label class="col-md-4 col-form-label text-right font-weight-bold" for="model_type">* ประเภทโมเดล</label>
                <div class="col-md-8">
                    <select class="form-control" name="model_type" id="model_type" onchange="getValueDropdown(this)" target="card_type">
                    <option disabled selected>--โปรดเลือก--</option>
                    <?php
                        $sql = $dropdown->get_model_types();
                        $query = oci_parse($conn, $sql);
                        oci_execute ($query,OCI_DEFAULT);
                        while ($row = oci_fetch_array($query,OCI_BOTH)) {
                        ?>
                            <option value="<?= $row['MODEL_TYPE_DISPLAY'] ?>"><?= $row['MODEL_TYPE_DISPLAY'] ?></option>
                        <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group row">
                <label class="col-md-4 col-form-label text-right font-weight-bold" for="region_name">ภาค/ฝ่าย</label>
                <div class="col-md-8">
                    <select class="form-control" name="region_name" id="region_name" onchange="getValueDropdown(this)" target="zone_name">
                        <option value="รวมทุกภาค" selected>รวมทุกภาค</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group row">
                <label class="col-md-4 col-form-label text-right font-weight-bold" for="card_type">* ประเภทบัตร</label>
                <div class="col-md-8">
                    <select class="form-control" name="card_type" id="card_type">
                        <option disabled selected>--โปรดเลือก--</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group row">
                <label class="col-md-4 col-form-label text-right font-weight-bold" for="zone_name">เขต/ส่วน</label>
                <div class="col-md-8">
                    <select class="form-control" name="zone_name" id="zone_name" onchange="getValueDropdown(this)" target="branch_name">
                        <!-- <option disabled selected>--โปรดเลือก--</option> -->
                        <option value='รวมทุกเขต' selected>รวมทุกเขต</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group row">
                <label class="col-md-4 col-form-label text-right font-weight-bold" for="model_version">* เวอร์ชั่นโมเดล</label>
                <div class="col-md-8">
                    <select class="form-control" name="model_version" id="model_version">
                        <option disabled selected>--โปรดเลือก--</option>
                    <?php
                        $sql = "select model_version_display
                            from prepare_master_step2
                            group by model_version_display
                            order by model_version_display asc";
                        $query = oci_parse($conn, $sql);
                        oci_execute ($query,OCI_DEFAULT);
                        while ($row = oci_fetch_array($query,OCI_BOTH)) {
                        ?>
                            <option value="<?= $row['MODEL_VERSION_DISPLAY'] ?>"><?= $row['MODEL_VERSION_DISPLAY'] ?></option>
                        <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group row">
                <label class="col-md-4 col-form-label text-right font-weight-bold" for="branch_name">สาขา/หน่วย</label>
                <div class="col-md-8">
                    <select class="form-control" name="branch_name" id="branch_name">
                        <!-- <option disabled selected>--โปรดเลือก--</option> -->
                        <option value='รวมทุกสาขา' selected>รวมทุกสาขา</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 form-group row">
                <label class="col-md-4 col-form-label text-right font-weight-bold" for="sales_channel">ช่องทางการขาย</label>
                <div class="col-md-8">
                    <select class="form-control" name="sales_channel" id="sales_channel">
                        <!-- <option disabled selected>--โปรดเลือก--</option> -->
                        <option value="รวมทุกช่องทาง" selected>รวมทุกช่องทาง</option>
                    <?php
                        $sql = "select sales_channel_display
                            from prepare_master_step2
                            group by sales_channel_display
                            order by sales_channel_display";
                        $query = oci_parse($conn, $sql);
                        oci_execute ($query,OCI_DEFAULT);
                        while ($row = oci_fetch_array($query,OCI_BOTH)) {
                        ?>
                            <option value="<?= $row['SALES_CHANNEL_DISPLAY'] ?>"><?= $row['SALES_CHANNEL_DISPLAY'] ?></option>
                        <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="col-md-8 form-group row p-0">
                <label class="col-md-3 col-form-label text-right font-weight-bold" for="create_date">* วันที่สร้างใบสมัคร</label>
                <div class="col-md-4">
                    <input class="form-control datepicker" type="text" name="start_date" id="start_date" placeholder="dd/mm/yyyy" onchange="check_date_between(this)">
                </div>
                <div class="col-md-1">ถึง</div>
                <div class="col-md-4">
                    <input class="form-control datepicker" type="text" name="end_date" id="end_date" placeholder="dd/mm/yyyy" onchange="check_date_between(this)">
                    <!-- <input class="form-control" type="date" name="end_date" id="end_date"> -->
                </div>
				<div class="col-md-3 text-right text-danger font-weight-bold d-none" id="check_date">* เลือกวันที่ไม่ถูกต้อง</div>
            </div>
        </div>
        <div class="row justify-content-end">
            <button class="col-md-2 btn btn-primary mr-3" type="submit" onclick="onSubmit(this)">แสดงรายงาน</button>
            <button class="col-md-1 btn btn-danger" type="btn" onclick="refreshPage()">รีเซ็ต</button>
        </div>
        <div id="report_area" style="display:none">
            <h3 class="text-center font-weight-bold">ธนาคารออมสิน</h3>
            <p class="text-center font-weight-bold">รายงานเปรียบเทียบการกระจายตัวของคะแนนของลูกค้าแต่ละกลุ่ม ณ ช่วงเวลาที่แตกต่างกัน</p>
            <!-- <br> -->
            <p class="text-center font-weight-bold">(Population Stability Report)(REP01)</p>
            <div class="row mb-5">
                <div class="col-md-12">
                    <span class="font-weight-bold">เวอร์ชันโมเดล:</span> <span id="model_version_show"></span>
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold">ประเภทสินเชื่อ:</span> <span id="product_type_show"></span>
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold">ประเภทโมเดล:</span> <span id="model_type_show"></span>
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold">ประเภทบัตร:</span> <span id="card_type_show"></span>
                </div>
                <div class="col-md-8">
                    <span class="font-weight-bold">ภาค:</span>&nbsp;&nbsp;&nbsp;<span id="region_show"></span>&nbsp;&nbsp;&nbsp;<span class="font-weight-bold">เขต:</span>&nbsp;&nbsp;&nbsp;<span id="zone_show"></span>&nbsp;&nbsp;&nbsp;<span class="font-weight-bold">สาขา:</span>&nbsp;&nbsp;&nbsp;<span id="branch_show"></span>
                </div>
                <div class="col-md-4">
                    <span class="font-weight-bold">ช่องทางการขาย:</span> <span id="sales_channels_show"></span>
                </div>
                <div class="col-md-12">
                    <span class="font-weight-bold">สายงานธุรกิจ:</span> <span id="business_type_show"></span>
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
	<div id="export"></div>
</body>
</html>