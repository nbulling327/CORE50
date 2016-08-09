<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/">Input Proposal Information</a></li>
        <li><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="/jobdatabase.php">Job Review</a></li>
        <li class="active"><a href="/jobanalysis.php">Jobs Analysis</a></li>
    </ul>
</div>
<div class = "container-fluid" id="futura">
<?php
//var_dump($_POST);
?>


<div class= "col-xs-12 text-center">
    <div class="row" id="futura">
        <div id="chart_div" style="width:840px;height:420px"></div>
    </div>
    

    <div class = "row">
        <div id="dom-target-chart_type" style="display: none;">
<?php 
            $output = $_POST["chart_type"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-begin_date" style="display: none;">
<?php 
            $output = $_POST["begin_date"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-end_date" style="display: none;">
<?php 
            $output = $_POST["end_date"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-geo_filter" style="display: none;">
<?php 
            $output = $_POST["geo_filter"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-filter1" style="display: none;">
<?php 
            $output = $_POST["filter1"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-chosen_company" style="display: none;">
<?php 
            $output = $_POST["chosen_company"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-xaxis" style="display: none;">
<?php 
            $output = $_POST["xaxis"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-yaxis" style="display: none;">
<?php 
            $output = $_POST["yaxis"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
        <div id="dom-target-series" style="display: none;">
<?php 
            $output = $_POST["series"]; //Again, do some operation, get the output.
            echo htmlspecialchars($output); /* You have to escape because the result
                                               will not be valid HTML otherwise. */
?>
        </div>
    </div>
</div>