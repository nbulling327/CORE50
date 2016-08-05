<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/">Input Proposal Information</a></li>
        <li><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="/jobdatabase.php">Job Review</a></li>
        <li class="active"><a href="/jobanalysis.php">Jobs Analysis</a></li>
    </ul>
</div>
<br/>
<form action="jobanalysis.php" method="post">
    <fieldset>
        <div class="row">
            <div class="col-xs-3 col-xs-offset-1 text-left">
                Chart Type
                <div class="row">
                    <div class="col-xs-3 text-left">
                        <select  name="chart_type" class="selectpicker" data-size="12">
                            <option value="line">Line Chart</option>
                            <option value="bar">Bar Chart</option>
                            <option value="pie">Pie Chart</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-2 col-xs-offset-1 text-left">
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
            <div class="col-xs-2 col-xs-offset-2 text-left">
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
            <div id="geography" class="col-xs-2 col-xs-offset-1 text-left">
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
            
            <div id="scrollable-dropdown-menu2" class="col-xs-3">
                <div class = "col-xs-11 col-xs-offset-1">
                Select Filter Value:
                </div>
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">--->
                        <select id="filter1" name="filter1" class="typeahead form-control" data-size="6" type="text" placeholder="Select place" data-live-search="true">
                        </select>
                    </div>
                </div>
            </div>
            <div class = "col-xs-6">
                <div class="col-xs-4 col-xs-offset-6 text-left">
                    Filter By Customer
                    <div class="row">
                        <div class="col-xs-3 text-left">
                            <select name="chosen_company" class="selectpicker" title="Select Customer Name.." data-size="12" data-live-search="true">                
<?php   
                                foreach ($options as $option) 
                                {
                                    $company_name=$option["company_option"];
                                    echo '<option value="' . "$company_name" . '">' ."$company_name" . '</option>' ;
                                }
?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-xs-3 col-xs-offset-1 text-left">
                X-AXIS
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
            <div class="col-xs-3 col-xs-offset-1 text-left">
                Y-AXIS
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
            <div class="col-xs-3 col-xs-offset-1 text-left">
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
        <br/><br/>
        <div class="row">
            <div class="col-xs-2 center-block" style="float:none">
                <div class="form-group">
                    <button class="btn my-btn" type="submit">
                        View Jobs Analysis 
                        <span aria-hidden="true" class="glyphicon glyphicon-arrow-right"></span>
                    </button>
                </div>
            </div>
        </div>
    </fieldset>   
</form>