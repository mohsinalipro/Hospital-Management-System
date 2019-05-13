<?php
date_default_timezone_set('Asia/Karachi');
$Hour = date('G');
if ( $Hour >= 5 && $Hour <= 11 ) {
    $greeting = "Good Morning";
} else if ( $Hour >= 12 && $Hour <= 18 ) {
    $greeting = "Good Afternoon";
} else if ( $Hour >= 19 || $Hour <= 4 ) {
    $greeting = "Good Evening";
}

$user = $_SESSION['user'];

?>
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        <div class="logo"></div>
                    </a> 
                    <div id="logged-in-info">
                        <span><?php echo $greeting . ' ' . $user['fname']; ?>! <br> <small>You're logged as '<?php echo $user['username']; ?>'</small><br><?php echo $user['typename']; ?></span> <a class="btn btn-danger" href="do_logout.php" role="button">Logout</a>
                    </div>
                </li>
                <?php
                    echo '<li><a href="dashboard.php">Dashboard</a></li>';
                
                    if(in_array($user['typename'],['Administrator']))
                        echo '<li><a href="employees.php">Employees</a></li>';
                
                    if(in_array($user['typename'],['Administrator','Doctor','Receptionist']))
                        echo '<li><a href="patients.php">Patients</a></li>';
                
                    if(in_array($user['typename'],['Administrator','Receptionist']))
                        echo '<li><a href="rooms.php">Rooms</a></li>';
                
                    if(in_array($user['typename'],['Administrator','Doctor','Receptionist']))
                        echo '<li><a href="patient-history.php">Patient History</a></li>';
                
                    if(in_array($user['typename'],['Administrator','Pharmacist']))
                        echo '<li><a href="medicines.php">Medicine</a></li>';
                
                    if(in_array($user['typename'],['Administrator']))
                        echo '<li><a href="operations.php">Operations</a></li>';
                ?>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
