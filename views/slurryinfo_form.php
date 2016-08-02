<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="/">Input Proposal Information</a></li>
        <li><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="/jobdatabase.php">View Job Database</a></li>
        <li><a href="#">Analyze Job Data</a></li>
    </ul>
    <br><br>
    <form action="completedprejob.php" method="post">
        <fieldset>
<?php
            $district = $options[0]["district"];
            $customer = $options[0]["customer"];
            $type = $options[0]["job_type"];
            $well_name = $options[0]["well_name"];
            $well_number = $options[0]["well_number"];
            $stage_count = $options[0]["stage_count"];
            $slurries = $options[0]["slurries"];
?>        
                <div class="row">
                    <div class="col-xs-5">
                        <div class="col-xs-11 col-xs-offset-1">
                        <br/>
                        <h4> Please enter job information for the 
                            <strong>
                                <?php echo "$type";?> 
                            </strong>
                            job being perfored by 
                            <b>
                                <?php echo "$district";?>
                            </b>
                            :
                        </h4>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <h2>
                            <strong>
                                <?php
                                    echo "$customer" . ' ' . "$well_name" . ' ' . "$well_number";
                                ?>
                            </strong>
                        </h2>
                    </div>
                </div>
                <br/><br/>
<?php
                if(1==$stage_count)
                {
                    for($i=0;$i<$slurries;)
                    {
?>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-1 text-left">
<?php
                                $i=$i+1;
                                echo "Slurry "."$i"." information:";
?>
                                <select  name="type_<?php echo "$i";?>" class="selectpicker" data-size="8" title="Slurry Function">
                                    <option value="Lead">Lead</option>
                                    <option value="Tail">Tail</option>
                                    <option value="primary">Primary</option>
                                    <option value="Scavenger">Scavenger</option>
                                    <option value="Cap">Cap</option>
                                    <option value="top_out">Top Out</option>
                                    <option value="foam_lead">Foamed Lead</option>
                                    <option value="bead_lead">Glass Bead Lead</option>
                                    <option value="bead_tail">Glass Bead Tail</option>
                                    </select>
                            </div>
                            <div id="prefetch_density" class="col-xs-3 text-left">
                                <input name="density_<?php echo "$i";?>" class="typeahead form-control" type="text" placeholder="Slurry Density (i.e. 12.2)">
                                    ppg
                            </div>
                            
                                <input name="designvolume_<?php echo "$i";?>" class="form-control" type="text" placeholder="Designed Slurry Volume">
                                    bbl

                        </div><br/>
<?php
                    }
                }
                else
                {
                    for($i=0;$i<$slurries;)
                    {
?>        
                        <div class="row">
                            <div class="col-xs-5 text-left">
                                <div class="col-xs-5 col-xs-offset-1">        
<?php
                                    $i=$i+1;
                                    echo "Slurry "."$i"." information:";
?>                
                                    <div class="row">
                                        <select  name="slurry_<?php echo "$i";?>_stage" class="selectpicker" data-size="8" title="Stage Number">
                                        
<?php                           
                                            for($j=0;$j<$stage_count;)
                                            {
                                                $j=$j+1;
?>                  
                                                <option value=<?php echo "$j";?>>Stage <?php echo "$j";?></option>
<?php   
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-5 col-xs-offset-1">
                                    <br/>
                                    <select  name="type_<?php echo "$i";?>" class="selectpicker" data-size="8" title="Slurry Function">
                                        <option value="Scavenger">Scavenger</option>
                                        <option value="Lead">Lead</option>
                                        <option value="Tail">Tail</option>
                                        <option value="Cap">Cap</option>
                                        <option value="top_out">Top Out</option>
                                        <option value="foam_lead">Foamed Lead</option>
                                        <option value="bead_lead">Glass Bead Lead</option>
                                        <option value="bead_tail">Glass Bead Tail</option>
                                    </select>
                                    
                                </div>    
                            </div>
                            <div class="col-xs-7">
                                <br/>
                                <div class="col-xs-5 col-xs-offset-1">
                                    
                                    <div id="prefetch_density">
                                        <input name="density_<?php echo "$i";?>" class="typeahead form-control" type="text" placeholder="Slurry Density (i.e. 12.2)">
                                            ppg
                                    </div>
                                </div>
                                <div class="col-xs-5 col-xs-offset-1">
                                    
                                    <input name="designvolume_<?php echo "$i";?>" class="form-control" type="text" placeholder="Designed Slurry Volume">
                                        bbl
                                </div>
                            </div>
                        </div><br/>
<?php
                    }
                }
?>
            </div>
            <div class="col-xs-2 center-block" style="float:none">
                <div class="form-group">
                    <button class="btn my-btn" type="submit">
                        Add Slurry Information 
                        <span aria-hidden="true" class="glyphicon glyphicon-arrow-right"></span>
                    </button>
                </div>
            </div>
        </fieldset>
    </form>
</div>