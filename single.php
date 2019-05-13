<?php

//http://localhost/hms/single.php?view=patient&id=123

$view = $_GET['view'];
$id = $_GET['id'];

switch($view) {
    case 'patient':
        require_once 'single-patients.php?id='.$id;
        break;
    case 'employee':
        require_once 'single-employees.php?id='.$id;
        break;
    case 'visit':
        require_once 'single-patient-history.php?id='.$id;
        break;
}

?>