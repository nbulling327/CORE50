<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/">Input Proposal Information</a></li>
        <li class="active"><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="#">View Job Database</a></li>
        <li><a href="#">Analyze Job Data</a></li>
    </ul>
</div>

<div class = "container">
<div class= "col-xs-7">
    <h3>Job Chart</h3>
    <div id="flot-placeholder" style="width:700px;height:350px"></div>
</div>
<div class= "col-xs-5">
    <br/><br/>
    <form action = "postjob.php" method="post" enctype="multipart/form-data">
        <div class = "row">
            <div class = "col-xs-6 col-xs-offset-3">
                <div id="overview" style="width:240px;height:120px"></div>
            </div>
        </div>
        <div class="row">
            <div class = "col-xs-4 col-xs-offset-2">
                Start Slurry 1:
            </div>
            <div class = "col-xs-4 col-xs-offset-2">
                Stop Slurry 1:
            </div>
        </div>
        <div class="row">
            <div class = "col-xs-4 col-xs-offset-2">
                <div class="input-group input-group-sm">
                    <input autocomplete="off" autofocus class="form-control" name="slurry_1_start" placeholder="Slurry 1 Start" type="text"/>
                </div>
            </div>
            <div class = "col-xs-4 col-xs-offset-2">
                <div class="input-group input-group-sm">
                    <input autocomplete="off" autofocus class="form-control" name="slurry_1_stop" placeholder="Slurry 1 Stop" type="text"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class = "col-xs-4 col-xs-offset-2">
                Start Displacement:
            </div>
            <div class = "col-xs-4 col-xs-offset-2">
                Stop Displacement:
            </div>
        </div>
        <div class="row">
            <div class = "col-xs-4 col-xs-offset-2">
                <div class="input-group input-group-sm">
                    <input autocomplete="off" autofocus class="form-control" name="displacement_start" placeholder="Displacement Start" type="text"/>
                </div>
            </div>
            <div class = "col-xs-4 col-xs-offset-2">
                <div class="input-group input-group-sm">
                    <input autocomplete="off" autofocus class="form-control" name="displacement_stop" placeholder="Displacement Stop" type="text"/>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-xs-12">
                <button class="btn my-btn" type="submit" value="Upload CSV" name="submit">
                    Complete Job Submission
                    <span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </form>
</div>
</div>