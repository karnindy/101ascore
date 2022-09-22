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
    $('.datepicker-month').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'mm-yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
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

function getLastDateOnMonth(month, year) {
    let date = "";
    switch(month){
        case 0 :  date = "31"
          break;
        case 1 :  date = (year%4)? "29" : "28"
          break;
        case 2 :  date = "31"
          break;
        case 3 :  date = "30"
          break;
        case 4 :  date = "31"
          break;
        case 5 :  date = "30"
          break;
        case 6 :  date = "31"
          break;
        case 7 :  date = "31"
          break;
        case 8 :  date = "30"
          break;
        case 9 :  date = "31"
          break;
        case 10 :  date = "30"
          break;
        case 11 :  date = "31"
          break;
        default: date = "31"
            break;
    }

    return date
}

function check_date_between () {
    const start_date = document.getElementById("start_date").value;
    const end_date = document.getElementById("end_date").value;
    if(start_date && end_date){
        const check = compareDate(start_date, end_date);
        
        const check_date = document.getElementById("check_date");
        if(check){
            check_date.classList.remove("d-block");
            check_date.classList.add("d-none");
        } else {
            check_date.classList.remove("d-none");
            check_date.classList.add("d-block");
        }
    }
}

function compareDate(start, end){
  const start_date_array = start.split("-").reverse()
  const end_date_array = end.split("-").reverse()
  if(start_date_array[0] < end_date_array[0]){
    return true;
  } else if(start_date_array[0] === end_date_array[0]) {
    if(start_date_array[1] < end_date_array[1]){
      return true;
    } else if(start_date_array[1] === end_date_array[1]) {
      if(start_date_array[2] < end_date_array[2]){
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  } else {
    return false;
  }
};

function onSubmit() {
    const product_type = document.getElementById('product_type').value; 
    const model_type = document.getElementById('model_type').value; 
    const card_type = document.getElementById('card_type').value; 
    const model_version = document.getElementById('model_version').value;
    const start_date_temp = document.getElementById('start_date').value;
    const end_date_temp = document.getElementById('end_date').value;
    if(product_type === '--โปรดเลือก--' || model_type === '--โปรดเลือก--' || card_type === '--โปรดเลือก--' || model_version === '--โปรดเลือก--' || !start_date_temp || !end_date_temp || !compareDate(start_date_temp,end_date_temp)) {
        alert("กรุณากรอกข้อมูลให้ครบถ้วน");
        return;
    }
    const region_name = document.getElementById('region_name').value;
    const zone_name = document.getElementById('zone_name').value;
    const branch_name = document.getElementById('branch_name').value;
    const sales_channel = document.getElementById('sales_channel').value;
    const business_type = document.getElementById('business_type').value;
    
    const start_date_format = new Date(start_date_temp.split("-").reverse().join("-"));
    const start_date = ("0" + start_date_format.getDate()).slice(-2) + '/' + ("0"+(start_date_format.getMonth()+1)).slice(-2) + '/' +start_date_format.getFullYear()
    const end_date_format = new Date(end_date_temp.split("-").reverse().join("-"));
    const end_date = getLastDateOnMonth(end_date_format.getMonth(), end_date_format.getFullYear()) + '/' + ("0"+(end_date_format.getMonth()+1)).slice(-2) + '/' +end_date_format.getFullYear()

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
    document.getElementById("start_date_show").innerHTML = start_date;
    document.getElementById("end_date_type_show").innerHTML = end_date;
    document.getElementById("current_date").innerHTML = date_now;
    document.getElementById('business_type_show').innerHTML = business_type;
    document.getElementById("start_date_show").classList.remove("pl-5") 
    document.getElementById("start_date_show").classList.remove("pr-4") 

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
            start_date: start_date,
            end_date: end_date,
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