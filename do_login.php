<?php
require_once 'config.php';
require_once 'includes/functions.php';
session_start();

if(isEmployeeLoggedIn()) {
    redirectTo('dashboard.php');
}


$username = $_POST['username'];
$password = $_POST['password'];

$q = $db->query("SELECT * from employee WHERE username = '{$username}' AND password = '{$password}' LIMIT 1");
if(count($q)>0) {
    $_SESSION['user'] = $q[0];
    $_SESSION['user']['typename'] = $db->query("SELECT typename from employee_type WHERE employee_type_id = '{$_SESSION['user']['employee_type_id']}' LIMIT 1")[0]['typename'];
    redirectTo('dashboard.php');
} else {
    echo 'Login failed, please try again';
}

