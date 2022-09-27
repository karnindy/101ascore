$(document).ready(function() {
    // $('#region_name').multiselect({
    //     enableFiltering: true,
    //     includeSelectAllOption:true,
    //     selectAllText:'All',
    //     selectAllValue:'ALL',
    // });
    // $('#zone_name').multiselect({
    //     enableFiltering: true,
    //     includeSelectAllOption:true,
    //     selectAllText:'All',
    //     selectAllValue:'ALL',
    // });
    // $('#branch_name').multiselect({
    //     enableFiltering: true,
    //     includeSelectAllOption:true,
    //     selectAllText:'All',
    //     selectAllValue:'ALL',
    // });
    // $('#sales_channel').multiselect({
    //     enableFiltering: true,
    //     includeSelectAllOption:true,
    //     selectAllText:'All',
    //     selectAllValue:'ALL',
    // });
    // $('#model_version').multiselect({
    //     enableFiltering: true,
    //     includeSelectAllOption:true,
    //     selectAllText:'All',
    //     selectAllValue:'ALL',
    // });
});

function getValueDropdown(element) {
    const value = element.value;
    const id = element.id;
    const target = element.getAttribute("target")
    const region = document.getElementById("region_name").value
    if(id === 'region_name'){
        document.getElementById("branch_name").innerHTML = "<option value='รวมทุกสาขา' selected>รวมทุกสาขา</option>";
    } else if(id === 'product_type') {
        document.getElementById("card_type").innerHTML = "<option disabled selected>--โปรดเลือก--</option>";
    } else if(id === 'business_type'){
        document.getElementById("zone_name").innerHTML = "<option value='รวมทุกเขต' selected>รวมทุกเขต</option>";
        document.getElementById("branch_name").innerHTML = "<option value='รวมทุกสาขา' selected>รวมทุกสาขา</option>";
    }

    $.ajax({
        type: "POST", 
        url: `functions/dropdownsExtend.php?region=${region}`,
        data: {
            value: value,
            id: id
        },
        success: function(result){
            if(target){
                document.getElementById(target).innerHTML = result;
            }
        }
    });
}

function onSubmit() {
    const product_type = document.getElementById('product_type').value; 
    const model_type = document.getElementById('model_type').value; 
    const card_type = document.getElementById('card_type').value; 
    const model_version = document.getElementById('model_version').value;
    const month = document.getElementById('month').value
    const year = document.getElementById('year').value
    if(product_type === '--โปรดเลือก--' || model_type === '--โปรดเลือก--' || card_type === '--โปรดเลือก--' || model_version === '--โปรดเลือก--' || !month || !year) { 
        alert("กรุณากรอกข้อมูลให้ครบถ้วน");
        return;
    }
    const region_name = document.getElementById('region_name').value;
    const zone_name = document.getElementById('zone_name').value;
    const branch_name = document.getElementById('branch_name').value;
    const sales_channel = document.getElementById('sales_channel').value;
    const business_type = document.getElementById('business_type').value;

    // const start_date_format = new Date(start_date_temp);
    // const start_date = ("0" + start_date_format.getDate()).slice(-2) + '/' + ("0"+(start_date_format.getMonth()+1)).slice(-2) + '/' +start_date_format.getFullYear()
    // const end_date_format = new Date(end_date_temp);
    // const end_date = ("0" + end_date_format.getDate()).slice(-2) + '/' + ("0"+(end_date_format.getMonth()+1)).slice(-2) + '/' +end_date_format.getFullYear()
    // const month = document.getElementById('month').value
    // const year = document.getElementById('year').value
    const date_report = `${month}/${year}`

    const date = new Date();
    const date_now = ("0" + date.getDate()).slice(-2) + '/' + ("0"+(date.getMonth()+1)).slice(-2) + '/' + date.getFullYear()+ "  " + ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2) + ":" + ("0" + date.getSeconds()).slice(-2)

    
    document.getElementById("product_type_show").innerHTML = product_type;
    document.getElementById("model_version_show").innerHTML = model_version;
    document.getElementById("model_type_show").innerHTML = model_type;
    document.getElementById("card_type_show").innerHTML = card_type;
    document.getElementById("region_show").innerHTML = region_name;
    document.getElementById("zone_show").innerHTML = zone_name;
    document.getElementById("branch_show").innerHTML = branch_name;
    document.getElementById("sales_channels_show").innerHTML = sales_channel;
    document.getElementById('business_type_show').innerHTML = business_type
    // document.getElementById("start_date_show").innerHTML = start_date;
    // document.getElementById("end_date_type_show").innerHTML = end_date;
    document.getElementById("current_date").innerHTML = date_now;
    document.getElementById("date_report").innerHTML = date_report;

    $.ajax({
        type: "POST", 
        url: "functions/showReport.php",
        data: {
            product_type: product_type,
            model_type: model_type,
            card_type: card_type,
            region_name: region_name,
            zone_name: zone_name,
            branch_name: branch_name,
            model_version: model_version,
            sales_channel: sales_channel,
            month: month,
            year: year,
            business_type: business_type
        },
        success: function(result){
            document.getElementById("report").innerHTML = result;
            document.getElementById("report_area").style.display = "block";
        }
    });
}

function refreshPage() {
    window.location.reload()
}