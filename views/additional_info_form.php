<br/><br/><br/>
<form action="userinfo.php" method="post">
    <fieldset>
        <div class="row">
            <div class="form-group">
            <div class="col-md-7 col-md-offset-2">
                <label for="role" class="control-label" >Selected Role:</label>
                <input type="text" class="form-control" id="role" name="role"/>
            </div>
            <div class="input-group role col-md-pull-1">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Function
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a name="role" value="pumper">Pump Truck Operator</a></li>
                        <li><a name="role" value="supervisor">Supervisor</a></li>
                        <li><a name="role" value="both">Operator/Supervisor</a></li>
                        <li class="divider"></li>
                        <li><a name="role" value="proposal">Proposal Generator</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="form-group">
            <div class="col-md-7 col-md-offset-2">
                <label for="district" class="control-label" >Selected District:</label>
                <input type="text" class="form-control" id="district" name="district"/>
            </div>
            <div class="input-group district col-md-pull-1">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">District
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a name="district" value="vernal">Vernal, UT</a></li>
                        <li><a name="district" value="rocksprings">Rock Springs, WY</a></li>
                        <li><a name="district" value="brighton">Brighton, CO</a></li>
                        <li class="divider"></li>
                        <li><a name="district" value="other">Other</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Complete Registration
            </button>
        </div>
        
        
    </fieldset>
</form>

<br/><br/>

