<?php

// configuration
require("../includes/config.php"); 
    
var_dump($_POST);
var_dump($_SESSION);

$job_id=$_POST["submit"];
$rows= CS50::query("SELECT * FROM jobs WHERE id = ?",$job_id);
$options = CS50::query("SELECT * FROM slurries WHERE job_id = ?",$job_id);
$slurries=[];
foreach ($options as $option)
{
    $slurries[]= [
        "weight"=> $option["density"],
        "stage"=> $option["stage"],
        "slurry_number"=> $option["slurry_number"],
        "function"=>$option["function"]
        ];
}

$job_slurries = $rows[0]["slurries"];
for($k=0;$k<$job_slurries;)
{
    $density=$slurries[$k]["weight"];
    $k=$k+1;
    $current_start = 'slurry_'.$k.'_start';
    $current_stop = 'slurry_'.$k.'_stop';
    CS50::query("UPDATE datas SET target_dens = ? WHERE time between ? AND ?",
            $density,(float)$_POST["$current_start"],(float)$_POST["$current_stop"]);
}
$prev_dens=0;
$infos=[];
$i=0;
$j=0;
$tot_vol=0;
$rows= CS50::query("SELECT * FROM datas ORDER BY id");
foreach ($rows as $row)
{
    
    $inc_vol=($row["rate"] + $i)/2*($row["time"]-$j);
    $i=$row["rate"];
    $j=$row["time"];
    if(abs($row["target_dens"]-$prev_dens) > 0)
    {
        $tot_vol=0;
    }
    else
    {
        $tot_vol=$tot_vol+$inc_vol;
    }
    if((abs($row["density"]-$row["target_dens"]) <= 0.2)&&$row["target_dens"]>0)
    {
        $spec=1;
    }
    else
    {
        $spec=0;
    }
    $prev_dens=$row["target_dens"];
    $infos[] = [
        "inc_volume" => $inc_vol,
        "tot_vol"=>$tot_vol,
        "id"=>$row["id"],
        "spec"=>$spec
        ];
}
foreach ($infos as $info)
{
    CS50::query("UPDATE datas SET inc_vol = ?, tot_vol=?, dens_in_spec=? WHERE id = ? ",
            $info["inc_volume"],$info["tot_vol"],$info["spec"],$info["id"]);
}

?>