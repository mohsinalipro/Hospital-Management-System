<?php


function isEmployeeLoggedIn() {
    global $_SESSION;
    return isset($_SESSION['user']) ? true : false;
}
function redirectTo($url) {
    $current_url = end(explode('/',$_SERVER['PHP_SELF']));
    if($current_url != $url) {
        header('Location: ' . $url);
        die();   
    }
}