<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="/proposal.php">Input Proposal Information</a></li>
        <li><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="/jobdatabase.php">Job Review</a></li>
        <li><a href="/jobanalysis.php">Jobs Analysis</a></li>
    </ul>

<br/><br/>
<form action="slurryinfo.php" method="post">
<fieldset>
<?php 
if(isset($job_to_edit)) {
    $a = $job_to_edit[0]["district"];
    $b = $job_to_edit[0]["customer"];
    $c = $job_to_edit[0]["job_type"];
    $d = $job_to_edit[0]["stage_count"];
    $e = $job_to_edit[0]["well_name"];
    $f = $job_to_edit[0]["well_number"];
    $g = $job_to_edit[0]["slurries"];
            
}
else {
    $a="abcdef";
    $b="abcdef";
    $c="abcdef";
    $d="abcdef";
    $e="abcdef";
    $f="abcdef";
    $g="abcdef";
}



?>
<div class="row">
    <div class="col-xs-3 col-xs-offset-1 text-left">
        <select name="district" class="selectpicker" title="Select Job District.." data-size="8" data-live-search="true">
            <?php
                foreach ($districts as $district) 
                {
                    $district_list = $district["district"];
                    if ($district_list == $a) {
                        echo '<option value="' . "$district_list" . '" selected="selected">' ."$district_list" . '</option>' ;    
                    }
                    else {
                        echo '<option value="' . "$district_list" . '">' ."$district_list" . '</option>' ;
                    }    
                }
            ?>
        </select>
    </div>
    <div class="col-xs-2 col-xs-offset-1 text-left">
        <select  name="chosen_company" class="selectpicker" title="Select Customer Name.." data-size="12" data-live-search="true">
            <?php 
                foreach ($options as $option) 
                {
                    $company_name=$option["company_option"];
                    if ($company_name == $b) {
                        echo '<option value="' . "$company_name" . '" selected="selected">' ."$company_name" . '</option>' ;    
                    }
                    else {
                        echo '<option value="' . "$company_name" . '">' ."$company_name" . '</option>' ;
                    }    
                }
            ?>
        </select>
    </div>
    <div class="col-xs-2">
        <span class="pull-left">
            <a href="newcompany.php" class="btn my-btn col-xs-offset-1" role="button">Add New Company</a>
        </span>
    </div>
</div>    
<br/>
<div class="row">
    <div class="col-xs-3 col-xs-offset-1 text-left">
        <br/>
            <select  name="job_type" class="selectpicker" title="Select Job Type.." data-size="8">
            <optgroup label = "Primary Jobs">
                <?php
                    foreach ($jobs as $job) 
                    {
                        if($job["primsec"]=="primary")
                        {
                            $type=$job["jobtype"];
                            if ($type == $c) {
                                echo '<option value="' . "$type" . '" selected="selected">' ."$type" . '</option>' ;    
                            }
                            else {
                                echo '<option value="' . "$type" . '">' ."$type" . '</option>' ;
                            }   
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
                            if ($type == $c) {
                                echo '<option value="' . "$type" . '" selected="selected">' ."$type" . '</option>' ;    
                            }
                            else {
                                echo '<option value="' . "$type" . '">' ."$type" . '</option>' ;
                            }
                        }
                    }
                ?>
            </optgroup>
        </select>
    </div>
    <div class="col-xs-3 col-xs-offset-1 text-left">
        Number of Stages:
        <div class="row">
            <div class="col-xs-3 text-left">
                <select  name="stage_count" class="selectpicker" data-size="12">
                    <?php
                        for ($z=1;$z<4;$z++) {
                            if ($z == $d) {
                                echo '<option value="' . "$z" . '" selected="selected">' ."$z" . '</option>' ;    
                            }
                            else {
                                echo '<option value="' . "$z" . '">' ."$z" . '</option>' ;
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-xs-3 col-xs-offset-1 text-left"> Enter Well Name:
        <div class="row">
            <div id="prefetch_name" class="col-xs-5 text-left">
                <?php
                    if ('abcdef' == $e) {
                ?>
                        <input name="well" class="typeahead form-control" type="text" placeholder="Well Name">
                <?php
                    }
                    else {
                ?>
                        <input name="well" class="typeahead form-control" type="text" value=<?php echo $e; ?>>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col-xs-3 col-xs-offset-1 text-left"> Enter Well Number:
        <div class="row">
            <div id="prefetch_number" class="col-xs-5 text-left">
                <?php
                    if ('abcdef' == $f) {
                ?>
                        <input name="number" class="typeahead form-control" type="text" placeholder="Well Number">
                <?php
                    }
                    else {
                ?>
                        <input name="number" class="typeahead form-control" type="text" value=<?php echo $f; ?>>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-xs-4 col-xs-offset-1 text-left">
        Total Number of Slurries:
        <div class="row">
            <div class="col-xs-5 text-left">
                <select  name="slurries" class="selectpicker" data-size="12">
                    <?php
                        for ($z=1;$z<7;$z++) {
                            if ($z == $g) {
                                echo '<option value="' . "$z" . '" selected="selected">' ."$z" . '</option>' ;    
                            }
                            else {
                                echo '<option value="' . "$z" . '">' ."$z" . '</option>' ;
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-xs-2 center-block" style="float:none">
        <div class="form-group">
            <button class="btn my-btn" type="submit">
            Go to Slurry Information 
                <span aria-hidden="true" class="glyphicon glyphicon-arrow-right"></span>
            </button>
        </div>
    </div>
</div>
</fieldset>
</form>
