<?php

// configuration
require("../includes/config.php"); 
// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    $rows= CS50::query("SELECT * FROM jobs WHERE complete = 1 ORDER BY job_date DESC");
    $jobs = [];
    $size=sizeof($rows);
    $geos=CS50::query("SELECT * FROM places");
    $places=[];
    $all_places=sizeof($geos);
    foreach ($geos as $geo)
    {
        $places[]=[
            "district"=>$geo["district"],
            "area"=>$geo["area"],
            "region"=>$geo["region"]
            ];
    }

    foreach ($rows as $row)
    {
        for($i=0;$i<$all_places;$i++)
        {
            if($row["district"]==$places[$i]["district"])
            {
                $area=$places[$i]["area"];
                $region=$places[$i]["region"];
            }
        }
        $jobs[]= [
            "id"=>$row["id"],
            "date"=> $row["job_date"],
            "district"=> $row["district"],
            "area"=>$area,
            "region"=>$region,
            "customer"=> $row["customer"],
            "job_type"=> $row["job_type"],
            "well"=> $row["well_name"]." ".$row["well_number"],
            "dens_acc"=>$row["dens_accur"]
            ];
    }

    $peoples = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    $users=[];
    foreach ($peoples as $people)
    {
        $users[0]["firstname"]=$people["firstname"];
        $users[0]["lastname"]=$people["lastname"];
    }

    render("header_review.php","edit_jobs_form.php",["title" => "Edit Complete Jobs","jobs"=>$jobs,"users"=>$users]);
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!isset($_POST["job"])) {
    apologize("You must select a job.");
    }
    $job_id=$_POST["job"];
    if(1==$_POST["submit"]) {
        $job_id=$_POST["job"];
        $rows= CS50::query("DELETE FROM jobs WHERE id = ?", $job_id);
        redirect("proposal.php");
    }
    if(2==$_POST["submit"]) {
        $job_id=$_POST["job"];
        
        redirect("proposal.php");
    }
    
}
?>