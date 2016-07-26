<?php
//configuration
    require("../includes/config.php");
    $datas = CS50::query("SELECT * FROM datas");
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

