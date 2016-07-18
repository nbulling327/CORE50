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
        
        <div class="form-group" id="companyselect">
            <input id="company" class="typeahead" autocomplete="off"/>
        </div>
        
        <div id="default-suggestions">
            <input class="typeahead" type="text" placeholder="Enter Company">
        </div>
        <br/>
        
        <select class="form-control" id="com_select">

        </select>
        
        <div class="form-group">
            <input class="form-control" name="email" placeholder="E-mail Address" type="email"/>
        </div>
        
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Register
            </button>
        </div>
    </form>


<br/><br/>


<div>
    or <a href="login.php">log in</a> to your account
</div>
