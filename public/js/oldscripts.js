$(document).ready(function () { 
    $("#post_well_customer").change(function(event){
        $("#scrollable-dropdown-menu").removeAttr("hidden");
        var custom = $("#comp_choice").val(); 
        console.log(custom);
        ($.ajax({
            url: "search.php",
            type: "GET",
            dataType:"json",
            data: {
                customer: custom
                },
        })        
        .done(function(data,textStatus,jqXHR){
            $('#scrollable-dropdown-menu .typeahead').typeahead(null,{
            hint:true,
            minLength: 1,
            display:'number',
            source: data
            });
        })
        .fail(function(xhr,status,errorThrown){
            alert("Sorry, there was a problem!");
            console.log("Error: " + errorThrown);
            console.log("Status: " + status);
            console.dir(xhr);    
        }));
    });
});
       
    /**
    * Try to implement query for customer name well choices
    * 
    */
/**
*$("post_well_choice").typeahead(null,{
        autoselect: true,
        highlight: true,
        minLength: 1
    },
    {
        source: search,
    });
    
    function search(query, cb)
    {
    // get places matching query (asynchronously)
    console.log(customer);
        var parameters = {
        customer: query
        };
    
        $.getJSON("search.php", parameters)
            .done(function(data, textStatus, jqXHR) {
            // call typeahead's callback with search results (i.e., places)
            cb(data);
            })
            
            .fail(function(jqXHR, textStatus, errorThrown) {
            // log error to browser's console
            console.log(errorThrown.toString());
            });
    }
});});
 
* 
* 
* $(document).ready(function () {
*actual handler
*$("#submitbutton").on("click", function(){
*
*    //arguments
*    var myheader = $("#header").val() == "true";
*    var myfile = $("#csvfile")[0].files[0];
*        
*    if(!myfile){
*        alert("No file selected.");
*        return;
*    }
*
*    //disable the button during upload
*    $("#submitbutton").attr("disabled", "disabled");
*
*    //perform the request
*    var req = call("read.csv", {
*        "file" : myfile,
*        "header" : myheader
*    }, function(session){
*        session.getConsole(function(outtxt){
*            $("#output").text(outtxt); 
*        });
*    });
*        
*    //if R returns an error, alert the error message
*    req.fail(function(){
*        alert("Server error: " + req.responseText);
*    });
*    
*   //after request complete, re-enable the button 
*    req.always(function(){
*        $("#submitbutton").removeAttr("disabled")
*    });        
*}); }); 
*/

$(document).ready(function () { 
    $("#post_well_customer").change(function(event){
        $("#scrollable-dropdown-menu").removeAttr("hidden");
        var custom = $("#comp_choice").val();
        var parameters ={customer: custom};
        $.getJSON("search.php", parameters)
        .done(function(data, textStatus, jqXHR)
        {
//            console.log(parameters);
//            var jobs = new Bloodhound({
//            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('combo'),
//            queryTokenizer: Bloodhound.tokenizers.whitespace,
//            identify: function(obj) { return obj.combo; },
//            remote: {
//                url: "search.php?query=%QUERY",
//                cache:"false",
//                replace: function(){
//                    var q = "search.php?query=%QUERY";
//                    q += "&customer=" + custom;
//                    console.log(q);
//                    return q;
//                }
//            }
//        });
//        console.log(jobs);
          var obj=document.getElementById("test"); 
          for (var i = 0; i < data.length; i++)     {                
                opt = document.createElement("option");
                opt.value = data[i].combo;
                opt.text=data[i].combo;
                obj.appendChild(opt);
            }
//        $('#scrollable-dropdown-menu .typeahead').typeahead(null,{
//            minLength: 3,
//            display:'combo',
//            source:jobs
//            });
        });
    });
});


$(document).ready(function () {
    var jsonData = $.ajax({
        url: "single_job_data.php",
        dataType: "json",
        success: function(html){
            // Succesful, load visualization API and send data
            google.setOnLoadCallback(drawData(html));
    
        }    
        });
    
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

    var options = {
        lines: {
            show: true    
        },
        points: {
            show: true
        },
        xaxis: {
            tickDecimals: 0,
            tickSize: 1
        }
    };
    
    var data = [];
    
    $.plot ("#placeholder",data,options);
    var alreadyFetched = {};
    
    function onDataReceived(series) {
        
        console.log(series.data);
        if(!alreadyFetched[series.label]){
            alreadyFetched[series.label]=true;
            data.push(series);
        }
    
        $.plot ("#placeholder",data,options);
    }
    
  $.ajax({
        url: "single_job_data.php",
        type:"GET",
        dataType: "json",
        success: onDataReceived
    });

    