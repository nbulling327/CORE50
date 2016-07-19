<?php
//configuration
    require("../includes/config.php");
    $names = CS50::query("SELECT * FROM wells ORDER BY name");
    $i=0;
    foreach ($names as $name) {
         $rows[$i]["name"]=$name["name"];   
         $i=$i+1;
    }
    $numbers = CS50::query("SELECT * FROM wells ORDER BY number");
    $i=0;
    foreach ($numbers as $number) {
         $rows[$i]["number"]=$number["number"];   
         $i=$i+1;
    }
    print json_encode($rows);
?>
