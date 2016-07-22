<?php

    //configuration
    require("../includes/config.php");
    
    //if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $rows= CS50::query("SELECT * FROM companies ORDER BY company");
        $options = [];
        foreach ($rows as $row)
        {
            $options[] = [
            "company_option" => $row["company"],
            ];
        }
        $rows= CS50::query("SELECT * FROM places ORDER BY region, district");
        $regions = [];
        $current = "blank";
        foreach ($rows as $row)
        {
            if($row["region"]!=$current)
            {
                $regions[] = [
                "region_option" => $row["region"],
                ];
            }
            $current = $row["region"];
        } 
        render("header_register.php","register_form.php", ["title" => "Register","options"=>$options,"regions"=>$regions]);
    } 
    //else if user reached page via POST (as by submitting a form via POST)
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["password"]))
        {
            apologize("You failed to type a password.");
        }
        if (empty($_POST["confirmation"]))
        {
            apologize("You failed to type a password confirmation.");
        }
        
        if ($_POST["password"] == $_POST["confirmation"])
        {
            if (empty($_POST["username"]))
            {
                apologize("You failed to enter a username.");
            }
            
            $result = CS50::query("SELECT * FROM users WHERE username = ?" , $_POST["username"]);
            
            if ($result == true)
            {
                apologize("An error has occurred registering.  Username alredy exists.");
            }
            
            else
            {
                $hemisphere = CS50:: query("SELECT hemisphere from places WHERE region = ?", $_POST["region"]);
                CS50::query("INSERT IGNORE INTO users (username, hash, company, email, region,hemisphere,firstname,lastname) 
                VALUES(?, ?, ?, ?,?,?,?,?)", 
                $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT),$_POST["chosen_company"],$_POST["email"],$_POST["region"],$hemisphere[0]["hemisphere"],$_POST["firstname"],$_POST["lastname"]);
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                $_SESSION["id"] = $id;
                $_SESSION["region"]   = $_POST["region"];
                
                if($_POST["chosen_company"]=="Halliburton")
                {
                    // redirect to portfolio
                    redirect("/userinfo.php");
                }
                if($_POST["chosen_company"]=="other")
                {
                    // redirect to portfolio
                    redirect("/newcompany.php");
                }
                else
                {
                    // redirect to home
                    CS50::query("UPDATE users SET role=? WHERE id = ?", 
                    "Customer",$_SESSION["id"]);
                    redirect("/");
                }
            }
        }    
        else
        {
            apologize("You did not type the same password twice.");
        }
    }
?>