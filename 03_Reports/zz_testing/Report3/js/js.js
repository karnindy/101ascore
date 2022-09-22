function export_csv() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var business_type = $('#business_type').val();
    var sales_channel = $('#sales_channel').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var factors = $('#factors').val();
    $.ajax({
        type: "POST", 
        url: "/Report3/export/exportcsv.php",
        data:{
        'product_type':product_type,
        'model_type':model_type,
        'card_type':card_type,
        'business_type':business_type,
        'sales_channel':sales_channel,
        'region_name':region_name,
        'zone_name':zone_name,
        'branch_name':branch_name,
        'start_date':start_date,
        'end_date':end_date,
        'factors':factors
    },
        success: function(result){
            $('#export').html(result);
            window.open("/Report3/export/csv/Report3_CSV.csv");
            
        }
    });
    
}

function export_txt() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var business_type = $('#business_type').val();
    var sales_channel = $('#sales_channel').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var factors = $('#factors').val();
    window.open('/Report3/export/exporttxt.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&business_type='+business_type+
        '&sales_channel='+sales_channel+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&start_date='+start_date+
        '&end_date='+end_date+
        '&factors='+factors
        );
}

function export_xls() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var business_type = $('#business_type').val();
    var sales_channel = $('#sales_channel').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var factors = $('#factors').val();
    window.open('/Report3/export/exportxls.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&business_type='+business_type+
        '&sales_channel='+sales_channel+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&start_date='+start_date+
        '&end_date='+end_date+
        '&factors='+factors
        );
}

function export_pdf() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var business_type = $('#business_type').val();
    var sales_channel = $('#sales_channel').val();
    var region_name = $('#region_name').val();
    var zone_name = $('#zone_name').val();
    var branch_name = $('#branch_name').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var factors = $('#factors').val();
    window.open('/Report3/export/exportpdf.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&business_type='+business_type+
        '&sales_channel='+sales_channel+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&start_date='+start_date+
        '&end_date='+end_date+
        '&factors='+factors
        );
}