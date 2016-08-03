<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/">Input Proposal Information</a></li>
        <li><a href="/postjob.php">Input Post-Job Information</a></li>
        <li class="active"><a href="/jobdatabase.php">Job Review</a></li>
        <li><a href="/jobanalysis.php">Jobs Analysis</a></li>
    </ul>
</div>
<?php
            $job_id=$jobs[0]["id"];
            $customer = $jobs[0]["customer"];
            $stage_count = $jobs[0]["stage_count"];
            $type = $jobs[0]["job_type"];
            $well_name = $jobs[0]["well_name"];
            $well_number = $jobs[0]["well_number"];
            $number_slurries = $jobs[0]["slurries"];
            $avg_disp_rate = $jobs[0]["avg_disp_rate"];
            $dens_accur = $jobs[0]["dens_accur"];
            $shutdowns = $jobs[0]["shutdowns"];
            $slurry_swap_time = $jobs[0]["slurry_swap_time"];
            $plug_shutdown_time = $jobs[0]["plug_shutdown_time"];
            $cem_vol_variance = $jobs[0]["cem_vol_variance"];
            $calculated_disp = $jobs[0]["calculated_disp"];
            $act_disp_vol = $jobs[0]["act_disp_vol"];
            $supervisor_name = $users[0]["supervisor_first_name"] . " " . $users[0]["supervisor_last_name"];
            $pumper_name = $users[0]["pumper_first_name"] . " " . $users[0]["pumper_last_name"];
?>
<div class = "container-fluid" id="futura">
    <div class= "col-xs-8 text-center">
        <div class="row" id="futura">
            <h3><?php echo $customer." ".$well_name." ".$well_number." ".$type." Chart Analysis"?></h3>
            <div id="flot-placeholder_analysis" style="width:750px;height:380px"></div>
        </div>
        <br/>
        <div class = "row">
            <div class= "col-xs-6" id="futura">
                Supervisor: <?php echo " ".$supervisor_name; ?>
            </div>
            <div class= "col-xs-6">
                Pump Operator: <?php echo " ".$pumper_name; ?>
            </div>
        </div>
        <div class = "row">
            <div id="dom-target" style="display: none;">
                <?php 
                    $output = $job_id."s"; //Again, do some operation, get the output.
                    echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
                ?>
            </div>
        </div>    
    </div>
    <div class= "col-xs-4 text-center">
        <br/>
        <div class= "col-xs-12" style="border: 1px solid #B00404; border-radius: 25px; background: #B00404;">
            <div class = "row" style="color: #fff">
                <h4 class="display-4"><strong>Job Summary</strong></h4>
            </div>
            <div class = "row" style="background: #fff;">
                <div class= "col-xs-6" style="border: 1px solid #B00404;">
                    Density Accuracy
                </div>
                <div class= "col-xs-6" style="border: 1px solid #B00404;">
                    Shutdowns > 2 min
                </div>
            </div>
            <div class = "row" style="background: #C8C7C7;">
                <div class= "col-xs-6" style="border: 1px solid #B00404;">
                    <?php echo round($dens_accur,1)." "; ?>%
                </div>
                <div class= "col-xs-6" style="border: 1px solid #B00404;">
                    <?php echo $shutdowns; ?>
                </div>
            </div>
            <div class = "row" style="background: #fff;">
                <div class= "col-xs-6" style="border: 1px solid #B00404;">
                    Ave Slurry Swap Time
                </div>
                <div class= "col-xs-6" style="border: 1px solid #B00404;">
                    Top Plug Shutdown
                </div>
            </div>
            <div class = "row" style="background: #C8C7C7;">
                <div class= "col-xs-6" style="border: 1px solid #B00404;">
                    <?php echo round($slurry_swap_time,1)." "; ?>min
                </div>
                <div class= "col-xs-6" style="border: 1px solid #B00404;">
                    <?php echo round($plug_shutdown_time,1)." "; ?>min
                </div>
            </div>
            <br/>
        </div>
        <div>&nbsp;</div>
        
        <div class= "col-xs-12" style="border: 1px solid #B00404; border-radius: 25px; background: #B00404;">
            <div class = "row" style="color: #fff">
                <h4 class="display-4"><strong>Job Details</strong></h4>
            </div>
        
