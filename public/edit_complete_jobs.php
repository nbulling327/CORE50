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
    $job_to_edit=[];
    $job_id=$_POST["job"];
    if(1==$_POST["submit"]) {
        $rows= CS50::query("SELECT * FROM jobs WHERE id = ?", $job_id);
        
        foreach ($rows as $row) {
            $job_to_edit[] = [
            "district" => $row["district"],
            "customer" => $row["customer"],
            "job_type" => $row["job_type"],
            "stage_count" => $row["stage_count"],
            "well_name" => $row["well_name"],
            "well_number" => $row["well_number"],
            "slurries" => $row["slurries"],
            ];
        }
        
        CS50::query("DELETE FROM jobs WHERE id = ?", $job_id);
        CS50::query("DELETE FROM slurries WHERE job_id = ?", $job_id);
        
        $rows= CS50::query("SELECT * FROM companies ORDER BY company");
        $options = [];
        foreach ($rows as $row) {
            $options[] = [
            "company_option" => $row["company"],
            ];
        }
        
        $rows= CS50::query("SELECT * FROM jobtypes ORDER BY type");
        $jobs = [];
        foreach ($rows as $row) {
            $primsec = "secondary";
            if($row["primary"]==1) {
                $primsec = "primary";
            }
            $jobs[] = [
            "jobtype" => $row["type"],
            "primsec" => $primsec
            ];
        }
        
        $rows= CS50::query("SELECT * FROM places ORDER BY district");
        $districts = [];
        foreach ($rows as $row) {
            $districts[] = [
            "district" => $row["district"],
            ];
        }
        
        $rows= CS50::query("SELECT * FROM users WHERE id=?",$_SESSION["id"]);
        $users = [];
        foreach ($rows as $row) {
            $users[] = [
            "firstname" => $row["firstname"],
            "lastname" => $row["lastname"],
            ];
        }
         
        render("header.php","data.php",["title" => "Proposal Info","options"=>$options,"job_to_edit"=>$job_to_edit,"jobs"=>$jobs,"districts"=>$districts,"users"=>$users]);
    }
    if(2==$_POST["submit"]) {
        
        $rows= CS50::query("SELECT * FROM jobs WHERE id = ?", $job_id);
        
        foreach ($rows as $row) {
            $job_to_edit[] = [
            "customer" => $row["customer"],
            "supervisor" => $row["job_type"],
            "pumper" => $row["stage_count"],
            "unit" => $row["well_name"],
            "displacement" => $row["well_number"],
            "slurries" => $row["slurries"],
            ];
        }
        
        /* Edit out complete, pressure, rate, density, time column analysis info */
        
        CS50::query("DELETE FROM jobs WHERE id = ?", $job_id);
        CS50::query("DELETE FROM slurries WHERE job_id = ?", $job_id);
        
        
        $rows= CS50::query("SELECT * FROM jobs WHERE complete = ? ORDER BY customer", 'FALSE');
        $prev_customer = "blank";
        foreach ($rows as $row)
        {
            if($prev_customer!=$row["customer"])
            {
            $customers[] = [
            "customer" => $row["customer"],
            ];
            }
            $prev_customer=$row["customer"];
        }
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
        $employees= CS50::query("SELECT * FROM users WHERE company = ? ORDER BY firstname","Halliburton");
        $pumpers =[];
        $supervisors=[];
        foreach($employees as $employee)
        {
            if(1==$employee["pumper"])
            {
                $pumpers[]= [
                    "id" => $employee["id"],
                    "name" => $employee["firstname"] . " " . $employee["lastname"], 
                    ];
            }
            if(1==$employee["supervisor"])
            {
                $supervisors[]= [
                    "id" => $employee["id"],
                    "name" => $employee["firstname"] . " " . $employee["lastname"], 
                    ];
            }
        }
        $units = CS50::query("SELECT * FROM pumps ORDER BY pump");
        $pumps =[];
        foreach($units as $unit)
        {
            $pumps[]= [
                    "id" => $unit["id"],
                    "pump" => $unit["pump"], 
                    ];
        }
        render("header.php","postjobinfo.php",["title" => "Post Job Entry","pumps"=>$pumps,"jobs"=>$jobs,"customers"=>$customers,"slurries"=>$slurries,"users"=>$users,"pumpers"=>$pumpers,"supervisors"=>$supervisors]);

    }
    
}
?>