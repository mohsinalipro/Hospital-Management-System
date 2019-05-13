<?php 

if(isset($_POST['add_patient_submit'])):
$error = NULL;

$already_exists = $db->query("SELECT email, cnic from patient WHERE email = '{$db->cleanString($_POST['email'])}' OR cnic = '{$db->cleanString($_POST['cnic_no'])}'");
   
    if(count($already_exists))
        $error = 'An patient with provided email or cnic is already exists, please try again.';
    
    if(!$error) {
        $db->query("INSERT INTO address (houseno, streetno, city, province, zipcode, country)
                values ('{$db->cleanString($_POST['house_no'])}', '{$db->cleanString($_POST['street_no'])}', '{$db->cleanString($_POST['city'])}', '{$db->cleanString($_POST['province'])}', '{$db->cleanString($_POST['zip_code'])}', '{$db->cleanString($_POST['country'])}')",true);

        $address_id = $db->query("SELECT address_id FROM address ORDER BY address_id desc LIMIT 1")[0]['address_id'];

         $q = $db->query("INSERT INTO patient (address_id, fname, lname, mobileno, registration_date, dob, sex, cnic, emergencyno, email) VALUES ('{$address_id}', '{$db->cleanString($_POST['first_name'])}', '{$db->cleanString($_POST['last_name'])}', '{$db->cleanString($_POST['phone_no'])}', '{$db->cleanString($_POST['dob'])}', now(), '{$db->cleanString($_POST['sex'])}', '{$db->cleanString($_POST['cnic_no'])}', '{$db->cleanString($_POST['phone_no2'])}','{$db->cleanString($_POST['email'])}')",true);
    }
    
if(!$error) {
    echo '<div class="alert alert-success">Patient added successfully</div><a href="patients.php" class="btn btn-default">Go Back</a>';
} else {
    echo '<div class="alert alert-danger">'. $error .'</div><a href="patients.php?action=add" class="btn btn-default">Go Back</a>';
}
else: 
?>


<form action="patients.php?action=add" method="post">
  <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="text" type="text" class="form-control" name="first_name" placeholder="First Name">
  </div>
  <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="text" type="text" class="form-control" name="last_name" placeholder="Last Name">
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
    <input id="email" type="email" class="form-control" name="email" placeholder="Email" required>
  </div>
  <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
    <input id="text" type="number" class="form-control" name="phone_no" placeholder="Phone Number" required>
  </div>
  <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="	glyphicon glyphicon-warning-sign"></i></span>
    <input id="text" type="number" class="form-control" name="phone_no2" placeholder="Emergence Phone Number" required>
  </div>
  <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="	glyphicon glyphicon-comment"></i></span>
    <input id="text" type="text" class="form-control" name="remarks" placeholder="Remarks">
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
      <button type="submit" class="btn btn-success" name="add_patient_submit">Add Patient</button>
      <button type="reset" class="btn btn-default">Reset</button>
  </div>
</form>

<?php
endif;
?>