<?php
// defImport
// display error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// turn off magic quotes
if(in_array(strtolower(ini_get('magic_quotes_gpc')), array('1','on'))) {
	$_POST = array_map('stripslashes', $_POST);
}

// set timezone
define('TIMEZONE', 'Asia/Bangkok');
@date_default_timezone_set('Asia/Bangkok');

// database config
$host = 'localhost';
$sql_user = 'apsuser';
$sql_pw = 'P@ssw0rd';
$sql_name = 'ascdev';

$conn_mysql = new mysqli($host, $sql_user, $sql_pw, $sql_name);
if (!$conn_mysql) {
  die('Connection failed.');
}
$conn_mysql->query('SET NAMES utf8');

// input validation
$input_xml = '';
if(isset($_POST['input_xml']) && trim($_POST['input_xml'] != '')) {
  libxml_disable_entity_loader(true);
  $text_xml = htmlspecialchars($_POST['input_xml'], ENT_XML1, 'UTF-8');
  $text_xml = html_entity_decode($text_xml);
  file_put_contents('input.xml', $text_xml);
} else {
  die('Missing parameter [input_xml]');
}
$input_xml = file_get_contents('input.xml');
$log_input = $input_xml;
$in_xml = simplexml_load_string($input_xml, 'SimpleXMLElement', LIBXML_NOCDATA);
$in_xml->REQUEST_DATE = format_date($in_xml->REQUEST_DATE);
$in_xml->REQUEST_DETAIL->APP_MASTER->CREATE_DATE = format_date($in_xml->REQUEST_DETAIL->APP_MASTER->CREATE_DATE);

