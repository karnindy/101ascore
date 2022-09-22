function set() {
    se_tab(1);
}

function se_tab(tab) {
        var ref_id = $('#ref_id').val();
        var ref_card = $('#ref_card').val();
        var ref_sequence = $('#ref_sequence').val();
        var appl_id_aam = $('#appl_id_aam').val();
        var product_type = $('#product_type').val();
        var card_type = $('#card_type').val();
        var cid = $('#cid').val();
        var region_name = $('#region_name').val();
        var zone_name = $('#zone_name').val();
        var branch_name = $('#branch_name').val();
        var create_start_date = $('#create_start_date').val();
        var create_end_date = $('#create_end_date').val();
        var update_start_date = $('#update_start_date').val();
        var update_end_date = $('#update_end_date').val();
        var ca2_appl_result_code = $('#ca2_appl_result_code').val();
    $('#loading').show();
    $('#page').hide();
    $.ajax({
        type: "POST", 
        url: "layout/head_tab.php",
        data:{'tab':tab,'ref_id':ref_id,'ref_card':ref_card,'ref_sequence':ref_sequence,
                'appl_id_aam':appl_id_aam,
                'product_type':product_type,
                'card_type':card_type,
                'cid':cid,
                'region_name':region_name,
                'zone_name':zone_name,
                'branch_name':branch_name,
                'create_start_date':create_start_date,
                'create_end_date':create_end_date,
                'update_start_date':update_start_date,
                'update_end_date':update_end_date,
                'ca2_appl_result_code':ca2_appl_result_code},
        success: function(result){
            $('#head_tab').html(result);
            se_filter_tab(tab,ref_id,ref_card,ref_sequence);
        }
    });
}

function re_ref() {
    $('#ref_id').remove();
    $('#ref_card').remove();
    $('#ref_sequence').remove();
}

function se_ref(ref_id,ref_card,ref_sequence) {
    $('#loading').show();
    $.ajax({
        type: "POST", 
        url: "layout/se_ref.php",
        data:{'ref_id':ref_id,'ref_card':ref_card,'ref_sequence':ref_sequence},
        success: function(result){
            $('#se_ref').html(result);
        }
    });
}

function check_13(tab,ref_id,ref_card,ref_sequence) {
    var cid = $('#cid').val();
    if(cid.length==13 || cid.length==0){se_filter_tab(tab,ref_id,ref_card,ref_sequence);}
}

function se_filter_tab(tab,ref_id,ref_card,ref_sequence) {
    $('#loading').show();
        var ref_id = $('#ref_id').val();
        var ref_card = $('#ref_card').val();
        var ref_sequence = $('#ref_sequence').val();
        var appl_id_aam = $('#appl_id_aam').val();
        var product_type = $('#product_type').val();
        var card_type = $('#card_type').val();
        var cid = $('#cid').val();
        var region_name = $('#region_name').val();
        var zone_name = $('#zone_name').val();
        var branch_name = $('#branch_name').val();
        var create_start_date = $('#create_start_date').val();
        var create_end_date = $('#create_end_date').val();
        var update_start_date = $('#update_start_date').val();
        var update_end_date = $('#update_end_date').val();
        var ca2_appl_result_code = $('#ca2_appl_result_code').val();
        // if(cid.length!=13){cid='';}
    $.ajax({
        type: "POST", 
        url: "layout/filter_tab.php",
                data:{'tab':tab,'ref_id':ref_id,'ref_card':ref_card,'ref_sequence':ref_sequence,
                'appl_id_aam':appl_id_aam,
                'product_type':product_type,
                'card_type':card_type,
                'cid':cid,
                'region_name':region_name,
                'zone_name':zone_name,
                'branch_name':branch_name,
                'create_start_date':create_start_date,
                'create_end_date':create_end_date,
                'update_start_date':update_start_date,
                'update_end_date':update_end_date,
                'ca2_appl_result_code':ca2_appl_result_code},
        success: function(result){
            $('#se_filter_tab').html(result);
            main_data(tab,1,ref_id,ref_card,ref_sequence);
        }
    });
}

function se_data(tab,page){
    $('#loading').show();
    $.ajax({
        type: "POST", 
        url: "layout/se_data.php",
        data:{'tab':tab,'page':page},
        success: function(result){
            $('#se_data').html(result);
            $('#loading').hide();
        }
    });
}

