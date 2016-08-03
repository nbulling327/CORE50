<?php

// configuration
require("../includes/config.php"); 
// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    $rows= CS50::query("SELECT * FROM jobs WHERE complete = 1 ORDER BY job_date DESC");
    $geos=CS50::query("SELECT * FROM places");
    $pumps=CS50::query("SELECT * FROM pumps");
    $peoples = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
  
    $places=[];
    $jobs=[];
    $users=[];
  
    $size=sizeof($rows);
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
    foreach ($peoples as $people)
    {
        $users[0]["firstname"]=$people["firstname"];
        $users[0]["lastname"]=$people["lastname"];
    }

    render("header.php","useranalysisform.php",["title" => "Jobs Analytics","jobs"=>$jobs,"users"=>$users]);
}
?>