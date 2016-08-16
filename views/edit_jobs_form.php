<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/proposal.php">Input Proposal Information</a></li>
        <li><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="/jobdatabase.php">Job Review</a></li>
        <li><a href="/jobanalysis.php">Jobs Analysis</a></li>
    </ul>
<?php
    $size=sizeof($jobs);
?>
    <br/>
    <form action="edit_complete_jobs.php" method="post">
        <fieldset>
            <div class="row">
                <div class="col-xs-3 col-xs-offset-3">
                    <button onClick="return confirm('Are you sure you want to reenter job info?  This will delete the current job.')" class="btn my-btn" type="submit" value="1" name="submit">
                        Reenter Proposal Info
                        <span aria-hidden="true" class="glyphicon glyphicon-pencil"></span>
                    </button>
                </div>
                <div class="col-xs-3">
                    <button onClick="return confirm('Are you sure you want to reload CSV?')" class="btn my-btn" type="submit" value="2" name="submit">
                        Reupload CSV Data
                        <span aria-hidden="true" class="glyphicon glyphicon-open-file"></span>
                    </button>
                </div>
                </div>
            </br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-condensed" id="joblisting">
                    <thead>
                        <tr>
                            <th>Select</th>    
                            <th>Job Date</th>
                            <th>Region</th>
                            <th>Area</th>
                            <th>District</th>
                            <th>Customer</th>
                            <th>Well</th>
                            <th>Job Type</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
                    for($i=0;$i<$size;$i++)
                    {
?>              
                        <tr>
                            <td><input type="radio" name="job" value="<?php echo $jobs[$i]["id"];?>"> </td>
                            <td><?php echo $jobs[$i]["date"]; ?></td>
                            <td><?php echo $jobs[$i]["region"]; ?></td>
                            <td><?php echo $jobs[$i]["area"]; ?></td>
                            <td><?php echo $jobs[$i]["district"]; ?></td>
                            <td><?php echo $jobs[$i]["customer"]; ?></td>
                            <td><?php echo $jobs[$i]["well"]; ?></td>
                            <td><?php echo $jobs[$i]["job_type"]; ?></td>
                        </tr>
<?php
            }
?>            
                    </tbody>
                </table>
            </div>
        </fieldset>
    </form>
</div>    