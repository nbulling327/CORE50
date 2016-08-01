
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
    $("#post_well_customer").change(function(event){
        $("#scrollable-dropdown-menu").removeAttr("hidden");
        $("#job_date").removeAttr("hidden");
        var custom = $("#comp_choice").val();
        var parameters ={customer: custom};
        $.getJSON("search.php", parameters)
        .success(function(data, textStatus, jqXHR)
        {
          document.getElementById("test").options.length = 0;
          var obj=document.getElementById("test"); 
          for (var i = 0; i < data.length; i++)     {                
                opt = document.createElement("option");
                opt.value = data[i].id;
                opt.text=data[i].combo;
                obj.appendChild(opt);
            }
        });
    });
});

function showTooltip(x,y,contents){
    $('<div id="tooltip">)' + contents + '</div>').css({
        position: 'absolute', display:'none',top: y+5,left:x+5,
        border: '1px solid #fdd',padding: '2px', 'background-color': '#fee', opacity:0.8
    }).appendTo("body").fadeIn(200);
}

 var parameter = "job="+"5s";
$(document).ready(function () {
    $.getJSON("single_job_data.php",{job: fives})
        .success(function(data, textStatus, jqXHR)
        {
            var pressure=[];
            var rate=[];
            var density=[];
            var optionsOverview;
            var overview;
            console.log(pressure);
            for (var i = 0; i<data.length-1; i++)
            {
                pressure.push([parseFloat(data[i]["time"]),parseFloat(data[i]["pressure"])]);
                rate.push([parseFloat(data[i]["time"]),parseFloat(data[i]["rate"])]);
                density.push([parseFloat(data[i]["time"]),parseFloat(data[i]["density"])]);
            }
            var plotdata = [{data: pressure, label:"Pressure", lines:{show:true}, yaxis: 2,color: '#CE0000'},
                        {data: rate, label:"Rate", lines:{show:true}, yaxis: 3, color: '#0005FF'},    
                        {data: density, label:"Density", lines:{show:true},color: '#2C9222'}];
            var options = {legend: {position:"ne"}, 
                        points: {show: false},
                        xaxis: {axisLabel: "Elapsed time (min)", 
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5},
                        yaxes: [
                        {
                            tickFormatter: function (val, axis) {
                                return val + " lb/gal";},
                            min: 8,
                            max: 20,
                            axisLabel: "Density",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5
                        },
                        {
                            position: 0,
                            tickFormatter: function (val, axis) {
                                return val + " psi";
                        },
                            min:0,
                            max: 5000,
                            axisLabel: "Pressure",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5
                        },{
                            tickFormatter: function (val, axis) {
                                return val + " bpm";},
                            min: 0,
                            max: 10,
                            axisLabel: "Rate",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5
                        },
                        ],
                        selection: {mode:"xy"},
                        grid:  {hoverable: true}};
            optionsOverview = {legend: {show:false}, selection:{mode:"xy"},yaxes: [{min: 8 ,max:20},{
                            position: 0,min: 0 },{min:0}]};
            
            
            chart1 = $.plot("#flot-placeholder",plotdata,options);
            overview = $.plot("#overview",plotdata,optionsOverview);
    
            $("#overview").bind("plotselected", function(event,ranges){
                chart1.setSelection(ranges);
            });
    
            $("#flot-placeholder").bind("plotselected",function(event,ranges){
                if(ranges.xaxis.to - ranges.xaxis.from < .1){ranges.xaxis.to=ranges.xaxis.from+.1;}
                plot=$.plot("#flot-placeholder",plotdata,
                    $.extend(true,{},options,{
                        xaxis:{min:ranges.xaxis.from, max: ranges.xaxis.to},
                        yaxis:{min:ranges.yaxis.from, max: ranges.yaxis.to}
                    })
                );
                overview.setSelection(ranges,true);
            });
            $("#flot-placeholder").bind("plotclick",function(event,pos,item){
                if(item){}
            });
        });


        $(document).ready(function () {
            $("#flot-placeholder").bind("plothover",function(event,pos,item){
                $("#tooltip").remove();
                if (item){
                    var x = item.datapoint[0].toFixed(2),y = item.datapoint[1].toFixed(2);
                    showTooltip(item.pageX, item.pageY, item.series.label + " at time " +x+ " is "+ y + ".");
                }
            });
        });
});

$(document).ready(function () {
    $.getJSON("single_job_data_analysis.php")
        .done(function(data, textStatus, jqXHR)
        {
            var pressure=[];
            var rate=[];
            var density=[];
            var stage_volume=[];
            var target_dens=[];
            var shutdowns=[];
            
            for (var i = 0; i<data.length-1; i++)
            {
                pressure.push([parseFloat(data[i]["time"]),parseFloat(data[i]["pressure"])]);
                rate.push([parseFloat(data[i]["time"]),parseFloat(data[i]["rate"])]);
                density.push([parseFloat(data[i]["time"]),parseFloat(data[i]["density"])]);
                stage_volume.push([parseFloat(data[i]["time"]),parseFloat(data[i]["stage_volume"])]);
                target_dens.push([parseFloat(data[i]["time"]),parseFloat(data[i]["target_dens"])]);
                shutdowns.push([parseFloat(data[i]["time"]),parseFloat(data[i]["shutdowns"])]);
            }
            
            var plotdata = [{data: pressure, label:"Pressure", lines:{show:true}, yaxis: 2,color: '#CE0000'},
                        {data: rate, label:"Rate", lines:{show:true}, yaxis: 3, color: '#0005FF'},    
                        {data: density, label:"Density", lines:{show:true},color: '#2C9222'},
                        {data: stage_volume, label:"Stage Volume", lines:{show:true}, yaxis: 4,color: '#4BCEFC'},
                        {data: target_dens, label:"Target Density", lines:{show:true}, color: '#27F513'},    
                        {data: shutdowns, label:"Shutdown", lines:{show:true},yaxis: 5,color: '#FE0000'}];
            var options = {legend: {position:"ne"}, 
                        points: {show: false},
                        xaxis: {axisLabel: "Elapsed time (min)", 
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5},
                        yaxes: [
                        {
                            tickFormatter: function (val, axis) {
                                return val + " lb/gal";},
                            min: 8,
                            axisLabel: "Density",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5
                        },
                        {
                            position: 0,
                            tickFormatter: function (val, axis) {
                                return val + " psi";
                        },
                            min:0,
                            axisLabel: "Pressure",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5
                        },
                        {
                            tickFormatter: function (val, axis) {
                                return val + " bpm";},
                            min: 0,
                            max: 10,
                            axisLabel: "Rate",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5
                        },
                        {
                            tickFormatter: function (val, axis) {
                                return val + " bbl";},
                            min: 0,
                            axisLabel: "Volume",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5
                        },
                        {
                            min: 0,
                            max: 3,
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5
                        },
                        ],
                        grid:  {hoverable: true}};
                        
            chart2 = $.plot("#flot-placeholder_analysis",plotdata,options);
    });    



    $(document).ready(function () {
        $("#flot-placeholder_analysis").bind("plothover",function(event,pos,item){
            $("#tooltip").remove();
            if (item){
                var x = item.datapoint[0].toFixed(2),y = item.datapoint[1].toFixed(2);
                showTooltip(item.pageX, item.pageY, item.series.label + " at time " +x+ " is "+ y + ".");
            }
        });
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
