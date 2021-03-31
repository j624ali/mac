<?php 

include "header.inc.php";


if ($_SERVER['REQUEST_METHOD'] == "GET") { ?>

<?php include "conversations_get.inc.php"; ?>

<?php } elseif ($_SERVER['REQUEST_METHOD'] == "POST") { ?>

<?php include "conversations_post.inc.php";?>

<?php } ?>