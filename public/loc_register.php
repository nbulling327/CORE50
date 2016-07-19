<?php
//configuration
    require("../includes/config.php");
    $districts = CS50::query("SELECT * FROM places ORDER BY region, district");
    print json_encode($districts);
?>