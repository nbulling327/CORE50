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
            <!-- http://silviomoreto.github.io/bootstrap-select/ -->
            <link href="/css/bootstrap-select.min.css" rel="stylesheet"/>
            <!-- website's own css -->
            <link rel="stylesheet" href="/css/styles.css">
        
        <!-- Active JS Files -->
            <!-- https://jquery.com/ -->
            <script src="/js/jquery-1.11.3.min.js"></script>
            <!-- http://twitter.github.io/typeahead.js/ -->
            <script src="/js/typeahead.bundle.min.js"></script>
            <!-- http://silviomoreto.github.io/bootstrap-select/ -->
            <script src="/js/bootstrap-select.min.js"></script>
            <!-- http://getbootstrap.com/ -->
            <script src="/js/bootstrap.min.js"></script>
            <!-- website's own js -->
            <script src="/js/scripts.js"></script>
            
        <link rel="icon" href="/images/favicon.ico?" type="image/x-icon">
        <?php if (isset($title)): ?>
            <title>CORE: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>CORE</title>
        <?php endif ?>    
    </head>    
    <body>
        <nav class="navbar navbar-default" role="navigation" style="color: #ffffff;">
            <div id="loghead" class = "container-fluid">
                <div class="col-xs-3">
                    <div class="row">
                    Cement
                    </div>
                    <div class="row">
                    Operational 
                    </div>
                    <div class="row">
                    Results 
                    </div>
                    <div class="row">
                    Evaluation 
                    </div>
                </div>
                <div class="col-xs-1 col-xs-offset-8">
                    
                    <div id="loginpageheaderbutton">
                        <br/>
                     <button id="register" type="button" class="btn my-btn"> <a id="signup" href="register.php">Sign Up <span aria-hidden="true" class="glyphicon glyphicon-modal-window"></span></a></button>
                    </div>
                </div>    
            </div>
        </nav>
        <div id="middle">
