<?php
session_start();
?>        <?php require_once 'header.php'; ?>
        <?php require_once 'sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?php if(isset($_GET['action']) && $_GET['action'] == 'add') : ?>
                    
                    <div class="col-md-12">   
                        <h1>Add New Employee</h1>

                            <?php include 'forms/add_employee.php'; ?>
                        
                    </div>
                    
                       <?php elseif(isset($_GET['action']) && $_GET['action'] == 'view_all') : ?>
<div class="col-md-12">   
    <h3>Find Employee:</h3>
    <form action="search.php" method="GET">
    <div class="searchBox input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
         <input type="hidden" name="for" value="employee" style="display:none" />
         <input id="text" type="text" class="inputBox form-control" name="id" placeholder="Enter Employee Id" required="" />        
    </div>
    <div style="margin-top:10px">
        <button type="submit"  class="btn btn-success">Search</button>
        <a href="search.php?for=employee" class="btn btn-warning">Advanced Search</a>
    </div>
    </form>   
</div>
                    <div class="col-md-12">   

                             <?php
                                  $q="select e.employee_id,et.typename,e.fname,e.lname,e.sex,e.cnic,e.mobile1 from employee e,employee_type et where e.employee_type_id=et.employee_type_id";
                                  $arr=$db->query($q);
                                  $no=0;
                                  $no=count($arr);
                                  if($no==0) : ?>
                                  <h3>No Employee Found</h1>
                                <?php else: ?>
                                  <h1>All Employees:</h1>
                                  <table class="table table-bordered">
                                   <thead>
                                  <tr>
                                    <th>Employee Id</th>
                                    <th>Employee Type</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>CNIC</th>
                                    <th>Mobile No</th>
                                    <th>Option</th>
                                  </tr>
                                </thead>
                                <tbody> 
                                <?php
                                $i=0;
                                while($i<$no)
                                { 
                                  echo "<tr>
                                        <td>{$arr[$i]['employee_id']}</td>
                                        <td>{$arr[$i]['typename']}</td>
                                        <td>{$arr[$i]['fname']}</td>
                                        <td>{$arr[$i]['lname']}</td>
                                        <td>{$arr[$i]['sex']}</td>
                                        <td>{$arr[$i]['cnic']}</td>
                                        <td>{$arr[$i]['mobile1']}</td>
                                        <td>
                                        <a href=\"employees.php?action=single_view&id={$arr[$i]['employee_id']}\" class=\"btn btn-primary btn-sm\">View</a>
                                        <a href=\"employees.php?action=single_edit&id={$arr[$i]['employee_id']}\" class=\"btn btn-warning btn-sm\">Edit</a>
                                        <a href=\"employees.php?action=single_delete&id={$arr[$i]['employee_id']}\" class=\"btn btn-danger btn-sm\">Delete</a>
                                        </td>
                                        </tr>";
                                  $i++;
                                }
                                ?>  
                                </tbody>
                                </table>
                                <a href="search.php?for=employee" style="background-color: #007384;color: white" class="btn btn-lg btn-default">Advance Search Employee</a>
                              </div>

                            <?php endif; ?>
                        
                    </div>
                    
                       <?php elseif(isset($_GET['action']) && $_GET['action'] == 'single_view') :
                            // single view
                            $employee_id = $db->cleanString($_GET['id']);
                            $employee = $db->query("SELECT e.employee_id, et.typename, d.name as deptname, e.dob, e.username, e.qualification, e.email, e.hiredate,e.mobile1,e.mobile2, e.fname,e.lname,e.sex,e.cnic,e.mobile1 from employee e,employee_type et, department d where e.employee_type_id=et.employee_type_id and e.dept_id = d.dept_id and e.employee_id = {$employee_id} LIMIT 1");
                            if(count($employee) == 0) {
                                echo '<div class="col-md-12"><div class="alert alert-danger">No employee found</div><a href="employees.php?action=view_all" class="btn btn-default">Go Back</a></div>';
                            } else {
                                $employee = $employee[0];
                            ?>
                            <div class="col-md-12">  
                            <h1>Employee Details:</h1>
                            <br> 
                            <div class="row statsboxes">
                                <div class="stats_title clearfix"><span class="pull-left">Employee Id: <?php echo $employee['employee_id']; ?></span></div>
                                <div class="col-md-3 statsbox">
                                    <h3>Employee Type:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['typename']; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 statsbox">
                                    <h3>Department Name:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['deptname']; ?>
                                    </div>
                                </div>  
                                <div class="col-md-3 statsbox">
                                    <h3>Name:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['fname'] . ' '. $employee['lname']; ?>
                                    </div>
                                </div>

                                <div class="col-md-3 statsbox">
                                    <h3>Date Of Birth:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['dob']; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 statsbox">
                                    <h3>Sex:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['sex']; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 statsbox">
                                    <h3>CNIC:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['cnic']; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 statsbox">
                                    <h3>Username:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['username']; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 statsbox">
                                    <h3>Qualification:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['qualification']; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 statsbox ">
                                    <h3>Email:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['email']; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 statsbox">
                                    <h3>Hiredate:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['hiredate']; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 statsbox">
                                    <h3>Mobile No:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['mobile1']; ?>
                                    </div>
                                </div>
                                <div class="col-md-3 statsbox">
                                    <h3>Secondary Mobile no:</h3>
                                    <div class="stats_content">
                                        <?php echo $employee['mobile2']; ?>
                                    </div>
                                </div>
                            </div>
                                <br>
                            <a href="employees.php?action=single_edit&id=<?php echo $employee['employee_id']; ?>" class="btn btn-lg btn-warning">Edit Employee</a>
                            <a href="employees.php?action=single_delete&id=<?php echo $employee['employee_id']; ?>" class="btn btn-lg btn-danger">Delete Employee</a>
                                
                            </div>
                        
                        <?php } // endif ?>
                   <?php 
                            elseif(isset($_GET['action']) && $_GET['action'] == 'single_edit'):
                        // single edit
                            ?>
                            <div class="col-md-12"> 
                                <h1>Update Employee:</h1>
                                <?php require_once 'forms/edit_employee.php'; ?>
                            </div>
                
                            <?php elseif(isset($_GET['action']) && $_GET['action'] == 'single_delete'):
                            echo '<h1>Employee Details:</h1>';
                            // single delete
                            $q = $db->query("DELETE from employee WHERE employee_id = '{$db->cleanString($_GET['id'])}'", true);
                            if($q) {
                                echo '<div class="alert alert-success">Employee deleted successfully</div><a href="employees.php" class="btn btn-default">Go Back</a>';
                            } else {
                                echo '<div class="alert alert-danger">Error occured, please try again.</div><a href="employees.php?action=add" class="btn btn-default">Go Back</a>';
                            }
                    ?>
                    <?php else: ?>
                    <div class="col-md-12">   
                        <h1>Employees</h1>
                        <div class="row statsboxes">
                            <div class="stats_title clearfix"><span class="pull-left">Employees Stats</span> <span class="pull-right">Total Employees: 100</span></div>
                            <div class="col-md-3 statsbox statsbox_doc">
                                <h3>Doctors</h3>
                                <div class="stats_content">
                                    Total Doctors: 10
                                </div>
                            </div>
                            <div class="col-md-3 statsbox statsbox_resp">
                                <h3>Receptionists</h3>
                                <div class="stats_content">
                                    Total Receptionists: 10
                                </div>
                            </div>
                            <div class="col-md-3 statsbox statsbox_nur">
                                <h3>Nurses</h3>
                                <div class="stats_content">
                                    Total Nurses: 10
                                </div>
                            </div>
                            <div class="col-md-3 statsbox statsbox_phar">
                                <h3>Pharmists</h3>
                                <div class="stats_content">
                                    Total Pharmists: 10
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <a href="employees.php?action=add" class="btn btn-lg btn-success">Add New Employee</a>
                            <a href="employees.php?action=view_all" class="btn btn-lg btn-primary">View All Employees</a>
                            <a href="search.php?for=employee" style="background-color: #007384;color: white" class="btn btn-lg btn-default">Advance Search Employee</a>
                        </div>
                            
                    </div>
                    
                    <?php endif; ?>
                </div>
            </div>
        <!-- /#page-content-wrapper -->

        <?php require_once 'footer.php'; ?>