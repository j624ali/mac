<?php

include "header.inc.php";

if (isset($_POST['message']) && isset($_POST['friend'])) {

$friend = test_input($_POST['friend']);
$message = test_input($_POST['message']);

$friend_query = "SELECT user_id FROM users WHERE user_id = {$friend}";
$friend_query = mysqli_query($connection, $friend_query);
$friend_query_num_rows = mysqli_num_rows($friend_query);

if ($friend_query_num_rows === 1 && !empty($message)) {
$send_message = "INSERT INTO `messages` (`message_content`, `message_reciever`, `message_sender`) VALUES ('{$message}', '{$friend}', '{$user_id}')";
$send_message = mysqli_query($connection, $send_message);
$unix_timestamp = date("U");
$last_message_current_user = "UPDATE users SET user_last_message = {$unix_timestamp} WHERE user_id IN ($user_id, $friend)";
$last_message_current_user = mysqli_query($connection, $last_message_current_user);

}
}
?>
