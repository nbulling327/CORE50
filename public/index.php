<!--
Created by Nick Bullington
A method of tracking on-location cement job results for improvement.

CORE
-->

<?php
    // configuration
    require("../includes/config.php"); 

    $rows= CS50::query("SELECT * FROM companies ORDER BY company");
        $options = [];
        foreach ($rows as $row)
        {
            $options[] = [
            "company_option" => $row["company"],
            ];
        }
    $rows= CS50::query("SELECT * FROM jobtypes ORDER BY type");
        $jobs = [];
        foreach ($rows as $row)
        {
            $primsec = "secondary";
            if($row["primary"]==1)
            {
                $primsec = "primary";
            }
            $jobs[] = [
            "jobtype" => $row["type"],
            "primsec" => $primsec
            ];
        }
    $rows= CS50::query("SELECT * FROM places ORDER BY district");
        $districts = [];
        foreach ($rows as $row)
        {
            $districts[] = [
            "district" => $row["district"],
            ];
        }
    $rows= CS50::query("SELECT * FROM users WHERE id=?",$_SESSION["id"]);
        $users = [];
        foreach ($rows as $row)
        {
            $users[] = [
            "firstname" => $row["firstname"],
            "lastname" => $row["lastname"],
            ];
        }
        render("header.php","data.php",["title" => "Main Page","options"=>$options,"jobs"=>$jobs,"districts"=>$districts,"users"=>$users]);
?>