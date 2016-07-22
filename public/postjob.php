<?php
    // configuration
    require("../includes/config.php"); 
    $jobs= CS50::query("SELECT * FROM jobs WHERE complete = ? ORDER BY customer", 'FALSE');
    $slurries= CS50::query("SELECT * FROM slurries ORDER BY job_id");
    $rows= CS50::query("SELECT * FROM users WHERE id=?",$_SESSION["id"]);
    $users = [];
    foreach ($rows as $row)
    {
        $users[] = [
        "firstname" => $row["firstname"],
        "lastname" => $row["lastname"],
        ];
    }
    render("header.php","postjobinfo.php",["title" => "Post Job Entry","jobs"=>$jobs,"slurries"=>$slurries,"users"=>$users]);
?>