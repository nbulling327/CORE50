<?php

//configuration
    require("../includes/config.php");
    $rows[0]["id"] = "0";
    $rows[0]["company"] = "Halliburton";
    $rows[0]["domain"] = "halliburton.com";
    
    //$rows[0]="{'id':'0','company':'Halliburton','domain':'halliburton.com'}";
    $comps = CS50::query("SELECT * FROM companies ORDER BY company");
    foreach ($comps as $comp) {
            array_push($rows, $comp);
    }
 
        
        print json_encode($rows);

?>