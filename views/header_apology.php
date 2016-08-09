<!DOCTYPE html>


<!--
Created by Nick Bullington
A method of tracking on-location cement job results for improvement.

CORE
-->
<html>
    <head>
        <!-- Active CSS Files -->
            <!-- http://getbootstrap.com/ -->
                <link href="/css/bootstrap.min.css" rel="stylesheet"/>
            <!-- website's own css -->
                <link rel="stylesheet" href="/css/styles.css">
        <!-- Active JS Files -->
            <!-- https://jquery.com/ -->
                <script src="/js/jquery-1.11.3.min.js"></script>
            <!-- http://getbootstrap.com/ -->
                <script src="/js/bootstrap.min.js"></script>
            <!-- website's own js -->
                <script src="/js/scripts.js"></script>
            
        <link rel="icon" href="/img/favicon.ico?" type="image/x-icon">
        <?php if (isset($title)): ?>
            <title>CORE: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>CORE</title>
        <?php endif ?>    
    </head>    
    <body>
        <nav class="navbar navbar-default" role="navigation" style="color: #ffffff;">
            <div id="errhead" class = "container-fluid">
                <div class="row col-xs-12">
                    Cement Operational Results Evaluation 
                </div>
            </div>
        </nav>
        <div id="middle">
