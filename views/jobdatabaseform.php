<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/">Input Proposal Information</a></li>
        <li><a href="/postjob.php">Input Post-Job Information</a></li>
        <li class="active"><a href="/jobdatabase.php">Job Review</a></li>
        <li><a href="#">Jobs Analysis</a></li>
    </ul>
<?php
    $size=sizeof($jobs);
?>


<br/><br/>
    <form action="jobdatabase.php" method="post">
        <fieldset>
            <div class="row">
                <div class="col-xs-3 col-xs-offset-9">
                    <button class="btn my-btn" type="submit" value="submit" name="submit">
                        Review Selected Job
                        <span aria-hidden="true" class="glyphicon glyphicon-arrow-right"></span>
                    </button>
                </div>
            </div>
            <br/>
            <div class="col-xs-1 basetable">
                <div class="row">
                    <div class="col-xs-12 basetable"> Job
                    </div>
                </div>
<?php
            for($j=0;$j<$size;$j++)
            {
?>              
                <div class="row basetable">
                            <input type="radio" name="job" value="<?php echo $jobs[$j]["id"];?>"> Review Job
                </div>
<?php
            }
?>
            </div>
            <div class="col-xs-11 basetable">
            <div class="row">
                <div class="col-xs-2 basetable">
                    Job Date
                </div>
                <div class="col-xs-2 basetable">
                    Region
                </div>
                <div class="col-xs-2 basetable">
                    Area
                </div>
                <div class="col-xs-2 basetable">
                    Customer
                </div>
                <div class="col-xs-2 basetable">
                    District
                </div>
                <div class="col-xs-2 basetable">
                    Well
                </div>
            </div>
<?php
            for($i=0;$i<$size;$i++)
            {
?>
            <div class="row">
                <div class="col-xs-2 basetable">
<?php                    
                    echo $jobs[$i]["date"];
?>
                </div>
                <div class="col-xs-2 basetable">
<?php                    
                    echo $jobs[$i]["region"];
?>
                </div>
                <div class="col-xs-2 basetable">
<?php                    
                    echo $jobs[$i]["area"];
?>
                </div>
                <div class="col-xs-2 basetable">
<?php                    
                    echo $jobs[$i]["customer"];
?>
                </div>
                <div class="col-xs-2 basetable">
<?php                    
                    echo $jobs[$i]["district"];
?>
                </div>
                <div class="col-xs-2 basetable">
<?php                    
                    echo $jobs[$i]["well"];
?>
                </div>
            </div>
<?php
            }
?>