        <?php session_start(); ?>
        <?php require_once 'header.php'; ?>
        <?php require_once 'sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">   
                        <h1>Search <?php echo isset($_GET['for']) ? ucwords($db->cleanString($_GET['for']) . 's') : ''; ?></h1>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                        
                                    <?php 
                                    if(isset($_GET['for']) && ($_GET['for'] == 'employee' || $_GET['for'] == 'patient'))
                                        require_once 'forms/advance_search.php';
                                    else
                                        echo '<a href="search.php?for=employee" class="btn btn-primary btn-lg">Search for Employees</a>'.
                                        ' <a href="search.php?for=patient" class="btn btn-success btn-lg">Search for Patients</a>';
                                    ?>

                                  </div>
                                </div>
                            </div>
  
                        
                    </div>              
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

        <?php require_once 'footer.php'; ?>