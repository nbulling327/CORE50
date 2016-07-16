<br/><br/><br/>
<form action="register.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="username" placeholder="Username" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="password" placeholder="Password" type="password"/>
        </div>
        
        <div class="form-group">
            <input class="form-control" name="confirmation" placeholder="Password" type="password"/>
        </div>
        
        
            <div class="form-group">
                <input class="form-control" id="company" autocomplete="off" placeholder="Company"/>
            </div>
       
        <div class="form-group">
            <input class="form-control" name="email" placeholder="E-mail Address" type="email"/>
        </div>
        
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Register
            </button>
        </div>
    </fieldset>
</form>

<div id="company_match">
                <input type="text" class="typeahead" autocomplete="off"/>
            </div>

<br/><br/>


<div>
    or <a href="login.php">log in</a> to your account
</div>
