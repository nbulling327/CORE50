<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/">Input Proposal Information</a></li>
        <li class="active"><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="/jobdatabase.php">View Job Database</a></li>
        <li><a href="#">Analyze Job Data</a></li>
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
    <div class= "col-xs-4 text-center" style="border: 2px solid black">
        <div class = "row">
            <div class= "col-xs-12">
                <h3>Job Analysis</h3>
            </div>
        </div>
                
<?php   if($stage_count==1)
        {
            for ($i=0;$i<$number_slurries;$i++)
            {
?>
            <div class = "row">
                <div class= "col-xs-12">
                    <h4><?php echo $slurries[$i]["function"]; ?></h4>
                </div>
            </div>
            <div class = "row" id="backgroundred">
                <div class= "col-xs-4">
                    Designed Density
                </div>
                <div class= "col-xs-4">
                    Cement in Spec
                </div>
                <div class= "col-xs-4">
                    # of Shutdowns
                </div>
            </div>
            <div class = "row" id="backgroundgray">
                <div class= "col-xs-4">
                    <?php echo round($slurries[$i]["density"],2)." "; ?>lb/gal
                </div>
                <div class= "col-xs-4">
                    <?php echo round($slurries[$i]["dens_acc"],1)." "; ?>%
                </div>
                <div class= "col-xs-4">
                    <?php echo $slurries[$i]["shutdowns"]; ?>
                </div>
            </div>
            <br/>
            <div class = "row" id="backgroundred">
                <div class= "col-xs-4">
                    Designed Volume
                </div>
                <div class= "col-xs-4">
                    Actual Volume
                </div>
                <div class= "col-xs-4">
                    Average Rate
                </div>
            </div>
            <div class = "row" id="backgroundgray">
                <div class= "col-xs-4">
                    <?php echo round($slurries[$i]["des_vol"],2)." "; ?>bbl
                </div>
                <div class= "col-xs-4">
                    <?php echo round($slurries[$i]["act_vol"],2)." "; ?>bbl
                </div>
                <div class= "col-xs-4">
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
                    <div class= "col-xs-12">
                        <h4><?php echo "Stage ".$slurries[$i]["stage"]." ".$slurries[$i]["function"]; ?></h4>
                    </div>
                </div>
                <div class = "row" id="backgroundred">
                    <div class= "col-xs-4">
                        Designed Density
                    </div>
                    <div class= "col-xs-4">
                        Cement in Spec
                    </div>
                    <div class= "col-xs-4">
                        # of Shutdowns
                    </div>
                </div>
                <div class = "row" id="backgroundgray">
                    <div class= "col-xs-4">
                        <?php echo round($slurries[$i]["density"],2)." "; ?>lb/gal
                    </div>
                    <div class= "col-xs-4">
                        <?php echo round($slurries[$i]["dens_acc"],1)." "; ?>%
                    </div>
                    <div class= "col-xs-4">
                        <?php echo $slurries[$i]["shutdowns"]; ?>
                    </div>
                </div>
                <br/>
                <div class = "row" id="backgroundred">
                    <div class= "col-xs-4">
                        Designed Volume
                    </div>
                    <div class= "col-xs-4">
                        Actual Volume
                    </div>
                    <div class= "col-xs-4">
                        Average Rate
                    </div>
                </div>
                <div class = "row" id="backgroundgray">
                    <div class= "col-xs-4">
                        <?php echo round($slurries[$i]["des_vol"],2)." "; ?>bbl
                    </div>
                    <div class= "col-xs-4">
                        <?php echo round($slurries[$i]["act_vol"],2)." "; ?>bbl
                    </div>
                    <div class= "col-xs-4">
                        <?php echo round($slurries[$i]["avg_rate"],2)." "; ?>bpm
                    </div>
                </div>
<?php
            }
        }
?>        
        <div class = "row">
            <div class= "col-xs-12"">
                    <h4>Displacement</h4>
            </div>
        </div>
        
        <div class = "row" id="backgroundred">
            <div class= "col-xs-4">
                Designed Volume
            </div>
            <div class= "col-xs-4">
                Actual Volume
            </div>
            <div class= "col-xs-4">
                Average Rate
            </div>
        </div>
        <div class = "row" id="backgroundgray">
            <div class= "col-xs-4">
                <?php echo round($calculated_disp,2)." "; ?>bbl
            </div>
            <div class= "col-xs-4">
                <?php echo round($act_disp_vol,2)." "; ?>bbl
            </div>
            <div class= "col-xs-4">
                <?php echo round($avg_disp_rate,2)." "; ?>bpm
            </div>
        </div>
        <br/>
        <div style="border: 2px solid black">
            <div class = "row">
                <div class= "col-xs-12">
                    <h4 class="display-4"><strong>Job Stats</strong></h4>
                </div>
            </div>
            <div class = "row">
                <div class= "col-xs-6">
                    Cement Density Accuracy
                </div>
                <div class= "col-xs-6">
                    Number of Shutdowns
                </div>
            </div>
            <div class = "row">
                <div class= "col-xs-6">
                    <?php echo round($dens_accur,1)." "; ?>%
                </div>
                <div class= "col-xs-6">
                    <?php echo $shutdowns; ?>
                </div>
            </div>
            <br/>
            <div class = "row">
                <div class= "col-xs-6">
                    Average Slurry Swap Time
                </div>
                <div class= "col-xs-6">
                    Top Plug Shutdown Length
                </div>
            </div>
            <div class = "row">
                <div class= "col-xs-6">
                    <?php echo round($slurry_swap_time,1)." "; ?>min
                </div>
                <div class= "col-xs-6">
                    <?php echo round($plug_shutdown_time,1)." "; ?>min
                </div>
            </div>
        </div>
    </div>
</div>