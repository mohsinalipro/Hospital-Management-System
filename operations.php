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
                        <h1>Add New Operation</h1>

                            <?php include 'forms/add_operation.php'; ?>
                        
                    </div>

                    <?php elseif(isset($_GET['action']) && $_GET['action'] == 'view_all') : ?>
                    <div class="col-md-12">   
                        <?php
                                  $q="select operation_id,title,price,estimated_time,description from operation";
                                  $arr=$db->query($q);
                                  $no=0;
                                  $no=count($arr);
                                  if($no==0) : ?>
                                  <h3>No Operation Found</h1>
                                <?php else: ?>
                                  <h1>All Operation:</h1>
                                  <table class="table table-bordered">
                                   <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Estimated Time</th>
                                    <th>Description</th>
                                    <th>Option</th>
                                  </tr>
                                </thead>
                                <tbody> 
                                <?php
                                $i=0;
                                while($i<$no)
                                { 
                                  echo "<tr>
                                        <td>{$arr[$i]['title']}</td>
                                        <td>{$arr[$i]['price']}</td>
                                        <td>{$arr[$i]['estimated_time']}</td>
                                        <td>{$arr[$i]['description']}</td>
                                        <td>
                                        <a href=\"single={$arr[$i]['operation_id']}\" class=\"btn btn-warning btn-sm\">Edit</a>
                                        <a href=\"single={$arr[$i]['operation_id']}\" class=\"btn btn-danger btn-sm\">Delete</a>
                                        </td>
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
                        <h1>Operation</h1>
                        <br>
                        <div class="row">
                            <a href="operations.php?action=add" class="btn btn-lg btn-success">Add New Operation</a>
                            <a href="operations.php?action=view_all" class="btn btn-lg btn-primary">View All Operation</a>
                        </div>
                            
                    </div>
                    
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

        <?php require_once 'footer.php'; ?>