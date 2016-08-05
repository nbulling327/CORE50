<br/>
<div id="registerform" class="container-fluid" style="text-align: left;">
<form action="register.php" method="post">
    <div class="row">
        <div class="col-xs-offset-3 col-xs-3">
            Name
        </div>
    </div>
    <div class="row">
        <div class="col-xs-offset-3 col-xs-4">
            <div class="form-group">
                <input autocomplete="off" autofocus class="form-control" name="firstname" placeholder="First Name" type="text"/>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <input autocomplete="off" autofocus class="form-control" name="lastname" placeholder="Last Name" type="text"/>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-offset-3 col-xs-3">
            Choose a user name
        </div>
    </div>
    <div class="row">
        <div class="col-xs-offset-3 col-xs-4">
            <div class="form-group">
                <input autocomplete="off" autofocus class="form-control" name="username" placeholder="Username" type="text"/>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-offset-3 col-xs-3">
            Choose a password
        </div>
        <div class="col-xs-offset-1 col-xs-4">
            Confirm Password
        </div>
    </div>
    <div class="row">
        <div class="col-xs-offset-3 col-xs-4">
            <div class="form-group">
                <input class="form-control" name="password" placeholder="Password" type="password"/>
            </div>        
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <input class="form-control" name="confirmation" placeholder="Password" type="password"/>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-offset-3 col-xs-3">
            Choose your company
        </div>
        <div class="col-xs-offset-1 col-xs-4">
            Choose your region
        </div>
    </div>
    <div class="row">
        <div class="col-xs-offset-3 col-xs-4">
            <select  name="chosen_company" class="selectpicker" title="Select your company.." data-size="8">
                <option value="Halliburton">Halliburton</option>
                <option class="divider"></option>
                <?php 
                    foreach ($options as $option) 
                    {
                        $company_name=$option["company_option"];
                        echo '<option value="' . "$company_name" . '">' ."$company_name" . '</option>' ;
                    }
                ?> 
                <option class="divider"></option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="col-xs-4">
            <select  name="region" class="selectpicker" title="Select your region.." data-header="Select your region">
                <?php 
                    foreach ($regions as $region) 
                    {
                        $region_name=$region["region_option"];
                        echo '<option value="' . "$region_name" . '">' ."$region_name" . '</option>' ;
                    }
                ?> 
            </select>
        </div>
    </div>
    <br/><br/>
    <div class="row">
        <div class="col-xs-offset-3 col-xs-3">
            Enter your Company E-mail Address
        </div>
    </div>
    <div class="row">
        <div class="col-xs-offset-3 col-xs-4">
            <div class="form-group">
                <input class="form-control" name="email" placeholder="E-mail Address" type="email"/>
            </div>    
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-1 center-block" style="float:none">
            <div class="form-group">
                <button class="btn my-btn" type="submit">
                    <span aria-hidden="true" class="glyphicon glyphicon-user"></span>
                    Register
                </button>
            </div>
        </div>
    </div>    
</form>
</div>