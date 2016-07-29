<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/">Input Proposal Information</a></li>
        <li class="active"><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="#">View Job Database</a></li>
        <li><a href="#">Analyze Job Data</a></li>
    </ul>
</div>
<?php
            $customer = $jobs[0]["customer"];
            $type = $jobs[0]["job_type"];
            $well_name = $jobs[0]["well_name"];
            $well_number = $jobs[0]["well_number"];
            $stage_count = $jobs[0]["stage_count"];
            $number_slurries = $jobs[0]["number_slurries"];
            $job_id=$jobs[0]["id"];
            
?>
<div class = "container">
<div class= "col-xs-7">
    <h3><?php echo $customer." ".$well_name." ".$well_number." ".$type." Job Chart"?></h3>
    <div id="flot-placeholder" style="width:700px;height:350px"></div>
</div>
<div class= "col-xs-5">
    <br/><br/>
    <form action = "postjobentered.php" method="post" enctype="multipart/form-data">
        <div class = "row">
            <div class = "col-xs-6 col-xs-offset-3">
                <div id="overview" style="width:240px;height:120px"></div>
            </div>
        </div>
<?php
        if(1==$stage_count)
        {
            for($i=0;$i<$number_slurries;)
            {
?>
                <div class="row">
                    <div class = "col-xs-6">
                        <div class = "col-xs-10 col-xs-offset-2">
<?php
                            echo "Start " .$slurries[$i]["function"].":";
?>
                        </div>
                    </div>
                    <div class = "col-xs-6">
                        <div class = "col-xs-10 col-xs-offset-2">
<?php
                            echo "Finish " .$slurries[$i]["function"].":";
                            $i=$i+1;
?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class = "col-xs-6">
                        <div class = "col-xs-10 col-xs-offset-2">
                            <div class="input-group input-group-sm">
                                <input autocomplete="off" autofocus class="form-control" name="slurry_<?php echo "$i";?>_start" placeholder="Start Time (i.e. 25.4)" type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class = "col-xs-6">
                        <div class = "col-xs-10 col-xs-offset-2">
                            <div class="input-group input-group-sm">
                                <input autocomplete="off" autofocus class="form-control" name="slurry_<?php echo "$i";?>_stop" placeholder="Stop Time (i.e. 25.4)" type="text"/>
                            </div>
                        </div>
                    </div>
                </div>
<?php
            }    
        }        
        else
        {
            for($i=0;$i<$number_slurries;)
            {
?>
                <div class="row">
                    <div class = "col-xs-6">
                        <div class = "col-xs-10 col-xs-offset-2">
<?php
                            echo "Start Stage " .$slurries[$i]["stage"]." ".$slurries[$i]["function"].":";
?>
                        </div>
                    </div>
                    <div class = "col-xs-6">
                        <div class = "col-xs-10 col-xs-offset-2">
<?php
                            echo "Finish Stage " .$slurries[$i]["stage"]." ".$slurries[$i]["function"].":";
                            $i=$i+1;
?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class = "col-xs-6">
                        <div class = "col-xs-10 col-xs-offset-2">
                            <div class="input-group input-group-sm">
                            <input autocomplete="off" autofocus class="form-control" name="slurry_<?php echo "$i";?>_start" placeholder="Start Time (i.e. 25.4)" type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class = "col-xs-6">
                        <div class = "col-xs-10 col-xs-offset-2">
                            <div class="input-group input-group-sm">
                                <input autocomplete="off" autofocus class="form-control" name="slurry_<?php echo "$i";?>_stop" placeholder="Stop Time (i.e. 25.4)" type="text"/>
                            </div>
                        </div>
                    </div>
                </div>
<?php
            }    
        }        
?>

        <div class="row">
            <div class = "col-xs-6">
                <div class = "col-xs-10 col-xs-offset-2">
                    Start Displacement:
                </div>
            </div>
            <div class = "col-xs-6">
                <div class = "col-xs-10 col-xs-offset-2">
                    Finish Displacement:
                </div>
            </div>
        </div>
        <div class="row">
            <div class = "col-xs-6">
                <div class = "col-xs-10 col-xs-offset-2">
                    <div class="input-group input-group-sm">
                        <input autocomplete="off" autofocus class="form-control" name="displacement_start" placeholder="Displacement Start" type="text"/>
                    </div>
                </div>
            </div>
            <div class = "col-xs-6">
                <div class = "col-xs-10 col-xs-offset-2">
                    <div class="input-group input-group-sm">
                        <input autocomplete="off" autofocus class="form-control" name="displacement_stop" placeholder="Displacement Stop" type="text"/>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-xs-12">
                <button class="btn my-btn" type="submit" value="<?php echo $job_id;?>" name="submit">
                        Complete Job Submission
                    <span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </form>
</div>
</div>