<?php

// configuration
require("../includes/config.php"); 
    
$job_id=$_POST["submit"];
$rows= CS50::query("SELECT * FROM jobs WHERE id = ?",$job_id);
$options = CS50::query("SELECT * FROM slurries WHERE job_id = ?",$job_id);
$slurries=[];
$slurry_stats=[];
foreach ($options as $option)
{
    $slurries[]= [
        "weight"=> $option["density"],
        "stage"=> $option["stage"],
        "slurry_number"=> $option["slurry_number"],
        "function"=>$option["function"],
        "des_vol"=>$option["des_vol"]
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
$previous_total=0;
$shutdown_total = 0;
$slurry_shutdowns_push=[];
$slurry_volume_push=[];
$slurry_volume_inspec_push=[];
$disp_volume=0;
$pumping = 0;
$countdown = $_POST["slurry_1_start"];
$rows= CS50::query("SELECT * FROM datas ORDER BY id");
$spec=0;

if (1==$job_slurries)
{
    $slurry1_shutdowns=0;
    $slurry1_volume=0;
    $slurry1_volume_inspec=0;
    
    
    $displacement_shutdowns=0;
    foreach ($rows as $row)
    {
        if ($row["time"]<($_POST["displacement_stop"]+10))
        {
            $pumping = 1;
        }
        
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
            $spec=$previous_total+$inc_vol;
            $previous_total = $spec;
        }
        
        
        if($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry1_volume=$tot_vol;
            $slurry1_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry1_shutdowns=$slurry1_shutdowns+1;
                $slurry1_volume=$tot_vol;
                $slurry1_volume_inspec=$spec;
            }
        }
        
        else if($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $disp_volume=$tot_vol;
        }
        else if ($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $displacement_shutdowns=$displacement_shutdowns+1;
                $disp_volume=$tot_vol;
            }
        }
        else
        {   
            $shutdown=0;
            $countdown=$row["time"];
        }
        
        

        $prev_dens=$row["target_dens"];
        $infos[] = [
            "inc_volume" => $inc_vol,
            "tot_vol"=>$tot_vol,
            "id"=>$row["id"],
            "spec"=>$spec,
            "shutdown"=>$shutdown,
            "pumping"=>$pumping
            ];
    }
    
    array_push($slurry_shutdowns_push,$slurry1_shutdowns);
    array_push($slurry_volume_push,$slurry1_volume);
    array_push($slurry_volume_inspec_push,$slurry1_volume_inspec);
        
    
}

else if (2==$job_slurries)
{
    $slurry1_shutdowns=0;
    $slurry2_shutdowns=0;
    
    $slurry1_volume=0;
    $slurry2_volume=0;
    
    $slurry1_volume_inspec=0;
    $slurry2_volume_inspec=0;
    
    
    $displacement_shutdowns=0;
    
    foreach ($rows as $row)
    {
        
        if ($row["time"]<($_POST["displacement_stop"]+10))
        {
            $pumping = 1;
        }
        
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
            $spec=$previous_total+$inc_vol;
            $previous_total = $spec;
        }
        
        
        if($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry1_volume=$tot_vol;
            $slurry1_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry1_shutdowns=$slurry1_shutdowns+1;
                $slurry1_volume=$tot_vol;
                $slurry1_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_2_start"] && $row["time"]<$_POST["slurry_2_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry2_volume=$tot_vol;
            $slurry2_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_2_start"] && $row["time"]<$_POST["slurry_2_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry2_shutdowns=$slurry2_shutdowns+1;
                $slurry2_volume=$tot_vol;
                $slurry2_volume_inspec=$spec;
            }
        }
        
        else if($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $disp_volume=$tot_vol;
        }
        else if ($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $displacement_shutdowns=$displacement_shutdowns+1;
                $disp_volume=$tot_vol;
            }
        }
        else
        {   
            $shutdown=0;
            $countdown=$row["time"];
        }
    
        
        
        
        $prev_dens=$row["target_dens"];
        $infos[] = [
            "inc_volume" => $inc_vol,
            "tot_vol"=>$tot_vol,
            "id"=>$row["id"],
            "spec"=>$spec,
            "shutdown"=>$shutdown,
            "pumping"=>$pumping
            ];
    }
    
    array_push($slurry_shutdowns_push,$slurry1_shutdowns);
    array_push($slurry_volume_push,$slurry1_volume);
    array_push($slurry_volume_inspec_push,$slurry1_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry2_shutdowns);
    array_push($slurry_volume_push,$slurry2_volume);
    $slurry2_volume_inspec=$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry2_volume_inspec);
    
}

