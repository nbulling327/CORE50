<?php

    require(__DIR__ . "/../includes/config.php");

    // numerically indexed array of places
    $jobinfos = [];

    // TODO: search database for places matching $_GET["geo"], store in $jobinfos
    $key_word = $_GET["customer"];
        $jobinfos = CS50::query("SELECT * FROM jobs WHERE customer = ? ORDER BY well_name DESC" , $key_word);
    // output jobs as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($jobinfos, JSON_PRETTY_PRINT));

?>