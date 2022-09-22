<?php
include("database/connect.php");  
$sql = "select batch_create_date
, online_create_date
, rep13_create_date
from logmonitor_reports
where report_group = 1";
$query = oci_parse($conn, $sql);
oci_execute ($query,OCI_DEFAULT);
while ($row = oci_fetch_array($query,OCI_BOTH)) {
?>

<div class="container mt-5">
        <table class='table table-bordered'>

            <thead style='background-color:#feccff'>
                
                <tr>
                    <th colspan="2" scope="col">รายงานผลการวิเคราะห์ออกแบบระบบงานตรวจสอบการคำนวณคะแนน</th>
                    <th colspan="2" scope='col'>ข้อมูลปัจจุบัน</th>
                </tr>
            
            </thead>
            
            <tbody>
            <td style="width:120px;">
                        <a class="" href="http://10.22.50.84:9704/analytics/saw.dll?Dashboard&PortalPath=%2Fshared%2F%E0%B8%A3%E0%B8%B2%E0%B8%A2%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%AA%E0%B8%B3%E0%B8%AB%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%95%E0%B8%A3%E0%B8%A7%E0%B8%88%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93%E0%B8%84%E0%B8%B0%E0%B9%81%E0%B8%99%E0%B8%99%2F_portal%2F%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%95%E0%B8%A3%E0%B8%A7%E0%B8%88%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93%E0%B8%84%E0%B8%B0%E0%B9%81%E0%B8%99%E0%B8%99&Page=%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B9%89%E0%B8%99%E0%B8%AB%E0%B8%B2%E0%B9%81%E0%B8%A5%E0%B8%B0%E0%B9%81%E0%B8%AA%E0%B8%94%E0%B8%87%E0%B8%9C%E0%B8%A5%E0%B9%83%E0%B8%9A%E0%B8%84%E0%B8%B3%E0%B8%82%E0%B8%AD%E0%B8%AA%E0%B8%B4%E0%B8%99%E0%B9%80%E0%B8%8A%E0%B8%B7%E0%B9%88%E0%B8%AD" target="_blank" rel="noopener noreferrer">
                            รายงานที่ 1
                        </a>
             </td>
                    
                    <td>รายงานการค้นหาและแสดงผลใบคำขอสินเชื่อ</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
            <td style="width:120px;">
                        <a class="" href="http://10.22.50.84:9704/analytics/saw.dll?Dashboard&PortalPath=%2Fshared%2F%E0%B8%A3%E0%B8%B2%E0%B8%A2%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%AA%E0%B8%B3%E0%B8%AB%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%95%E0%B8%A3%E0%B8%A7%E0%B8%88%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93%E0%B8%84%E0%B8%B0%E0%B9%81%E0%B8%99%E0%B8%99%2F_portal%2F%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%95%E0%B8%A3%E0%B8%A7%E0%B8%88%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93%E0%B8%84%E0%B8%B0%E0%B9%81%E0%B8%99%E0%B8%99&Page=%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%A1%E0%B8%B9%E0%B8%A5%E0%B9%83%E0%B8%9A%E0%B8%84%E0%B8%B3%E0%B8%82%E0%B8%AD%E0%B8%AA%E0%B8%B4%E0%B8%99%E0%B9%80%E0%B8%8A%E0%B8%B7%E0%B9%88%E0%B8%AD&Action=RefreshAll&ViewState=tj2to0b17mr71lk3bjjlfimtu6&StateAction=samePageState" target="_blank" rel="noopener noreferrer">
                            รายงานที่ 2
                        </a>
             </td>
                    <td>รายงานข้อมูลใบคำขอสินเชื่อ</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
            <td style="width:120px;">
                        <a class="" href="http://10.22.50.84:9704/analytics/saw.dll?Dashboard&PortalPath=%2Fshared%2F%E0%B8%A3%E0%B8%B2%E0%B8%A2%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%AA%E0%B8%B3%E0%B8%AB%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%95%E0%B8%A3%E0%B8%A7%E0%B8%88%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93%E0%B8%84%E0%B8%B0%E0%B9%81%E0%B8%99%E0%B8%99%2F_portal%2F%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%95%E0%B8%A3%E0%B8%A7%E0%B8%88%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93%E0%B8%84%E0%B8%B0%E0%B9%81%E0%B8%99%E0%B8%99&Page=%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%A1%E0%B8%B9%E0%B8%A5%E0%B9%83%E0%B8%9A%E0%B8%84%E0%B8%B3%E0%B8%82%E0%B8%AD%E0%B8%97%E0%B8%B8%E0%B8%81%20Sequence&Action=RefreshAll&ViewState=q2ad27hktmqairtaa01pjrj7qm&StateAction=samePageState" target="_blank" rel="noopener noreferrer">
                            รายงานที่ 3
                        </a>
             </td>
                    <td>รายงานข้อมูลใบคำขอทุก Sequence</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
            <td style="width:120px;">
                        <a class="" href="http://10.22.50.84:9704/analytics/saw.dll?Dashboard&PortalPath=%2Fshared%2F%E0%B8%A3%E0%B8%B2%E0%B8%A2%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%AA%E0%B8%B3%E0%B8%AB%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%95%E0%B8%A3%E0%B8%A7%E0%B8%88%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93%E0%B8%84%E0%B8%B0%E0%B9%81%E0%B8%99%E0%B8%99%2F_portal%2F%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%95%E0%B8%A3%E0%B8%A7%E0%B8%88%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93%E0%B8%84%E0%B8%B0%E0%B9%81%E0%B8%99%E0%B8%99&Page=%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%A1%E0%B8%B9%E0%B8%A5%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93&Action=RefreshAll&ViewState=0nps7c1o54kmvincfls758tb1m&StateAction=samePageState" target="_blank" rel="noopener noreferrer">
                            รายงานที่ 4
                        </a>
             </td>
                    <td>รายงานข้อมูลการคำนวณ</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
            <td style="width:120px;">
                        <a class="" href="http://10.22.50.84:9704/analytics/saw.dll?Dashboard&PortalPath=%2Fshared%2F%E0%B8%A3%E0%B8%B2%E0%B8%A2%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%AA%E0%B8%B3%E0%B8%AB%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%95%E0%B8%A3%E0%B8%A7%E0%B8%88%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93%E0%B8%84%E0%B8%B0%E0%B9%81%E0%B8%99%E0%B8%99%2F_portal%2F%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%95%E0%B8%A3%E0%B8%A7%E0%B8%88%E0%B8%AA%E0%B8%AD%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%B3%E0%B8%99%E0%B8%A7%E0%B8%93%E0%B8%84%E0%B8%B0%E0%B9%81%E0%B8%99%E0%B8%99&Page=%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B9%89%E0%B8%99%E0%B8%AB%E0%B8%B2%E0%B9%81%E0%B8%A5%E0%B8%B0%E0%B9%81%E0%B8%AA%E0%B8%94%E0%B8%87%E0%B8%9C%E0%B8%A5%E0%B9%83%E0%B8%9A%E0%B8%84%E0%B8%B3%E0%B8%82%E0%B8%AD%E0%B8%AA%E0%B8%B4%E0%B8%99%E0%B9%80%E0%B8%8A%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%AA%E0%B9%88%E0%B8%87%E0%B8%AD%E0%B8%AD%E0%B8%81%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%A1%E0%B8%B9%E0%B8%A5&Action=RefreshAll&ViewState=td0162eugs2uvr5kcppgg6umhu&StateAction=samePageState" target="_blank" rel="noopener noreferrer">
                            รายงานที่ 5
                        </a>
             </td>
                    <td>รายงานการค้นหาและแสดงผลใบคำขอสินเชื่อเพื่อส่งออกข้อมูล</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

            </tbody>

            
            <thead style='background-color:#feccff'>
                <tr>
                    <th colspan="2" scope='col'>ระบบรายงานเพื่อการติดตามประเมินผลการใช้งานแบบจำลอง</th>
                    <th colspan="2" scope='col'>ข้อมูลปัจจุบัน</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td style="width:120px;">
                        <a class="" href="../Report1/index.php" target="_blank" rel="noopener noreferrer">
                            REP01
                        </a>
                    </td>
                    <td>รายงานเปรียบเทียบการกระจายตัวของคะแนนของลูกค้าแต่ละกลุ่ม ณ ช่วงเวลาที่แตกต่างกัน 
                    (Population Stability Report)</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report2/index.php" target="_blank" rel="noopener noreferrer">
                            REP02
                        </a>
                    </td>
                    <td>รายงานการติดตามผลการพิจารณาบัตรเครดิตและสินเชื่อบัตรเงินสด ณ ช่วงเวลาที่แตกต่างกัน 
                    (Approval Rate Report)</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report3/index.php" target="_blank" rel="noopener noreferrer">
                            REP03
                        </a>
                    </td>
                    <td>รายงานการเปรียบเทียบการเปลี่ยนแปลงคุณลักษณะของลูกค้าปัจจุบันกับลูกค้าช่วงที่ใช้พัฒนาแบบจำลองฯ 
                    (Characteristic Analysis Rate Report)</td>
                    <td style="width:120px;"><option value="<?= $row['ONLINE_CREATE_DATE'] ?>"><?= $row['ONLINE_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report4/index.php" target="_blank" rel="noopener noreferrer">
                            REP04
                        </a>
                    </td>
                    <td>Final Score Report</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report5/index.php" target="_blank" rel="noopener noreferrer">
                            REP05
                        </a>
                    </td>
                    <td>รายงานแสดงสัดส่วนของลูกค้าที่มีการ Override ทั้ง High-Side Override และ Low-Side Override Override Rate Report</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report6/index.php" target="_blank" rel="noopener noreferrer">
                            REP06
                        </a>
                    </td>
                    <td>รายงานแสดงสัดส่วนเหตุผลการ Override ของลูกค้า (Override Reason Report)</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report7/index.php" target="_blank" rel="noopener noreferrer">
                            REP07
                        </a>
                    </td>
                    <td>รายงานประเมินประสิทธิผลของแบบจำลองฯ ในการแยกลูกค้าดีออกจากลูกค้าไม่ดี (Good or Bad Separation Report)</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report8/index.php" target="_blank" rel="noopener noreferrer">
                            REP08
                        </a>
                    </td>
                    <td>รายงานการดำเนินการของแบบจำลองฯ ในการวัดความเสี่ยงของลูกค้าก่อนที่จะเป็นหนี้เสีย (Early Performance Score Report)</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report9/index.php" target="_blank" rel="noopener noreferrer">
                            REP09
                        </a>
                    </td>
                    <td>รายงานเปรียบเทียบการผิดนัดชำระหนี้ของลูกหนี้ที่ได้เปิดบัญชีมาเป็นระยะเวลาเท่ากัน (Vintage Analysis Report)</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report10/index.php" target="_blank" rel="noopener noreferrer">
                            REP10
                        </a>
                    </td>
                    <td>รายงานอัตราการผิดนัดชำระหนี้ของลูกค้าตามระดับคะแนน ณ ช่วงไตรมาสต่างกันในแต่ละช่วงคะแนน (Delinquency Distribution Report)</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report11/index.php" target="_blank" rel="noopener noreferrer">
                            REP11
                        </a>
                    </td>
                    <td>รายงานความสามารถในการชำระหนี้ของลูกค้าในแต่ละช่วงคะแนน อัตราการเกิดหนี้เสียหลังจากที่นำระบบ Credit Scoring เข้ามาใช้งาน (Portfolio Score Performance Report)</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report12/index.php" target="_blank" rel="noopener noreferrer">
                            REP12
                        </a>
                    </td>
                    <td>รายงานความสามารถในการชำระหนี้ของลูกค้าในแต่ละช่วงเกรด อัตราการเกิดหนี้เสียหลังจากที่นำระบบ Credit Scoring เข้ามาใช้งาน (Portfolio Grade Performance Report)</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report13/index.php" target="_blank" rel="noopener noreferrer">
                            REP13
                        </a>
                    </td>
                    <td>รายงานเหตุการณ์ (Portfolio Chronology logs Report)</td>
                    <td style="width:120px;"><option value="<?= $row['REP13_CREATE_DATE'] ?>"><?= $row['REP13_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report14/index.php" target="_blank" rel="noopener noreferrer">
                            REP14
                        </a>
                    </td>
                    <td>รายงานการวิเคราะห์และติดตามประเมินผลการใช้แบบจำลองฯ วัดระดับความเสี่ยง (Credit Scoring Model)</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>

                <tr>
                    <td>
                        <a class="" href="../Report15/index.php" target="_blank" rel="noopener noreferrer">
                            REP15
                        </a>                        
                    </td>

                    <td>รายงานการทดสอบค่า Performance แบบจำลองฯ</td>
                    <td style="width:120px;"><option value="<?= $row['BATCH_CREATE_DATE'] ?>"><?= $row['BATCH_CREATE_DATE'] ?></option></td>
                </tr>
            </tbody>



        </table>
    </div>

<?php
}
?>