<?php

$host_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "project";

$connection = mysqli_connect($host_name, $db_username, $db_password, $db_name);

if (!$connection) {
    
    die ("Database connection failed.");
    
}


?>