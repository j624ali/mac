<script>

$('#_new_password, #_confirm_new_password').removeClass('has-error');
$('.form-feedback').html('');

function form_error($data) {$('#_' + $data).addClass('has-error');}
function form_feedback($data1, $data2) {$('#' + $data1 + '_').html($data2);}

</script>



<?php

$script = "";


include ("../external/db.inc.php");
include ("../external/functions.inc.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {








$new_password =  test_input($_POST['new_password']);
$confirm_new_password =  test_input($_POST['confirm_new_password']);
$selector =  test_input($_POST['selector']);
$validator =  test_input($_POST['validator']);

$salt = '$2y$10$iusesomecrazystrings22';
$crypt_password = crypt($new_password, $salt); 

if (!isset($_POST['validator']) || !isset($_POST['selector'])) {

	
	$script .= "$('.container-content-middle').html(\"<div class='m-x-auto app-form'> <div class='text-center m-t-0 m-b-md'> <h3 class='m-t-0 text-center'>We could not validate your request.</h3> <p class='text-muted'>Login or reset your password again.</p> </div> <div class='text-center'><a href='../login/index.html' class='text-muted'><b>Log In</b></a>/<a href='../password_reset/index.html' class='text-muted'><b>Reset Password</b></a></div></div>\");";


} elseif (ctype_xdigit($_POST['selector']) == false || ctype_xdigit($_POST['validator']) == false) {

	$script .= "$('.container-content-middle').html(\"<div class='m-x-auto app-form'> <div class='text-center m-t-0 m-b-md'> <h3 class='m-t-0 text-center'>We could not validate your request.</h3> <p class='text-muted'>Login or reset your password again.</p> </div> <div class='text-center'><a href='../login/index.html' class='text-muted'><b>Log In</b></a>/<a href='../password_reset/index.html' class='text-muted'><b>Reset Password</b></a></div></div>\");";


} elseif (strlen($new_password) < 6) {

	echo "<div style='border-radius: 3px !important;' class='alert alert-dark'>The password is too short.</div>"; 
	$script .= "form_feedback('new_password', 'The password must be at least 6 charachters.'); form_error('new_password');";
	$script .= "form_feedback('new_password', 'The password must be at least 6 charachters.'); form_error('confirm_new_password');";

} elseif ($new_password != $confirm_new_password) {

	echo "<div style='border-radius: 3px !important;' class='alert alert-dark'>The passwords do not match.</div>"; 
	$script .= "form_error('new_password');";
	$script .= "form_error('confirm_new_password');";

} else {
	
	$current_time = date("U");

	$query = "SELECT * FROM password_reset WHERE password_reset_selector = '{$selector}' AND password_reset_expiry >= $current_time";
	$query = mysqli_query($connection, $query);


	if (!$row = mysqli_fetch_assoc($query)) {

	$script .= "$('.container-content-middle').html(\"<div class='m-x-auto app-form'> <div class='text-center m-t-0 m-b-md'> <h3 class='m-t-0 text-center'>The link has expired.</h3> <p class='text-muted'>Login or reset your password again.</p> </div> <div class='text-center'><a href='../login/index.html' class='text-muted'><b>Log In</b></a>/<a href='../password_reset/index.html' class='text-muted'><b>Reset Password</b></a></div></div>\");";
		

	} else {



		$token_bin = hex2bin($validator);
		$token_check = password_verify($token_bin, $row['password_reset_token']);

		if (!$token_check) {

	$script .= "$('.container-content-middle').html(\"<div class='m-x-auto app-form'> <div class='text-center m-t-0 m-b-md'> <h3 class='m-t-0 text-center'>We could not validate your request.</h3> <p class='text-muted'>Login or reset your password again.</p> </div> <div class='text-center'><a href='../login/index.html' class='text-muted'><b>Log In</b></a>/<a href='../password_reset/index.html' class='text-muted'><b>Reset Password</b></a></div></div>\");";


		} else {

			$token_email = $row['password_reset_email'];

			$query2 = "SELECT * FROM users WHERE user_email = '{$token_email}'";
			$query2 = mysqli_query($connection, $query2);

		if (!$row = mysqli_fetch_assoc($query2)) {

		$script .= "$('.container-content-middle').html(\"<div class='m-x-auto app-form'> <div class='text-center m-t-0 m-b-md'> <h3 class='m-t-0 text-center'>There was an error.</h3> <p class='text-muted'>Login or reset your password again.</p> </div> <div class='text-center'><a href='../login/index.html' class='text-muted'><b>Log In</b></a>/<a href='../password_reset/index.html' class='text-muted'><b>Reset Password</b></a></div></div>\");";

		} else {

			$update_password = "UPDATE users SET user_password = '{$crypt_password}' WHERE user_email = '{$token_email}'";
			$update_password = mysqli_query($connection, $update_password);

			$delete_token = "DELETE FROM password_reset WHERE password_reset_email = '{$token_email}'";
			$delete_token = mysqli_query($connection, $delete_token);

			if ($update_password && $delete_token) {

				$script .= "window.location.replace('../login/index.html?password_reset=success');";

			} else {

		$script .= "$('.container-content-middle').html(\"<div class='m-x-auto app-form'> <div class='text-center m-t-0 m-b-md'> <h3 class='m-t-0 text-center'>There was an error.</h3> <p class='text-muted'>Login or reset your password again.</p> </div> <div class='text-center'><a href='../login/index.html' class='text-muted'><b>Log In</b></a>/<a href='../password_reset/index.html' class='text-muted'><b>Reset Password</b></a></div></div>\");";


			}


		}


		}



	};


}








} else {
	

header("Location: index.html");


}


?>

<script>
	
<?php echo $script; ?>

</script>
