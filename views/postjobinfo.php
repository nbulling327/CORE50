

<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/">Input Proposal Information</a></li>
        <li class="active"><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="/jobdatabase.php">Job Review</a></li>
        <li><a href="#">Job Analysis</a></li>
    </ul>
</div>
<br/>
<form action = "postjob.php" method="post" enctype="multipart/form-data">
    <div id="small_font">
    <div class="row">
        <div class="col-xs-6">
            <div class="col-xs-3 col-xs-offset-1 text-left">
                Customer:
                <div class="row">
                    <div id="post_well_customer" class="col-xs-11 text-left">
                        <select  id="comp_choice" name="chosen_company" class="selectpicker" title="Select Customer Name.." data-size="12" data-live-search="true">
                    <?php 
                        foreach ($customers as $customer) 
                        {
                            $company_name=$customer["customer"];
                            echo '<option value="' . "$company_name" . '">' ."$company_name" . '</option>' ;
                        }
                    ?>
                        </select>
                    </div>
                </div>
            </div>
            <div id="scrollable-dropdown-menu" hidden class="col-xs-offset-3 col-xs-5">
                Job:
                <div class="row">
                    <div class="col-xs-12">
                <select id="test" name="wellsite" class="typeahead form-control" type="text" placeholder="Well Name" data-live-search="true">
                </select>
                    </div>
                </div>    
            </div>
        </div>
        <div id="job_date" hidden class="col-xs-3 col-xs-offset-3">
            <div class="col-xs-11 col-xs-offset-1">
                Job Date:
            </div>
            <div class = "row"> <div class="col-xs-offset-1 col-xs-3 text-left">
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker1'>
                        <input name="jobdate" type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div></div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-6">
            <div id="post_well_supervisor" class="col-xs-5 col-xs-offset-1 text-left">
                Select Supervisor:
                <div class = "row"> 
                    <div class="col-xs-12 text-left">
                        <select  id="sup_choice" name="chosen_supervisor" class="selectpicker" title="Select Supervisor" data-size="6" data-live-search="true">
<?php 
                            foreach ($supervisors as $supervisor) 
                            {
                                $sup_name=$supervisor["name"];
                                $sup_id=$supervisor["id"];
                                echo '<option value="' . "$sup_id" . '">' ."$sup_name" . '</option>' ;
                            }
?>
                        </select>
                    </div>
                </div>
            </div>
            <div id="post_well_supervisor" class="col-xs-5 col-xs-offset-1 text-left">
                Select Pump Truck Operator:
                <div class = "row"> 
                    <div class="col-xs-12 text-left">
                        <select  id="pump_choice" name="chosen_pumper" class="selectpicker" title="Select Pump Operator" data-size="6" data-live-search="true">
<?php 
                            foreach ($pumpers as $pumper) 
                            {
                                $pump_name=$pumper["name"];
                                $pump_id=$pumper["id"];
                                echo '<option value="' . "$pump_id" . '">' ."$pump_name" . '</option>' ;
                            }
?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="col-xs-6">
                <div class="col-xs-10 col-xs-offset-2">
                <br/>
                    <span class="pull-left">
                        <a href="#" class="btn my-btn" role="button">Add Field Employee</a>
                    </span>
                </div>
            </div>
            <div id="post_well_supervisor" class="col-xs-5 col-xs-offset-1 text-left">
                Select Pump Truck:
                <div class = "row"> 
                    <div class="col-xs-12 text-left">
                        <select  id="pump" name="chosen_pump" class="selectpicker" title="Select Pump Unit" data-size="6" data-live-search="true">
