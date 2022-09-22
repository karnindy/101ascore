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
    <link rel="stylesheet" href="font/all.min.css">
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.bundle-4.5.2.min.js"></script>
    <script src="js/dropdowns.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <title>Report13</title>
</head>
<body>
    <style>
        /* .ui-datepicker-calendar {
            display: none;
        } */
    </style>
    <div class="container">
        <form action="functions/addData.php" method="post" class="row justify-content-center mt-5">
            <div class="col-md-8 form-group row">
                <label for="" class="col-md-4 text-right font-weight-bold">*ประเภทสินเชื่อ : </label>
                <select class="col-md-8 form-control"  name="product_type" id="product_type" onchange="getValueDropdown(this)" target="model_type" required>
                    <option disabled selected value="">--โปรดเลือก--</option>
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
                <label for="" class="col-md-4 text-right font-weight-bold" >*ประเภทโมเดล : </label>
                <select class="col-md-8 form-control"  name="model_type" id="model_type" onchange="getValueDropdown(this)" target="card_type" type="insert" required >
                    <option disabled selected value="">--โปรดเลือก--</option>
                </select>
            </div>
            <div class="col-md-8 form-group row">
                <label for="" class="col-md-4 text-right font-weight-bold">*ประเภทบัตร : </label>
                <select class="col-md-8 form-control"  name="card_type" id="card_type" required>
                    <option disabled selected value="">--โปรดเลือก--</option>
                </select>
            </div>
            <div class="col-md-8 form-group row">
                <label for="" class="col-md-4 text-right font-weight-bold" >*เวอร์ชันโมเดล : </label>
                <select class="col-md-8 form-control"  name="model_version" id="model_version" required>
                    <option disabled selected value="">--โปรดเลือก--</option>
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
            <div class="col-md-8 form-group row">
                <label for="" class="col-md-4 text-right font-weight-bold">*วันเริ่มใช้งาน : </label>
                <div class="col-md-4 p-0 text-secondary"> 15/11/2018
                </div>
            </div>
            <div class="col-md-8 form-group row">
                <label for="" class="col-md-4 text-right font-weight-bold">วันที่บันทึก : </label>
                <div id="date_save" class="col-md-4 p-0 text-secondary"></div>
            </div>
            <div class="col-md-8 form-group row">
                <label for="" class="col-md-4 text-right font-weight-bold">*รายละเอียด: </label>
                <div class="col-md-8 p-0">
                    <textarea class="form-control" type="text" name="description" id="description" required></textarea>
                </div>
            </div>
            <div class="col-md-8 d-flex justify-content-center">
                <button class="col-md-2 btn btn-primary mr-3" type="submit" onclick="onSubmit(this)">บันทึกข้อมูล</button>
                <button class="col-md-1 btn btn-danger mr-3" type="button" onclick="refreshPage()">รีเซ็ต</button>
                <button class="col-md-2 btn btn-info mr-3" type="button" onclick="window.location.href = 'index.php'">ดูรายงาน</button>
            </div>
        </form>
    </div>
    <script>
        (function(){
		const d = new Date();
		document.getElementById('date_save').innerHTML = ("0" + d.getDate()).slice(-2) + "/" + ("0" + (d.getMonth()+1)).slice(-2) + "/" + d.getFullYear()
})();
    </script>
</body>
</html>