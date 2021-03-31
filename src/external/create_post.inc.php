<?php

include("header.inc.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

$file_name = test_input($_FILES['file']['name']);
$form_text = nl2br(test_post_input($_POST['form-text']));

if(empty($file_name) && empty($form_text)) {

echo "both fields are empty";

} else {

if (!empty($file_name)) {

$accepted_image_types = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
$accepted_video_types = array('video/mp4', 'video/x-m4v');
$extension = $_FILES['file']['type'];

if (in_array($extension, $accepted_image_types)) {

$new_file_name = bin2hex(random_bytes(6)) . uniqid() . ".jpg";
$post_type = "image";

$query = "INSERT INTO `posts`(`post_user_id`, `post_content`, `post_file`, `post_type`) VALUES ('{$user_id}', '{$form_text}', '{$new_file_name}', '{$post_type}')";
$query = mysqli_query($connection, $query);

if ($query) {

$file_tmp_name = test_input($_FILES['file']['tmp_name']);

$move_file = move_uploaded_file($file_tmp_name, "../post_files/{$new_file_name}");
if ($move_file) {
echo "<script>location.reload();</script>";


}

}

} elseif (in_array($extension, $accepted_video_types)) {


$new_file_name = bin2hex(random_bytes(6)) . uniqid() . ".mp4";
$post_type = "video";

$query = "INSERT INTO `posts`(`post_user_id`, `post_content`, `post_file`, `post_type`) VALUES ('{$user_id}', '{$form_text}', '{$new_file_name}', '{$post_type}')";
$query = mysqli_query($connection, $query);

if ($query) {

$file_tmp_name = test_input($_FILES['file']['tmp_name']);

$move_file = move_uploaded_file($file_tmp_name, "../post_files/{$new_file_name}");
if ($move_file) {
echo "<script>location.reload();</script>";


}

}



} else {

	echo "Invalid file type";
}

} else {


$post_type = "text";

$query = "INSERT INTO `posts`(`post_user_id`, `post_content`, `post_type`) VALUES ('{$user_id}', '{$form_text}', '{$post_type}')";
$query = mysqli_query($connection, $query);

if ($query) {

echo "<script>location.reload();</script>";



                

} else {

	// echo "There was a problem.";
	echo mysqli_error($connection);
}



}



}



} else {

header("Location: ../index.php");

}