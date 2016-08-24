<?php

//configuration
require("../includes/config.php");

$start = $_GET["start"];
$finish = $_GET["finish"];
$xaxis = $_GET["xaxis"];
$yaxis = $_GET["yaxis"];

if(isset($_GET["series"])) {
    if(0!=$_GET["series"]) {
        $series = $_GET["series"];
    }
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

$districts_included=[];
$xdata=[];
$ydata=[];
$vols=[];
$jobs=[];

$all_places = CS50::query("SELECT * FROM places");

if(isset($_GET["geo_cat"])&&isset($_GET["geo"])&&strcmp("blank",$_GET["geo"])!=0)
{
    $geo_cat = $_GET["geo_cat"];
    $geo = $_GET["geo"];
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
    for($i=0;$i<count($districts_included);$i++) {
        if(isset($start_date)) {
            if(isset($end_date)) {
                $holders = CS50::query("SELECT * FROM jobs WHERE customer='$customer' AND complete = 1 AND district='$districts_included[$i]' AND job_date>='$start_date' AND job_date<='$end_date' ORDER BY job_date");        
                foreach ($holders as $holder) {
                    $check_date= date("Y-m-d", strtotime($holder["job_date"]));
                    if(($start_date<=$check_date)&&($end_date>=$check_date)) {
                        array_push($jobs,$holder);
            }   }   }
            else {
                $holders = CS50::query("SELECT * FROM jobs WHERE customer='$customer' AND complete = 1 AND district='$districts_included[$i]' AND job_date>='$start_date' ORDER BY job_date");        
                foreach ($holders as $holder) {
                    $check_date= date("Y-m-d", strtotime($holder["job_date"]));
                    if($start_date<=$check_date) {    
                        array_push($jobs,$holder);
        }   }   }   }
        else {
            $holders = CS50::query("SELECT * FROM jobs WHERE customer='$customer' AND complete = 1 AND district='$districts_included[$i]' ORDER BY job_date");        
            foreach ($holders as $holder) {
                array_push($jobs,$holder);
                    
}   }   }   }   
else if((strlen($customer)==0)&&(strlen($not_included)>0)) {
    for($i=0;$i<count($districts_included);$i++) {
        if(isset($start_date)) {
            if(isset($end_date)) {
                $holders = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND district='$districts_included[$i]' AND job_date>='$start_date' AND job_date<='$end_date' ORDER BY job_date");        
                foreach ($holders as $holder) {
                    $check_date= date("Y-m-d", strtotime($holder["job_date"]));
                    if(($start_date<=$check_date)&&($end_date>=$check_date)) {
                        array_push($jobs,$holder);
            }   }   }
            else {
                $holders = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND district='$districts_included[$i]' AND job_date>='$start_date' ORDER BY job_date");        
                foreach ($holders as $holder) {
                    $check_date= date("Y-m-d", strtotime($holder["job_date"]));
                    if($start_date<=$check_date) {    
                        array_push($jobs,$holder);
        }   }   }   }
        else {
            $holders = CS50::query("SELECT * FROM jobs WHERE customer='$customer' AND complete = 1 AND district='$districts_included[$i]' ORDER BY job_date");        
            foreach ($holders as $holder) {
                array_push($jobs,$holder);
}   }   }   }
else if((strlen($customer)>0)&&(strlen($not_included)==0)) {
    if(isset($start_date)) {
        if(isset($end_date)) {
            $holders = CS50::query("SELECT * FROM jobs WHERE customer='$customer' AND complete = 1 AND job_date>='$start_date' AND job_date<='$end_date' ORDER BY job_date");        
            foreach ($holders as $holder) {
                $check_date= date("Y-m-d", strtotime($holder["job_date"]));
                if(($start_date<=$check_date)&&($end_date>=$check_date)) {
                    array_push($jobs,$holder);
        }    }  }
        else {
            $holders = CS50::query("SELECT * FROM jobs WHERE customer='$customer' AND complete = 1 AND job_date>='$start_date' ORDER BY job_date");        
            foreach ($holders as $holder) {
                $check_date= date("Y-m-d", strtotime($holder["job_date"]));
                if($start_date<=$check_date) {
                    array_push($jobs,$holder);
    }   }   }   }
    else {
        $holders = CS50::query("SELECT * FROM jobs WHERE customer='$customer' AND complete = 1 AND ORDER BY job_date");        
        foreach ($holders as $holder) {
            array_push($jobs,$holder);    
}   }   }
else if((strlen($customer)==0)&&(strlen($not_included)==0)) {
    if(isset($start_date)) {
        if(isset($end_date)) {
            $holders = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND job_date>='$start_date' AND job_date<='$end_date' ORDER BY job_date");        
            foreach($holders as $holder) {
                $check_date= date("Y-m-d", strtotime($holder["job_date"]));
                if(($start_date<=$check_date)&&($end_date>=$check_date)) {
                    array_push($jobs,$holder);
        }   }   }
        else {
            $holders = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND job_date>='$start_date' AND ORDER BY job_date");        
            foreach($holders as $holder) {
                $check_date= date("Y-m-d", strtotime($holder["job_date"]));
                if($start_date<=$check_date) {
                    array_push($jobs,$holder);
    }   }   }   }
    else {
        $holders = CS50::query("SELECT * FROM jobs WHERE complete = 1 AND ORDER BY job_date");        
            foreach($holders as $holder) {
                array_push($jobs,$holder);
}   }   }
else {
    echo "This FAILED!";
}

if("supervisor_id"==$xaxis||"slurry_density"==$xaxis||"pumper_id"==$xaxis||"slurry_function"==$xaxis||"pump_id"==$xaxis||"job_type"==$xaxis||"well"==$xaxis||"job"==$xaxis||"date"==$xaxis||"geo"==$xaxis)
{
    if("supervisor_id"==$xaxis) {
        $workers= CS50::query("SELECT * FROM users WHERE supervisor = 1 ORDER BY lastname");
        foreach($jobs as $job) {
            foreach($workers as $worker) {
                if($job["supervisor_id"]==$worker["id"]) {
                    array_push($xdata, $worker["lastname"].", ".$worker["firstname"]);
                    if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
                    else {array_push($vols,$job["total_cem_vol"]); }
    }   }   }   }
    else if("pumper_id"==$xaxis) {
        $workers= CS50::query("SELECT * FROM users WHERE pumper = 1 ORDER BY lastname");
        foreach($jobs as $job) {
            foreach($workers as $worker) {
                if($job["pumper_id"]==$worker["id"]) {
                    array_push($xdata, $worker["lastname"].", ".$worker["firstname"]);
                    if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
                    else {array_push($vols,$job["total_cem_vol"]); }
    }   }   }   }
    else if("pump_id"==$xaxis) {
        $workers= CS50::query("SELECT * FROM pumps");
        foreach($jobs as $job) {
            foreach($workers as $worker) {
                if($job["pump_id"]==$worker["id"]) {
                    array_push($xdata, $worker["pump"]);
                    if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
                    else {array_push($vols,$job["total_cem_vol"]); }
    }   }   }   }
    else if("job_type"==$xaxis) {
        foreach($jobs as $job) {
            array_push($xdata, $job["job_type"]);
            if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
            else {array_push($vols,$job["total_cem_vol"]); }
    }   }   
    else if("slurry_density"==$xaxis) {
        if("disp_vol_var"==$yaxis) {
            echo json_encode(array("1","1"));
            exit(400);
        }
        $functions=[];
        $workers= CS50::query("SELECT * FROM slurries");
        foreach($jobs as $job) {
            foreach($workers as $worker) {
                if($job["id"]==$worker["job_id"]) {
                    array_push($xdata, $worker["density"]);
                    array_push($vols,$worker["act_vol"]);
                    array_push($functions,$worker["density"]);
    }   }   }   }
    else if("slurry_function"==$xaxis) {
        if("disp_vol_var"==$yaxis) {
            echo json_encode(array("1","1"));
            exit(400);
        }
        $functions=[];
        $workers= CS50::query("SELECT * FROM slurries");
        foreach($jobs as $job) {
            foreach($workers as $worker) {
                if($job["id"]==$worker["job_id"]) {
                    array_push($xdata, $worker["function"]);
                    array_push($vols,$worker["act_vol"]);
                    array_push($functions,$worker["function"]);
    }   }   }   }
    else if("well"==$xaxis) {
        foreach($jobs as $job) {
            array_push($xdata, $job["customer"]." ".$job["well_name"]." ".$job["well_number"]);
            if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
            else {array_push($vols,$job["total_cem_vol"]); }
    }   }   
    else if("job"==$xaxis) {
        foreach($jobs as $job) {
            array_push($xdata, $job["well_name"]." ".$job["well_number"]." ".$job["job_type"]);
            if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
            else {array_push($vols,$job["total_cem_vol"]); }
    }   }
    else if("date"==$xaxis) {
        foreach($jobs as $job) {
            array_push($xdata, $job["job_date"]);
            if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
            else {array_push($vols,$job["total_cem_vol"]); }
    }   }
    else if("geo"==$xaxis) {
        if(isset($geo_cat)) {
            if("hemisphere"==$geo_cat) {
                foreach($jobs as $job) {
                    foreach($places as $place) {
                        if($job["district"]==$place["district"]) {
                            array_push($xdata, $place["region"]);
                            if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
                            else {array_push($vols,$job["total_cem_vol"]); }
            }   }   }   }
            else if("region"==$geo_cat) {
                foreach($jobs as $job) {
                    foreach($places as $place) {
                        if($job["district"]==$place["district"]) {
                            array_push($xdata, $place["area"]);
                            if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
                            else {array_push($vols,$job["total_cem_vol"]); }
            }   }   }   }
            else if("area"==$geo_cat) {
                foreach($jobs as $job) {
                    foreach($places as $place) {
                        if($job["district"]==$place["district"]) {
                            array_push($xdata, $place["district"]);
                            if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
                            else {array_push($vols,$job["total_cem_vol"]); }
            }   }   }   }
            else if("district"==$geo_cat) {
                foreach($jobs as $job) {
                    foreach($places as $place) {
                        if($job["district"]==$place["district"]) {
                            array_push($xdata, $place["district"]);
                            if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
                            else {array_push($vols,$job["total_cem_vol"]); }
        }   }   }   }   }
        else {
            foreach($jobs as $job) {
                foreach($places as $place) {
                    if($job["district"]==$place["district"]) {
                        array_push($xdata, $place["hemisphere"]);
                        if("disp_vol_var"==$yaxis) { array_push($vols,$job["act_disp_vol"]); }
                        else {array_push($vols,$job["total_cem_vol"]); }
    }   }   }   }   }

    if("slurry_function"!=$xaxis&&"slurry_density"!=$xaxis) {
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
                if($job["slurries"]-$job["stage_count"]>0) {
                    array_push($ydata, $job["slurry_swap_time"]);    
                }
        }   }
        else if("plug_shutdown_time"==$yaxis)   {
            foreach($jobs as $job) {
                array_push($ydata, $job["plug_shutdown_time"]);
        }   }       
        else if("jobs"==$yaxis) {
            foreach($jobs as $job) {
                array_push($ydata, 1);
        }   }       
        else if("disp_vol_var"==$yaxis) {
            foreach($jobs as $job) {
                $variance=abs($job["calculated_disp"]-$job["act_disp_vol"])*100/$job["calculated_disp"];
                array_push($ydata, $variance);
    }   }   }
    else if ("slurry_function"==$xaxis||"slurry_density"==$xaxis) {
        foreach($jobs as $job) {
            foreach($workers as $worker) {
                if($job["id"]==$worker["job_id"]) {
                    if("density"==$yaxis) {
                        array_push($ydata, $worker["dens_acc"]);
                    }
                    else if("cem_vol_var"==$yaxis) {
                        array_push($ydata, $worker["vol_var"]);    
                    }
}   }   }   }   }   