else if (3==$job_slurries)
{
    $slurry1_shutdowns=0;
    $slurry2_shutdowns=0;
    $slurry3_shutdowns=0;
    
    $slurry1_volume=0;
    $slurry2_volume=0;
    $slurry3_volume=0;
    
    $slurry1_volume_inspec=0;
    $slurry2_volume=0;
    $slurry3_volume=0;
    
    
    $displacement_shutdowns=0;
    
    foreach ($rows as $row)
    {
    
        if ($row["time"]<($_POST["displacement_stop"]+10))
        {
            $pumping = 1;
        }
        
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
            $spec=$previous_total+$inc_vol;
            $previous_total = $spec;
        }
        
        if($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry1_volume=$tot_vol;
            $slurry1_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry1_shutdowns=$slurry1_shutdowns+1;
                $slurry1_volume=$tot_vol;
                $slurry1_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_2_start"] && $row["time"]<$_POST["slurry_2_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry2_volume=$tot_vol;
            $slurry2_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_2_start"] && $row["time"]<$_POST["slurry_2_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry2_shutdowns=$slurry2_shutdowns+1;
                $slurry2_volume=$tot_vol;
                $slurry2_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_3_start"] && $row["time"]<$_POST["slurry_3_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry3_volume=$tot_vol;
            $slurry3_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_3_start"] && $row["time"]<$_POST["slurry_3_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry3_shutdowns=$slurry3_shutdowns+1;
                $slurry3_volume=$tot_vol;
                $slurry3_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $disp_volume=$tot_vol;
        }
        else if ($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $displacement_shutdowns=$displacement_shutdowns+1;
                $disp_volume=$tot_vol;
            }
        }
        else
        {   
            $shutdown=0;
            $countdown=$row["time"];
        }
        
        $prev_dens=$row["target_dens"];
        $infos[] = [
            "inc_volume" => $inc_vol,
            "tot_vol"=>$tot_vol,
            "id"=>$row["id"],
            "spec"=>$spec,
            "shutdown"=>$shutdown,
            "pumping"=>$pumping
            ];
    }
    
    array_push($slurry_shutdowns_push,$slurry1_shutdowns);
    array_push($slurry_volume_push,$slurry1_volume);
    array_push($slurry_volume_inspec_push,$slurry1_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry2_shutdowns);
    array_push($slurry_volume_push,$slurry2_volume);
    $slurry2_volume_inspec=$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry2_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry3_shutdowns);
    array_push($slurry_volume_push,$slurry3_volume);
    $slurry3_volume_inspec=$slurry3_volume_inspec-$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry3_volume_inspec);
    
   
}