$input_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<DAXMLDocument xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">
  <OCONTROL>
  <ALIAS>APS</ALIAS>
  <SIGNATURE>GSB</SIGNATURE>
  <APPLICATION_ID>".blank_to_decimal($in_xml->REQUEST_DETAIL->APP_MASTER->APPL_ID)."</APPLICATION_ID>
  <DALOGLEVEL>0</DALOGLEVEL>
  </OCONTROL>
  <In>
  <Age>".blank_to_decimal($in_xml->REQUEST_DETAIL->PROFILE->AGE)."</Age>
  <Applid>".blank_to_decimal($in_xml->REQUEST_DETAIL->APP_MASTER->APPL_ID)."</Applid>
  <Avgmonthlyincamt>0</Avgmonthlyincamt>
  <Borrowertype>".blank_to_decimal($in_xml->REQUEST_DETAIL->PROFILE->BORROWER_TYPE)."</Borrowertype>
  <Branchcode>".blank_to_decimal($in_xml->REQUEST_DETAIL->APP_MASTER->BRANCH_CODE)."</Branchcode>
  <Businesstypecode>".blank_to_decimal($in_xml->REQUEST_DETAIL->DETWORKING->BUSINESS_TYPE_CODE)."</Businesstypecode>
  <Cardtype>".blank_to_decimal($in_xml->REQUEST_DETAIL->APP_MASTER->CARD_TYPE)."</Cardtype>
  <Cid>".blank_to_decimal($in_xml->REQUEST_DETAIL->PROFILE->CID)."</Cid>
  <Commm1amt>0</Commm1amt>
  <Commm2amt>0</Commm2amt>
  <Commm3amt>0</Commm3amt>
  <Companygroupcode>0</Companygroupcode>
  <Createdate>".blank_to_decimal($in_xml->REQUEST_DATE)."</Createdate>
  <Currenthomenumber>0</Currenthomenumber>
  <Currentmobilenumber>0</Currentmobilenumber>
  <Currentprovince>0</Currentprovince>
  <Currentresidentialstatus>".blank_to_decimal($in_xml->REQUEST_DETAIL->PROFILE->CURRENT_RESIDENTIAL_STATUS)."</Currentresidentialstatus>
  <Educationlevel>".blank_to_decimal($in_xml->REQUEST_DETAIL->PROFILE->EDUCATION_LEVEL)."</Educationlevel>
  <Emplomentstatuscode>0</Emplomentstatuscode>
  <Estimateassetvalue>".blank_to_decimal($in_xml->REQUEST_DETAIL->PROFILE->ESTIMATE_ASSET_VALUE)."</Estimateassetvalue>
  <Estimateincomepermonth>".blank_to_decimal($in_xml->REQUEST_DETAIL->DETWORKING->ESTIMATE_INCOME_PER_MONTH)."</Estimateincomepermonth>
  <Finalmnthincamt>0</Finalmnthincamt>
  <Gender>".blank_to_decimal($in_xml->REQUEST_DETAIL->PROFILE->GENDER)."</Gender>
  <Incometocalculate>0</Incometocalculate>
  <Legalhomenumber>0</Legalhomenumber>
  <Legalmobilenumber>0</Legalmobilenumber>
  <Legalprovince>".blank_to_decimal($in_xml->REQUEST_DETAIL->PROFILE->LEGAL_PROVINCE)."</Legalprovince>
  <Maritalstatus>".blank_to_decimal($in_xml->REQUEST_DETAIL->PROFILE->MARITAL_STATUS)."</Maritalstatus>
  <Modelversion>1.0</Modelversion>
  <Noofchildren>0</Noofchildren>
  <OccProcode>0</OccProcode>
  <Occupationcode>".blank_to_decimal($in_xml->REQUEST_DETAIL->DETWORKING->OCCUPATION_CODE)."</Occupationcode>
  <Officenumber>0</Officenumber>
  <Otherfixincamt>0</Otherfixincamt>
  <Otm1amt>0</Otm1amt>
  <Otm2amt>0</Otm2amt>
  <Otm3amt>0</Otm3amt>
  <Productprogram>0</Productprogram>
  <Producttype>".blank_to_decimal($in_xml->REQUEST_DETAIL->APP_MASTER->PRODUCT_TYPE)."</Producttype>
  <Professionalcode>".blank_to_decimal($in_xml->REQUEST_DETAIL->DETWORKING->PROFESSIONAL_CODE)."</Professionalcode>
  <Regioncode>0</Regioncode>
  <Salaryamt>0</Salaryamt>
  <Saleschannel>0</Saleschannel>
  <Sourceofasset>0</Sourceofasset>
  <Subbusinesstypecode>0</Subbusinesstypecode>
  <Timeinjob>".blank_to_decimal($in_xml->REQUEST_DETAIL->DETWORKING->TIME_IN_JOB)."</Timeinjob>
  <Totaldebtamt>0</Totaldebtamt>
  <Totalmnthincamt>0</Totalmnthincamt>
  <Vipflag>0</Vipflag>
  <Zonecode>0</Zonecode>
  </In>
  <Out>
  <AgeYear>0</AgeYear>
  <Appid>0</Appid>
  <AscoreInput>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
  </AscoreInput>

  <AscoreOutcome>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
  </AscoreOutcome>

  <AscoreValue>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
  </AscoreValue>
  <Grade>0</Grade>
  <GradeDesc>0</GradeDesc>
  <Index>0</Index>
  <Modelversion>0</Modelversion>
  <Scorecardname>0</Scorecardname>
  <Scoreresulttable>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
    <item>0</item>
  </Scoreresulttable>
  <SumScore>0</SumScore>
  <TimeInJob>0</TimeInJob>
  </Out>
</DAXMLDocument>";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'ASCORE.UAT.SM:8092/DAServiceREST');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $input_xml);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate'); 
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
$raw_output = curl_exec($ch);
$log_output = $raw_output;
$out_xml = simplexml_load_string($raw_output, 'SimpleXMLElement', LIBXML_NOCDATA);
//echo curl_error($ch);
//echo $raw_output;
//die();

