google.charts.load('current', {packages: ['bar','line','corechart']});
google.charts.setOnLoadCallback(drawChart);
            
function drawChart(){
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
        if (geo_picked.length >80 ) {
            geo_picked="blank";
        }
        
        if (empty.length==geo_picked.length)
        {
            geo_picked="blank";
        }
    
        var div5 = document.getElementById("dom-target-chosen_company");
        var company_name = div5.textContent.trim();
        if (empty.length==company_name.length)
        {
            company_name="blank";
        }
    
        var div6 = document.getElementById("dom-target-xaxis");
        var x_name = div6.textContent.trim();
        
        if("date"==x_name)
        {
            x_info=['string','Month'];
        }
        else if("well"==x_name)
        {
            x_info=['string','Well'];
        }
        else if("supervisor_id"==x_name)
        {
            x_info=['string','Supervisor'];
        }
        else if("pumper_id"==x_name)
        {
            x_info=['string','Pump Operator'];
        }
        else if("pump_id"==x_name)
        {
            x_info=['string','Pump'];
        }
        else if("geo"==x_name)
        {
            x_info=['string','Place'];
        }
        else if("job_type"==x_name)
        {
            x_info=['string','Job Type'];
        }
        else if("slurry_function"==x_name)
        {
            x_info=['string','Slurry Function'];
        }
        else if("slurry_density"==x_name)
        {
            x_info==['number','Slurry Density'];
        }    
    
        var div7 = document.getElementById("dom-target-yaxis");
        var y_name = div7.textContent.trim();
        
        //get axis name and series name
        if('density'==y_name)
        {
            
            if(geo_picked!="blank")
            {
                y_info=['Density Accuracy',geo_picked];    
            }
            else
            {
                y_info=['Density Accuracy','Density Accuracy'];
            }
        }
    
        var div8 = document.getElementById("dom-target-series");
        var series_data = div8.textContent.trim();
        if (empty.length==series_data.length)
        {
            series_data="blank";
        }
    
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
        console.log(company_name);
        if(company_name==("blank"))
        {}
        else
        {
        user_title+=" for ";
        user_title+=company_name;
        }
        
        //console.log(parameters);
        $.getJSON("overall_job_data_analysis.php",parameters)
        .done(function(data, textStatus, jqXHR)
        {
            
            if("date"==x_name)
            {
                for (var i = 0; i<data.length; i++)
                {
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
            else
            {
                for (var i = 0; i<data.length; i++)
                {
                    x1.push(data[i]["xdata"]);
                }    
            }
            
        
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
            console.log(materialOptions);
            var table = new google.visualization.DataTable();
            table.addColumn(x_info[0],x_info[1]);
            
            table.addColumn('number',y_info[1]);
            table.addRows(y1);
        
            
            function drawColumnChart(){
                var columnChart = new google.charts.Bar(chartDiv);
                columnChart.draw(table, google.charts.Bar.convertOptions(materialOptions));
                }
            
            function drawMaterialChart() {
                var materialChart = new google.visualization.LineChart(chartDiv);
                materialChart.draw(table, materialOptions);
                }
            console.log(table);
            if("line"==chart_type)
            {
            drawMaterialChart();    
            }
            else if("bar"==chart_type)
            {
            drawColumnChart();    
            }
        });
    });
}