else if (4==$job_slurries)
{
    $slurry1_shutdowns=0;
    $slurry2_shutdowns=0;
    $slurry3_shutdowns=0;
    $slurry4_shutdowns=0;
    
    $slurry1_volume=0;
    $slurry2_volume=0;
    $slurry3_volume=0;
    $slurry4_volume=0;
    
    $slurry1_volume_inspec=0;
    $slurry2_volume=0;
    $slurry3_volume=0;
    $slurry4_volume=0;
    
    
    $displacement_shutdowns=0;
    foreach ($rows as $row)
    {
    
        if ($row["time"]<($_POST["displacement_stop"]+10))
        {
            $pumping = 1;
        }
        
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
            $spec=$previous_total+$inc_vol;
            $previous_total = $spec;
        }
       
        
        if($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry1_volume=$tot_vol;
            $slurry1_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry1_shutdowns=$slurry1_shutdowns+1;
                $slurry1_volume=$tot_vol;
                $slurry1_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_2_start"] && $row["time"]<$_POST["slurry_2_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry2_volume=$tot_vol;
            $slurry2_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_2_start"] && $row["time"]<$_POST["slurry_2_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry2_shutdowns=$slurry2_shutdowns+1;
                $slurry2_volume=$tot_vol;
                $slurry2_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_3_start"] && $row["time"]<$_POST["slurry_3_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry3_volume=$tot_vol;
            $slurry3_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_3_start"] && $row["time"]<$_POST["slurry_3_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry3_shutdowns=$slurry3_shutdowns+1;
                $slurry3_volume=$tot_vol;
                $slurry3_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_4_start"] && $row["time"]<$_POST["slurry_4_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry4_volume=$tot_vol;
            $slurry4_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_4_start"] && $row["time"]<$_POST["slurry_4_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry4_shutdowns=$slurry4_shutdowns+1;
                $slurry4_volume=$tot_vol;
                $slurry4_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $disp_volume=$tot_vol;
        }
        else if ($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $displacement_shutdowns=$displacement_shutdowns+1;
                $disp_volume=$tot_vol;
            }
        }
        else
        {   
            $shutdown=0;
            $countdown=$row["time"];
        }
    

        $prev_dens=$row["target_dens"];
        $infos[] = [
            "inc_volume" => $inc_vol,
            "tot_vol"=>$tot_vol,
            "id"=>$row["id"],
            "spec"=>$spec,
            "shutdown"=>$shutdown,
            "pumping"=>$pumping
            ];
    }

    array_push($slurry_shutdowns_push,$slurry1_shutdowns);
    array_push($slurry_volume_push,$slurry1_volume);
    array_push($slurry_volume_inspec_push,$slurry1_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry2_shutdowns);
    array_push($slurry_volume_push,$slurry2_volume);
    $slurry2_volume_inspec=$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry2_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry3_shutdowns);
    array_push($slurry_volume_push,$slurry3_volume);
    $slurry3_volume_inspec=$slurry3_volume_inspec-$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry3_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry4_shutdowns);
    array_push($slurry_volume_push,$slurry4_volume);
    $slurry4_volume_inspec=$slurry4_volume_inspec-$slurry3_volume_inspec-$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry4_volume_inspec);    
    
}

else if (5==$job_slurries)
{
    $slurry1_shutdowns=0;
    $slurry2_shutdowns=0;
    $slurry3_shutdowns=0;
    $slurry4_shutdowns=0;
    $slurry5_shutdowns=0;
    
    $slurry1_volume=0;
    $slurry2_volume=0;
    $slurry3_volume=0;
    $slurry4_volume=0;
    $slurry5_volume=0;
    
    $slurry1_volume_inspec=0;
    $slurry2_volume=0;
    $slurry3_volume=0;
    $slurry4_volume=0;
    $slurry5_volume=0;
    
    
    $displacement_shutdowns=0;
    foreach ($rows as $row)
    {
    
        if ($row["time"]<($_POST["displacement_stop"]+10))
        {
            $pumping = 1;
        }
        
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
            $spec=$previous_total+$inc_vol;
            $previous_total = $spec;
        }
        
        if($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry1_volume=$tot_vol;
            $slurry1_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry1_shutdowns=$slurry1_shutdowns+1;
                $slurry1_volume=$tot_vol;
                $slurry1_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_2_start"] && $row["time"]<$_POST["slurry_2_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry2_volume=$tot_vol;
            $slurry2_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_2_start"] && $row["time"]<$_POST["slurry_2_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry2_shutdowns=$slurry2_shutdowns+1;
                $slurry2_volume=$tot_vol;
                $slurry2_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_3_start"] && $row["time"]<$_POST["slurry_3_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry3_volume=$tot_vol;
            $slurry3_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_3_start"] && $row["time"]<$_POST["slurry_3_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry3_shutdowns=$slurry3_shutdowns+1;
                $slurry3_volume=$tot_vol;
                $slurry3_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_4_start"] && $row["time"]<$_POST["slurry_4_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry4_volume=$tot_vol;
            $slurry4_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_4_start"] && $row["time"]<$_POST["slurry_4_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry4_shutdowns=$slurry4_shutdowns+1;
                $slurry4_volume=$tot_vol;
                $slurry4_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_5_start"] && $row["time"]<$_POST["slurry_5_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry5_volume=$tot_vol;
            $slurry5_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_5_start"] && $row["time"]<$_POST["slurry_5_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry5_shutdowns=$slurry5_shutdowns+1;
                $slurry5_volume=$tot_vol;
                $slurry5_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $disp_volume=$tot_vol;
        }
        else if ($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $displacement_shutdowns=$displacement_shutdowns+1;
                $disp_volume=$tot_vol;
            }
        }
        else
        {   
            $shutdown=0;
            $countdown=$row["time"];
        }
        
        
        $prev_dens=$row["target_dens"];
        $infos[] = [
            "inc_volume" => $inc_vol,
            "tot_vol"=>$tot_vol,
            "id"=>$row["id"],
            "spec"=>$spec,
            "shutdown"=>$shutdown,
            "pumping"=>$pumping
            ];
    }
    
    array_push($slurry_shutdowns_push,$slurry1_shutdowns);
    array_push($slurry_volume_push,$slurry1_volume);
    array_push($slurry_volume_inspec_push,$slurry1_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry2_shutdowns);
    array_push($slurry_volume_push,$slurry2_volume);
    $slurry2_volume_inspec=$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry2_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry3_shutdowns);
    array_push($slurry_volume_push,$slurry3_volume);
    $slurry3_volume_inspec=$slurry3_volume_inspec-$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry3_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry4_shutdowns);
    array_push($slurry_volume_push,$slurry4_volume);
    $slurry4_volume_inspec=$slurry4_volume_inspec-$slurry3_volume_inspec-$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry4_volume_inspec);    
    array_push($slurry_shutdowns_push,$slurry5_shutdowns);
    array_push($slurry_volume_push,$slurry5_volume);
    $slurry5_volume_inspec=$slurry5_volume_inspec-$slurry4_volume_inspec-$slurry3_volume_inspec-$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry5_volume_inspec);
        
    
    
    
}

