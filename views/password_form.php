<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li><a href="/proposal.php">Input Proposal Information</a></li>
        <li><a href="/postjob.php">Input Post-Job Information</a></li>
        <li><a href="/jobdatabase.php">Job Review</a></li>
        <li><a href="/jobanalysis.php">Jobs Analysis</a></li>
    </ul>
</div>    
<br/><br/><br/>
<div class="container-fluid">
    <form action="password_update.php" method="post">
        <fieldset>
            <div class="form-group">
                <input autocomplete="off" autofocus class="form-control" name="old_password" placeholder="Old Password" type="password"/>
            </div>
            <div class="form-group">
                <input class="form-control" name="new_password" placeholder="New Password" type="password"/>
            </div>
            <div class="form-group">
                <input class="form-control" name="confirmation" placeholder="New Password" type="password"/>
            </div>
            <div class="form-group">
                <button class="btn my-btn" type="submit">
                    Update Password
                </button>
            </div>
        </fieldset>
    </form>
</div>
