<?php
require_once( 'includes/class.db.php' );

define( 'DB_HOST', 'localhost' ); // set database host
define( 'DB_USER', 'root' ); // set database user
define( 'DB_PASS', '' ); // set database password
define( 'DB_NAME', 'hms' ); // set database name
define( 'DISPLAY_DEBUG', true ); //display db errors?

$db = new DB(DB_HOST,DB_USER,DB_PASS,DB_NAME);