if("date"==$xaxis) {
    for($i=0;$i<count($xdata);$i++) {
        $total_y=0;
        $total_weight=0;
        $matches=[];
        array_push($matches,$i);
        for($j=$i+1;$j<count($xdata);$j++) {
            if(strcmp(substr($xdata[$i],0,4),substr($xdata[$j],0,4))==0&&strcmp(substr($xdata[$i],5,2),substr($xdata[$j],5,2))==0) {
                array_push($matches,$i);
            }
            else {
                array_push($matches,$j);
            }
            if($j==count($xdata)-1) {
                for($z=0;$z<count($matches);$z++) {
                    $spot=$matches[$z];
                    if($spot==$matches[0]) {
                        if("shutdowns"==$yaxis||"plug_shutdown_time"==$yaxis) {
                            $total_y=$total_y+$ydata[$z+$i];
                            $total_weight=$total_weight+1;
                        }
                        else if ("jobs"==$yaxis) {
                            $total_y=$total_y+$ydata[$z+$i];
                            $total_weight=1;
                        }
                        else {
                        $total_y=$total_y+$ydata[$z+$i]*$vols[$z+$i];
                        $total_weight=$total_weight+$vols[$z+$i];
                }   }   }
                for($zz=0;$zz<count($matches);$zz++) {
                    if($matches[$zz]==$matches[0]) {
                        $new_spot=$zz+$i;
                        $ydata[$new_spot]=$total_y/$total_weight;
}   }   }   }   }   }

if ("date"==$xaxis||"slurry_function"==$xaxis||"slurry_density"==$xaxis||"pumper_id"==$xaxis||"supervisor_id"==$xaxis||"pump_id"==$xaxis||"job_type"==$xaxis||"geo"==$xaxis||"well"==$xaxis)
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
    }   }   }   }
    $x_holder=[];
    for($ll=1;$ll<$ii;$ll++) {
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
                if("shutdowns"==$yaxis||"plug_shutdown_time"==$yaxis) {
                    $y_holder[$jj-1]=$y_holder[$jj-1]+$ydata[$k];
                    $vol_holder[$jj-1]=$vol_holder[$jj-1]+1;    
                }
                else if ("jobs"==$yaxis) {
                    $y_holder[$jj-1]=$y_holder[$jj-1]+$ydata[$k];
                    $vol_holder[$jj-1]=1;
                }
                else {
                    $y_holder[$jj-1]=$y_holder[$jj-1]+$ydata[$k]*$vols[$k];
                    $vol_holder[$jj-1]=$vol_holder[$jj-1]+$vols[$k];
                }    
            }
        } 
    }
    for($l=0;$l<count($y_holder);$l++) {
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