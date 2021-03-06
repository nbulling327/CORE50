//function to populate well register with past well names so that it can prefetch
$(document).ready(function () {
    var wellnames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function(obj) { return obj.name; },
        prefetch: {
            url: "job_register.php",
            cache:"false",
        }
    });
    // passing in `null` for the `options` arguments will result in the default
    // options being used
    $('#prefetch_name .typeahead').typeahead(null,{
        hint:true,
        minLength: 1,
        display:'name',
        source: wellnames
    });
});  

//function to populate well registers with past well numbers so that it can prefetch
$(document).ready(function () {
    var wellnumbers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('number'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function(obj) { return obj.number; },
        prefetch: {
            url: "job_registers.php",
            cache:"false",
        }
    });
    // passing in `null` for the `options` arguments will result in the default
    // options being used
    $('#prefetch_number .typeahead').typeahead(null,{
        hint:true,
        minLength: 1,
        display:'number',
        source: wellnumbers
    });
});

$(document).ready(function () {
                $('#datetimepicker1').datetimepicker({
                    format: 'MM/DD/YYYY'
                });
            });
    

//function to active select picker for Job District, etc.
$(document).ready(function() {
  $('.selectpicker').selectpicker({
    style: 'btn-default',
    dropupauto: 'false',
    size: 4
  });
});


$(document).ready(function() {
var div1 = document.getElementById("dom-target-begin_date");
var begin = div1.textContent.trim();

var div2 = document.getElementById("dom-target-end_date");
var end = div2.textContent.trim();

    $(function () {
        $('#datetimepicker6').datetimepicker({
            defaultDate: begin,
            format: 'MM/DD/YYYY'
        });
        $('#datetimepicker7').datetimepicker({
            defaultDate: end,
            useCurrent: false, //Important! See issue #1075
            format: 'MM/DD/YYYY'
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
});

$(document).ready(function () {
    var div3 = document.getElementById("dom-target-geo_filter");
    var geo_type = div3.textContent.trim();
    var div4 = document.getElementById("dom-target-filter1");
    var geo_picked = div4.textContent.trim();
    if (0==geo_type || 0== geo_type.length) {    
    $("#scrollable-dropdown-menu2").css("visibility", "hidden");
    }
    else {
        var filter1 = $("#geo_choice").val();
        var parameters ={geo: filter1};
        $.getJSON("geo_search.php", parameters)
        .success(function(data, textStatus, jqXHR)
        {
          document.getElementById("filter1").options.length = 0;
          var obj=document.getElementById("filter1"); 
          for (var i = 0; i < data.length; i++)     {                
                opt = document.createElement("option");
                opt.value = data[i].point;
                opt.text=data[i].point;
                if(opt.value==geo_picked) {
                    opt.setAttribute("selected", "selected");
                }
                obj.appendChild(opt);
            }
        });
    }
    $("#geography").change(function(event){
        $("#scrollable-dropdown-menu2").css("visibility", "visible");
        var filter1 = $("#geo_choice").val();
        if ('0'==filter1)
        {
            $("#scrollable-dropdown-menu2").css("visibility", "hidden");
        }
        
        var parameters ={geo: filter1};
        $.getJSON("geo_search.php", parameters)
        .success(function(data, textStatus, jqXHR)
        {
          document.getElementById("filter1").options.length = 0;
          var obj=document.getElementById("filter1"); 
          for (var i = 0; i < data.length; i++)     {                
                opt = document.createElement("option");
                opt.value = data[i].point;
                opt.text=data[i].point;
                obj.appendChild(opt);
            }
        });
    });
});