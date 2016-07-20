<?php print_r($_SESSION); ?>
<div class="container-fluid">
    <ul class="nav nav-justified">
        <li><a id="current" href="#">Input Proposal Information</a></li>
        <li><a href="#">Input Post-Job Information</a></li>
        <li><a href="#">View Job Database</a></li>
        <li><a href="#">Analyze Job Data</a></li>
    </ul>
    <br><br><br>
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
    <h4> Please enter job information for the 
        <strong>
<?php echo "$type";?> 
        </strong>
        job being perfored by 
        <b>
<?php echo "$district";?>
        </b>
    </h4>
    <h2><strong>
<?php
    echo "$customer" . ' ' . "$well_name" . ' ' . "$well_number";
?>
    </strong></h2>
    <br/><br/><br/>
<?php
    if(1==$stage_count)
    {
        for($i=0;$i<$slurries;)
        {
?>
    <div class="row">
        <div class="col-xs-5 col-xs-offset-1 text-left">
<?php

            $i=$i+1;
            echo "Slurry "."$i"." information:";
?>
            <select  name="type_<?php echo "$i";?>" class="selectpicker" data-size="10" title="Slurry Function">
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
        <div id="prefetch_density" class="col-xs-5 text-left">
            <input name="density_<?php echo "$i";?>" class="typeahead form-control" type="text" placeholder="Slurry Density (i.e. 12.2)">
            ppg
        </div>
    </div><br/><br/><br/><br/>
<?php
        }
    }
?>
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">
    Add Slurry Information 
        <span aria-hidden="true" class="glyphicon glyphicon-arrow-right"></span>
    </button>
</div>

</fieldset>
</form>