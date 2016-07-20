<?php
    // configuration
    require("../includes/config.php"); 
    $rows= CS50::query("SELECT * FROM jobs WHERE complete = ? ORDER BY customer", 'FALSE');
    $slurries= CS50::query("SELECT * FROM slurries ORDER BY job_id");
        render("postjobinfo.php",["title" => "Post Job Entry","jobs"=>$rows,"slurries"=>$slurries]);
?>