else if (6==$job_slurries)
{
    $slurry1_shutdowns=0;
    $slurry2_shutdowns=0;
    $slurry3_shutdowns=0;
    $slurry4_shutdowns=0;
    $slurry5_shutdowns=0;
    $slurry6_shutdowns=0;
    
    $slurry1_volume=0;
    $slurry2_volume=0;
    $slurry3_volume=0;
    $slurry4_volume=0;
    $slurry5_volume=0;
    $slurry6_volume=0;
    
    $slurry1_volume_inspec=0;
    $slurry2_volume=0;
    $slurry3_volume=0;
    $slurry4_volume=0;
    $slurry5_volume=0;
    $slurry6_volume=0;
    
    
    $displacement_shutdowns=0;
    foreach ($rows as $row)
    {
    
        if ($row["time"]<($_POST["displacement_stop"]+10))
        {
            $pumping = 1;
        }
        
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
            $spec=$previous_total+$inc_vol;
            $previous_total = $spec;
        }
        
        
        if($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry1_volume=$tot_vol;
            $slurry1_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_1_start"] && $row["time"]<$_POST["slurry_1_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry1_shutdowns=$slurry1_shutdowns+1;
                $slurry1_volume=$tot_vol;
                $slurry1_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_2_start"] && $row["time"]<$_POST["slurry_2_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry2_volume=$tot_vol;
            $slurry2_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_2_start"] && $row["time"]<$_POST["slurry_2_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry2_shutdowns=$slurry2_shutdowns+1;
                $slurry2_volume=$tot_vol;
                $slurry2_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_3_start"] && $row["time"]<$_POST["slurry_3_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry3_volume=$tot_vol;
            $slurry3_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_3_start"] && $row["time"]<$_POST["slurry_3_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry3_shutdowns=$slurry3_shutdowns+1;
                $slurry3_volume=$tot_vol;
                $slurry3_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_4_start"] && $row["time"]<$_POST["slurry_4_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry4_volume=$tot_vol;
            $slurry4_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_4_start"] && $row["time"]<$_POST["slurry_4_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry4_shutdowns=$slurry4_shutdowns+1;
                $slurry4_volume=$tot_vol;
                $slurry4_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_5_start"] && $row["time"]<$_POST["slurry_5_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry5_volume=$tot_vol;
            $slurry5_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_5_start"] && $row["time"]<$_POST["slurry_5_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry5_shutdowns=$slurry5_shutdowns+1;
                $slurry5_volume=$tot_vol;
                $slurry5_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["slurry_6_start"] && $row["time"]<$_POST["slurry_6_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $slurry6_volume=$tot_vol;
            $slurry6_volume_inspec=$spec;
        }
        else if ($row["time"]>$_POST["slurry_6_start"] && $row["time"]<$_POST["slurry_6_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $slurry6_shutdowns=$slurry6_shutdowns+1;
                $slurry6_volume=$tot_vol;
                $slurry6_volume_inspec=$spec;
            }
        }
        else if($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]>0.1)
        {
            $countdown=$row["time"];
            $shutdown=0;
            $disp_volume=$tot_vol;
        }
        else if ($row["time"]>$_POST["displacement_start"] && $row["time"]<$_POST["displacement_stop"] && $row["rate"]<=0.1)
        {
            if(($row["time"]-$countdown)>2&&$shutdown==0)
            {
                $shutdown=1;
                $shutdown_total=$shutdown_total+1;
                $displacement_shutdowns=$displacement_shutdowns+1;
                $disp_volume=$tot_vol;
            }
        }
        else
        {   
            $shutdown=0;
            $countdown=$row["time"];
        }
    
        
        $prev_dens=$row["target_dens"];
        $infos[] = [
            "inc_volume" => $inc_vol,
            "tot_vol"=>$tot_vol,
            "id"=>$row["id"],
            "spec"=>$spec,
            "shutdown"=>$shutdown,
            "pumping"=>$pumping
            ];
    }
    
    array_push($slurry_shutdowns_push,$slurry1_shutdowns);
    array_push($slurry_volume_push,$slurry1_volume);
    array_push($slurry_volume_inspec_push,$slurry1_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry2_shutdowns);
    array_push($slurry_volume_push,$slurry2_volume);
    $slurry2_volume_inspec=$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry2_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry3_shutdowns);
    array_push($slurry_volume_push,$slurry3_volume);
    $slurry3_volume_inspec=$slurry3_volume_inspec-$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry3_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry4_shutdowns);
    array_push($slurry_volume_push,$slurry4_volume);
    $slurry4_volume_inspec=$slurry4_volume_inspec-$slurry3_volume_inspec-$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry4_volume_inspec);    
    array_push($slurry_shutdowns_push,$slurry5_shutdowns);
    array_push($slurry_volume_push,$slurry5_volume);
    $slurry5_volume_inspec=$slurry5_volume_inspec-$slurry4_volume_inspec-$slurry3_volume_inspec-$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry5_volume_inspec);
    array_push($slurry_shutdowns_push,$slurry6_shutdowns);
    array_push($slurry_volume_push,$slurry6_volume);
    $slurry6_volume_inspec=$slurry6_volume_inspec-$slurry5_volume_inspec-$slurry4_volume_inspec-$slurry3_volume_inspec-$slurry2_volume_inspec-$slurry1_volume_inspec;
    array_push($slurry_volume_inspec_push,$slurry6_volume_inspec);
}
else
{
    apologize("This job has too many slurries to be scored.");
}

