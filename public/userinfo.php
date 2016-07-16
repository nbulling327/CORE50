<?php

    //configuration
    require("../includes/config.php");
    
    //if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        //else render form
        render("additional_info_form.php", ["title" => "Additional Information"]);
    }

    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        print_r($_POST);
        if (empty($_POST["role"]))
        {
            apologize("You failed to enter your role.");
        }
        $role=$_POST["role"];
        $district=$_POST["district"];
        print_r($role);
        
         CS50::query("UPDATE users SET role=? WHERE id = ?", 
               $_POST["role"],$_SESSION["id"]);
        CS50::query("UPDATE users SET district=? WHERE id = ?", 
               $_POST["district"],$_SESSION["id"]);
                 
        
        
        // redirect to home
        redirect("/");
    }
?>