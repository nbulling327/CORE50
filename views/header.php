<!DOCTYPE html>


<!--
Created by Nick Bullington
A method of tracking on-location cement job results for improvement.

CORE
-->
<html>
    <head>
        <!-- http://getbootstrap.com/ -->
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        
        <!-- http://nicolasbize.com/magicsuggest/ -->
        <link href="/css/magicsuggest-min.css" rel="stylesheet"/>
        
        <!-- website's own css -->
        <link rel="stylesheet" href="/css/styles.css">
        
        <!-- https://jquery.com/ -->
        <script src="/js/jquery-1.11.3.min.js"></script>
        
        <!-- http://twitter.github.io/typeahead.js/ -->
        <script src="/js/bloodhound.min.js"></script>
        <script src="/js/typeahead.jquery.min.js"></script>
        <script src="/js/typeahead.bundle.min.js"></script>
        


        
        <!-- http://nicolasbize.com/magicsuggest/ -->
        <script src="/js/magicsuggest.js"></script>
        
        <!-- http://getbootstrap.com/ -->
        <script src="/js/bootstrap.min.js"></script>

        <script src="/js/scripts.js"></script>
        
        <link rel="icon" href="/img/favicon.ico?" type="image/x-icon">
        
        <?php if (isset($title)): ?>
            <title>CORE: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>CORE</title>
        <?php endif ?>    
        
    </head>    
    
    <body>
        <div class = "container">
            <div id="top">
                <h1>Cement Operational Results Evaluation</h1>
            </div>
        <div id="middle">