$cement_vol=0;
$cement_vol_inspec=0;
$previous_finish=0;
$swap_time=0;
$total_cem_des_vol=0;
$total_cem_time=0;
$total_cem_inspec=0;


for($k=0;$k<$job_slurries;)
{
    $density=$slurries[$k]["weight"];
    $design_volume=$slurries[$k]["des_vol"];
    
    $current_volume = $slurry_volume_push[$k];
    $current_volume_inspec = $slurry_volume_inspec_push[$k];
    $current_shutdowns = $slurry_shutdowns_push[$k];
    
    $k=$k+1;
    $current_start = 'slurry_'.$k.'_start';
    $current_stop = 'slurry_'.$k.'_stop';
    
    $vol_variance=100*abs(($current_volume - $design_volume)/$design_volume);
    $dens_acc=100*$current_volume_inspec/$current_volume;
    $avg_rate=$current_volume/($_POST["$current_stop"]-$_POST["$current_start"]);
    
    $cement_vol=$cement_vol+$current_volume;
    $cement_vol_inspec=$cement_vol_inspec+$current_volume_inspec;
    $total_cem_des_vol=$total_cem_des_vol+$design_volume;
    $total_cem_time=$total_cem_time+($_POST["$current_stop"]-$_POST["$current_start"]);
    $total_cem_inspec=$total_cem_inspec+$current_volume_inspec;
    $tot_cem_vol_var=100*(abs($total_cem_des_vol-$cement_vol))/$total_cem_des_vol;
    
    
    
    if($k>1&&$previous_finish>0)
    {
        $swap_time=$swap_time+$_POST["$current_start"]-$previous_finish;
    }
    
    $previous_finish=$_POST["$current_stop"];
    
    
    CS50::query("UPDATE slurries SET avg_rate=?, dens_acc=?, vol_var=?,shutdowns=?, act_vol=? WHERE job_id=? AND slurry_number=?",
        $avg_rate,$dens_acc,$vol_variance,$current_shutdowns,$current_volume,$job_id,$k); 
   
}

