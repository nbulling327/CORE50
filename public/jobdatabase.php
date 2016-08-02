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

    render("header.php","jobdatabaseform.php",["title" => "Completed Jobs","jobs"=>$jobs,"users"=>$users]);
}
else if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$job_id=$_POST["job"];
$rows= CS50::query("SELECT * FROM jobs WHERE id = ?",$job_id);
$options = CS50::query("SELECT * FROM slurries WHERE job_id = ? ORDER BY id",$job_id);
$peoples = CS50::query("SELECT * FROM users WHERE company = ?","Halliburton");
$jobs=[];
$slurries=[];
$users=[];

foreach ($options as $option)
{
    $slurries[]= [
        "function"=> $option["function"],
        "density"=> $option["density"],
        "avg_rate"=> $option["avg_rate"],
        "dens_acc"=>$option["dens_acc"],
        "des_vol"=>$option["des_vol"],
        "act_vol"=>$option["act_vol"],
        "stage"=>$option["stage"],
        "shutdowns"=>$option["shutdowns"]
        ];
}

foreach ($rows as $row)
{
    $jobs[]= [
        "id"=> $row["id"],
        "customer"=> $row["customer"],
        "stage_count"=> $row["stage_count"],
        "job_type"=> $row["job_type"],
        "well_name"=> $row["well_name"],
        "well_number"=> $row["well_number"],
        "slurries"=> $row["slurries"],
        "avg_disp_rate"=> $row["avg_disp_rate"],
        "dens_accur"=> $row["dens_accur"],
        "shutdowns"=> $row["shutdowns"],
        "slurry_swap_time"=> $row["slurry_swap_time"],
        "plug_shutdown_time"=> $row["plug_shutdown_time"],
        "cem_vol_variance"=> $row["cem_vol_variance"],
        "pumper_id"=> $row["pumper_id"],
        "supervisor_id"=> $row["supervisor_id"],
        "calculated_disp"=> $row["calculated_disp"],
        "act_disp_vol"=> $row["act_disp_vol"]
        ];
}

foreach ($peoples as $people)
{
    if ($jobs[0]["supervisor_id"]==$people["id"])
    {
        $users[0]["supervisor_first_name"]=$people["firstname"];
        $users[0]["supervisor_last_name"]=$people["lastname"];
    }
    else if ($jobs[0]["pumper_id"]==$people["id"])
    {
        $users[0]["pumper_first_name"]=$people["firstname"];
        $users[0]["pumper_last_name"]=$people["lastname"];
    }
    if ($_SESSION["id"]==$people["id"])
    {
        $users[0]["firstname"]=$people["firstname"];
        $users[0]["lastname"]=$people["lastname"];
    }
}

render("header_jobanalysis.php","jobanalysis.php",["title" => "Job Analysis","jobs"=>$jobs,"slurries"=>$slurries,"users"=>$users]);
}
?>