<?php

//configuration
require("../includes/config.php");

$start = $_GET["start"];
$finish = $_GET["finish"];
$xaxis = $_GET["xaxis"];
$yaxis = $_GET["yaxis"];

if(0!=$_GET["series"]) {
    $series = $_GET["series"];
}

if("blank"!=($_GET["customer"])) {
    $customer = $_GET["customer"];
}
else {
    $customer="";
}

$start_date = date("Y-m-d", strtotime($start));
$end_date = date("Y-m-d", strtotime($finish));

// numerically indexed array of places
$geo_cat = $_GET["geo_cat"];
$geo = $_GET["geo"];
$districts_included=[];
$xdata=[];
$ydata=[];
$vols=[];

$all_places = CS50::query("SELECT * FROM places");

if(isset($geo_cat)&&isset($geo))
{
    $places = CS50::query("SELECT * FROM places WHERE ? = ?" , $geo_cat,$geo);
}
else
{
    $places = CS50::query("SELECT * FROM places");
}

foreach($places as $place)
{
    array_push($districts_included, $place["district"]);  
}

if(count($places)==count($all_places)) {
    $not_included="true";
}
else {
    $not_included="";
}

if((strlen($customer)>0)&&(strlen($not_included)>0)) {
    echo("actually entered here");
    foreach($districts_included as $district_include) {
        if(isset($start_date)) {
            if(isset($end_date)) {
                $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND customer=? AND district=? AND job_date>=$start_date AND job_date<=$end_date ORDER BY job_date",$customer,$district_include);        
                echo "1";
                
            }
            else {
                $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND customer=? AND district=? AND job_date>=$start_date ORDER BY job_date", $customer,$district_include);
                echo "2";
                
        }   }
        else {
            $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND customer=? AND district=? ORDER BY job_date",$customer,$district_include);
            echo "3";
                    
}   }   }
else if((strlen($customer)==0)&&(strlen($not_included)>0)) {
    foreach($districts_included as $district_include) {
        if(isset($start_date)) {
            if(isset($end_date)) {
                $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND district=? AND job_date>=$start_date AND job_date<=$end_date ORDER BY job_date",$district_include);        
            
                echo "4";
            }
            else {
                $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND district=? AND job_date>=$start_date ORDER BY job_date",$district_include);
                echo "5";
            
        }   }
        else {
            $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND district=? ORDER BY job_date",$district_include);
            echo "6";
            
}   }   }
else if((strlen($customer)>0)&&(strlen($not_included)==0)) {
    if(isset($start_date)) {
        if(isset($end_date)) {
            $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND customer=? AND job_date>=$start_date AND job_date<=$end_date ORDER BY job_date",$customer);        
            echo "7";    
            
        }
        else {
            $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND customer=? AND job_date>=$start_date ORDER BY job_date", $customer);
            echo "8";
        
    }   }
    else {
        $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND customer=? ORDER BY job_date",$customer);
        echo "9";
            
}   }
else if((strlen($customer)==0)&&(strlen($not_included)==0)) {
    if(isset($start_date)) {
        if(isset($end_date)) {
            $holders = CS50::query("SELECT * FROM jobs WHERE complete = 1 ORDER BY job_date");        
            $jobs=[];
            foreach($holders as $holder) {
                $check_date= date("Y-m-d", strtotime($holder["job_date"]));
                if(($start_date<=$check_date)&&($end_date>=$check_date)) {
                    array_push($jobs,$holder);
        }   }   }
        else {
            $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND job_date>=$start_date ORDER BY job_date");
            echo "11";
            
    }   }
    else {
        $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 ORDER BY job_date");
        echo "12";
        
}   }
else {
    echo "This FAILED!";
}


