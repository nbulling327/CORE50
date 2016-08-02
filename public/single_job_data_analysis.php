<?php

    if (empty($_GET["job"]))
    {
        http_response_code(400);
        exit;
    }
    
    $table = $_GET["job"];
    
    //configuration
    require("../includes/config.php");
    $datas = CS50::query("SELECT * FROM $table WHERE pumping = 1");
    $i=0;
    foreach ($datas as $data) {
        $rows[$i]["time"]=$data["time"];
        $rows[$i]["pressure"]=$data["pressure"];
        $rows[$i]["rate"]=$data["rate"];
        $rows[$i]["density"]=$data["density"];
        $rows[$i]["tot_vol"]=$data["tot_vol"];
        $rows[$i]["target_dens"]=$data["target_dens"];
        $rows[$i]["shutdowns"]=$data["shutdowns"];
        $i=$i+1;
    }
    print json_encode($rows);
?>

