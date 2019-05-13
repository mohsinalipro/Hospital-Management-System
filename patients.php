<?php 
session_start();
?>
 <?php require_once 'header.php'; ?>
        <?php require_once 'sidebar.php'; ?>

        <!-- If Add Button Is Pressed -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?php if(isset($_GET['action']) && $_GET['action'] == 'add'): ?>
                    
                    <div class="col-md-12">   
                        <h1>Add New Patient</h1>

                            <?php include 'forms/add_patient.php'; ?>
                        
                    </div>
                    
                <!-- If View All/Search Button Is Pressed -->
                <?php elseif(isset($_GET['action']) && $_GET['action'] == 'view_all'): ?>
                

<div class="col-md-12">   
    <h3>Find Patient:</h3>
    <form action="search.php" method="GET">
    <div class="searchBox input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
         <input type="hidden" name="for" value="patient" style="display:none" />
         <input id="text" type="text" class="inputBox form-control" name="id" placeholder="Enter Patient Id" required="" />        
    </div>
    <div style="margin-top:10px">
        <button type="submit"  class="btn btn-success">Search</button>
        <a href="search.php?for=patient" class="btn btn-warning">Advanced Search</a>
    </div>
    </form>   
</div>

                    <div class="col-md-12"> 
                        <?php if($_GET['action'] == 'view_all') echo '<h1>All Patients</h1>'; ?>
                       <?php
                            if(isset($_POST['patient_id_search']))
                                $q="select patient_id, fname,lname,cnic,mobileno from patient WHERE patient_id = '{$db->cleanString($_POST['patient_id_search'])}'";
                            else
                                $q="select patient_id, fname,lname,cnic,mobileno from patient";
                          $arr=$db->query($q);
                          $no=0;
                          $no=count($arr);
                          if($no==0) { ?>
                          <h3>No Result Found</h3>
                        <?php } else { ?>
                          <?php (isset($_GET['action']) && $_GET['action'] != 'view_all') ? '<h3>Search Results:</h3>' : ''; ?>
                          <table class="table table-bordered">
                           <thead>
                          <tr>
                            <th>Patient Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>CNIC</th>
                            <th>Mobile No.</th>
                            <th>Options</th>
                          </tr>
                        </thead>
                        <tbody> 
                        <?php
                        $i=0;
                        while($i<$no)
                        { 
                          echo "<tr>
                                <td>{$arr[$i]['patient_id']}</td>
                                <td>{$arr[$i]['fname']}</td>
                                <td>{$arr[$i]['lname']}</td>
                                <td>{$arr[$i]['cnic']}</td>
                                <td>{$arr[$i]['mobileno']}</td>
                                <td>
                                <a href=\"patients.php?action=single_view&id={$arr[$i]['patient_id']}\" class=\"btn btn-primary btn-sm\">View</a>";
                            if($user['typename'] == 'Administrator')
                                echo " <a href=\"patients.php?action=single_edit&id={$arr[$i]['patient_id']}\" class=\"btn btn-warning btn-sm\">Edit</a>
                                <a href=\"patients.php?action=single_delete&id={$arr[$i]['patient_id']}\" class=\"btn btn-danger btn-sm\">Delete</a>
                                </td>
                                </tr>";
                          $i++;
                        }
                        ?>  
                        </tbody>
                        </table>
                  </div>
                <?php } ?>
                    
            <?php elseif(isset($_GET['action']) && $_GET['action'] == 'create_new_visitrecord'): 
                    
                    
              $pid= $db->cleanString($_GET['id']);
              $q="insert into medical_record (patient_id) values ('{$pid}')";
              $db->query($q,true);
              $q="select med_rec_id from medical_record where patient_id='{$pid}'";
              $medical=$db->query($q);
              $q="insert into visit_record (med_rec_id,patient_id,doctor_id, time_in) values ('{$medical[0]['med_rec_id']}','{$pid}','{$user['employee_id']}', now())";
              $db->query($q,true);
               $q="select visit_rec_id from visit_record where patient_id='{$pid}' order by visit_rec_id desc";
              $medical=$db->query($q);
              $q="insert into precription_rec (visit_rec_id,patient_id) values ('{$medical[0]['visit_rec_id']}','{$pid}')";
              $db->query($q,true);
              echo '<div class="alert alert-success">Visit Record And Prescription Record Created Successfully <a class="btn btn-default" href="patients.php">Go Back</a></div>';
            ?>

                    
                    
                    
                    
                    
            <?php elseif(isset($_GET['action']) && $_GET['action'] == 'single_view'):
                $patient_id = $db->cleanString($_GET['id']);
                $patient = $db->query("SELECT * FROM patient p, address a WHERE p.patient_id = '{$patient_id}' AND a.address_id = p.address_id LIMIT 1")[0];
            ?>
             <div class="col-md-12">  
                <h1>Patient Details:</h1>
                <br> 
                <div class="row statsboxes">
                    <div class="stats_title clearfix"><span class="pull-left">Patient Id: <?php echo $patient_id; ?></span></div>
                        <div class="col-md-3 statsbox">
                            <h3>Patient Name:</h3>
                            <div class="stats_content">
                                <?php echo $patient['fname']; ?>
                            </div>
                        </div>
                        <div class="col-md-3 statsbox">
                            <h3>CNIC:</h3>
                            <div class="stats_content">
                                 <?php echo $patient['cnic']; ?>
                            </div>
                        </div>  
                        <div class="col-md-3 statsbox">
                            <h3>Mobile No:</h3>
                            <div class="stats_content">
                                <?php echo $patient['mobileno']; ?>
                            </div>
                        </div>
                        <div class="col-md-3 statsbox">
                            <h3>Emergency No:</h3>
                            <div class="stats_content">
                                <?php echo $patient['emergencyno']; ?>a
                            </div>
                        </div>

                        <div class="col-md-3 statsbox">
                            <h3>Registration Date:</h3>
                            <div class="stats_content">
                                <?php echo $patient['registration_date']; ?>
                            </div>
                        </div>
                        <div class="col-md-3 statsbox">
                            <h3>Gender:</h3>
                            <div class="stats_content">
                                <?php echo $patient['sex']; ?>
                            </div>
                        </div>
                        <div class="col-md-3 statsbox">
                            <h3>Email:</h3>
                            <div class="stats_content">
                                <?php echo $patient['email']; ?>
                            </div>
                        </div>
                        <div class="col-md-3 statsbox">
                            <h3>Date of Birth:</h3>
                            <div class="stats_content">
                                <?php echo $patient['dob']; ?>
                            </div>
                        </div>
                 </div>
                 <br>
                 <a href="patients.php?action=create_new_visitrecord&id=<?php echo $patient_id; ?>" class="btn btn-primary btn-lg">Create New Visit Record</a>
            </div>
            <?php elseif(isset($_GET['action']) && $_GET['action'] == 'single_edit'):
                $patient_id = $db->cleanString($_GET['id']);
            ?>
            <div class="col-md-12"> 
                <h1>Update Patient:</h1>
                <?php require_once 'forms/edit_patient.php'; ?>
            </div>
            <?php elseif(isset($_GET['action']) && $_GET['action'] == 'single_delete'):
                $patient_id = $db->cleanString($_GET['id']);
                // single delete
                    /* 
                        checking if room alloted, visit record exists
                    */
                    // room
                    $db->query("UPDATE room SET patient_id = NULL WHERE patient_id = '{$patient_id}'", true);
                    
                    $precriptions = $db->query("SELECT presc_id FROM precription_rec WHERE patient_id = '{$patient_id}'");
                   
                    $precriptions_count = count($precriptions);
                    for($i = 0; $i < $precriptions_count; $i++) {
                        $db->query("DELETE FROM presc_med WHERE presc_id = '{$precriptions[$i]['presc_id']}'",true);
                    }
                    $db->query("DELETE FROM precription_rec WHERE patient_id = '{$patient_id}'",true);
                    
                    $db->query("DELETE FROM medical_record WHERE patient_id = '{$patient_id}'",true);
                    
                    // visit record
                    $db->query("DELETE FROM visit_record WHERE patient_id = '{$patient_id}'",true);
                    
                    
                $q = $db->query("DELETE FROM patient WHERE patient_id = '{$patient_id}'", true);
                if($q) {
                    echo '<div class="alert alert-success">Patient with ID ' . $patient_id . ' deleted successfully</div><a href="patients.php" class="btn btn-default">Go Back</a>';
                } else {
                    echo '<div class="alert alert-danger">Error occured, please try again.</div><a href="patients.php" class="btn btn-default">Go Back</a>';
                }
            ?>


             <?php else: ?>
                    <!--Main Page-->
            <div class="col-md-12">   
                <h1>Patients</h1>
                <br>
                <div class="row">
                    <a href="patients.php?action=add" class="btn btn-lg btn-success">Add New Patients</a>
                    <a href="patients.php?action=view_all" class="btn btn-lg btn-primary">View All Patients</a>
                </div>

            </div>

            <?php endif; ?>
        </div>
    </div>
<!-- /#page-content-wrapper -->

<?php require_once 'footer.php'; ?>