<?php 
if(isset($_POST['update_employee_submit'])):


$error = NULL;



        $address_id = $db->query("SELECT address_id FROM employee WHERE employee_id ='{$db->cleanString($_GET['id'])}' LIMIT 1")[0]['address_id'];
        
        $db->query("UPDATE address set houseno='{$db->cleanString($_POST['house_no'])}', streetno='{$db->cleanString($_POST['street_no'])}', city='{$db->cleanString($_POST['city'])}', province='{$db->cleanString($_POST['province'])}', zipcode='{$db->cleanString($_POST['zip_code'])}'', country='{$db->cleanString($_POST['country'])}' WHERE address_id ='{$address_id}'",true);

        $q = $db->query("UPDATE employee set employee_type_id = '{$db->cleanString($_POST['emp_type'])}', dept_id = '{$db->cleanString($_POST['dept_id'])}', fname = '{$db->cleanString($_POST['first_name'])}'', lname = '{$db->cleanString($_POST['last_name'])}', dob = '{$db->cleanString($_POST['dob'])}', sex = '{$db->cleanString($_POST['sex'])}', cnic = '{$db->cleanString($_POST['cnic_no'])}', qualification = '{$db->cleanString($_POST['qualification'])}', username = '{$db->cleanString($_POST['username'])}', password = '{$db->cleanString($_POST['password'])}', mobile1 = '{$db->cleanString($_POST['phone_no'])}', mobile2 = '{$db->cleanString($_POST['phone_no2'])}'", true);


if(!$error) {
    echo '<div class="alert alert-success">Employee updated successfully</div><a href="employees.php" class="btn btn-default">Go Back</a>';
} else {
    echo '<div class="alert alert-danger">'. $error .'</div><a href="employees.php?action=add" class="btn btn-default">Go Back</a>';
}

?>
<?php else: 


$departments = $db->query('SELECT * from department');
$departments_count = count($departments);

$employee_types = $db->query('SELECT * from employee_type');
$employee_types_count = count($employee_types);

$employee_id = $db->cleanString($_GET['id']);
$employee = $db->query("SELECT e.*,a.* FROM employee e, address a WHERE e.employee_id = {$employee_id} and a.address_id = e.address_id LIMIT 1");


if(count($employee) == 0) {
    echo '<div class="alert alert-danger">No employee found with ID '. $employee_id .'</div><a href="employees.php?action=view_all" class="btn btn-default">Go Back</a>';
} else {
    $employee = $employee[0];
    ?>
    <form action="employees.php?action=single_edit&id=<?php echo $employee_id ?>" method="post">

            <div class="formdiv2 form-group">
              <label for="emp_type">Employee Type:</label>
              <select class="form-control" name="emp_type" id="emp_type">
                  <?php 
                    for($i = 0; $i < $employee_types_count; $i++) {
                        $selected = ($employee['employee_type_id'] == $employee_types[$i]['employee_type_id'] ? 'selected' : '');
                        echo "<option value=\"{$employee_types[$i]['employee_type_id']}\" {$selected}>{$employee_types[$i]['typename']}</option>";
                    }
                  ?>
              </select>
            </div>
            <div class="formdiv2 form-group">
              <label for="emp_type">Department:</label>
              <select class="form-control" name="dept_id" id="emp_type">
                  <?php 
                    for($i = 0; $i < $departments_count; $i++) {
                        $selected = ($employee['dept_id'] == $departments[$i]['dept_id'] ? 'selected' : '');
                        echo "<option value=\"{$departments[$i]['dept_id']}\" {$selected}>{$departments[$i]['name']}</option>";
                    }
                  ?>
              </select>
            </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="text" type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $employee['fname']; ?>" required>
          </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="text" type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $employee['lname']; ?>" required>
          </div>
        <div class="formdiv2 input-group">
            <?php echo ($employee['sex'] == 'F' ? 'selected' : ''); ?>
            <label for="emp_type">Sex:</label>
              <select class="form-control" name="sex" id="emp_type">
                  <option value="M" <?php echo ($employee['sex'] == 'M' ? 'selected' : ''); ?>>Male</option>
                  <option value="F" <?php echo ($employee['sex'] == 'F' ? 'selected' : ''); ?>>Female</option>
                  <option value="O" <?php echo ($employee['sex'] == 'O' ? 'selected' : ''); ?>>Other</option>
              </select>
          </div>

            <div class='input-group date formdiv2' id='datetimepicker1'>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                <input type='text' class="form-control" name="dob" placeholder="Date of Birth" value="<?php echo $employee['dob']; ?>" />
            </div>

          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input id="text" type="text" class="form-control" name="cnic_no" placeholder="CNIC Number" value="<?php echo $employee['cnic']; ?>" required>
          </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $employee['email']; ?>" required>
          </div>
         <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
            <input id="text" type="text" class="form-control" name="qualification" placeholder="Qualification" value="<?php echo $employee['qualification']; ?>" required>
          </div>
           <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="text" type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $employee['username']; ?>" required>
          </div> 

           <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="pwd" type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $employee['fname']; ?>" required>
          </div> 

          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
            <input id="text" type="text" class="form-control" name="salary" placeholder="Salary" value="<?php echo $employee['salary']; ?>" required>
          </div>

          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input id="text" type="text" class="form-control" name="phone_no" placeholder="Phone Number" value="<?php echo $employee['mobile1']; ?>" required>
          </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="	glyphicon glyphicon-warning-sign"></i></span>
            <input id="text" type="text" class="form-control" name="phone_no2" placeholder="Another Phone Number" value="<?php echo $employee['mobile2']; ?>" required>
        </div>
            <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
            <input id="text" type="text" class="form-control" name="house_no" placeholder="House No." value="<?php echo $employee['houseno']; ?>" required>
          </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
            <input id="text" type="text" class="form-control" name="street_no" placeholder="Street No." value="<?php echo $employee['streetno']; ?>" required>
          </div>

           <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
            <input id="text" type="text" class="form-control" name="city" placeholder="City" value="<?php echo $employee['city']; ?>" required>
          </div>

           <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
            <input id="text" type="text" class="form-control" name="province" placeholder="Province" value="<?php echo $employee['province']; ?>" required>
          </div>

          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
            <input id="text" type="text" class="form-control" name="country" placeholder="Country" value="<?php echo $employee['country']; ?>" required>
          </div>
          <div class="formdiv2 input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
            <input id="text" type="text" class="form-control" name="zip_code" placeholder="Zip Code" value="<?php echo $employee['zipcode']; ?>" required>
          </div>


           <div class="formdiv2">
           <button type="submit" name="update_employee_submit" class="btn btn-success">Update Employee</button>
           <button type="reset" class="btn btn-default">Reset</button>
          </div>
    </form>
<?php 
    }
endif;
?>