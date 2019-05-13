<?php
session_start();
require_once 'header.php'; 
require_once 'sidebar.php'; 


$user['typename'] = $db->query("SELECT typename from employee_type WHERE employee_type_id = '{$user['employee_type_id']} LIMIT 1'")[0]['typename'];
?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">       
                        <h1><?php echo $user['typename']; ?> Dashboard</h1>
                        <?php require_once 'dashboard-widgets.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

        <?php require_once 'footer.php'; ?>