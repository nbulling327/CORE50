<?php
//configuration
    require("../includes/config.php");
    $names = CS50::query("SELECT DISTINCT well_name FROM jobs ORDER BY well_name");
    $i=0;
    foreach ($names as $name) {
         $rows[$i]["name"]=$name["well_name"];   
         $i=$i+1;
    }
    $numbers = CS50::query("SELECT DISTINCT well_number FROM jobs ORDER BY well_number");
    $i=0;
    foreach ($numbers as $number) {
         $rows[$i]["number"]=$number["well_number"];   
         $i=$i+1;
    }
    print json_encode($rows);
?>
