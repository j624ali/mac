<script>

$('#_email').removeClass('has-error');
$('.form-feedback').html('');

function form_error($data) {$('#_' + $data).addClass('has-error');}
function form_feedback($data1, $data2) {$('#' + $data1 + '_').html($data2);}

</script>


<?php


include ("../external/db.inc.php");
include ("../external/functions.inc.php");





if ($_SERVER['REQUEST_METHOD'] == "POST") {


$email =  test_input($_POST['email']);


  


$script = "";

$login_method = "";


$check_email = "SELECT * FROM `users` WHERE `user_email` = '{$email}'";
$check_email = mysqli_query($connection, $check_email);
$email_num_rows = mysqli_num_rows($check_email);



if (empty($email)) {

	echo "<div style='border-radius: 3px !important;' class='alert alert-dark'>Please fill in the email field.</div>";
	$script .= "form_feedback('email', 'Please enter you email.'); form_error('email');";

} elseif (!is_email($email)) {

	echo "<div style='border-radius: 3px !important;' class='alert alert-dark'>The email address is not valid.</div>";
	$script .= "form_feedback('email', 'Please enter a valid email address.'); form_error('email');";

} elseif ($email_num_rows == 0) {

	echo "<div style='border-radius: 3px !important;' class='alert alert-dark'>The email address does not exist.</div>";
	$script .= "form_feedback('email', 'Please enter a valid email address.'); form_error('email');";

} else {


$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);
$hashed_token = password_hash($token, PASSWORD_DEFAULT);

$url = "http://localhost/project/docs/create_new_password?selector={$selector}&validator=" . bin2hex($token);

$expiry = date("U") + 600;

$clear_tokens = "DELETE FROM `password_reset` WHERE `password_reset_email` = '{$email}'";
$clear_tokens = mysqli_query($connection, $clear_tokens);

$insert_token = "INSERT INTO `password_reset` (password_reset_email, password_reset_selector, password_reset_token, password_reset_expiry) VALUES ('{$email}', '{$selector}', '{$hashed_token}', '{$expiry}')";
$insert_token = mysqli_query($connection, $insert_token);


if($clear_tokens && $insert_token) {

$subject = "Reset your password";

$message = "<p>We have recieved a request to reset your password. If you have not made this request, you can ignore this email.</p>";
$message .= "<p>Here is the link to reset your password: <a href='{$url}'>{$url}</a></p>";

$header = "From: project <jihad624ali@gmail.com>\r\n";
$header .= "Reply-To: jihad624ali@gmail.com\r\n";
$header .= "Content-type: text/html\r\n";

$send_mail = mail($email, $subject, $message, $header);

if ($send_mail){

	// $script .= "$('.container-content-middle').html(\"<div class='m-x-auto app-form'> <div class='text-center m-t-0 m-b-md'> <h3 class='m-t-0 text-center'>Check Your Inbox</h3> <p class='text-muted'>We sent you a verification email. Tap the link to reset your password.</p> </div> <div class='text-center'> <a href='../login/' id='submit' class='btn-pill btn form-btn'>Log In</a> </div></div>\");";	

	$script .= "$('.container-content-middle').html(\"<div class='m-x-auto app-form'> <div class='text-center m-t-0 m-b-md'> <h3 class='m-t-0 text-center'>Check Your Inbox</h3> <p class='text-muted'>{$url}</p> </div> <div class='text-center'> <a href='../login/' id='submit' class='btn-pill btn form-btn'>Log In</a> </div></div>\");";
}




}



}









} else {
	

header("Location: index.html");

}


?>

<script>
	
<?php echo $script; ?>

</script>
