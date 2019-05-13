<?php
$departments = $db->query('SELECT * FROM department');
$departments_count = count($departments);
$employee_types = $db->query('SELECT * FROM employee_type');
$employee_types_count = count($employee_types);
$address_cities = $db->query('SELECT DISTINCT city from address');
$address_cities_count = count($address_cities);

$table = '';

if(isset($_GET['for']) && $_GET['for'] == 'employee') {
    $table .= 'employee';
}elseif(isset($_GET['for']) && $_GET['for'] == 'patient') {
    $table .= 'patient';
} else {
    redirect_to('search.php');
}

$query = 'SELECT * FROM ' . $table;

    

if(isset($_POST['advance_search_submit']) || (isset($_GET['id']) && is_numeric($_GET['id']))) {
    
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $db->cleanString($_GET['id']);   
        $query = "SELECT * FROM {$table} WHERE {$table}_id = '{$id}' LIMIT 1";

    } else {
        $is_where_printed = false;
        $is_multiple_conditions = false;

        if(isset($_POST['dept_id']) && !empty($_POST['dept_id'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }
            $query .= " dept_id = '{$db->cleanString($_POST['emp_type'])}' ";
            $is_multiple_conditions = true;
        }
        if(isset($_POST['name']) && !empty($_POST['name'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }
            $fullname = strtolower($_POST['name']);
            $query .= " lower(concat(fname, ' ', lname)) like '%{$db->cleanString($fullname)}%' ";
            $is_multiple_conditions = true;
        }
        if(isset($_POST['hiredate_from']) && !empty($_POST['hiredate_from'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }

            $query .= " hiredate >= '{$db->cleanString($_POST['hiredate_from'])}' ";
            $is_multiple_conditions = true;
        }

        if(isset($_POST['hiredate_to']) && !empty($_POST['hiredate_to'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }
            $query .= " hiredate <= '{$db->cleanString($_POST['hiredate_to'])}' ";
            $is_multiple_conditions = true;
        }

        if(isset($_POST['sal_from']) && !empty($_POST['sal_from'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }
            $query .= " salary >= '{$db->cleanString($_POST['sal_from'])} ' ";
            $is_multiple_conditions = true;
        }

        if(isset($_POST['sal_to']) && !empty($_POST['sal_to'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }
            $query .= " salary <= '{$db->cleanString($_POST['sal_to'])} ' ";
            $is_multiple_conditions = true;
        }

        
        

        if(isset($_POST['age_from']) && !empty($_POST['age_from'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }
            $query .= " floor(datediff(curdate(),dob) / 365) >= '{$db->cleanString($_POST['age_from'])} ' ";
            $is_multiple_conditions = true;
        }

        if(isset($_POST['age_to']) && !empty($_POST['age_to'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }
            $query .= " floor(datediff(curdate(),dob) / 365) <= '{$db->cleanString($_POST['age_to'])} ' ";
            $is_multiple_conditions = true;
        }

        
        
        
        
        if(isset($_POST['cnic']) && !empty($_POST['cnic'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }
            $query .= " cnic = '{$db->cleanString($_POST['cnic'])} ' ";
            $is_multiple_conditions = true;
        }

        if(isset($_POST['mobile']) && !empty($_POST['mobile'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }
            $query .= " (mobileno1 = '{$db->cleanString($_POST['mobile'])}' OR  mobileno2 = '{$db->cleanString($_POST['mobile'])}) ' ";
            $is_multiple_conditions = true;
        }
        if(isset($_POST['sex']) && !empty($_POST['sex'])) {
            if(!$is_where_printed) {
                $query .= ' WHERE ';
                $is_where_printed = true;
            }
            if($is_multiple_conditions) {
                $query .= ' AND ';
            }
            $query .= " sex = '{$db->cleanString($_POST['sex'])}' ";
            $is_multiple_conditions = true;
        }


        if(isset($_POST['city']) && !empty($_POST['city'])) {
                $query = "SELECT e.* FROM ($query) e, address a WHERE e.address_id = a.address_id AND a.city = '{$db->cleanString($_POST['city'])}'";
        }


}
    $arr_result = $db->query($query);
    if(count($arr_result) > 0){
       $output = '';
?>
    <div class=" col-md-11">
        <h3><?php echo count($arr_result) . ' ' . ucwords($table) . (count($arr_result > 1) ? 's' : ''); ?> found: </h3>
        <?php $output .= '<table class="table table-bordered">
           <thead>
          <tr>
            <th>' . ucwords($table) . 'Id</th>';

              if($table == 'employee')
                $output .= '<th>Employee Type</th>';
              
            $output .= '<th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>CNIC</th>
            <th>Mobile No</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody>';
        
        foreach($arr_result as $arr)
        { 
            if(isset($_POST['emp_type']) && !empty($_POST['emp_type']) && $arr['employee_type_id'] != $_POST['emp_type']) 
                continue;
                
                $output .= "<tr>";
                $output .= "<td>{$arr[$table . '_id']}</td>";
                if($table == 'employee') {
                    $typename = $db->query("SELECT typename from employee_type WHERE employee_type_id = {$arr['employee_type_id']}")[0]['typename'];
                    $output .= "<td>{$typename}</td>";
                }
                $output .= "<td>{$arr['fname']}</td>";
                $output .= "<td>{$arr['lname']}</td>";
                $output .= "<td>{$arr['sex']}</td>";
                $output .= "<td>{$arr['cnic']}</td>";
                if($table == 'employee')
                    $output .= "<td>{$arr['mobile1']}</td>";
                elseif($table == 'patient') 
                    $output .= "<td>{$arr['mobileno']}</td>";
                $output .= "<td>
                <a href=\"{$table}s.php?action=single_view&id={$arr[$table . '_id']}\" class=\"btn btn-primary btn-sm\">View</a>
                <a href=\"{$table}s.php?action=single_edit&id={$arr[$table . '_id']}\" class=\"btn btn-warning btn-sm\">Edit</a>
                <a href=\"{$table}s.php?action=single_delete&id={$arr[$table . '_id']}\" class=\"btn btn-danger btn-sm\">Delete</a>";
                $output .= "</td>
                </tr>";
        }
        echo $output;                       
        ?>  
        </tbody>
        </table>
    </div>

<?php
    } else {
        echo '<div class="alert alert-warning">No ' . ucwords($table) . ' found with provided details, please try again. <a href="'. $_SERVER['PHP_SELF'] .'?for=' . $table . '" class="btn btn-default">Go Back</a></div>';
    }
} else {

?>
<form action="search.php?for=<?php echo $table ?>" method="post">
    <?php if($_GET['for'] == 'employee'): ?>
    <div class="formdiv2">
        <div class="form-group">
          <label for="emp_type">Employee Type:</label>
          <select class="form-control" name="emp_type" id="emp_type">
              <option selected></option>
              <?php 
              for($i = 0; $i < $employee_types_count; $i++) {
                  echo "<option value=\"{$employee_types[$i]['employee_type_id']}\">{$employee_types[$i]['typename']}</option>";
              }
              ?>
          </select>
        </div>
    </div>
    <div class="formdiv2">
        <div class="form-group">
          <label for="emp_type">Department:</label>
          <select class="form-control" name="dept_id" id="emp_type">
              <option selected></option>
              <?php 
              for($i = 0; $i < $departments_count; $i++) {
                  echo "<option value=\"{$departments[$i]['dept_id']}\">{$departments[$i]['name']}</option>";
              }
              ?>
          </select>
        </div>
    </div>
    <?php endif; ?>

      <div class="formdiv2 input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="text" type="text" class="form-control" name="name" placeholder="Name">
      </div> 
    <div class="formdiv2 input-group date">
         <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
         <input type='text' class="form-control" name="hiredate_from" placeholder="Hiredate From" />
    </div>


    <div class="formdiv2 input-group date">
         <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
         <input type='text' class="form-control" name="hiredate_to" placeholder="Hiredate To" />
    </div>

    <?php if($_GET['for'] == 'employee'): ?>
   <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    <input id="text" type="number" class="form-control" name="sal_from" placeholder="Salary From">
  </div>


   <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    <input id="text" type="number" class="form-control" name="sal_to" placeholder="Salary To">
  </div>
    <?php endif; ?>


   <div class="formdiv2 input-group">
        <label for="city">City:</label>
          <select class="form-control" name="city" id="city">
              <option selected></option>
              <?php 
              for($i = 0; $i < $address_cities_count; $i++) {
                  echo "<option value=\"{$address_cities[$i]['city']}\">{$address_cities[$i]['city']}</option>";
              }
              ?>
          </select>
  </div> 

   <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input id="text" type="text" class="form-control" name="cnic" placeholder="CNIC">
  </div> 

  <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input id="text" type="number" class="form-control" name="mobile" placeholder="Mobile">
  </div> 

  <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
    <input id="number" type="number" class="form-control" name="age_from" placeholder="Age From" >
  </div>

   <div class="formdiv2 input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
    <input id="number" type="number" class="form-control" name="age_to" placeholder="Age To">
  </div>

    <div class="formdiv2 input-group">
    <label for="emp_type">Sex:</label>
      <select class="form-control" name="sex" id="emp_type">
          <option selected></option>
          <option value="M">Male</option>
          <option value="F">Female</option>
          <option value="O">Other</option>
      </select>
  </div>

  <div class="formdiv2">
  <button type="submit" name="advance_search_submit" class="btn btn-default">Search</button>
  </div>
</form>
<?php }; ?>