if("supervisor_id"==$xaxis) {
    $workers= CS50::query("SELECT * FROM users WHERE supervisor = 1 ORDER BY lastname");
    foreach($jobs as $job) {
        foreach($workers as $worker) {
            if($job["supervior_id"]==$worker["id"]) {
                array_push($xdata, $worker["lastname"].", ".$worker["firstname"]);
                array_push($vols,$job["total_cem_vol"]);
}   }   }   }
else if("pumper_id"==$xaxis) {
    $workers= CS50::query("SELECT * FROM users WHERE pumper = 1 ORDER BY lastname");
    foreach($jobs as $job) {
        foreach($workers as $worker) {
            if($job["pumper_id"]==$worker["id"]) {
                array_push($xdata, $worker["lastname"].", ".$worker["firstname"]);
                array_push($vols,$job["total_cem_vol"]);
}   }   }   }
else if("pump_id"==$xaxis) {
    $workers= CS50::query("SELECT * FROM pumps");
    foreach($jobs as $job) {
        foreach($workers as $worker) {
            if($job["pump_id"]==$worker["id"]) {
                array_push($xdata, $worker["pump"]);
                array_push($vols,$job["total_cem_vol"]);
}   }   }   }
else if("job_type"==$xaxis)
{
    foreach($jobs as $job) {
        array_push($xdata, $job["job_type"]);
        array_push($vols,$job["total_cem_vol"]);
}   }   
else if("well"==$xaxis) {
    foreach($jobs as $job) {
        array_push($xdata, $job["well_name"]." ".$job["well_number"]);
        array_push($vols,$job["total_cem_vol"]);
}   }   
else if("job"==$xaxis) {
    foreach($jobs as $job) {
        array_push($xdata, $job["well_name"]." ".$job["well_number"]." ".$job["job_type"]);
        array_push($vols,$job["total_cem_vol"]);
}   }
else if("date"==$xaxis) {
    foreach($jobs as $job) {
        array_push($xdata, $job["job_date"]);
        array_push($vols,$job["total_cem_vol"]);
}   }
else if("geography"==$xaxis) {
    if(isset($geo_cat)) {
        if($hemisphere==$geo_cat) {
            foreach($jobs as $job) {
                foreach($places as $place) {
                    if($job["district"]==$place["district"]) {
                        array_push($xdata, $place["region"]);
                        array_push($vols,$job["total_cem_vol"]);
        }   }   }   }
        else if($region==$geo_cat) {
            foreach($jobs as $job) {
                foreach($places as $place) {
                    if($job["district"]==$place["district"]) {
                        array_push($xdata, $place["area"]);
                        array_push($vols,$job["total_cem_vol"]);
        }   }   }   }
        else if($area==$geo_cat) {
            foreach($jobs as $job) {
                foreach($places as $place) {
                    if($job["district"]==$place["district"]) {
                        array_push($xdata, $place["district"]);
                        array_push($vols,$job["total_cem_vol"]);
        }   }   }   }
        else if($district==$geo_cat) {
            foreach($jobs as $job) {
                foreach($places as $place) {
                    if($job["district"]==$place["district"]) {
                        array_push($xdata, $place["district"]);
                        array_push($vols,$job["total_cem_vol"]);
    }   }   }   }   }
    else {
        foreach($jobs as $job) {
            foreach($places as $place) {
                if($job["district"]==$place["district"]) {
                    array_push($xdata, $place["hemisphere"]);
                    array_push($vols,$job["total_cem_vol"]);
}   }   }   }   }

if("density"==$yaxis) {
    foreach($jobs as $job) {
        array_push($ydata, $job["dens_accur"]);
}   }   
else if("shutdowns"==$yaxis) {
    foreach($jobs as $job) {
        array_push($ydata, $job["shutdowns"]);
}   }   
else if("cem_vol_var"==$yaxis) {
    foreach($jobs as $job) {
        array_push($ydata, $job["cem_vol_variance"]);
}   }       
else if("slurry_swap_time"==$yaxis) {
    foreach($jobs as $job) {
        array_push($ydata, $job["slurry_swap_time"]);
}   }
else if("plug_shutdown_time"==$yaxis) {
    foreach($jobs as $job) {
        array_push($ydata, $job["plug_shutdown_time"]);
}   }       
else if("jobs"==$yaxis) {
    foreach($jobs as $job) {
        array_push($ydata, 1);
}   }       
else if("disp_vol_var"==$yaxis) {
    foreach($jobs as $job) {
        $variance=abs($job["calculated_disp"]-$job["act_disp_vol"])/$job["calculated_disp"];
        array_push($ydata, $variance);
}   }

if("date"==$xaxis)
{
   for($i=0;$i<count($xdata);$i++)
   {
        $total_y=0;
        $total_weight=0;
        $matches=[];
    
        for($j=$i+1;$j<count($xdata);$j++)
        {
            array_push($matches,$i);
            
            if(strcmp(substr($xdata[$i],0,4),substr($xdata[$j],0,4))==0&&strcmp(substr($xdata[$i],5,2),substr($xdata[$j],5,2))==0)
            {
                array_push($matches,$j);
                
            }
            if($j==count($xdata)-1)
            {
                for($z=0;$z<count($matches);$z++)
                {
                    $spot=$matches[$z];
                    $total_y=$total_y+$ydata[$spot]*$vols[$spot];
                    $total_weight=$total_weight+$vols[$spot];
                }
                
                for($zz=0;$zz<count($matches);$zz++)
                {
                    $new_spot=$matches[$zz];
                    $ydata[$new_spot]=$total_y/$total_weight;
                }
            }
        }    
   }
}
else if ("pumper_id"==$xaxis)
{
   $matches=[];
   
   $ii=1;
   for($i=0;$i<count($xdata);$i++)
   {
        array_push($matches,0);
   }
   for($i=0;$i<count($xdata);$i++)
   {
        if($matches[$i]==0)
        {
            for($j=$i+1;$j<count($xdata);$j++)
            {
                if(strcmp($xdata[$i],$xdata[$j])==0)
                {
                    $matches[$j]=$matches[$i];
                }
            }
        }
   }
}


$plot_data=[];
$counter=0;

if (count($xdata)==count($ydata))
{
    foreach($xdata as $xdatum)
    {
        $plot_data[$counter]["xdata"]=$xdatum;
        $plot_data[$counter]["ydata"]=$ydata[$counter];
        $counter=$counter+1;        
    }
}


// output jobs as JSON (pretty-printed for debugging convenience)
header("Content-type: application/json");
print(json_encode($plot_data, JSON_PRETTY_PRINT));

?>