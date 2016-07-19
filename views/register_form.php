<br/><br/><br/>
<form action="register.php" method="post">
    <div class="form-group">
        <input autocomplete="off" autofocus class="form-control" name="username" placeholder="Username" type="text"/>
    </div>
    <div class="form-group">
        <input class="form-control" name="password" placeholder="Password" type="password"/>
    </div>
    <div class="form-group">
        <input class="form-control" name="confirmation" placeholder="Password" type="password"/>
    </div>
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
    <br/><br/>
    <select  name="region" class="selectpicker" title="Select your region.." data-header="Select your region">
        <?php 
            foreach ($regions as $region) 
            {
                $region_name=$region["region_option"];
                echo '<option value="' . "$region_name" . '">' ."$region_name" . '</option>' ;
            }
        ?> 
    </select>
    <br/><br/>
    <div class="form-group">
        <input class="form-control" name="email" placeholder="E-mail Address" type="email"/>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">
            <span aria-hidden="true" class="glyphicon glyphicon-user"></span>
            Register
        </button>
    </div>
</form>
<br/><br/>
<div>
    or <a href="login.php">log in</a> to your account
</div>
