<?php 
if(isset($_POST['update_patient_submit'])):


$error = NULL;



        $address_id = $db->query("SELECT address_id FROM patient WHERE employee_id ='{$db->cleanString($_GET['id'])}' LIMIT 1")[0]['address_id'];
        
        $db->query("UPDATE address set houseno='{$db->cleanString($_POST['house_no'])}', streetno='{$db->cleanString($_POST['street_no'])}', city='{$db->cleanString($_POST['city'])}', province='{$db->cleanString($_POST['province'])}', zipcode='{$db->cleanString($_POST['zip_code'])}'', country='{$db->cleanString($_POST['country'])}' WHERE address_id ='{$address_id}'",true);

        $q = $db->query("UPDATE patient set fname = '{$db->cleanString($_POST['first_name'])}', lname = '{$db->cleanString($_POST['last_name'])}', dob = '{$db->cleanString($_POST['dob'])}', sex = '{$db->cleanString($_POST['sex'])}', cnic = '{$db->cleanString($_POST['cnic_no'])}', mobileno = '{$db->cleanString($_POST['phone_no'])}', emergencyno = '{$db->cleanString($_POST['phone_no2'])}', email = '{$db->cleanString($_POST['email'])}' WHERE patient_id = '{$db->cleanString($_GET['id'])}'", true);
        
        if(!$q)
            $error = 'Error occured';
    
if(!$error) {
    echo '<div class="alert alert-success">Patient data updated successfully</div><a href="patients.php" class="btn btn-default">Go Back</a>';
} else {
    echo '<div class="alert alert-danger">'. $error .'</div><a href="patients.php?action=add" class="btn btn-default">Go Back</a>';
}

?>
<?php else: 


$patient_id = $db->cleanString($_GET['id']);
$patient = $db->query("SELECT p.*,a.* FROM patient p, address a WHERE p.patient_id = {$patient_id} and a.address_id = p.address_id LIMIT 1");


if(count($patient) == 0) {
    echo '<div class="alert alert-danger">No patient found with ID '. $patient .'</div><a href="patients.php?action=view_all" class="btn btn-default">Go Back</a>';
} else {
    $patient = $patient[0];
    ?>
    <form action="patients.php?action=single_edit&id=<?php echo $patient_id ?>" method="post">
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="text" type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $patient['fname']; ?>" required>
          </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="text" type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $patient['lname']; ?>" required>
          </div>
        <div class="formdiv2 input-group">
            <?php echo ($patient['sex'] == 'F' ? 'selected' : ''); ?>
            <label for="emp_type">Sex:</label>
              <select class="form-control" name="sex" id="emp_type">
                  <option value="M" <?php echo ($patient['sex'] == 'M' ? 'selected' : ''); ?>>Male</option>
                  <option value="F" <?php echo ($patient['sex'] == 'F' ? 'selected' : ''); ?>>Female</option>
                  <option value="O" <?php echo ($patient['sex'] == 'O' ? 'selected' : ''); ?>>Other</option>
              </select>
          </div>

            <div class='input-group date formdiv2' id='datetimepicker1'>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                <input type='text' class="form-control" name="dob" placeholder="Date of Birth" value="<?php echo $patient['dob']; ?>" />
            </div>

          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input id="text" type="text" class="form-control" name="cnic_no" placeholder="CNIC Number" value="<?php echo $patient['cnic']; ?>" required>
          </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $patient['email']; ?>" required>
          </div>

          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input id="text" type="text" class="form-control" name="phone_no" placeholder="Phone Number" value="<?php echo $patient['mobileno']; ?>" required>
          </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="	glyphicon glyphicon-warning-sign"></i></span>
            <input id="text" type="text" class="form-control" name="phone_no2" placeholder="Emergency No" value="<?php echo $patient['emergencyno']; ?>" required>
        </div>
            <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
            <input id="text" type="text" class="form-control" name="house_no" placeholder="House No." value="<?php echo $patient['houseno']; ?>" required>
          </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
            <input id="text" type="text" class="form-control" name="street_no" placeholder="Street No." value="<?php echo $patient['streetno']; ?>" required>
          </div>

           <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
            <input id="text" type="text" class="form-control" name="city" placeholder="City" value="<?php echo $patient['city']; ?>" required>
          </div>

           <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
            <input id="text" type="text" class="form-control" name="province" placeholder="Province" value="<?php echo $patient['province']; ?>" required>
          </div>

          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
            <input id="text" type="text" class="form-control" name="country" placeholder="Country" value="<?php echo $patient['country']; ?>" required>
          </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
            <input id="text" type="text" class="form-control" name="zip_code" placeholder="Zip Code" value="<?php echo $patient['zipcode']; ?>" required>
          </div>


           <div class="formdiv2">
           <button type="submit" name="update_patient_submit" class="btn btn-success">Update Patient</button>
           <button type="reset" class="btn btn-default">Reset</button>
          </div>
    </form>
<?php 
    }
endif;
?>