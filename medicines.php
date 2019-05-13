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
                        <h1>Add New Medicine</h1>

                            <?php include 'forms/add_medicine.php'; ?>
                        
                    </div>
                    
                    <?php elseif(isset($_GET['action']) && $_GET['action'] == 'view_all') : ?>
                        <div class="col-md-12">   

                            <?php
                                  $q="select med_id,med_name,description,price from medicine";
                                  $arr=$db->query($q);
                                  $no=0;
                                  $no=count($arr);
                                  if($no==0) : ?>
                                  <h3>No Medicine Found</h1>
                                <?php else: ?>
                                  <h1>All Medicines:</h1>
                                  <table class="table table-bordered">
                                   <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Decription</th>
                                    <th>Price</th>
                                    <th>Option</th>
                                  </tr>
                                </thead>
                                <tbody> 
                                <?php
                                $i=0;
                                while($i<$no)
                                { 
                                  echo "<tr>
                                        <td>{$arr[$i]['med_name']}</td>
                                        <td>{$arr[$i]['description']}</td>
                                        <td>{$arr[$i]['price']}</td>
                                        <td>
                                        <a href=\"single={$arr[$i]['med_id']}\" class=\"btn btn-warning btn-sm\">Edit</a>
                                        <a href=\"single={$arr[$i]['med_id']}\" class=\"btn btn-danger btn-sm\">Delete</a>
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
                        <h1>Medicines</h1>
                        <br>
                        <div class="row">
                            <a href="medicines.php?action=add" class="btn btn-lg btn-success">Add New Medicine</a>
                            <a href="medicines.php?action=view_all" class="btn btn-lg btn-primary">View All Medicine</a>
                        </div>
                    </div>
                    
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

        <?php require_once 'footer.php'; ?>