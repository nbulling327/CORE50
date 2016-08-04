function showTooltip(x,y,contents){
    $('<div id="tooltip">)' + contents + '</div>').css({
        position: 'absolute', display:'none',top: y+5,left:x+5,
        border: '1px solid #fdd',padding: '2px', 'background-color': '#fee', opacity:0.8
    }).appendTo("body").fadeIn(200);
}

$(document).ready(function () {
    var div0 = document.getElementById("dom-target-chart_type");
    var chart_type = div0.textContent;
    var div1 = document.getElementById("dom-target-begin_date");
    var begin = div1.textContent;
    var div2 = document.getElementById("dom-target-end_date");
    var end = div2.textContent;
    var div3 = document.getElementById("dom-target-geo_filter");
    var geo_type = div3.textContent;
    var div4 = document.getElementById("dom-target-filter1");
    var geo_picked = div4.textContent;
    var div5 = document.getElementById("dom-target-chosen_company");
    var company_name = div5.textContent;
    var div6 = document.getElementById("dom-target-xaxis");
    var x_name = div6.textContent;
    var div7 = document.getElementById("dom-target-yaxis");
    var y_name = div7.textContent;
    var div8 = document.getElementById("dom-target-series");
    var series_data = div8.textContent;
    
    var paramters = {start: begin, finish: end, geo_cat: geo_type,
                    geo: geo_picked, customer: company_name,
                    xaxis: x_name, yaxis: y_name, series: series_data};
    
    $.getJSON("overall_job_data_analysis.php",parameters)
        .done(function(data, textStatus, jqXHR)
        {
            
            var y1=[];
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
                stage_volume.push([parseFloat(data[i]["time"]),parseFloat(data[i]["tot_vol"])]);
                target_dens.push([parseFloat(data[i]["time"]),parseFloat(data[i]["target_dens"])]);
                shutdowns.push([parseFloat(data[i]["time"]),parseFloat(data[i]["shutdowns"])]);
            }
            
            var plotdata = [{data: pressure, label:"Pressure", lines:{show:true}, yaxis: 2,color: '#CE0000'},
                        {data: rate, label:"Rate", lines:{show:true}, yaxis: 3, color: '#0005FF'},    
                        {data: density, label:"Density", lines:{show:true},color: '#2C9222'},
                        {data: stage_volume, label:"Stage Volume", lines:{show:true}, yaxis: 4,color: '#4BCEFC'},
                        {data: target_dens, label:"Target Density", lines:{show:true}, color: '#27F513'},    
                        {data: shutdowns, label:"Shutdown", lines:{show:true},yaxis: 5,color: '#FFC220'}];
            var options = {legend: {position:"ne"}, 
                        points: {show: false},
                        xaxis: {axisLabel: "Elapsed time (min)", 
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5},
                        yaxes: [
                        {
                            position: 0,
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
                            position: 0,
                            min: 0,
                            max: 5,
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5
                        },
                        ],
                        grid:  {hoverable: true}};
                        
                        
                        chart2 = $.plot("#flot-placeholder_analysis",plotdata,options);
    
});});


$(document).ready(function () {
    $("#flot-placeholder_analysis").bind("plothover",function(event,pos,item){
        $("#tooltip").remove();
        if (item){
            var x = item.datapoint[0].toFixed(2),y = item.datapoint[1].toFixed(2);
            showTooltip(item.pageX, item.pageY, item.series.label + " at time " +x+ " is "+ y + ".");
        }
});});

$(document).ready(function () {
    $("#flot-placeholder").bind("plothover",function(event,pos,item){
        $("#tooltip").remove();
        if (item){
            var x = item.datapoint[0].toFixed(2),y = item.datapoint[1].toFixed(2);
            showTooltip(item.pageX, item.pageY, item.series.label + " at time " +x+ " is "+ y + ".");
        }
});});