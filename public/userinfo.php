<?php

    //configuration
    require("../includes/config.php");
    
    //if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        //else render form
        $rows= CS50::query("SELECT * FROM places WHERE region = ? ORDER BY district ", $_SESSION["region"]);
        $options = [];
        foreach ($rows as $row)
        {
            $options[] = [
            "district_option" => $row["district"],
            ];
        } 
        render("header_register.php","additional_info_form.php", ["title" => "Additional Information","options"=>$options]);
    }

    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["role"]))
        {
            apologize("You failed to enter your role.");
        }
        $role=$_POST["role"];
        $district=$_POST["district"];
        $area=CS50::query("SELECT area from places WHERE district = ?", $_POST["district"]);
        print_r($area);
        CS50::query("UPDATE users SET role=? WHERE id = ?", 
               $_POST["role"],$_SESSION["id"]);
        CS50::query("UPDATE users SET district=? WHERE id = ?", 
               $_POST["district"],$_SESSION["id"]);
        CS50::query("UPDATE users SET area=? WHERE id = ?", 
               $area[0]["area"],$_SESSION["id"]);
        if("both" == $_POST["role"])
        {
        CS50::query("UPDATE users SET pumper=? WHERE id = ?", 
            1,$_SESSION["id"]);
        CS50::query("UPDATE users SET supervisor=? WHERE id = ?", 
            1,$_SESSION["id"]);
        }
        else if("pumper" == $_POST["role"])
        {
        CS50::query("UPDATE users SET pumper=? WHERE id = ?", 
            1,$_SESSION["id"]);
        CS50::query("UPDATE users SET supervisor=? WHERE id = ?", 
            0,$_SESSION["id"]);
        }
        else if("supervisor" == $_POST["role"])
        {
        CS50::query("UPDATE users SET pumper=? WHERE id = ?", 
            0,$_SESSION["id"]);
        CS50::query("UPDATE users SET supervisor=? WHERE id = ?", 
            1,$_SESSION["id"]);
        }
        else
        {
        CS50::query("UPDATE users SET pumper=? WHERE id = ?", 
            0,$_SESSION["id"]);
        CS50::query("UPDATE users SET supervisor=? WHERE id = ?", 
            0,$_SESSION["id"]);
        }
        // redirect to home
        redirect("/");
    }
?>