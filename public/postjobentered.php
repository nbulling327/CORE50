<?php

// configuration
require("../includes/config.php"); 
    
var_dump($_POST);
var_dump($_SESSION);

$infos=[];
$i=0;
$j=0;
$infos= CS50::query("SELECT * FROM datas");
foreach ($infos as $info)
{
    
    $info["inc_vol"]=($info["rate"] + $i)/2*($info["time"]-$j);
    $i=$info["rate"];
    $j=$info["time"];
    
    
}
var_dump($infos);
foreach ($infos as $info)
{
    CS50::query("INSERT IGNORE INTO datas 
        (inc_vol) VALUES(?)",$info["inc_vol"]);
}


?>