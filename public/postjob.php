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
        //echo ini_get('file_uploads');
        //echo ini_get('upload_max_filesize');
        //ini_set('upload_max_filesize', '10M');
        //phpinfo();
        //echo ini_get('upload_max_filesize');
        $target_dir="uploads/";
        $target_file=$target_dir. basename($_FILES["fileToUpload"]["name"]);
        //echo $target_file;
        //var_dump($_FILES);
        //$uploadOk=1;
        if(isset($_POST["submit"]))
        {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false)
            {
                echo "File is an image - ". $check["mine"] . ".";
                $uploadOk = 0;
            }
            else
            {
                echo "File is not an image.";
                $uploadOk=1;
            }
        }
        if (file_exists($target_file))
        {
            echo "Sorry, file already exists.";
            $uploadOk=0;
        }
        if ($_FILES["fileToUpload"]["size"] > 2000000)
        {
            echo "Sorry, file is too large.";
            $uploadOk=0;
        }
        //echo "file size is " . $_FILES["fileToUpload"]["size"]. "!!";
        //if($imageFileType != "csv")
        //{
        //    echo "Sorry - only csvs are allowed.";
        //    $uploadOk=0;
        //}
        if($uploadOk == 0)
        {
            echo "Your upload failed.";
        }
        
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file))
            {
                echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
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
            else
            {
                echo "File upload failed.";   
            }
        
    }
?>