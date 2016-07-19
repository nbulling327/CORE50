</<div>
<div class="container-fluid">
    <ul class="nav nav-justified">
        <li><a id="current" href="#">Input Proposal Information</a></li>
        <li><a href="#">Input Post-Job Information</a></li>
        <li><a href="#">View Job Database</a></li>
        <li><a href="#">Analyze Job Data</a></li>
    </ul>
</div>
<br/><br/><br/>
<form action="slurryinfo.php" method="post">
    <fieldset>
<div class="row">
    <div class="col-xs-5 col-xs-offset-1 text-left">
        <select  name="district" class="selectpicker" title="Select Job District.." data-size="8">
            <?php
                foreach ($districts as $district) 
                {
                    $district_list = $district["district"];
                    echo '<option value="' . "$district_list" . '">' ."$district_list" . '</option>' ;
                }
            ?>
        </select>
    </div>
</div>
<br/><br/>
<div class="row">
    <div class="col-xs-5 col-xs-offset-1 text-left">
        <select  name="chosen_company" class="selectpicker" title="Select Customer Name.." data-size="12">
            <?php 
                foreach ($options as $option) 
                {
                    $company_name=$option["company_option"];
                    echo '<option value="' . "$company_name" . '">' ."$company_name" . '</option>' ;
                }
            ?>
        </select>
    </div>
    <div class="col-xs-5 col-xs-offset-1">
        <span class="pull-left">
            <a href="newcompany.php" class="btn btn-info col-xs-offset-1" role="button">Add New Company</a>
        </span>
    </div>
</div>    
<br/><br/>
<div class="row">
    <div class="col-xs-5 col-xs-offset-1 text-left">
        <select  name="job_type" class="selectpicker" title="Select Job Type.." data-size="8">
            <optgroup label = "Primary Jobs">
                <?php
                    foreach ($jobs as $job) 
                    {
                        if($job["primsec"]=="primary")
                        {
                        $type=$job["jobtype"];
                        echo '<option value="' . "$type" . '">' ."$type" . '</option>' ;
                        }
                    }
                ?>
            </optgroup>
            <optgroup label = "Remedial">
                <?php
                    foreach ($jobs as $job) 
                    {
                        if($job["primsec"]=="secondary")
                        {
                            $type=$job["jobtype"];
                            echo '<option value="' . "$type" . '">' ."$type" . '</option>' ;
                        }
                    }
                ?>
            </optgroup>
        </select>
    </div>
    <div class="col-xs-5 col-xs-offset-1 text-left">
        Number of Stages:
        <div class="row">
            <div class="col-xs-5 text-left">
                <select  name="stage_count" class="selectpicker" data-size="12">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div>
    </div>
</div>
<br/><br/>
<div class="row">
    <div class="col-xs-5 col-xs-offset-1 text-left"> Enter Well Name:
        <div class="row">
            <div id="prefetch_name" class="col-xs-5 text-left">
                <input name="well" class="typeahead form-control" type="text" placeholder="Well Name">
            </div>
        </div>
    </div>
    <div class="col-xs-5 col-xs-offset-1 text-left"> Enter Well Number:
        <div class="row">
            <div id="prefetch_number" class="col-xs-5 text-left">
                <input name="number" class="typeahead form-control" type="text" placeholder="Well Number">
            </div>
        </div>
    </div>
</div>    
<br/><br/>
<div class="row">
    <div class="col-xs-5 col-xs-offset-1 text-left">
        Total Number of Slurries:
        <div class="row">
            <div class="col-xs-5 text-left">
                <select  name="slurries" class="selectpicker" data-size="12">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="form-group">
            <button class="btn btn-primary" type="submit">
                Go to Slurry Information 
                <span aria-hidden="true" class="glyphicon glyphicon-arrow-right"></span>
                
            </button>
        </div>
    </fieldset>
</form>
