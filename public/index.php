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
    $prev_comp="";
    
    $comps= CS50::query("SELECT * FROM jobs WHERE complete = 1 ORDER BY customer");
        $options = [];
        foreach ($comps as $comp)
        {
            if(strcmp($prev_comp, $comp["customer"])!=0)
            $options[] = [
            "company_option" => $comp["customer"],
            ];
            $prev_comp=$comp["customer"];
        }
    


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

    foreach ($peoples as $people)
    {
        $users[0]["firstname"]=$people["firstname"];
        $users[0]["lastname"]=$people["lastname"];
        $userdistrict=$people["district"];
        $users[0]["company"] = $people["company"];
    }
    
$_POST["chart_type"] = "bar";
$_POST["xaxis"] = "date";
$_POST["yaxis"] = "density";
$_POST["begin_date"]="";
$_POST["end_date"]="";
    
if (strcmp('Halliburton', $users[0]["company"])==0) {
    $_POST["chosen_company"]="";
    $_POST["geo_filter"] = "district";
    $_POST["filter1"] = $userdistrict;
    $_POST["series"]="";
    render("header_jobs_analysis.php","overallanalysis.php",["title" => "Jobs Analytics","jobs"=>$jobs,"options"=>$options,"users"=>$users]);    
}
else {
    $_POST["chosen_company"]=$users[0]["company"];
    $_POST["geo_filter"] = "0";
    $_POST["series"]="0";
    render("header_jobs_analysis.php","customer_overallanalysis.php",["title" => "Jobs Analytics","jobs"=>$jobs,"options"=>$options,"users"=>$users]);
}

} 