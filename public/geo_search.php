<?php

    require(__DIR__ . "/../includes/config.php");

    // numerically indexed array of places
    $geoinfos = [];
    $landmark='blank';
    $geomarks=[];
    
    $key_word = $_GET["geo"];
    
    if($key_word!='0')
    {
        $places = CS50::query("SELECT * FROM places ORDER BY ? ASC" , $key_word);
    
    $i=0;
    $j=0;
    $k=0;
    
        foreach($places as $place)
        {
            if (strcmp($landmark, $place["$key_word"]) !== 0) 
            {
                $geoinfos[$j]["point"]= $place["$key_word"];
                $j=$j+1;
            }
            $landmark=$place["$key_word"];
            $i=$i+1;        
        }
        
        asort($geoinfos);
        foreach($geoinfos as $geoinfo)
        {
            $geomarks[$k]["point"] = $geoinfo["point"];
            $k=$k+1;
        }
    }
    else {
        $geomarks[0]["point"]="";
    }
    
    // output jobs as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($geomarks, JSON_PRETTY_PRINT));

?>