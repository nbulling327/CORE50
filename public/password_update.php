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
        render("header.php","password_form.php",["title" => "Update Password","users"=>$users]);
    }
    
    //else if user reached page via POST (as by submitting a form via POST)
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["old_password"]))
        {
            apologize("You failed to type in your old password.");
        }
        if (empty($_POST["new_password"]))
        {
            apologize("You failed to type a new password.");
        }
        if (empty($_POST["confirmation"]))
        {
            apologize("You failed to type a new password confirmation.");
        }
        
        if ($_POST["new_password"] == $_POST["confirmation"])
        {
            $result = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
            if(!password_verify($_POST["old_password"],$result[0]['hash']))
            {
                apologize("An error has occurred updating your password.  Your old password did not match.");
            }
            else
            {
                $new_hash=password_hash($_POST["new_password"], PASSWORD_DEFAULT);
                CS50::query("UPDATE users SET hash='$new_hash' WHERE id=?",$_SESSION["id"]);
                
                $rows= CS50::query("SELECT * FROM users WHERE id=?",$_SESSION["id"]);
                $users = [];
                foreach ($rows as $row) {
                    $users[] = [
                    "firstname" => $row["firstname"],
                    "lastname" => $row["lastname"],
                    ];
                }
                
                // redirect to portfolio
                render("header.php","password_success.php",["title" => "Password Updated","users"=>$users]);
            }
        }
        else
        {
            apologize("You did not type the same new password and confirmation.");
        }
    }
?>