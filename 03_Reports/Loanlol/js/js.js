function set() {
    se_nav_bar(1,'home');
}

function se_nav_bar(tab,from_page) {
    $.ajax({
        type: "POST", 
        url: "layout/nav_bar.php",
        data:{'tab':tab,'from_page':from_page},
        success: function(result){
            $('#nav_bar').html(result);
            select_from_page(tab,from_page);
        }
    });
}

function select_from_page(tab,from_page) {
        if(from_page=="house"||from_page=="person"){var url_file="from_reg.php";}
        if(from_page=="home"){var url_file="home.php";}
    $.ajax({
        type: "POST", 
        url: "layout/"+url_file,
        data:{'tab':tab,'from_page':from_page},
        success: function(result){
            $('#se_data').html(result);
        }
    });
}

function view_data(tab,from_page) {
        $('#loading').show();
    if (from_page=='house') {
        var total_loan = $('#total_loan').val();
        var total_salary = $('#total_salary').val();
        var total_payout = $('#total_payout').val();
        var total_asset = $('#total_asset').val();
        var total_worktime = $('#total_worktime').val();
        var total_addresstime = $('#total_addresstime').val();
        var age = $('#age').val();
        var education = $('#education').val();
        var type_job = $('#type_job').val();
        var region = $('#region').val();

    $.ajax({
        type: "POST", 
        url: "script/insert.php",
        data:{'tab':tab,
            'from_page':from_page,
            'total_loan':total_loan,
            'total_salary':total_salary,
            'total_payout':total_payout,
            'total_asset':total_asset,
            'total_worktime':total_worktime,
            'total_addresstime':total_addresstime,
            'age':age,
            'education':education,
            'type_job':type_job,
            'region':region
            },
        success: function(result){
            $('#process').html(result);
            $('#loading').hide();
        }
    });

    }

    if (from_page=='person') {
        var time_loan = $('#time_loan').val();
        var type_loan = $('#type_loan').val();
        var total_payout = $('#total_payout').val();
        var worktime = $('#worktime').val();
        var age = $('#age').val();
        var type_job = $('#type_job').val();
    $.ajax({
        type: "POST", 
        url: "script/insert.php",
        data:{'tab':tab,
            'from_page':from_page,
            'time_loan':time_loan,
            'type_loan':type_loan,
            'total_payout':total_payout,
            'worktime':worktime,
            'age':age,
            'type_job':type_job
            },
        success: function(result){
            $('#process').html(result);
            $('#loading').hide();
        }
    });

    }
}

function test(tab,from_page,id) {
    
    $('#loading').show();
    $.ajax({
        type: "POST", 
        url: "script/z_a.php",
        data:{'tab':tab,
            'from_page':from_page,
            'id':id
            },
        success: function(result){
            $('#export').html(result);
            window.open('layout/report.php?id='+id+'&from_page='+from_page),
            select_from_page(tab,from_page),
            $('#loading').hide();
        }
    });
}