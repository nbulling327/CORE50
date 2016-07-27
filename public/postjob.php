<?php
    
    // configuration
    require("../includes/config.php"); 
    
    //if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
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
        render("header.php","postjobinfo.php",["title" => "Post Job Entry","jobs"=>$jobs,"customers"=>$customers,"slurries"=>$slurries,"users"=>$users,"pumpers"=>$pumpers,"supervisors"=>$supervisors]);
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["chosen_company"]))
        {
            apologize("You failed to select a customer.");
        }
        else if(empty($_POST["wellsite"]))
        {
            apologize("You failed to properly select a job.");
        }
        else if(empty($_POST["jobdate"]))
        {
            apologize("You failed to select a job date.");
        }
        else if(empty($_POST["chosen_supervisor"]))
        {
            apologize("You failed to choose a supervisor!");
        }
        else if(empty($_POST["chosen_pumper"]))
        {
            apologize("You failed to choose a pump truck operator.");
        }
        else if(empty($_POST["calculated_disp"]))
        {
            apologize("You failed to enter the total calculated displacement.");
        }
        else if(empty($_POST["time"]))
        {
            apologize("You failed to choose the elapsed time column.");
        }
        else if(empty($_POST["pressure"]))
        {
            apologize("You failed to choose the pressure column.");
        }
        else if(empty($_POST["density"]))
        {
            apologize("You failed to choose the density column.");
        }
        else if(empty($_POST["rate"]))
        {
            apologize("You failed to choose the pump rate column.");
        }
        else if(empty($_FILES["fileToUpload"]["tmp_name"]))
        {
            apologize("You failed to choose the csv to upload.");
        }
        else
        {
            $jobs= CS50::query("SELECT * FROM jobs WHERE id = ?", $_POST["wellsite"]);
            $current_job = $jobs[0];
            $name = $current_job["customer"]." ".$current_job["well_name"]." ".$current_job["well_number"]." ".$current_job["job_type"];
            $name = str_replace(' ', '_', $name);
            $target_dir="uploads/";
            $target_file=$target_dir. $name.".csv";
            
            if(isset($_POST["submit"]))
            {
                $info = new SplFileInfo($_FILES["fileToUpload"]["name"]);
                if('csv' != $info->getExtension())
                {
                    apologize("File is not a csv.");
                }
                
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false)
                {
                    apologize("File is an image.");
                    $uploadOk = 0;
                }
                else
                {
                    $uploadOk=1;
                }
            }
        
            if (file_exists($target_file))
            {
                apologize("A file for this job already exists.");
                $uploadOk=0;
            }
        
            if ($_FILES["fileToUpload"]["size"] > 2000000)
            {
                apologize("File size" . $_FILES["fileToUpload"]["size"] . ".  Current max size is 2 MB.");
                $uploadOk=0;
            }
        
            if(!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file))
            {
                apologize("Upload of file failed for some unknown reason.");
            }
            else
            {
                CS50::query("TRUNCATE datas");
                $time_col=$_POST["time"];
                $pres_col=$_POST["pressure"];
                $rate_col=$_POST["rate"];
                $dens_col=$_POST["density"];

                $fp=fopen($target_file,'r');
                $prd=fgetcsv($fp,1000,",");
                while(!feof($fp))
                {
                    $prd=fgetcsv($fp,1000,",");
                    $datas[] = [
                        "time" => $prd[$time_col],
                        "pressure" => $prd[$pres_col],
                        "rate"=>$prd[$rate_col],
                        "density"=>$prd[$dens_col],
                    ];
                }
        
                foreach ($datas as $data)
                {
                    CS50::query("INSERT IGNORE INTO datas 
                    (time, pressure, rate, density) VALUES(?,?,?,?)",$data["time"],$data["pressure"],$data["rate"],$data["density"]);
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
                render("header.php","postjobcomplete_form.php",["title" => "Post Job Chart","users" =>$users]);
                
            }
            
        }
    }
?>