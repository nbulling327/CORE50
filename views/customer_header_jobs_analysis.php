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
            <!-- https://eonasdan.github.io/bootstrap-datetimepicker/ -->
                <link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
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
            <!-- http://momentjs.com/ -->    
                <script src="/js/moment.min.js"></script>
            <!--https://eonasdan.github.io/bootstrap-datetimepicker/-->
                <script src="/js/bootstrap-datetimepicker.min.js"></script>
            <!-- https://www.gstatic.com/charts/loader.js -->
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <!-- website's own js -->
                <script src="/js/analysis_script.js"></script>
                <script src="/js/google_jobs_analysis.js"></script>

        <link rel="icon" href="/images/favicon.ico?" type="image/x-icon">
        <?php if (isset($title)): ?>
            <title>CORE: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>CORE</title>
        <?php endif ?>    

    </head>    
    <body>
        <nav class="navbar navbar-default" role="navigation" style="color: #ffffff;">
            <div class = "container-fluid">
                <div id="loghead" class="col-xs-3">
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
                <div class="col-xs-4 col-xs-offset-1">
                    <br/>
                    Signed in as
                    <?php 
                        $firstname=$users[0]["firstname"];
                        $lastname=$users[0]["lastname"];
                        echo "$firstname" . ' ' ."$lastname";
                    ?>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Options <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php">Log Out</a></li>
                            <li><a href="password_update.php">Update Password</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="middle">
