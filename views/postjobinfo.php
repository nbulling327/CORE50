<div class="container-fluid">
    <ul class="nav nav-justified">
        <li><a href="/">Input Proposal Information</a></li>
        <li><a id="current" href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="#">View Job Database</a></li>
        <li><a href="#">Analyze Job Data</a></li>
    </ul>
</div>
<br/><br/><br/>
<div class="row">
    <div id="post_well_customer" class="col-xs-5 col-xs-offset-1 text-left">
        <select  name="chosen_company" class="selectpicker" title="Select Customer Name.." data-size="12" data-live-search="true">
            <?php 
                foreach ($jobs as $job) 
                {
                    $company_name=$job["customer"];
                    echo '<option value="' . "$company_name" . '">' ."$company_name" . '</option>' ;
                }
            ?>
        </select>
    </div>
    <div id="post_well_choice" hidden class="col-xs-5 col-xs-offset-1">
        <select  name="job_select" class="selectpicker" title="Select Correct Job.." data-size="12" data-live-search="true">
            <?php 
                foreach ($jobs as $job) 
                {
                    $id=$job["id"];
                    $well_name=$job["well_name"];
                    $well_number=$job["well_number"];
                    $job_type=$job["job_type"];
                    echo '<option value="' . "$id" . '">' ."$well_name" . " " . "$well_number" . " " ."$job_type" . '</option>' ;
                }
            ?>
        </select>    
    </div>
</div>   
<br/><br/><br/>