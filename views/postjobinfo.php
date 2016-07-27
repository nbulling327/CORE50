

<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/">Input Proposal Information</a></li>
        <li class="active"><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="#">View Job Database</a></li>
        <li><a href="#">Analyze Job Data</a></li>
    </ul>
</div>
<br/><br/>
<form action = "postjob.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div id="post_well_customer" class="col-xs-5 col-xs-offset-1 text-left">
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
        <div id="scrollable-dropdown-menu" hidden class="col-xs-5 col-xs-offset-1">
            <select id="test" name="wellsite" class="typeahead form-control" type="text" placeholder="Well Name" data-live-search="true">
            </select>
        </div>
    </div>
    <br/>
    <div class="row">
        <div id="post_well_supervisor" class="col-xs-3 col-xs-offset-1 text-left">
            <select  id="sup_choice" name="chosen_supervisor" class="selectpicker" title="Select Supervisor" data-size="6" data-live-search="true">
                <?php 
                    foreach ($supervisors as $supervisor) 
                    {
                        $sup_name=$supervisor["name"];
                        $sup_id=$supervsior["id"];
                        echo '<option value="' . "$sup_id" . '">' ."$sup_name" . '</option>' ;
                    }
                ?>
            </select>
        </div>
        <div id="post_well_supervisor" class="col-xs-3 col-xs-offset-1 text-left">
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
        <div class="col-xs-2 col-xs-offset-1">
            <span class="pull-left">
                <a href="#" class="btn my-btn" role="button">Add Field Employee</a>
            </span>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-2 col-xs-offset-1 text-left">
            <select  name="time" class="selectpicker" data-size="8" title="Select Elapsed Time Column" data-live-search="true">
                <option value="0">A</option>
                <option value="1">B</option>
                <option value="2">C</option>
                <option value="3">D</option>
                <option value="4">E</option>
                <option value="5">F</option>
                <option value="6">G</option>
                <option value="7">H</option>
                <option value="8">I</option>
                <option value="9">J</option>
                <option value="10">K</option>
                <option value="11">L</option>
                <option value="12">M</option>
                <option value="13">N</option>
                <option value="14">O</option>
                <option value="15">P</option>
                <option value="16">Q</option>
                <option value="17">R</option>
                <option value="18">S</option>
                <option value="19">T</option>
                <option value="20">U</option>
                <option value="21">V</option>
                <option value="22">W</option>
                <option value="23">X</option>
                <option value="24">Y</option>
                <option value="25">Z</option>
            </select>
        </div>
        <div class="col-xs-2 col-xs-offset-1 text-left">
            <select  name="pressure" class="selectpicker" data-size="8" title="Select Pressure Column" data-live-search="true">
                <option value="0">A</option>
                <option value="1">B</option>
                <option value="2">C</option>
                <option value="3">D</option>
                <option value="4">E</option>
                <option value="5">F</option>
                <option value="6">G</option>
                <option value="7">H</option>
                <option value="8">I</option>
                <option value="9">J</option>
                <option value="10">K</option>
                <option value="11">L</option>
                <option value="12">M</option>
                <option value="13">N</option>
                <option value="14">O</option>
                <option value="15">P</option>
                <option value="16">Q</option>
                <option value="17">R</option>
                <option value="18">S</option>
                <option value="19">T</option>
                <option value="20">U</option>
                <option value="21">V</option>
                <option value="22">W</option>
                <option value="23">X</option>
                <option value="24">Y</option>
                <option value="25">Z</option>
            </select>
        </div>
        <div class="col-xs-2 col-xs-offset-1 text-left">
            <select  name="rate" class="selectpicker" data-size="8" title="Select Rate Column" data-live-search="true">
                <option value="0">A</option>
                <option value="1">B</option>
                <option value="2">C</option>
                <option value="3">D</option>
                <option value="4">E</option>
                <option value="5">F</option>
                <option value="6">G</option>
                <option value="7">H</option>
                <option value="8">I</option>
                <option value="9">J</option>
                <option value="10">K</option>
                <option value="11">L</option>
                <option value="12">M</option>
                <option value="13">N</option>
                <option value="14">O</option>
                <option value="15">P</option>
                <option value="16">Q</option>
                <option value="17">R</option>
                <option value="18">S</option>
                <option value="19">T</option>
                <option value="20">U</option>
                <option value="21">V</option>
                <option value="22">W</option>
                <option value="23">X</option>
                <option value="24">Y</option>
                <option value="25">Z</option>
            </select>
        </div>
        <div class="col-xs-2 col-xs-offset-1 text-left">
            <select  name="density" class="selectpicker" data-size="8" title="Select Density Column" data-live-search="true">
                <option value="0">A</option>
                <option value="1">B</option>
                <option value="2">C</option>
                <option value="3">D</option>
                <option value="4">E</option>
                <option value="5">F</option>
                <option value="6">G</option>
                <option value="7">H</option>
                <option value="8">I</option>
                <option value="9">J</option>
                <option value="10">K</option>
                <option value="11">L</option>
                <option value="12">M</option>
                <option value="13">N</option>
                <option value="14">O</option>
                <option value="15">P</option>
                <option value="16">Q</option>
                <option value="17">R</option>
                <option value="18">S</option>
                <option value="19">T</option>
                <option value="20">U</option>
                <option value="21">V</option>
                <option value="22">W</option>
                <option value="23">X</option>
                <option value="24">Y</option>
                <option value="25">Z</option>
            </select>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-offset-5">
            Select csv to upload.
            <input class="btn btn-secondary" type = "file" name="fileToUpload" id="fileToUpload">
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-offset-5">
            <button class="btn my-btn" type="submit" value="Upload CSV" name="submit">
                Submit
            </button>
        </div>
    </div>
</form>
</div>