<?php 
                            foreach ($pumps as $pump) 
                            {
                                $unit_name=$pump["pump"];
                                $unit_id=$pump["id"];
                                echo '<option value="' . "$unit_id" . '">' ."$unit_name" . '</option>' ;
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
        <div class="col-xs-6 text-left">
            <div class="col-xs-10 col-xs-offset-1 text-left"> 
                Enter Calculated Displacement in bbl:
                <div class="row">
                    <div class="col-xs-12 text-left">
                        <input name="calculated_disp" class="form-control" type="text" placeholder="Displacement Volume (bbl)">
                        bbl
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-6 text-left">
            <div class="col-xs-5 col-xs-offset-1 text-left">
                Time:
                <div class="row">
                    <div class="col-xs-12 text-left">
                <select  name="time" class="selectpicker" data-size="8" title="Select Elapsed Time Column" data-live-search="true">
                <option value="1">A</option>
                <option value="2">B</option>
                <option value="3">C</option>
                <option value="4">D</option>
                <option value="5">E</option>
                <option value="6">F</option>
                <option value="7">G</option>
                <option value="8">H</option>
                <option value="9">I</option>
                <option value="10">J</option>
                <option value="11">K</option>
                <option value="12">L</option>
                <option value="13">M</option>
                <option value="14">N</option>
                <option value="15">O</option>
                <option value="16">P</option>
                <option value="17">Q</option>
                <option value="18">R</option>
                <option value="19">S</option>
                <option value="20">T</option>
                <option value="21">U</option>
                <option value="22">V</option>
                <option value="23">W</option>
                <option value="24">X</option>
                <option value="25">Y</option>
                <option value="26">Z</option>
                </select>
                </div></div>
            </div>
            <div class="col-xs-5 col-xs-offset-1 text-left">
                Pressure:
                <div class="row"><div class="col-xs-12 text-left">
                <select  name="pressure" class="selectpicker" data-size="8" title="Select Pressure Column" data-live-search="true">
                <option value="1">A</option>
                <option value="2">B</option>
                <option value="3">C</option>
                <option value="4">D</option>
                <option value="5">E</option>
                <option value="6">F</option>
                <option value="7">G</option>
                <option value="8">H</option>
                <option value="9">I</option>
                <option value="10">J</option>
                <option value="11">K</option>
                <option value="12">L</option>
                <option value="13">M</option>
                <option value="14">N</option>
                <option value="15">O</option>
                <option value="16">P</option>
                <option value="17">Q</option>
                <option value="18">R</option>
                <option value="19">S</option>
                <option value="20">T</option>
                <option value="21">U</option>
                <option value="22">V</option>
                <option value="23">W</option>
                <option value="24">X</option>
                <option value="25">Y</option>
                <option value="26">Z</option>
                </select>
                </div></div>
            </div>
        </div>
        <div class="col-xs-6 text-left">
            <div class="col-xs-5 col-xs-offset-1 text-left">
                Rate:
                <div class="row"><div class="col-xs-12 text-left">
                <select  name="rate" class="selectpicker" data-size="8" title="Select Rate Column" data-live-search="true">
                <option value="1">A</option>
                <option value="2">B</option>
                <option value="3">C</option>
                <option value="4">D</option>
                <option value="5">E</option>
                <option value="6">F</option>
                <option value="7">G</option>
                <option value="8">H</option>
                <option value="9">I</option>
                <option value="10">J</option>
                <option value="11">K</option>
                <option value="12">L</option>
                <option value="13">M</option>
                <option value="14">N</option>
                <option value="15">O</option>
                <option value="16">P</option>
                <option value="17">Q</option>
                <option value="18">R</option>
                <option value="19">S</option>
                <option value="20">T</option>
                <option value="21">U</option>
                <option value="22">V</option>
                <option value="23">W</option>
                <option value="24">X</option>
                <option value="25">Y</option>
                <option value="26">Z</option>
                </select>
                </div></div>
            </div>
            <div class="col-xs-5 col-xs-offset-1 text-left">
                Density:
                <div class="row"><div class="col-xs-12 text-left">
                <select  name="density" class="selectpicker" data-size="8" title="Select Density Column" data-live-search="true">
                <option value="1">A</option>
                <option value="2">B</option>
                <option value="3">C</option>
                <option value="4">D</option>
                <option value="5">E</option>
                <option value="6">F</option>
                <option value="7">G</option>
                <option value="8">H</option>
                <option value="9">I</option>
                <option value="10">J</option>
                <option value="11">K</option>
                <option value="12">L</option>
                <option value="13">M</option>
                <option value="14">N</option>
                <option value="15">O</option>
                <option value="16">P</option>
                <option value="17">Q</option>
                <option value="18">R</option>
                <option value="19">S</option>
                <option value="20">T</option>
                <option value="21">U</option>
                <option value="22">V</option>
                <option value="23">W</option>
                <option value="24">X</option>
                <option value="25">Y</option>
                <option value="26">Z</option>
                </select>
                </div></div>
            </div>
        </div>
    </div>
    <br/><br/>
    <div class="row">
        <div class="col-xs-6">
        <div class="col-xs-5 col-xs-offset-7">
            Select csv to upload.
            <input class="btn btn-secondary" type = "file" name="fileToUpload" id="fileToUpload">
        </div></div>
    
    
        <div class="col-xs-6">
        <div class="col-xs-11 col-xs-offset-1">
            <br/>
                <button class="btn my-btn" type="submit" value="Upload CSV" name="submit">
                    Next
                    <span aria-hidden="true" class="glyphicon glyphicon-arrow-right"></span>
                </button>
        
        </div></div>
    </div></div>
</form>
</div>