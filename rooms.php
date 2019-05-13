<?php 
session_start();
?>
 <?php require_once 'header.php'; ?>
        <?php require_once 'sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?php if(isset($_GET['action']) && $_GET['action'] == 'add') : ?>
                    
                    <div class="col-md-12">   
                        <h1>Add New Room</h1>

                            <?php include 'forms/add_room.php'; ?>
                        
                    </div>
                    <?php elseif(isset($_GET['action']) && $_GET['action'] == 'assign_nurse') : ?>
                    
                    <div class="col-md-12">   
                        <h1>Assign Nurse to a Room</h1>

                            <?php include 'forms/assign_nurse.php'; ?>
                        
                    </div>
                    <?php elseif(isset($_GET['action']) && $_GET['action'] == 'unassign_nurse') : ?>
                    
                    <div class="col-md-12">   
                        <h1>Unassign Nurse From a Room</h1>

                            <?php include 'forms/unassign_nurse.php'; ?>
                        
                    </div>
                    <?php elseif(isset($_GET['action']) && $_GET['action'] == 'view_all') : ?>
                    
                    <div class="col-md-12">   

                     <?php
                                  $q="select room_id,nurse_id,patient_id from room ";
                                  $arr=$db->query($q);
                                  $no=0;
                                  $no=count($arr);
                                  if($no==0) : ?>
                                  <h3>No Room Found</h1>
                                <?php else: ?>
                                  <h1>All Rooms:</h1>
                                  <table class="table table-bordered">
                                   <thead>
                                  <tr>
                                    <th>Room Id</th>
                                    <th>Patient Id</th>
                                    <th>Nurse Id</th>
                                  </tr>
                                </thead>
                                <tbody> 
                                <?php
                                $i=0;
                                while($i<$no)
                                { 
                                    $nurse=$arr[$i]['nurse_id'];

                                    if(!$nurse)
                                        $nurse="Not Assigned";

                                    $patient=$arr[$i]['patient_id'];
                                        if(empty($patient))
                                            $patient="Not Assigned";
                                  echo "<tr>
                                        <td>{$arr[$i]['room_id']}</td>
                                        <td>{$patient}</td>
                                        <td>{$nurse}</td>
                                        </tr>";
                                  $i++;
                                }
                                ?>  
                                </tbody>
                                </table>
                                
                              </div>

                            <?php endif; ?>
                            
                    </div>

                     <?php else: ?>
                    <div class="col-md-12">   
                        <h1>Rooms</h1>
                        <br>
                        <div class="row">
                            <a href="rooms.php?action=add" class="btn btn-lg btn-success">Add New Room</a>
                            <a href="rooms.php?action=view_all" class="btn btn-lg btn-primary">View All Rooms</a>
                            <a href="rooms.php?action=assign_nurse" class="btn btn-lg btn-warning">Assign Nurse</a>
                            <a href="rooms.php?action=unassign_nurse" class="btn btn-lg btn-danger">Unassign Nurse</a>
                        </div>
                    </div>
                    
                    <?php endif; ?>
                </div>
            </div>
        
        <!-- /#page-content-wrapper -->

        <?php require_once 'footer.php'; ?>