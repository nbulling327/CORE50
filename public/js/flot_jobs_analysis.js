function showTooltip(x,y,contents){
    $('<div id="tooltip">)' + contents + '</div>').css({
        position: 'absolute', display:'none',top: y+5,left:x+5,
        border: '1px solid #fdd',padding: '2px', 'background-color': '#fee', opacity:0.8
    }).appendTo("body").fadeIn(200);
}

$(document).ready(function () {
    var empty="";
    
    var div0 = document.getElementById("dom-target-chart_type");
    var chart_type = div0.textContent.trim();
    
    var div1 = document.getElementById("dom-target-begin_date");
    var begin = div1.textContent.trim();
    
    var div2 = document.getElementById("dom-target-end_date");
    var end = div2.textContent.trim();
    
    var div3 = document.getElementById("dom-target-geo_filter");
    var geo_type = div3.textContent.trim();
    if (empty.length==geo_type.length)
    {
        geo_type="blank";
    }
    
    var div4 = document.getElementById("dom-target-filter1");
    var geo_picked = div4.textContent.trim();
    if (empty.length==geo_picked.length)
    {
        geo_picked="blank";
    }
    
    
    var div5 = document.getElementById("dom-target-chosen_company");
    var company_name = div5.textContent.trim();
    console.log(company_name);
    console.log("Name is "+company_name.length+"chars!");
    console.log("Name is "+empty.length+"chars!");
    if (empty.length==company_name.length)
    {
        company_name="blank";
    }
    
    var div6 = document.getElementById("dom-target-xaxis");
    var x_name = div6.textContent.trim();
    
    var div7 = document.getElementById("dom-target-yaxis");
    var y_name = div7.textContent.trim();
    
    var div8 = document.getElementById("dom-target-series");
    var series_data = div8.textContent.trim();
    if (empty.length==series_data.length)
    {
        series_data="blank";
    }
    
    
    
    var parameters = {start: begin, finish: end, geo_cat: geo_type,
                    geo: geo_picked, customer: company_name,
                    xaxis: x_name, yaxis: y_name, series: series_data};
    
    console.log(parameters);
    $.getJSON("overall_job_data_analysis.php",parameters)
        .done(function(data, textStatus, jqXHR)
        {
            
            console.log("check three");
            console.log(y_name);
            var y1=[];
            
            for (var i = 0; i<data.length; i++)
            {
                y1.push([parseFloat(data[i]["xdata"]),parseFloat(data[i]["ydata"])]);
                
            }
            
            console.log(y1);
            var plotdata = [{data: y1, lines:{show:true},color: '#CE0000'}];
            var options = {legend: {position:"ne"}, 
                        points: {show: true},
                        xaxis: [{min: 2016,
                                max: 2017
                            }],
                        yaxes: [
                        {
                            position: 0,
                            min: 8,
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: "Verdana, Arial, Helvetica, Tahoma, sans-serif",
                            axisLabelPadding: 5
                        },],
                        grid:  {hoverable: true}};
                        chart3 = $.plot("#flot-placeholder_overallanalysis",plotdata,options);
    });
});


$(document).ready(function () {
    $("#flot-placeholder_overallanalysis").bind("plothover",function(event,pos,item){
        $("#tooltip").remove();
        if (item){
            var x = item.datapoint[0].toFixed(2),y = item.datapoint[1].toFixed(2);
            showTooltip(item.pageX, item.pageY, item.series.label + " at " +x+ " is "+ y + ".");
        }
    });
});
