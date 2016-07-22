<?php
    //configuration
    require("../includes/config.php");
    
    //if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $rows= CS50::query("SELECT * FROM users WHERE id=?",$_SESSION["id"]);
        $users = [];
        foreach ($rows as $row)
        {
            $users[] = [
            "firstname" => $row["firstname"],
            "lastname" => $row["lastname"],
            ];
        }
        render("header.php","enternewcompany.php", ["title" => "Add New Company","users"=>$users]);
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        print_r($_POST);
        $test=CS50::query("SELECT * FROM companies WHERE company = ?", $_POST["company"]);
         print_r($test);
        if(!empty($test))
        {
            apologize("Company already is in database.");
        }
        else
        {
            $company=CS50::query("Select * FROM users WHERE id = ?", $_SESSION["id"]);
            if($company[0]["company"]!="Halliburton")
            {
                CS50::query("UPDATE users SET company=? WHERE id = ?", 
                $_POST["company"],$_SESSION["id"]);
                CS50::query("UPDATE users SET role=? WHERE id = ?", 
                "Customer",$_SESSION["id"]);
            }        
            CS50::query("INSERT IGNORE INTO companies (company, domain) 
            VALUES(?, ?)", $_POST["company"],$_POST["domain"]);
            // redirect to home
            redirect("/");
        }
    }
?>