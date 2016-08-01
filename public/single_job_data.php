<?php
//configuration
    if (empty($_GET["job"]))
    {
        http_response_code(400);
        exit;
    }
    
    $table = $_GET["job"];
    
    require("../includes/config.php");
    $datas = CS50::query("SELECT * FROM $table");
    $i=0;
    foreach ($datas as $data) {
        $rows[$i]["time"]=$data["time"];
        $rows[$i]["pressure"]=$data["pressure"];
        $rows[$i]["rate"]=$data["rate"];
        $rows[$i]["density"]=$data["density"];
        $i=$i+1;
    }
    print json_encode($rows);
?>