$sql_cmd = 'INSERT INTO func_zugsz_log_inout SET 
  text_in = ?, 
  text_out = ?, 
  insertdatetime = NOW(), 
  insertusertype = "0", 
  insertuserid = 0, 
  updatedatetime = NOW(), 
  updateusertype = "0", 
  updateuserid = 0, 
  sortorderid = 0, 
  version = 1, 
  status = "Active"';

$stmt = $conn_mysql->prepare($sql_cmd);
$stmt->bind_param('ss', $log_input, $log_output);
$stmt->execute();

//echo '<textarea>';
//echo $raw_output;
//print_r($out_xml);
//echo '</textarea>';
//die();

//echo '<textarea>';
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
echo '<RESPONSE>'.PHP_EOL;
echo '<REQUEST_ID>'.$in_xml->REQUEST->REQUEST_ID.'</REQUEST_ID>'.PHP_EOL;

echo '<STATUS>OK</STATUS>'.PHP_EOL;
echo '<DESCRIPTION>xxxxxx</DESCRIPTION>'.PHP_EOL;
echo '<REQUEST>'.PHP_EOL;
echo '<APPID>'.$out_xml->Out->Appid.'</APPID>'.PHP_EOL;

echo '<CID>'.$out_xml->In->Cid.'</CID>'.PHP_EOL;
echo '</REQUEST>'.PHP_EOL;
echo '<RESULT>'.PHP_EOL;
echo '<GRADE>'.$out_xml->Out->Grade.'</GRADE>'.PHP_EOL;
echo '<DESCRIPTION>'.$out_xml->Out->GradeDesc.'</DESCRIPTION>'.PHP_EOL;
echo '</RESULT>'.PHP_EOL;
echo '</RESPONSE>'.PHP_EOL;
//echo '</textarea>';

$ora_host = 'ASCORE.UAT.DB';
$ora_port = '1521';
$ora_service = 'ASCDEV';
$ora_user = 'apsuser';
$ora_pw = 'APSuser123#';

$connection_string = $ora_host.':'.$ora_port.'/'.$ora_service;

$conn = oci_connect($ora_user, $ora_pw, $connection_string, 'AL32UTF8');
if(!$conn) {
  $e = oci_error();
  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  die();
}

