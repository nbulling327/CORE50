<br/><br/><br/>
<form action="userinfo.php" method="post">
    <fieldset>
        <div class="container">
            <select  name="role" class="selectpicker" title="Select your function.." data-header="Select your function">
                <option value="pumper">Pump Truck Operator</option>
                <option value="supervisor">Supervisor</option>
                <option value="both">Operator/Supervisor</option>
                <option data-divider="true"></option>
                <option value="end_user">End User</option>
            </select>
            <br/><br/>
            <select  name="district" class="selectpicker" title="Select your district.." data-header="Select your district"  data-live-search="true">
                <?php 
                    foreach ($options as $option) 
                    {
                        $district_name=$option["district_option"];
                        echo '<option value="' . "$district_name" . '">' ."$district_name" . '</option>' ;
                    }
                ?> 
            </select>
            <br/><br/><br/><br/>
            <div class="form-group">
                <button class="btn my-btn" type="submit">
                    <span aria-hidden="true" class="glyphicon glyphicon-user"></span>
                    Complete Registration
                </button>
            </div>
        </div>
    </fieldset>
</form>