function export_csv() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var model_version = $('#model_version').val();
    var sales_channel = $('#sales_channel').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var business_type = $('#business_type').val();
    $.ajax({
        type: "POST", 
        url: "/Report1/export/exportcsv.php",
        data:{
        'product_type':product_type,
        'model_type':model_type,
        'card_type':card_type,
        'region_name':region_name,
        'zone_name':zone_name,
        'branch_name':branch_name,
        'model_version':model_version,
        'sales_channel':sales_channel,
        'start_date':start_date,
        'end_date':end_date,
        'business_type':business_type
    },
        success: function(result){
            $('#export').html(result);
            window.open("/Report1/export/csv/Report1_CSV.csv");
            
        }
    });
    
}

function export_txt() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var model_version = $('#model_version').val();
    var sales_channel = $('#sales_channel').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var business_type = $('#business_type').val();
    window.open('/Report1/export/exporttxt.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&model_version='+model_version+
        '&sales_channel='+sales_channel+
        '&start_date='+start_date+
        '&end_date='+end_date+
        '&business_type='+business_type
        );
    
}

function export_xls() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var model_version = $('#model_version').val();
    var sales_channel = $('#sales_channel').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var business_type = $('#business_type').val();
    window.open('/Report1/export/exportxls.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&model_version='+model_version+
        '&sales_channel='+sales_channel+
        '&start_date='+start_date+
        '&end_date='+end_date+
        '&business_type='+business_type
        );
}

function export_pdf() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var model_version = $('#model_version').val();
    var sales_channel = $('#sales_channel').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var business_type = $('#business_type').val();
    window.open('/Report1/export/exportpdf.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&model_version='+model_version+
        '&sales_channel='+sales_channel+
        '&start_date='+start_date+
        '&end_date='+end_date+
        '&business_type='+business_type
        );
}