$insert_cols = array(
  'REQ_ID',
  'REQ_REQUEST_ID',
  'REQ_REQUEST_DATE',
  'REQ_REQUEST_TIME',
  'APPL_ID',
  'PRODUCT_TYPE',
  'PRODUCT_PROGRAM',
  'CARD_TYPE',
  'SALES_CHANNEL',
  'BRANCH_CODE',
  'BRANCH_NAME',
  'ZONE_CODE',
  'ZONE_NAME',
  'REGION_CODE',
  'REGION_NAME',
  'CREATE_DATE',
  'VIP_FLAG',
  'CID',
  'BORROWER_TYPE',
  'FIRST_NAME_TH',
  'LAST_NAME_TH',
  'AGE',
  'GENDER',
  'EDUCATION_LEVEL',
  'MARITAL_STATUS',
  'SOURCE_OF_ASSET',
  'ESTIMATE_ASSET_VALUE',
  'LEGAL_PROVINCE',
  'LEGAL_HOME_NUMBER',
  'LEGAL_MOBILE_NUMBER',
  'CURRENT_PROVINCE',
  'CURRENT_ZIPCODE',
  'CURRENT_HOME_NUMBER',
  'CURRENT_EXT_NUMBER',
  'CURRENT_MOBILE_NUMBER',
  'CURRENT_RESIDENTIAL_STATUS',
  'EMPLOMENT_STATUS_CODE',
  'OCCUPATION_CODE',
  'PROFESSIONAL_CODE',
  'SUB_BUSINESS_TYPE_CODE',
  'TIME_IN_JOB',
  'COMPANY_GROUP_CODE',
  'COMPANY_NAME_CODE',
  'OFFICE_NUMBER',
  'ESTIMATE_INCOME_PER_MONTH',
  'OT_M1_AMT',
  'OT_M2_AMT',
  'OT_M3_AMT',
  'COMM_M1_AMT',
  'COMM_M2_AMT',
  'COMM_M3_AMT',
  'AVG_MONTHLY_INC_AMT',
  'TOTAL_MNTH_INC_AMT',
  'FINAL_MNTH_INC_AMT',
  'INCOME_TO_CALCULATE',
  'SCORE',
  'SCORE_GRADE',
  'OOC_ID',
  'OOC_ALIAS',
  'OOC_SIGNATURE',
  'OOC_EDITION',
  'OOC_OBJECTIVE',
  'OOC_EDITIONDATE',
  'OOC_APPLICATION_ID',
  'OOC_DALOGLEVEL',
  'OI_ID',
  'OI_OCONTROL_ID',
  'OI_AGE',
  'OI_APPLID',
  'OI_AVGMONTHLYINCAMT',
  'OI_BORROWERTYPE',
  'OI_BRANCHCODE',
  'OI_BUSINESSTYPECODE',
  'OI_CARDTYPE',
  'OI_CID',
  'OI_COMMM1AMT',
  'OI_COMMM2AMT',
  'OI_COMMM3AMT',
  'OI_COMPANYGROUPCODE',
  'OI_CREATEDATE',
  'OI_CURRENTHOMENUMBER',
  'OI_CURRENTMOBILENUMBER',
  'OI_CURRENTPROVINCE',
  'OI_CURRENTRESIDENTIALSTATUS',
  'OI_EDUCATIONLEVEL',
  'OI_EMPLOMENTSTATUSCODE',
  'OI_ESTIMATEASSETVALUE',
  'OI_ESTIMATEINCOMEPERMONTH',
  'OI_FINALMNTHINCAMT',
  'OI_GENDER',
  'OI_INCOMETOCALCULATE',
  'OI_LEGALHOMENUMBER',
  'OI_LEGALMOBILENUMBER',
  'OI_LEGALPROVINCE',
  'OI_MARITALSTATUS',
  'OI_MODELVERSION',
  'OI_NOOFCHILDREN',
  'OI_OCCUPATIONCODE',
  'OI_OFFICENUMBER',
  'OI_OTHERFIXINCAMT',
  'OI_OTM1AMT',
  'OI_OTM2AMT',
  'OI_OTM3AMT',
  'OI_PRODUCTPROGRAM',
  'OI_PRODUCTTYPE',
  'OI_PROFESSIONALCODE',
  'OI_REGIONCODE',
  'OI_SALARYAMT',
  'OI_SALESCHANNEL',
  'OI_SOURCEOFASSET',
  'OI_SUBBUSINESSTYPECODE',
  'OI_TIMEINJOB',
  'OI_TOTALDEBTAMT',
  'OI_TOTALMNTHINCAMT',
  'OI_VIPFLAG',
  'OI_ZONECODE',
  'OO_ID',
  'OO_OCONTROL_ID',
  'OO_APPID',
  'OO_AGEYEAR',
  'OO_GRADE',
  'OO_GRADEDESC',
  'OO_INDEX',
  'OO_MODELVERSION',
  'OO_SCORECARDNAME',
  'OO_SUMSCORE',
  'OO_TIMEINJOB',
  'OOAI_ID',
  'OOAI_OCONTROL_ID',
  'OOAI_OUTPUT_OUT_ID',
  'OOAI_ITEM',
  'OOAO_ID',
  'OOAO_OCONTROL_ID',
  'OOAO_OUTPUT_OUT_ID',
  'OOAO_ITEM',
  'OOAV_ID',
  'OOAV_OCONTROL_ID',
  'OOAV_OUTPUT_OUT_ID',
  'OOAV_ITEM',
  'OOART_ID',
  'OOART_OCONTROL_ID',
  'OOART_OUTPUT_OUT_ID',
  'OOART_ITEM'
);

