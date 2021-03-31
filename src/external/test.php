<?php

include ("header.inc.php");


if (compress("../post_files/613.jpg", "../post_files/624.jpg", 40)) {
	echo "success";
}