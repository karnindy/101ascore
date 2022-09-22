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
    var report_id = $('#report_id').val();
    $.ajax({
        type: "POST", 
        url: "/Report14/export/exportcsv.php",
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
        'end_date':end_date,
        'report_id':report_id
    },
        success: function(result){
            $('#export').html(result);
            window.open("/Report14/export/csv/Report14_CSV.csv");
            
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
    var report_id = $('#report_id').val();
    window.open('/Report14/export/exporttxt.php'+
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
        '&end_date='+end_date+
        '&report_id='+report_id
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
    var report_id = $('#report_id').val();
    window.open('/Report14/export/exportxls.php'+
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
        '&end_date='+end_date+
        '&report_id='+report_id
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
    var report_id = $('#report_id').val();
    window.open('/Report14/export/exportpdf.php'+
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
        '&end_date='+end_date+
        '&report_id='+report_id
        );
}