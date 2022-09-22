function export_csv() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var model_version = $('#model_version').val();
    var sales_channel = $('#sales_channel').val();
    var business_type = $('#business_type').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    // var start_mm = $('#start_mm').val();
    // var START_YYYY = $('#START_YYYY').val();
    // var end_mm = $('#end_mm').val();
    // var end_yyyy = $('#end_yyyy').val();
    $.ajax({
        type: "POST", 
        url: "/Report10/export/exportcsv.php",
        data:{
        'product_type':product_type,
        'model_type':model_type,
        'card_type':card_type,
        'model_version':model_version,
        'sales_channel':sales_channel,
        'business_type':business_type,
        'region_name':region_name,
        'zone_name':zone_name,
        'branch_name':branch_name,
        'start_date':start_date,
        'end_date':end_date
        // 'start_mm':start_mm,
        // 'START_YYYY':START_YYYY,
        // 'end_mm':end_mm,
        // 'end_yyyy':end_yyyy
    },
        success: function(result){
            $('#export').html(result);
            window.open("/Report10/export/csv/Report10_CSV.csv");
            
        }
    });
    
}

function export_txt() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var model_version = $('#model_version').val();
    var sales_channel = $('#sales_channel').val();
    var business_type = $('#business_type').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    // var start_mm = $('#start_mm').val();
    // var START_YYYY = $('#START_YYYY').val();
    // var end_mm = $('#end_mm').val();
    // var end_yyyy = $('#end_yyyy').val();
    window.open('/Report10/export/exporttxt.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&model_version='+model_version+
        '&sales_channel='+sales_channel+
        '&business_type='+business_type+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&start_date='+start_date+
        '&end_date='+end_date
        // '&start_mm='+start_mm+
        // '&START_YYYY='+START_YYYY+
        // '&end_mm='+end_mm+
        // '&end_yyyy='+end_yyyy
        );
    
}

function export_xls() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var model_version = $('#model_version').val();
    var sales_channel = $('#sales_channel').val();
    var business_type = $('#business_type').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    // var start_mm = $('#start_mm').val();
    // var START_YYYY = $('#START_YYYY').val();
    // var end_mm = $('#end_mm').val();
    // var end_yyyy = $('#end_yyyy').val();
    window.open('/Report10/export/exportxls.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&model_version='+model_version+
        '&sales_channel='+sales_channel+
        '&business_type='+business_type+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&start_date='+start_date+
        '&end_date='+end_date
        // '&start_mm='+start_mm+
        // '&START_YYYY='+START_YYYY+
        // '&end_mm='+end_mm+
        // '&end_yyyy='+end_yyyy
        );
}

function export_pdf() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var model_version = $('#model_version').val();
    var sales_channel = $('#sales_channel').val();
    var business_type = $('#business_type').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    // var start_mm = $('#start_mm').val();
    // var START_YYYY = $('#START_YYYY').val();
    // var end_mm = $('#end_mm').val();
    // var end_yyyy = $('#end_yyyy').val();
    window.open('/Report10/export/exportpdf.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&model_version='+model_version+
        '&sales_channel='+sales_channel+
        '&business_type='+business_type+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&start_date='+start_date+
        '&end_date='+end_date
        // '&start_mm='+start_mm+
        // '&START_YYYY='+START_YYYY+
        // '&end_mm='+end_mm+
        // '&end_yyyy='+end_yyyy
        );
}