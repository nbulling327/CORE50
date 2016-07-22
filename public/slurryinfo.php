<?php

    //configuration
    require("../includes/config.php");
    
    //if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(!empty($_SESSION["job"]))
        {
            $rows= CS50::query("SELECT * FROM jobs WHERE id =?", $_SESSION["job"]);
            $options = [];
            foreach ($rows as $row)
            {
                $options[] = [
                "job_id" => $row["id"],
                "district" => $row["district"],
                "customer" => $row["customer"],
                "stage_count" => $row["stage_count"],
                "job_type" => $row["job_type"],
                "well_name" => $row["well_name"],
                "well_number" => $row["well_number"],
                "slurries" => $row["slurries"],
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
            render("header.php","slurryinfo_form.php",["title" => "Slurry Information","options"=>$options,"users"=>$users]);
        }
        else
        {
            redirect("/");    
        }
    } 
    //else if user reached page via POST (as by submitting a form via POST)
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["chosen_company"]))
        {
            apologize("You failed to choose a customer.");
        }
        else if (empty($_POST["district"]))
        {
            apologize("You failed to enter a district.");
        }
        else if (empty($_POST["stage_count"]))
        {
            apologize("You failed to select if single-stage or multi-stage.");
        }
        else if (empty($_POST["job_type"]))
        {
            apologize("You failed to choose the job type.");
        }
        else if (empty($_POST["well"]))
        {
            apologize("You failed to enter the well name.");
        }
        else if (empty($_POST["number"]))
        {
            apologize("You failed to enter the well number.");
        }
        else if (empty($_POST["slurries"]))
        {
            apologize("You failed to enter the total number of slurries for the job.");
        }
        else
        {
                CS50::query("INSERT IGNORE INTO jobs (district, customer, stage_count, job_type, 
                well_name, well_number, slurries, prejobentry) 
                VALUES(?,?,?,?,?,?,?,?)", 
                $_POST["district"], $_POST["chosen_company"],$_POST["stage_count"],$_POST["job_type"],
                $_POST["well"], $_POST["number"],$_POST["slurries"],$_SESSION["id"]);
                
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                $_SESSION["job"] = $rows[0]["id"];

                // redirect to portfolio
                redirect("/slurryinfo.php");
        }
    }
?>