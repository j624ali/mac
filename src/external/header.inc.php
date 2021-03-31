<?php

session_start(); 

include("db.inc.php");
include("functions.inc.php");


if(!isset($_SESSION['user_id'])) {

	header("Location: login/index.html");

} else {

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE `user_id` = '{$user_id}'";
$query = mysqli_query($connection, $query);

$header_row = mysqli_fetch_assoc($query);

$user_firstname = $header_row['user_firstname'];
$user_lastname = $header_row['user_lastname'];
$user_username = $header_row['user_username'];
$user_email = $header_row['user_email'];
$user_dob = $header_row['user_dob'];
$user_avatar = $header_row['user_avatar'];
$user_date_created = $header_row['user_date_created'];
$dark_mode = $header_row['dark_mode'];

}
?>

