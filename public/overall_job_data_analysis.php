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

if($end_date<date("Y-m-d", strtotime("01/01/1995")))
{
    $end_date=date("Y-m-d", strtotime("12/31/2050"));
}

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
    $places = CS50::query("SELECT * FROM places WHERE $geo_cat = ?" , $geo);
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
    $not_included="";
}
else {
    $not_included="true";
}
if((strlen($customer)>0)&&(strlen($not_included)>0)) {
    $jobs=[];
    for($i=0;$i<count($districts_included);$i++) {
        if(isset($start_date)) {
            if(isset($end_date)) {
                $holders = CS50::query("SELECT * FROM jobs WHERE customer='$customer' AND complete = 1 AND district='$districts_included[$i]' AND job_date>='$start_date' AND job_date<='$end_date' ORDER BY job_date");        
                foreach ($holders as $holder) {
                    array_push($jobs,$holder);
                }
                
            }
            else {
                $holders = CS50::query("SELECT * FROM jobs WHERE customer='$customer' AND complete = 1 AND district='$districts_included[$i]' AND job_date>='$start_date' ORDER BY job_date");        
                foreach ($holders as $holder) {
                    array_push($jobs,$holder);
        }   }   }
        else {
            $jobs = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND customer=? AND district=? ORDER BY job_date",$customer,$district_include);
            echo "3";
                    
}   }   }
else if((strlen($customer)==0)&&(strlen($not_included)>0)) {
    $jobs=[];
    for($i=0;$i<count($districts_included);$i++) {
        if(isset($start_date)) {
            if(isset($end_date)) {
                $holders = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND district='$districts_included[$i]' AND job_date>='$start_date' AND job_date<='$end_date' ORDER BY job_date");        
                foreach ($holders as $holder) {
                    array_push($jobs,$holder);
                }
                
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

if("supervisor_id"==$xaxis||"pumper_id"==$xaxis||"pump_id"==$xaxis||"job_type"==$xaxis||"well"==$xaxis||"job"==$xaxis||"date"==$xaxis||"geo"==$xaxis)
{
if("supervisor_id"==$xaxis) {
    $workers= CS50::query("SELECT * FROM users WHERE supervisor = 1 ORDER BY lastname");
    foreach($jobs as $job) {
        foreach($workers as $worker) {
            if($job["supervisor_id"]==$worker["id"]) {
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
        array_push($xdata, $job["customer"]." ".$job["well_name"]." ".$job["well_number"]);
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
else if("geo"==$xaxis) {
    if(isset($geo_cat)) {
        if("hemisphere"==$geo_cat) {
            foreach($jobs as $job) {
                foreach($places as $place) {
                    if($job["district"]==$place["district"]) {
                        array_push($xdata, $place["region"]);
                        array_push($vols,$job["total_cem_vol"]);
        }   }   }   }
        else if("region"==$geo_cat) {
            foreach($jobs as $job) {
                foreach($places as $place) {
                    if($job["district"]==$place["district"]) {
                        array_push($xdata, $place["area"]);
                        array_push($vols,$job["total_cem_vol"]);
        }   }   }   }
        else if("area"==$geo_cat) {
            foreach($jobs as $job) {
                foreach($places as $place) {
                    if($job["district"]==$place["district"]) {
                        array_push($xdata, $place["district"]);
                        array_push($vols,$job["total_cem_vol"]);
        }   }   }   }
        else if("district"==$geo_cat) {
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

}






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

if ("date"==$xaxis||"pumper_id"==$xaxis||"supervisor_id"==$xaxis||"pump_id"==$xaxis||"job_type"==$xaxis||"geo"==$xaxis||"well"==$xaxis)
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
            $matches[$i]=$ii;
            $ii++;
            for($j=$i+1;$j<count($xdata);$j++)
            {
                if(strcmp($xdata[$i],$xdata[$j])==0)
                {
                    $matches[$j]=$matches[$i];
                }
            }
        }
   }
    $x_holder=[];
    for($ll=1;$ll<$ii;$ll++)
    {
        $y_holder[$ll-1]=0;
        $vol_holder[$ll-1]=0;
        $y_sort[$ll-1]=0;
    }
    $y_temp=[];
    for($jj=1;$jj<$ii;$jj++)
    {
        for($k=0;$k<count($xdata);$k++)
        {
            if($matches[$k]==$jj)
            {
                if (count($x_holder)==($jj-1))
                {
                    $x_holder[$jj-1]=$xdata[$k];   
                }
                $y_holder[$jj-1]=$y_holder[$jj-1]+$ydata[$k]*$vols[$k];
                $vol_holder[$jj-1]=$vol_holder[$jj-1]+$vols[$k];
            }
        } 
    }
    for($l=0;$l<count($y_holder);$l++)
    {
        $y_temp[$l]=$y_holder[$l]/$vol_holder[$l];
    }
    $x_sort=$x_holder;
    sort($x_sort, SORT_NATURAL | SORT_FLAG_CASE);
    for($m=0;$m<count($x_sort);$m++)
    {
        for($n=0;$n<count($x_sort);$n++)
        {
            if($x_sort[$m]==$x_holder[$n])
            {
                $y_sort[$m]=$y_temp[$n];
            }
        }
    }
    $xdata=[];
    $ydata=[];
    for($n=0;$n<count($y_sort);$n++)
    {
        if($n==0)
        {
            array_push($xdata,$x_sort[$n]);
            array_push($ydata,$y_sort[$n]);
        }
        else if("date"==$xaxis&&strcmp(substr($x_sort[$n],0,7),substr($x_sort[$n-1],0,7))!=0)
        {
            array_push($xdata,$x_sort[$n]);
            array_push($ydata,$y_sort[$n]);
        }
        else if ("date"!=$xaxis)
        {
            array_push($xdata,$x_sort[$n]);
            array_push($ydata,$y_sort[$n]);
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