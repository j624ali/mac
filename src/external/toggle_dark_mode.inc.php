<?php

include "header.inc.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {


$query = "UPDATE users SET `dark_mode` = '" . opposite_bool($dark_mode) . "' WHERE `user_id` = '{$user_id}'";
$query = mysqli_query($connection, $query);

if ($query) { echo "<script>$('body').toggleClass('dark');</script>"; }


}

?>