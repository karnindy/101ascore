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
    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({
        type: "POST", 
        url: "/Report8/export/exportcsv.php",
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
        'month':month,
        'year':year
    },
        success: function(result){
            $('#export').html(result);
            window.open("/Report8/export/csv/Report8_CSV.csv");
            
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
    var month = $('#month').val();
    var year = $('#year').val();
    window.open('/Report8/export/exporttxt.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&model_version='+model_version+
        '&sales_channel='+sales_channel+
        '&business_type='+business_type+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&month='+month+
        '&year='+year
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
    var month = $('#month').val();
    var year = $('#year').val();
    window.open('/Report8/export/exportxls.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&model_version='+model_version+
        '&sales_channel='+sales_channel+
        '&business_type='+business_type+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&month='+month+
        '&year='+year
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
    var month = $('#month').val();
    var year = $('#year').val();
    window.open('/Report8/export/exportpdf.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&model_version='+model_version+
        '&sales_channel='+sales_channel+
        '&business_type='+business_type+
        '&region_name='+region_name+
        '&zone_name='+zone_name+
        '&branch_name='+branch_name+
        '&month='+month+
        '&year='+year
        );
}