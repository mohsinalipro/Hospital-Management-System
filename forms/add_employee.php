<?php 
if(isset($_POST['add_employee_submit'])):


$error = NULL;

if(isset($_POST['emp_type']) && !empty($_POST['emp_type'])) {

    
    $already_exists = $db->query("SELECT username, email, cnic from employee WHERE username = '{$db->cleanString($_POST['username'])}' OR email = '{$db->cleanString($_POST['email'])}' OR cnic = '{$db->cleanString($_POST['cnic_no'])}' ");
   
    if(count($already_exists))
        $error = 'An employee with provided username or email or cnic is already exists, please try again.';
    
    if(!$error) {
        $q = $db->query("INSERT INTO address (houseno, streetno, city, province, zipcode, country)
        values ('{$db->cleanString($_POST['house_no'])}', '{$db->cleanString($_POST['street_no'])}', '{$db->cleanString($_POST['city'])}', '{$db->cleanString($_POST['province'])}', '{$db->cleanString($_POST['zip_code'])}', '{$db->cleanString($_POST['country'])}')",true);

        $address_id = $db->query("SELECT address_id FROM address ORDER BY address_id desc LIMIT 1")[0]['address_id'];

        $q = $db->query("INSERT INTO employee (employee_type_id, dept_id, address_id, fname, lname, dob, sex, cnic, qualification, username, password, hiredate, mobile1, mobile2, email) VALUES ('{$db->cleanString($_POST['emp_type'])}', '{$db->cleanString($_POST['dept_id'])}', '{$address_id}', '{$db->cleanString($_POST['first_name'])}', '{$db->cleanString($_POST['last_name'])}', '{$db->cleanString($_POST['dob'])}', '{$db->cleanString($_POST['sex'])}', '{$db->cleanString($_POST['cnic_no'])}', '{$db->cleanString($_POST['qualification'])}', '{$db->cleanString($_POST['username'])}', '{$db->cleanString($_POST['password'])}', now(), '{$db->cleanString($_POST['phone_no'])}', '{$db->cleanString($_POST['phone_no2'])}', '{$db->cleanString($_POST['email'])}')", true);
    }

} else {
    $error = 'Error occured, please try again.';
}

if(!$error) {
    echo '<div class="alert alert-success">Employee added successfully</div><a href="employees.php" class="btn btn-default">Go Back</a>';
} else {
    echo '<div class="alert alert-danger">'. $error .'</div><a href="employees.php?action=add" class="btn btn-default">Go Back</a>';
}
?>
<?php else: 




$departments = $db->query('SELECT * from department');
$departments_count = count($departments);

$employee_types = $db->query('SELECT * from employee_type');
$employee_types_count = count($employee_types);
?>
<form action="employees.php?action=add" method="post">

        <div class="formdiv2 form-group">
          <label for="emp_type">Employee Type:</label>
          <select class="form-control" name="emp_type" id="emp_type">
              <option value="" disabled selected></option>
              <?php 
                for($i = 0; $i < $employee_types_count; $i++) {
                    echo "<option value=\"{$employee_types[$i]['employee_type_id']}\">{$employee_types[$i]['typename']}</option>";
                }
              ?>
          </select>
        </div>
        <div class="formdiv2 form-group">
          <label for="emp_type">Department:</label>
          <select class="form-control" name="dept_id" id="emp_type">
              <option value="" disabled selected></option>
              <?php 
                for($i = 0; $i < $departments_count; $i++) {
                    echo "<option value=\"{$departments[$i]['dept_id']}\">{$departments[$i]['name']}</option>";
                }
              ?>
          </select>
        </div>
      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="text" type="text" class="form-control" name="first_name" placeholder="First Name" required>
      </div>
      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="text" type="text" class="form-control" name="last_name" placeholder="Last Name"  required>
      </div>
    <div class="formdiv2 input-group">
        <label for="emp_type">Sex:</label>
          <select class="form-control" name="sex" id="emp_type">
              <option value="M">Male</option>
              <option value="F">Female</option>
              <option value="O">Other</option>
          </select>
      </div>

        <div class='input-group date formdiv2' id='datetimepicker1'>
         <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input type='text' class="form-control" name="dob" placeholder="Date of Birth" />
        </div>

      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
        <input id="text" type="text" class="form-control" name="cnic_no" placeholder="CNIC Number" required>
      </div>
      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
        <input id="email" type="email" class="form-control" name="email" placeholder="Email"  required>
      </div>
     <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
        <input id="text" type="text" class="form-control" name="qualification" placeholder="Qualification" required>
      </div>
       <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="text" type="text" class="form-control" name="username" placeholder="Username"  required>
      </div> 

       <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="pwd" type="password" class="form-control" name="password" placeholder="Password"  required>
      </div> 

      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
        <input id="text" type="number" class="form-control" name="salary" placeholder="Salary"  required>
      </div>

      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
        <input id="text" type="number" class="form-control" name="phone_no" placeholder="Phone Number" required>
      </div>
      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="	glyphicon glyphicon-warning-sign"></i></span>
        <input id="text" type="number" class="form-control" name="phone_no2" placeholder="Another Phone Number">
    </div>
        <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
        <input id="text" type="number" class="form-control" name="house_no" placeholder="House No." required>
      </div>
      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
        <input id="text" type="number" class="form-control" name="street_no" placeholder="Street No." required>
      </div>

       <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
        <input id="text" type="text" class="form-control" name="city" placeholder="City" required>
      </div>

       <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
        <input id="text" type="text" class="form-control" name="province" placeholder="Province" required>
      </div>

      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
        <input id="text" type="text" class="form-control" name="country" placeholder="Country" required>
      </div>
      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
        <input id="text" type="number" class="form-control" name="zip_code" placeholder="Zip Code" required>
      </div>


       <div class="formdiv2">
       <button type="submit" name="add_employee_submit" class="btn btn-success">Add Employee</button>
       <button type="reset" class="btn btn-default">Reset</button>
      </div>
</form>
<?php endif; ?>