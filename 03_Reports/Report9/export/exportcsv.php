<?php
include("../database/connect.php");
// include("js/jquery-2.2.4.min.js");
error_reporting(0); 
$product_type=$_POST['product_type'];
$model_type=$_POST['model_type'];
$card_type=$_POST['card_type'];
$model_version=$_POST['model_version'];
$sales_channel=$_POST['sales_channel'];
$business_type=$_POST['business_type'];
$region_name=$_POST['region_name'];
$zone_name=$_POST['zone_name'];
$branch_name=$_POST['branch_name'];
$month=$_POST['month'];
$year=$_POST['year'];
$all_year=$_POST['all_year'];

require('sqlExport.php');
// echo  $sql;


$name="9";
$fileName = "csv/Report".$name."_CSV.csv";
$objWrite = fopen("csv/Report".$name."_CSV.csv", "w");
fwrite($objWrite, "\xEF\xBB\xBF");


$sql_all_year = get_all_year($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['model_version'], $_POST['sales_channel'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['month'], $_POST['year']);
$query_all_year = oci_parse($conn, $sql_all_year);
// echo $sql_all_year;
oci_execute($query_all_year,OCI_DEFAULT);

$numrows = oci_fetch_all($query_all_year, $res);

fwrite($objWrite, "\" \",\" \",\"Deliquency\"");
for ($x = 1; $x <= $numrows-1; $x++) {
  fwrite($objWrite, ",\" \"");
} 
fwrite($objWrite, "\n");
fwrite($objWrite, "\"Approve Date\",\"Total Account\"");

$all_year = "";
$array_all_year = array();
$count_all_year = 1;
// print_r($res["ALL_YEAR"]);
foreach ($res["ALL_YEAR"] as $row_all_year) {
    array_push($array_all_year, $row_all_year);

  fwrite($objWrite, ",\"$row_all_year\"");

    if($count_all_year == $numrows){
        $all_year = $all_year . "'" . $row_all_year . "'";
    } else {
        $all_year = $all_year . "'" . $row_all_year . "',";
    }
    $count_all_year++;
}
fwrite($objWrite, "\n");
$sql = get_report_sql($_POST['product_type'], $_POST['model_type'], $_POST['card_type'], $_POST['region_name'], $_POST['zone_name'], $_POST['branch_name'], $_POST['model_version'], $_POST['sales_channel'], $_POST['month'], $_POST['year'], $all_year, $_POST['business_type']);

$query = oci_parse($conn, $sql);
oci_execute($query,OCI_DEFAULT);
$count = 0;
while ($row = oci_fetch_array($query,OCI_BOTH)) {
	$month = "'" . $array_all_year[$count] . "'";

		$s1=$array_all_year[$count];
		$s2=number_format($row['TOTAL_ACCOUNT'], 0);
		$s3=number_format($row[$month], 2);

			fwrite($objWrite, "\"$s1\",\"$s2\"");

    for ($i=0; $i < $numrows; $i++) {
        if($count == $i){
        	fwrite($objWrite, ",\"$s3\"");
        } else {
            fwrite($objWrite, ",\"0.00\"");
        }
    }
    fwrite($objWrite, "\n");
    $count++;
}




fclose($objWrite);
?>