<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/jobdatabase.php">Job Review</a></li>
        <li class="active"><a href="/jobanalysis.php">Jobs Analysis</a></li>
    </ul>
</div>
<div class = "container-fluid" id="futura">

<div class= "col-xs-7">
    <div class="row" id="futura">
        <div id="chart_div" style="width:840px;height:420px"></div>
        <br/><br/><br/>
        <div class = "progress center-block" style="width: 300px;" >
            <div id="progressBar" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
        </div>    
        <br/>
        <span id="status"></span>
        <br/>
        <h1 id="finalMessage"></h1>
    </div>
    

            
    <div class = "row">
        <div id="dom-target-chart_type" style="display: none;">
<?php 
            $output = '';
            $output = $_POST["chart_type"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-begin_date" style="display: none;">
<?php 
            $output = $_POST["begin_date"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-end_date" style="display: none;">
<?php 
            $output = $_POST["end_date"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-geo_filter" style="display: none;">
<?php 
            $output = $_POST["geo_filter"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-filter1" style="display: none;">
<?php 
            $output = $_POST["filter1"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-chosen_company" style="display: none;">
<?php 
            $company_name=$_POST["chosen_company"];
            $output = $_POST["chosen_company"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-xaxis" style="display: none;">
<?php 
            $output = $_POST["xaxis"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-yaxis" style="display: none;">
<?php 
            $output = $_POST["yaxis"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-series" style="display: none;">
<?php 
            $output = $_POST["series"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
    </div>
</div>
<div class= "col-xs-5">
    <form action="jobanalysis.php" method="post">
        <fieldset>
            <div class="row">
                <br/>
                <div class="col-xs-6 text-left">
                    Chart Type
                    <div class="row">
                        <div class="col-xs-3 text-left">
                            <select  name="chart_type" class="selectpicker" data-size="12">
                                <option value="line">Line Chart</option>
                                <option value="bar">Bar Chart</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 text-left" style="visibility: hidden;">
                    Series
                    <div class="row">
                        <div class="col-xs-3 text-left">
                            <select name="series" class="selectpicker" data-size="12">
                                <option value="0">none</option>
                                <option value="geography">Geography</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="pumper">Pump Operator</option>
                                <option value="pump">Pump Unit</option>
                                <option value="job_type">Job Type</option>
                                <option value="slurry_function">Slurry Function</option>
                                <option value="slurry_density">Slurry Density</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <br/>
                <div class="col-xs-6 text-left">
                    Time Range Begin
                    <div class="row">
                        <div class="col-xs-3 text-left">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker6'>
                                    <input type='text' class="form-control" name="begin_date"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 text-left">
                    Time Range End
                    <div class="row">
                        <div class="col-xs-3 text-left">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker7'>
                                    <input type='text' class="form-control" name="end_date"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="geography" class="col-xs-6 text-left">
                    Geographic Filter
                    <div class="row">
                        <div class="col-xs-3 text-left">
                            <select id="geo_choice" name="geo_filter" class="selectpicker" data-size="12">
                                <option value="0">none</option>
                                <option value="hemisphere">Hemisphere</option>
                                <option value="region">Region</option>
                                <option value="area">Area</option>
                                <option value="district">District</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="scrollable-dropdown-menu2" class="col-xs-6">
                    <div class = "col-xs-12 text-left">
                        Select Filter Value:
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-left"><span aria-hidden="true" class="glyphicon glyphicon-arrow-right"></span>
                            <select id="filter1" name="filter1" class="typeahead form-control" data-size="6" type="text" placeholder="Select place" data-live-search="true">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <br/>
                <div class = "col-xs-12 text-left" hidden>
                    Filter By Customer
                    <div class="row">
                        <div class="col-xs-3 text-left">
                            <select name="chosen_company" value=<?php echo $company_name; ?>>                
<?php   
                                    echo '<option value="' . "$company_name" . '">' ."$company_name" . '</option>' ;
?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <br/>
                <div class="col-xs-6 text-left">
                    X-Axis
                    <div class="row">
                        <div class="col-xs-3 text-left">
                            <select name="xaxis" class="selectpicker" data-size="12">
                                <option value="well">Well</option>
                                <option value="date">Month</option>
                                <option value="supervisor_id">Supervisor</option>
                                <option value="pumper_id">Pump Operator</option>
                                <option value="pump_id">Pump Unit</option>
                                <option value="geo">Geography</option>
                                <option value="job_type">Job Type</option>
                                <option value="slurry_function">Slurry Function</option>
                                <option value="slurry_density">Slurry Density</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 text-left">
                    Y-Axis
                    <div class="row">
                        <div class="col-xs-3 text-left">
                            <select name="yaxis" class="selectpicker" data-size="12">
                                <option value="density">Density Accuracy</option>
                                <option value="shutdowns">Shutdowns</option>
                                <option value="cem_vol_var">Cement Volume Variance</option>
                                <option value="slurry_swap_time">Slurry Swap Time</option>
                                <option value="plug_shutdown_time">Plug Shutdown Time</option>
                                <option value="disp_vol_var">Displacement Volume Variance</option>
                                <option value="jobs"># of Jobs Performed</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12 center-block" style="float:none">
                    <div class="form-group">
                        <button class="btn my-btn" type="submit">
                            Refresh Jobs Analysis 
                            <span aria-hidden="true" class="glyphicon glyphicon glyphicon-stats"></span>
                        </button>
                    </div>
                </div>
            </div>
        </fieldset>   
    </form> 
</div>