$insert_values_template = array(
  $in_xml->REQUEST_ID, // REQ_ID
  $in_xml->REQUEST_ID, // REQ_REQUEST_ID
  $in_xml->REQUEST_DATE, // REQ_REQUEST_DATE
  $in_xml->REQUEST_TIME, // REQ_REQUEST_TIME
  $in_xml->REQUEST_DETAIL->APP_MASTER->APPL_ID, // APPL_ID
  $in_xml->REQUEST_DETAIL->APP_MASTER->PRODUCT_TYPE, // PRODUCT_TYPE
  $in_xml->REQUEST_DETAIL->APP_MASTER->PRODUCT_PROGRAM, // PRODUCT_PROGRAM
  $in_xml->REQUEST_DETAIL->APP_MASTER->CARD_TYPE, // CARD_TYPE
  $in_xml->REQUEST_DETAIL->APP_MASTER->SALES_CHANNEL, // SALES_CHANNEL
  $in_xml->REQUEST_DETAIL->APP_MASTER->BRANCH_CODE, // BRANCH_CODE
  $in_xml->REQUEST_DETAIL->APP_MASTER->BRANCH_NAME, // BRANCH_NAME
  $in_xml->REQUEST_DETAIL->APP_MASTER->ZONE_CODE, // ZONE_CODE
  $in_xml->REQUEST_DETAIL->APP_MASTER->ZONE_NAME, // ZONE_NAME
  $in_xml->REQUEST_DETAIL->APP_MASTER->REGION_CODE, // REGION_CODE
  $in_xml->REQUEST_DETAIL->APP_MASTER->REGION_NAME, // REGION_NAME
  $in_xml->REQUEST_DETAIL->APP_MASTER->CREATE_DATE, // CREATE_DATE
  $in_xml->REQUEST_DETAIL->APP_MASTER->VIP_FLAG, // VIP_FLAG
  $in_xml->REQUEST_DETAIL->PROFILE->CID, // CID
  $in_xml->REQUEST_DETAIL->PROFILE->BORROWER_TYPE, // BORROWER_TYPE
  $in_xml->REQUEST_DETAIL->PROFILE->FIRST_NAME_TH, // FIRST_NAME_TH
  $in_xml->REQUEST_DETAIL->PROFILE->LAST_NAME_TH, // LAST_NAME_TH
  $in_xml->REQUEST_DETAIL->PROFILE->AGE, // AGE
  $in_xml->REQUEST_DETAIL->PROFILE->GENDER, // GENDER
  $in_xml->REQUEST_DETAIL->PROFILE->EDUCATION_LEVEL, // EDUCATION_LEVEL
  $in_xml->REQUEST_DETAIL->PROFILE->MARITAL_STATUS, // MARITAL_STATUS
  $in_xml->REQUEST_DETAIL->PROFILE->SOURCE_OF_ASSET, // SOURCE_OF_ASSET
  $in_xml->REQUEST_DETAIL->PROFILE->ESTIMATE_ASSET_VALUE, // ESTIMATE_ASSET_VALUE
  $in_xml->REQUEST_DETAIL->PROFILE->LEGAL_PROVINCE, // LEGAL_PROVINCE
  $in_xml->REQUEST_DETAIL->PROFILE->LEGAL_HOME_NUMBER, // LEGAL_HOME_NUMBER
  $in_xml->REQUEST_DETAIL->PROFILE->LEGAL_MOBILE_NUMBER, // LEGAL_MOBILE_NUMBER
  $in_xml->REQUEST_DETAIL->PROFILE->CURRENT_PROVINCE, // CURRENT_PROVINCE
  $in_xml->REQUEST_DETAIL->PROFILE->CURRENT_ZIPCODE, // CURRENT_ZIPCODE
  $in_xml->REQUEST_DETAIL->PROFILE->CURRENT_HOME_NUMBER, // CURRENT_HOME_NUMBER
  $in_xml->REQUEST_DETAIL->PROFILE->CURRENT_EXT_NUMBER, // CURRENT_EXT_NUMBER
  $in_xml->REQUEST_DETAIL->PROFILE->CURRENT_MOBILE_NUMBER, // CURRENT_MOBILE_NUMBER
  $in_xml->REQUEST_DETAIL->PROFILE->CURRENT_RESIDENTIAL_STATUS, // CURRENT_RESIDENTIAL_STATUS
  $in_xml->REQUEST_DETAIL->DETWORKING->EMPLOMENT_STATUS_CODE, // EMPLOMENT_STATUS_CODE
  $in_xml->REQUEST_DETAIL->DETWORKING->OCCUPATION_CODE, // OCCUPATION_CODE
  $in_xml->REQUEST_DETAIL->DETWORKING->PROFESSIONAL_CODE, // PROFESSIONAL_CODE
  $in_xml->REQUEST_DETAIL->DETWORKING->SUB_BUSINESS_TYPE_CODE, // SUB_BUSINESS_TYPE_CODE
  $in_xml->REQUEST_DETAIL->DETWORKING->TIME_IN_JOB, // TIME_IN_JOB
  $in_xml->REQUEST_DETAIL->DETWORKING->COMPANY_GROUP_CODE, // COMPANY_GROUP_CODE
  $in_xml->REQUEST_DETAIL->DETWORKING->COMPANY_NAME_CODE, // COMPANY_NAME_CODE
  $in_xml->REQUEST_DETAIL->DETWORKING->OFFICE_NUMBER, // OFFICE_NUMBER
  $in_xml->REQUEST_DETAIL->DETWORKING->ESTIMATE_INCOME_PER_MONTH, // ESTIMATE_INCOME_PER_MONTH
  $in_xml->REQUEST_DETAIL->INCOME->OT_M1_AMT, // OT_M1_AMT
  $in_xml->REQUEST_DETAIL->INCOME->OT_M2_AMT, // OT_M2_AMT
  $in_xml->REQUEST_DETAIL->INCOME->OT_M3_AMT, // OT_M3_AMT
  $in_xml->REQUEST_DETAIL->INCOME->COMM_M1_AMT, // COMM_M1_AMT
  $in_xml->REQUEST_DETAIL->INCOME->COMM_M2_AMT, // COMM_M2_AMT
  $in_xml->REQUEST_DETAIL->INCOME->COMM_M3_AMT, // COMM_M3_AMT
  $in_xml->REQUEST_DETAIL->INCOME->AVG_MONTHLY_INC_AMT, // AVG_MONTHLY_INC_AMT
  $in_xml->REQUEST_DETAIL->INCOME->TOTAL_MNTH_INC_AMT, // TOTAL_MNTH_INC_AMT
  $in_xml->REQUEST_DETAIL->INCOME->FINAL_MNTH_INC_AMT, // FINAL_MNTH_INC_AMT
  $in_xml->REQUEST_DETAIL->INCOME->INCOME_TO_CALCULATE, // INCOME_TO_CALCULATE
  $in_xml->REQUEST_DETAIL->NCBSCORE->SCORE, // SCORE
  $in_xml->REQUEST_DETAIL->NCBSCORE->SCORE_GRADE, // SCORE_GRADE
  $in_xml->REQUEST_ID, // OOC_ID
  $out_xml->OCONTROL->ALIAS , // OOC_ALIAS
  $out_xml->OCONTROL->SIGNATURE, // OOC_SIGNATURE
  $out_xml->OCONTROL->EDITION, // OOC_EDITION
  $out_xml->OCONTROL->OBJECTIVE, // OOC_OBJECTIVE
  $out_xml->OCONTROL->EDITIONDATE, // OOC_EDITIONDATE
  $out_xml->OCONTROL->APPLICATION_ID, // OOC_APPLICATION_ID
  $out_xml->OCONTROL->DALOGLEVEL, // OOC_DALOGLEVEL
  $in_xml->REQUEST_ID, // OI_ID
  $in_xml->REQUEST_ID, // OI_OCONTROL_ID
  $out_xml->In->Age, // OI_AGE
  $out_xml->In->Applid, // OI_APPLID
  $out_xml->In->Avgmonthlyincamt, // OI_AVGMONTHLYINCAMT
  $out_xml->In->Borrowertype, // OI_BORROWERTYPE
  $out_xml->In->Branchcode, // OI_BRANCHCODE
  $out_xml->In->Businesstypecode, // OI_BUSINESSTYPECODE
  $out_xml->In->Cardtype, // OI_CARDTYPE
  $out_xml->In->Cid, // OI_CID
  $out_xml->In->Commm1amt, // OI_COMMM1AMT
  $out_xml->In->Commm2amt, // OI_COMMM2AMT
  $out_xml->In->Commm3amt, // OI_COMMM3AMT
  $out_xml->In->Companygroupcode, // OI_COMPANYGROUPCODE
  $out_xml->In->Createdate, // OI_CREATEDATE
  $out_xml->In->Currenthomenumber, // OI_CURRENTHOMENUMBER
  $out_xml->In->Currentmobilenumber, // OI_CURRENTMOBILENUMBER
  $out_xml->In->Currentprovince, // OI_CURRENTPROVINCE
  $out_xml->In->Currentresidentialstatus, // OI_CURRENTRESIDENTIALSTATUS
  $out_xml->In->Educationlevel, // OI_EDUCATIONLEVEL
  $out_xml->In->Emplomentstatuscode, // OI_EMPLOMENTSTATUSCODE
  $out_xml->In->Estimateassetvalue, // OI_ESTIMATEASSETVALUE
  $out_xml->In->Estimateincomepermonth, // OI_ESTIMATEINCOMEPERMONTH
  $out_xml->In->Finalmnthincamt, // OI_FINALMNTHINCAMT
  $out_xml->In->Gender, // OI_GENDER
  $out_xml->In->Incometocalculate, // OI_INCOMETOCALCULATE
  $out_xml->In->Legalhomenumber, // OI_LEGALHOMENUMBER
  $out_xml->In->Legalmobilenumber, // OI_LEGALMOBILENUMBER
  $out_xml->In->Legalprovince, // OI_LEGALPROVINCE
  $out_xml->In->Maritalstatus, // OI_MARITALSTATUS
  $out_xml->In->Modelversion, // OI_MODELVERSION
  $out_xml->In->Noofchildren, // OI_NOOFCHILDREN
  $out_xml->In->Occupationcode, // OI_OCCUPATIONCODE
  $out_xml->In->Officenumber, // OI_OFFICENUMBER
  $out_xml->In->Otherfixincamt, // OI_OTHERFIXINCAMT
  $out_xml->In->Otm1amt, // OI_OTM1AMT
  $out_xml->In->Otm2amt, // OI_OTM2AMT
  $out_xml->In->Otm3amt, // OI_OTM3AMT
  $out_xml->In->Productprogram, // OI_PRODUCTPROGRAM
  $out_xml->In->Producttype, // OI_PRODUCTTYPE
  $out_xml->In->Professionalcode, // OI_PROFESSIONALCODE
  $out_xml->In->Regioncode, // OI_REGIONCODE
  $out_xml->In->Salaryamt, // OI_SALARYAMT
  $out_xml->In->Saleschannel, // OI_SALESCHANNEL
  $out_xml->In->Sourceofasset, // OI_SOURCEOFASSET
  $out_xml->In->Subbusinesstypecode, // OI_SUBBUSINESSTYPECODE
  $out_xml->In->TimeinJob, // OI_TIMEINJOB
  $out_xml->In->Totaldebtamt, // OI_TOTALDEBTAMT
  $out_xml->In->Totalmnthincamt, // OI_TOTALMNTHINCAMT
  $out_xml->In->Vipflag, // OI_VIPFLAG
  $out_xml->In->Zonecode, // OI_ZONECODE
  $in_xml->REQUEST_ID, // OO_ID
  $in_xml->REQUEST_ID, // OO_OCONTROL_ID
  $out_xml->Out->Appid, // OO_APPID
  $out_xml->Out->AgeYear, // OO_AGEYEAR
  $out_xml->Out->Grade, // OO_GRADE
  $out_xml->Out->GradeDesc, // OO_GRADEDESC
  $out_xml->Out->Index, // OO_INDEX
  $out_xml->Out->Modelversion, // OO_MODELVERSION
  $out_xml->Out->Scorecardname, // OO_SCORECARDNAME
  $out_xml->Out->SumScore, // OO_SUMSCORE
  $out_xml->Out->TimeInJob // OO_TIMEINJOB
);