$total_avg_cem_rate=$cement_vol/$total_cem_time;
$total_dens_acc=100*$total_cem_inspec/$cement_vol;
$plug_shutdown_time=$_POST["displacement_start"]-$previous_finish;
$avg_disp_rate=$disp_volume/($_POST["displacement_stop"]-$_POST["displacement_start"]);
if($job_slurries>1)
{
    $slurry_swap_time=$swap_time/($job_slurries-1);    
}
else
{
    $slurry_swap_time=0;
}


CS50::query("UPDATE jobs SET avg_cem_rate=?,dens_accur=?,shutdowns=?,postjobentry=?,act_disp_vol=?,
                cem_vol_variance=?,plug_shutdown_time=?,slurry_swap_time=?,avg_disp_rate=? WHERE id=?",
                $total_avg_cem_rate,$total_dens_acc,$shutdown_total,$_SESSION["id"],$disp_volume,
                $tot_cem_vol_var,$plug_shutdown_time,$slurry_swap_time,$avg_disp_rate,$job_id); 


foreach ($infos as $info)
    {
        CS50::query("UPDATE datas SET inc_vol = ?, tot_vol=?, dens_in_spec=?, shutdowns=?, pumping=? WHERE id = ? ",
            $info["inc_volume"],$info["tot_vol"],$info["spec"],$info["shutdown"],$info["pumping"],$info["id"]);
    }

$rows= CS50::query("SELECT * FROM jobs WHERE id = ?",$job_id);
$options = CS50::query("SELECT * FROM slurries WHERE job_id = ? ORDER BY id",$job_id);
$peoples = CS50::query("SELECT * FROM users WHERE company = ?","Halliburton");
$jobs=[];
$slurries=[];
$users=[];

foreach ($options as $option)
{
    $slurries[]= [
        "function"=> $option["function"],
        "density"=> $option["density"],
        "avg_rate"=> $option["avg_rate"],
        "dens_acc"=>$option["dens_acc"],
        "des_vol"=>$option["des_vol"],
        "act_vol"=>$option["act_vol"],
        "stage"=>$option["stage"],
        "shutdowns"=>$option["shutdowns"]
        ];
}

foreach ($rows as $row)
{
    $jobs[]= [
        "id"=> $row["id"],
        "customer"=> $row["customer"],
        "stage_count"=> $row["stage_count"],
        "job_type"=> $row["job_type"],
        "well_name"=> $row["well_name"],
        "well_number"=> $row["well_number"],
        "slurries"=> $row["slurries"],
        "avg_disp_rate"=> $row["avg_disp_rate"],
        "dens_accur"=> $row["dens_accur"],
        "shutdowns"=> $row["shutdowns"],
        "slurry_swap_time"=> $row["slurry_swap_time"],
        "plug_shutdown_time"=> $row["plug_shutdown_time"],
        "cem_vol_variance"=> $row["cem_vol_variance"],
        "pumper_id"=> $row["pumper_id"],
        "supervisor_id"=> $row["supervisor_id"],
        "calculated_disp"=> $row["calculated_disp"],
        "act_disp_vol"=> $row["act_disp_vol"]
        ];
}

foreach ($peoples as $people)
{
    if ($jobs[0]["supervisor_id"]==$people["id"])
    {
        $users[0]["supervisor_first_name"]=$people["firstname"];
        $users[0]["supervisor_last_name"]=$people["lastname"];
    }
    else if ($jobs[0]["pumper_id"]==$people["id"])
    {
        $users[0]["pumper_first_name"]=$people["firstname"];
        $users[0]["pumper_last_name"]=$people["lastname"];
    }
    if ($_SESSION["id"]==$people["id"])
    {
        $users[0]["firstname"]=$people["firstname"];
        $users[0]["lastname"]=$people["lastname"];
    }
}


render("header1.php","jobanalysis.php",["title" => "Job Analysis","jobs"=>$jobs,"slurries"=>$slurries,"users"=>$users]);
?>