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
    <br/><br/>
    <form action="delete_proposals.php" method="post">
        <fieldset>
            <div class="row">
                <div class="col-xs-12">
                    <button id="delete_job" onClick="return confirm('Are you absolutely sure you want to delete?')" class="btn my-btn" type="submit" value="submit" name="submit">
                        Delete Selected Job
                        <span aria-hidden="true" class="glyphicon glyphicon-trash"></span>
                    </button>
                </div>
            </div>
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