function changepage(tab,page){
    $('#se_data').hide();
    $('#loading').show();
        var appl_id_aam = $('#appl_id_aam').val();
        var product_type = $('#product_type').val();
        var card_type = $('#card_type').val();
        var cid = $('#cid').val();
        var region_name = $('#region_name').val();
        var zone_name = $('#zone_name').val();
        var branch_name = $('#branch_name').val();
        var result_code = $('#result_code').val();
        var create_start_date = $('#create_start_date').val();
        var create_end_date = $('#create_end_date').val();
        var update_start_date = $('#update_start_date').val();
        var update_end_date = $('#update_end_date').val();
        var ca2_appl_result_code = $('#ca2_appl_result_code').val();
        $.ajax({
        type: "POST", 
        url: "layout/se_data.php",
        data:{
            'appl_id_aam':appl_id_aam,
            'product_type':product_type,
            'card_type':card_type,
            'cid':cid,
            'region_name':region_name,
            'zone_name':zone_name,
            'branch_name':branch_name,
            'result_code':result_code,
            'create_start_date':create_start_date,
            'create_end_date':create_end_date,
            'update_start_date':update_start_date,
            'update_end_date':update_end_date,
            'ca2_appl_result_code':ca2_appl_result_code,
            'tab':tab,
            'page':page},
        success: function(result){
            $('#se_data').html(result);
            $('#loading').hide();
            $('#se_data').show();
        }
    });
}

function se_more(ref_id,ref_card,ref_sequence) {
    $('#loading').show();
    $.ajax({
        type: "POST", 
        url: "layout/se_more.php",
        data:{'ref_id':ref_id,'ref_card':ref_card,'ref_sequence':ref_sequence,},
        success: function(result){
            $('#se_more').html(result);
            $('#loading').hide();
        }
    });
}

function main_data(tab,page,ref_id,ref_card,ref_sequence) {
        var appl_id_aam = $('#appl_id_aam').val();
        var product_type = $('#product_type').val();
        var card_type = $('#card_type').val();
        var cid = $('#cid').val();
        var region_name = $('#region_name').val();
        var zone_name = $('#zone_name').val();
        var branch_name = $('#branch_name').val();
        var create_start_date = $('#create_start_date').val();
        var create_end_date = $('#create_end_date').val();
        var update_start_date = $('#update_start_date').val();
        var update_end_date = $('#update_end_date').val();
        var ca2_appl_result_code = $('#ca2_appl_result_code').val();
        $.ajax({
        type: "POST", 
        url: "layout/se_data.php",
        data:{
            'appl_id_aam':appl_id_aam,
            'product_type':product_type,
            'card_type':card_type,
            'cid':cid,
            'region_name':region_name,
            'zone_name':zone_name,
            'branch_name':branch_name,
            'create_start_date':create_start_date,
            'create_end_date':create_end_date,
            'update_start_date':update_start_date,
            'update_end_date':update_end_date,
            'ca2_appl_result_code':ca2_appl_result_code,
            'tab':tab,
            'page':page,
            'ref_id':ref_id,'ref_card':ref_card,'ref_sequence':ref_sequence,},
        success: function(result){
            $('#se_data').html(result);
            $('#page').show();
            $('#loading').hide();
        }
    });
    }

function re(tab,page) {
    $('#loading').show();
        var ref_id = null;
        var ref_card = null;
        var ref_sequence = null;
        var appl_id_aam = null;
        var product_type = null;
        var card_type = null;
        var cid = null;
        var region_name = null;
        var zone_name = null;
        var branch_name = null;
        var create_start_date = null;
        var create_end_date = null;
        var update_start_date = null;
        var update_end_date = null;
        var ca2_appl_result_code = null;
    // $('#loading').show();
    $.ajax({
        type: "POST", 
        url: "layout/filter_tab.php",
                data:{'tab':tab,'ref_id':ref_id,'ref_card':ref_card,'ref_sequence':ref_sequence,
                'appl_id_aam':appl_id_aam,
                'product_type':product_type,
                'card_type':card_type,
                'cid':cid,
                'region_name':region_name,
                'zone_name':zone_name,
                'branch_name':branch_name,
                'create_start_date':create_start_date,
                'create_end_date':create_end_date,
                'update_start_date':update_start_date,
                'update_end_date':update_end_date,
                'ca2_appl_result_code':ca2_appl_result_code},
        success: function(result){
            $('#se_filter_tab').html(result);
            main_data(tab,1,ref_id,ref_card,ref_sequence);
        }
    });
}

