function export_csv() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    
    $.ajax({
        type: "POST", 
        url: "/Report13/export/exportcsv.php",
        data:{
        'product_type':product_type,
        'model_type':model_type,
        'card_type':card_type,
        'start_date':start_date,
        'end_date':end_date
    },
        success: function(result){
            $('#export').html(result);
            window.open("/Report13/export/csv/Report13_CSV.csv");
            
        }
    });
    
}

function export_txt() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    window.open('/Report13/export/exporttxt.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&start_date='+start_date+
        '&end_date='+end_date
        );
    
}

function export_xls() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    window.open('/Report13/export/exportxls.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&start_date='+start_date+
        '&end_date='+end_date
        );
}

function export_pdf() {
    var product_type = $('#product_type').val();
    var model_type = $('#model_type').val();
    var card_type = $('#card_type').val();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    window.open('/Report13/export/exportpdf.php'+
        '?product_type='+product_type+
        '&model_type='+model_type+
        '&card_type='+card_type+
        '&start_date='+start_date+
        '&end_date='+end_date
        );
}