for($i = 0 ; $i < count($out_xml->Out->AscoreInput->item) ; $i++) {
  $input_item = $out_xml->Out->AscoreInput->item[$i];
  $outcome_item = isset($out_xml->Out->AscoreOutcome->item[$i]) ? $out_xml->Out->AscoreOutcome->item[$i] : '';
  $value_item = isset($out_xml->Out->AscoreValue->item[$i]) ? $out_xml->Out->AscoreValue->item[$i] : '';
  $result_item = isset($out_xml->Out->Scoreresulttable->item[$i]) ? $out_xml->Out->Scoreresulttable->item[$i] : '';
  
  $insert_item = array(
    $i, // OOAI_ID
    $in_xml->REQUEST_ID, // OOAI_OCONTROL_ID
    $in_xml->REQUEST_ID, // OOAI_OUTPUT_OUT_ID
    $input_item, // OOAI_ITEM
    
    $i, // OOAO_ID
    $in_xml->REQUEST_ID, // OOAO_OCONTROL_ID
    $in_xml->REQUEST_ID, // OOAO_OUTPUT_OUT_ID
    $outcome_item, // OOAO_ITEM
    
    $i, // OOAV_ID
    $in_xml->REQUEST_ID, // OOAV_OCONTROL_ID
    $in_xml->REQUEST_ID, // OOAV_OUTPUT_OUT_ID
    $value_item, // OOAV_ITEM
    
    $i, // OOART_ID
    $in_xml->REQUEST_ID, // OOART_OCONTROL_ID
    $in_xml->REQUEST_ID, // OOART_OUTPUT_OUT_ID
    $result_item, // OOART_ITEM
  );
  $insert_values = array_merge($insert_values_template, $insert_item);
  
  foreach($insert_values as $idx => $value) {
    if(is_null($value)) {
      $insert_values[$idx] = "''";
    } else {
      $insert_values[$idx] = "'".$insert_values[$idx]."'";
    }
  }
  
  $sql_command = "INSERT INTO ASCDEV_DW.APS_ONLINE_WS (".implode($insert_cols, ",").") VALUES(".implode($insert_values, ",").")";
  // echo $sql_command.'<br><hr>';
  $stid = oci_parse($conn, $sql_command);
  oci_execute($stid);
}

// util functions
function blank_to_decimal($value) {
  return trim($value) == '' ? 0 : trim($value);
}
function format_date($date) {
  $datetime = explode(" ", $date);
  if(count($datetime) > 1) {
    $date = $datetime[0];
  }
  $date_arr = explode("/", $date);
  if(count($date_arr) > 1) {
    $day = $date_arr[0];
    $month = $date_arr[1];
    $year = ($date_arr[2] * 1) - 543;
    $date = $year.'-'.$month.'-'.$day;
  }
  return $date;
}
?>