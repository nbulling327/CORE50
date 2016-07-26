//function to active select picker for Job District, etc.
$(document).ready(function() {
  $('.selectpicker').selectpicker({
    style: 'btn-default',
    dropupauto: 'false',
    size: 4
  });
});

//function to populate well register with past well names so that it can prefetch
$(document).ready(function () {
    var wellnames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function(obj) { return obj.name; },
        prefetch: {
            url: "well_register.php",
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
            url: "well_registers.php",
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
    $("#post_well_customer").change(function(event){
        $("#scrollable-dropdown-menu").removeAttr("hidden");
        var custom = $("#comp_choice").val();
        var parameters ={customer: custom};
        $.getJSON("search.php", parameters)
        .done(function(data, textStatus, jqXHR)
        {
          var obj=document.getElementById("test"); 
          for (var i = 0; i < data.length; i++)     {                
                opt = document.createElement("option");
                opt.value = data[i].combo;
                opt.text=data[i].combo;
                obj.appendChild(opt);
            }
        });
    });
});

$(document).ready(function () {
    var jsonData = $.ajax({
        url: "single_job_data.php",
        dataType: "json",
        async: false
    }).responseText;
    
    var chartDiv = document.getElementById('chart_div');
    var data = new google.visualization.DataTable(jsonData);
    var materialOptions = {
        chart: {
            title: "Job Data"
        },
        width: 900,
        height: 500,
        series: {
            0: {axis: 'Pressure'},
            1: {axis: 'Rate'},
            2: {axis: 'Density'}
        },
        axes:{
            y: {
                Pressure: {label: 'Pressure (psi)'},
                Rate: {label: 'Rate (bpm)'},
                Density: {label: 'Density (lb/gal)'}
            }
        }
    };
    var classicOptions = {
        title: 'Job Data',
        width: 900,
        height:500,
        series:{
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1},
            2: {targetAxisIndex: 2}
        },
        vAxes:
        {
            0: {title: 'Pressure'},
            1: {title: 'Rate'},
            2: {title: 'Density'}
        },
        vAxis: {
            viewWindow: {
                max: 30
        }
    }
    };
    
    function drawMaterialChart() {
        var materialChart = new google.charts.Line(chartDiv);
        materialChart.draw(data, materialOptions);
    }
    
     
    drawMaterialChart();
});


