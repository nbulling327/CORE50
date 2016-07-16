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
        
        render("register_form.php", ["title" => "Register","options"=>$options]);
        
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
                CS50::query("INSERT IGNORE INTO users (username, hash, company, email) 
                VALUES(?, ?, ?, ?)", 
                $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT),$_POST["company"],$_POST["email"]);
                
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                $_SESSION["id"] = $id;
                
                // redirect to portfolio
                redirect("/userinfo.php");
            }
        }
        else
        {
            apologize("You did not type the same password twice.");
        }
    }
    
?>