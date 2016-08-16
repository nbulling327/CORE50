google.charts.load('current', {packages: ['bar','line','corechart']});
google.charts.setOnLoadCallback(drawChart);
  
function progressBarupdate(al){
    var bar = document.getElementById('progressBar');
    var status = document.getElementById('status');
    var message = document.getElementById('finalMessage');
    var chart = document.getElementById('chart_div');
    
    if (al<45) {
        $('#progressBar').attr('aria-valuenow', al).css('width',al+'%');
        status.innerHTML = al +"%";
        message.innerHTML="Chart is loading";
        chart.style.display='none';
        bar.style.display='inline';
        status.style.display='inline';
        message.style.display='inline';
    }
    else if (45<= al && al < 100){
        chart.style.display='none';
        bar.style.display='inline';
        status.style.display='inline';
        message.style.display='inline';
        message.innerHTML="Chart is loading";
        status.innerHTML=al+"%";
        $('#progressBar').attr('aria-valuenow', al).css('width',al+'%');
        al=al+5;
        setTimeout('progressBarupdate('+al+')', 300);
    }
    else if (al == 100) {
        message.innerHTML="Chart is loaded!";
        $('#progressBar').attr('aria-valuenow', al).css('width',al+'%');
        setTimeout('progressBarupdate(101)', 1000);
        chart.style.display='inline';
        bar.style.display='none';
        status.style.display='none';
        message.style.display='none'; 
    }
    else if (al > 100) {
        message.innerHTML="Chart is loaded!";
        chart.style.display='inline';
        bar.style.display='none';
        status.style.display='none';
        message.style.display='none'; 
    }
}

