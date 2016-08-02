function showTooltip(x,y,contents){
    $('<div id="tooltip">)' + contents + '</div>').css({
        position: 'absolute', display:'none',top: y+5,left:x+5,
        border: '1px solid #fdd',padding: '2px', 'background-color': '#fee', opacity:0.8
    }).appendTo("body").fadeIn(200);
}

$(document).ready(function () {
    var div = document.getElementById("dom-target");
    var myData = div.textContent;
    $.getJSON("single_job_data_analysis.php",{job: myData})
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