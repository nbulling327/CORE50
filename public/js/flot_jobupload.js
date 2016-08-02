function showTooltip(x,y,contents){
    $('<div id="tooltip">)' + contents + '</div>').css({
        position: 'absolute', display:'none',top: y+5,left:x+5,
        border: '1px solid #fdd',padding: '2px', 'background-color': '#fee', opacity:0.8
    }).appendTo("body").fadeIn(200);
}

$(document).ready(function () {
    var div = document.getElementById("dom-target");
    var myData = div.textContent;
    $.getJSON("single_job_data.php",{job: myData})
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