function drawChart(){
    $(document).ready(function () {
        var empty="";
        var div0 = document.getElementById("dom-target-chart_type");
        var chart_type = div0.textContent.trim();
        progressBarupdate(1);
        var div1 = document.getElementById("dom-target-begin_date");
        var begin = div1.textContent.trim();
    
        var div2 = document.getElementById("dom-target-end_date");
        var end = div2.textContent.trim();
        progressBarupdate(4);
        var div3 = document.getElementById("dom-target-geo_filter");
        var geo_type = div3.textContent.trim();
        if (empty.length==geo_type.length) {
            geo_type="blank";
        }
    
        
        var div4 = document.getElementById("dom-target-filter1");
        var geo_picked = div4.textContent.trim();
        if (geo_picked.length >80 ) {
            geo_picked="blank";
        }
        
        if (empty.length==geo_picked.length) {
            geo_picked="blank";
        }
        progressBarupdate(7);
        var div5 = document.getElementById("dom-target-chosen_company");
        var company_name = div5.textContent.trim();
        if (empty.length==company_name.length) {
            company_name="blank";
        }
    
        var div6 = document.getElementById("dom-target-xaxis");
        var x_name = div6.textContent.trim();
        progressBarupdate(10);
        if("date"==x_name) {
            x_info=['string','Month'];
        }
        else if("well"==x_name) {
            x_info=['string','Well'];
        }
        else if("supervisor_id"==x_name) {
            x_info=['string','Supervisor'];
        }
        else if("pumper_id"==x_name) {
            x_info=['string','Pump Operator'];
        }
        else if("pump_id"==x_name) {
            x_info=['string','Pump'];
        }
        else if("geo"==x_name) {
            x_info=['string','Place'];
        }
        else if("job_type"==x_name) {
            x_info=['string','Job Type'];
        }
        else if("slurry_function"==x_name) {
            x_info=['string','Slurry Function'];
        }
        else if("slurry_density"==x_name) {
            x_info==['number','Slurry Density'];
        }    
        progressBarupdate(12);
        var div7 = document.getElementById("dom-target-yaxis");
        var y_name = div7.textContent.trim();

        //get axis name and series name
        if('density'==y_name) {
            if(geo_picked!="blank") {
                y_info=['Density Accuracy',geo_picked];    
            }
            else {
                y_info=['Density Accuracy','Density Accuracy'];
            }
        }
        //get axis name and series name
        else if('shutdowns'==y_name) {
            if(geo_picked!="blank") {
                y_info=['Unplanned Shutdowns per Job',geo_picked];    
            }
            else {
                y_info=['Unplanned Shutdowns per Job','Unplanned Shutdowns per Job'];
            }
        }
        else if('cem_vol_var'==y_name) {
            if(geo_picked!="blank") {
                y_info=['Cement Volume Variance',geo_picked];    
            }
            else {
                y_info=['Cement Volume Variance','Cement Volume Variance'];
            }
        }
        else if('disp_vol_var'==y_name) {
            if(geo_picked!="blank") {
                y_info=['Displacement Volume Variance',geo_picked];    
            }
            else {
                y_info=['Displacement Volume Variance','Displacement Volume Variance'];
            }
        }
        else if('plug_shutdown_time'==y_name) {
            if(geo_picked!="blank") {
                y_info=['Time down before Displacement (min)',geo_picked];    
            }
            else {
                y_info=['Time down before Displacement (min)','Top Plug Shutdown Time'];
            }
        }
        else if('jobs'==y_name) {
            if(geo_picked!="blank") {
                y_info=['Number of Jobs',geo_picked];    
            }
            else {
                y_info=['Number of Jobs','Number of Jobs'];
            }
        }
        else if('slurry_swap_time'==y_name) {
            if(geo_picked!="blank") {
                y_info=['Average Slurry Swap Time',geo_picked];    
            }
            else {
                y_info=['Average Slurry Swap Time','Average Slurry Swap Time'];
            }
        }
        progressBarupdate(15);
        var div8 = document.getElementById("dom-target-series");
        var series_data = div8.textContent.trim();
        if (empty.length==series_data.length)
        {
            series_data="blank";
        }
        progressBarupdate(18);
        var parameters = {start: begin, finish: end, geo_cat: geo_type,
                geo: geo_picked, customer: company_name,
                xaxis: x_name, yaxis: y_name, series: series_data};
        var chartDiv = document.getElementById('chart_div');
        var x1=[];
        var month;
        var year;
        var user_title =y_info[0];
        user_title+=" by ";
        user_title+=x_info[1];
        if(company_name==("blank")) {}
        else {
            user_title+=" for ";
            user_title+=company_name;
            }
        progressBarupdate(21);
        $.getJSON("overall_job_data_analysis.php",parameters)
        .done(function(data, textStatus, jqXHR) {
            progressBarupdate(50);
            if("date"==x_name) {
                for (var i = 0; i<data.length; i++) {
                    switch (data[i]["xdata"].slice(5,7)) {
                        case "01":
                            month = "January";
                            break;
                        case "02":
                            month = "February";
                            break;
                        case "03":
                            month = "March";
                            break;
                        case "04":
                            month = "April";
                            break;
                        case "05":
                            month = "May";
                            break;
                        case "06":
                            month = "June";
                            break;
                        case "07":
                            month = "July";
                            break;
                        case "08":
                            month = "August";
                            break;
                        case "09":
                            month = "September";
                            break;
                        case "10":
                            month = "October";
                            break;    
                        case "11":
                            month = "November";
                            break;    
                        case "12":
                            month = "December";
                            break;    
                    }
                    year =parseFloat(data[i]["xdata"].slice(0,4));
                    month+=" ";
                    month+=year;
                    x1.push(month);
                }    
            }
            else {
                for (var i = 0; i<data.length; i++) {
                    x1.push(data[i]["xdata"]);
                }    
            }
            progressBarupdate(60);
            var y1=[];
            for (var i = 0; i<data.length; i++)
            {
                y1.push([x1[i],parseFloat(data[i]["ydata"])]);
            }
            var materialOptions = {
                title: user_title,
                titleTextStyle: { fontName: 'futura'  
                },
                colors:['#B00404'],
                hAxis:{
                    title: x_info[1],
                    titleTextStyle:{bold: true, fontName: 'futura', italic: false},
                    slantedText: false,
                    maxTextlines: 5,
                    showTextEvery: 1,
                    maxAlternation: 4
                },
                backgroundColor:{
                    stroke: '#000',
                    strokeWidth: 0
                },
                legend:
                {
                  position: 'top'  
                },
                vAxis:{
                    title: y_info[0],
                    titleTextStyle:{bold: true, fontName: 'futura',italic: false},
                },
                width: 900,
                height: 450,
                series: {
                    0: {axis: 'YAXIS'}
                },
            };
            progressBarupdate(30);
            var table = new google.visualization.DataTable();
            table.addColumn(x_info[0],x_info[1]);
            table.addColumn('number',y_info[1]);
            table.addRows(y1);
            progressBarupdate(35);   
            function drawOriginalColumnChart() {
                var originalchart = new google.visualization.ColumnChart(chartDiv);
                originalchart.draw(table, materialOptions);
            }
            function drawMaterialChart() {
                var materialChart = new google.visualization.LineChart(chartDiv);
                materialChart.draw(table, materialOptions);
            }
            progressBarupdate(40);
            if("line"==chart_type) {
                drawMaterialChart();    
                progressBarupdate(45);
                
            }
            else if("bar"==chart_type) {
                drawOriginalColumnChart();    
                progressBarupdate(45);
            }
        });
    });
}
