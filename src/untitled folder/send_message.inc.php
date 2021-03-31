<?php

include "header.inc.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

$friend = test_input($_POST['friend']);
$message = test_input($_POST['message']);

$send_message = "INSERT INTO `messages` (`message_content`, `message_reciever`, `message_sender`) VALUES ('{$message}', '{$friend}', '{$user_id}')";
$send_message = mysqli_query($connection, $send_message);

}
?>
