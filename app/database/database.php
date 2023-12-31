<?php
require_once('../config/config.php');

// CONNNECTION TO MYSQL
$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// LOG CONNECTION ERRORS
echo !$connection ? mysqli_connect_error() : null;

?>