<?php       if($stage_count==1)
            {
                for ($i=0;$i<$number_slurries;$i++)
                {
?>
                    <div class = "row">
                        <div class= "col-xs-12" style="border: 1px solid #B00404; background: #FAC0C0;">
                            <h4><b><?php echo $slurries[$i]["function"]; ?></b></h4>
                        </div>
                    </div>
                    <div class = "row" style="background: #fff;">
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Designed Density
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Cement in Spec
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Shutdowns > 2 min
                        </div>
                    </div>
                    <div class = "row" style="background: #C8C7C7;">
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo round($slurries[$i]["density"],2)." "; ?>lb/gal
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo round($slurries[$i]["dens_acc"],1)." "; ?>%
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo $slurries[$i]["shutdowns"]; ?>
                        </div>
                    </div>
    
                    <div class = "row" style="background: #fff;">
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Designed Volume
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Actual Volume
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Average Rate
                        </div>
                    </div>
                    <div class = "row" style="background: #C8C7C7;">
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo round($slurries[$i]["des_vol"],2)." "; ?>bbl
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo round($slurries[$i]["act_vol"],2)." "; ?>bbl
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo round($slurries[$i]["avg_rate"],2)." "; ?>bpm
                        </div>
                    </div>
<?php
                }
            }
            else
            {
                for ($i=0;$i<$number_slurries;$i++)
                {
?>
                    <div class = "row">
                        <div class= "col-xs-12" style="border: 1px solid #B00404; background: #FAC0C0;">
                            <h4><b><?php echo "Stage ".$slurries[$i]["stage"]." ".$slurries[$i]["function"]; ?></b></h4>
                        </div>
                    </div>
                    <div class = "row" style="background: #fff;">
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Designed Density
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Cement in Spec
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Shutdowns > 2 min
                        </div>
                    </div>
                    <div class = "row" style="background: #C8C7C7;">
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo round($slurries[$i]["density"],2)." "; ?>lb/gal
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo round($slurries[$i]["dens_acc"],1)." "; ?>%
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo $slurries[$i]["shutdowns"]; ?>
                        </div>
                    </div>
                    <div class = "row" style="background: #fff;">
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Designed Volume
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Actual Volume
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            Average Rate
                        </div>
                    </div>
                    <div class = "row" style="background: #C8C7C7;">
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo round($slurries[$i]["des_vol"],2)." "; ?>bbl
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo round($slurries[$i]["act_vol"],2)." "; ?>bbl
                        </div>
                        <div class= "col-xs-4" style="border: 1px solid #B00404;">
                            <?php echo round($slurries[$i]["avg_rate"],2)." "; ?>bpm
                        </div>
                    </div>
<?php
                }
            }
?>        
            <div class = "row">
                <div class= "col-xs-12" style="border: 1px solid #B00404; background: #FAC0C0;">
                    <h4><b>Displacement</b></h4>
                </div>
            </div>
            
            <div class = "row" style="background: #fff;">
                <div class= "col-xs-4" style="border: 1px solid #B00404;">
                    Designed Volume
                </div>
                <div class= "col-xs-4" style="border: 1px solid #B00404;">
                    Actual Volume
                </div>
                <div class= "col-xs-4" style="border: 1px solid #B00404;">
                    Average Rate
                </div>
            </div>
            <div class = "row" style="background: #C8C7C7;">
                <div class= "col-xs-4" style="border: 1px solid #B00404;">
                    <?php echo round($calculated_disp,2)." "; ?>bbl
                </div>
                <div class= "col-xs-4" style="border: 1px solid #B00404;">
                    <?php echo round($act_disp_vol,2)." "; ?>bbl
                </div>
                <div class= "col-xs-4" style="border: 1px solid #B00404;">
                    <?php echo round($avg_disp_rate,2)." "; ?>bpm
                </div>
            </div>
            <br/>
        </div>
    </div>
</div>