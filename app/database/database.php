<?php
require_once('config.php');

// CONNNECTION TO MYSQL
$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// LOG CONNECTION ERRORS
echo !$connection ? 'Connection to DB error' . mysqli_connect_error() : 'Connected';

?>