<?php
    
    //configuration
    require("../includes/config.php");
    
    //if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        redirect("/");    
    } 
    //else if user reached page via POST (as by submitting a form via POST)
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $rows= CS50::query("SELECT * FROM jobs WHERE id =?", $_SESSION["job"]);
        $job_id = $rows[0]["id"];
        $stage_count = $rows[0]["stage_count"];
        $slurries = $rows[0]["slurries"];
        $_SESSION["stage_count"] = $rows[0]["stage_count"];
        $_SESSION["slurries"] = $rows[0]["slurries"];
        $stage_count = $rows[0]["stage_count"];
        
        for($i=0;$i<$slurries;)
        {
            $i=$i+1;
            if($stage_count>1)
            {
                $current_stage = 'slurry_'.$i.'_stage';
            }
            else
            {
                $current_stage='$current_stage';
                $_POST[$current_stage] = 1;
            }
            
            $current_type = 'type_'.$i;
            $current_dens = 'density_'.$i;
            $current_vol = 'designvolume_'.$i;
            if (empty($_POST["$current_type"]))
            {
                apologize("You failed to choose a slurry function for slurry $i.");
            }
            else if ((24<($_POST["$current_dens"]))||(8.33>($_POST["$current_dens"])))
            {
                apologize("You failed to enter a proper density for slurry $i.");
            }
            else if (1>($_POST["$current_vol"]))
            {
                apologize("You failed to enter a proper slurry volume for slurry $i.");
            }
            else
            {
                CS50::query("INSERT IGNORE INTO slurries (job_id, stage, function, density, des_vol, slurry_number) 
                VALUES(?,?,?,?,?,?)", 
                $_SESSION["job"], $_POST["$current_stage"],$_POST["$current_type"],$_POST["$current_dens"],$_POST["$current_vol"],$i);
            
                $rows= CS50::query("SELECT * FROM users WHERE id=?",$_SESSION["id"]);
                $users = [];
                foreach ($rows as $row)
                {
                    $users[] = [
                    "firstname" => $row["firstname"],
                    "lastname" => $row["lastname"],
                    ];
                }
                
            }
        }
        // redirect to portfolio
        render("header.php","proposal_complete.php",["title" => "Proposal Entry Complete","users"=>$users]);
    }
?>