function export_xls() {
        var appl_id_aam = $('#appl_id_aam').val();
        var product_type = $('#product_type').val();
        var card_type = $('#card_type').val();
        var cid = $('#cid').val();
        var region_name = $('#region_name').val();
        var zone_name = $('#zone_name').val();
        var branch_name = $('#branch_name').val();
        var create_start_date = $('#create_start_date').val();
        var create_end_date = $('#create_end_date').val();
        var update_start_date = $('#update_start_date').val();
        var update_end_date = $('#update_end_date').val();
        var ca2_appl_result_code = $('#ca2_appl_result_code').val();
    window.open('export/export_xls.php?'
        +'appl_id_aam='+appl_id_aam
        +'&product_type='+product_type
        +'&card_type='+card_type
        +'&cid='+cid
        +'&region_name='+region_name
        +'&zone_name='+zone_name
        +'&branch_name='+branch_name
        +'&ca2_appl_result_code='+ca2_appl_result_code
        +'&create_start_date='+create_start_date
        +'&create_end_date='+create_end_date
        +'&update_start_date='+update_start_date
        +'&update_end_date='+update_end_date
        );
}

function export_txt() {
        var appl_id_aam = $('#appl_id_aam').val();
        var product_type = $('#product_type').val();
        var card_type = $('#card_type').val();
        var cid = $('#cid').val();
        var region_name = $('#region_name').val();
        var zone_name = $('#zone_name').val();
        var branch_name = $('#branch_name').val();
        var create_start_date = $('#create_start_date').val();
        var create_end_date = $('#create_end_date').val();
        var update_start_date = $('#update_start_date').val();
        var update_end_date = $('#update_end_date').val();
        var ca2_appl_result_code = $('#ca2_appl_result_code').val();
    window.open('export/export_txt.php?'
        +'appl_id_aam='+appl_id_aam
        +'&product_type='+product_type
        +'&card_type='+card_type
        +'&cid='+cid
        +'&region_name='+region_name
        +'&zone_name='+zone_name
        +'&branch_name='+branch_name
        +'&ca2_appl_result_code='+ca2_appl_result_code
        +'&create_start_date='+create_start_date
        +'&create_end_date='+create_end_date
        +'&update_start_date='+update_start_date
        +'&update_end_date='+update_end_date
        );
}

function export_csv() {
        var appl_id_aam = $('#appl_id_aam').val();
        var product_type = $('#product_type').val();
        var card_type = $('#card_type').val();
        var cid = $('#cid').val();
        var region_name = $('#region_name').val();
        var zone_name = $('#zone_name').val();
        var branch_name = $('#branch_name').val();
        var create_start_date = $('#create_start_date').val();
        var create_end_date = $('#create_end_date').val();
        var update_start_date = $('#update_start_date').val();
        var update_end_date = $('#update_end_date').val();
        var ca2_appl_result_code = $('#ca2_appl_result_code').val();
    $.ajax({
        type: "POST", 
        url: "export/export_csv.php",
        data:{
            'appl_id_aam':appl_id_aam,
            'product_type':product_type,
            'card_type':card_type,
            'cid':cid,
            'region_name':region_name,
            'zone_name':zone_name,
            'branch_name':branch_name,
            'create_start_date':create_start_date,
            'create_end_date':create_end_date,
            'update_start_date':update_start_date,
            'update_end_date':update_end_date,
            'ca2_appl_result_code':ca2_appl_result_code},
        success: function(result){
            $('#export').html(result);
            window.open("export/file/export_csv.csv");
        }
    });
    
}

function export_pdf() {
        var appl_id_aam = $('#appl_id_aam').val();
        var product_type = $('#product_type').val();
        var card_type = $('#card_type').val();
        var cid = $('#cid').val();
        var region_name = $('#region_name').val();
        var zone_name = $('#zone_name').val();
        var branch_name = $('#branch_name').val();
        var create_start_date = $('#create_start_date').val();
        var create_end_date = $('#create_end_date').val();
        var update_start_date = $('#update_start_date').val();
        var update_end_date = $('#update_end_date').val();
        var ca2_appl_result_code = $('#ca2_appl_result_code').val();
    window.open('export/export_pdf.php?'
        +'&appl_id_aam='+appl_id_aam
        +'&product_type='+product_type
        +'&card_type='+card_type
        +'&cid='+cid
        +'&region_name='+region_name
        +'&zone_name='+zone_name
        +'&branch_name='+branch_name
        +'&ca2_appl_result_code='+ca2_appl_result_code
        +'&create_start_date='+create_start_date
        +'&create_end_date='+create_end_date
        +'&update_start_date='+update_start_date
        +'&update_end_date='+update_end_date
        );
}
