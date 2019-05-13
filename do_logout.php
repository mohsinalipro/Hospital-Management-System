<?php
require_once 'config.php';
require_once 'includes/functions.php';

session_start();
if(isEmployeeLoggedIn()) {
    unset($_SESSION['user']);
    session_destroy();
}
redirectTo('dashboard.php');