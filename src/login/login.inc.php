<script>

$('#_username_email, #_password').removeClass('has-error');
$('.form-feedback').html('');

function form_error($data) {$('#_' + $data).addClass('has-error');}
function form_feedback($data1, $data2) {$('#' + $data1 + '_').html($data2);}

</script>


<?php


include ("../external/db.inc.php");
include ("../external/functions.inc.php");





if ($_SERVER['REQUEST_METHOD'] == "POST") {


$username_email =  test_input($_POST['username_email']);
$password =  test_input($_POST['password']);


$salt = '$2y$10$iusesomecrazystrings22';
$crypt_password = crypt($password, $salt);    


$script = "";

$login_method = "";


if (!empty($username_email)) {


	if (is_email($username_email)) {

		$check_email = "SELECT * FROM `users` WHERE `user_email` = '{$username_email}'";
		$check_email = mysqli_query($connection, $check_email);
		$email_num_rows = mysqli_num_rows($check_email);

		if($email_num_rows == 0) {$script .= "form_feedback('username_email', 'The email you entered does not exist.'); form_error('username_email');";} else {
			$login_method = "email";

		}

	} else {

		$check_username = "SELECT * FROM `users` WHERE `user_username` = '{$username_email}'";
		$check_username = mysqli_query($connection, $check_username);
		$username_num_rows = mysqli_num_rows($check_username);

				if($username_num_rows == 0) {$script .= "form_feedback('username_email', 'The username you entered does not exist.'); form_error('username_email');";} else {
			$login_method = "username";
				
		}

	}






} else {

	echo "<div style='border-radius: 3px !important;' class='alert alert-dark'>Please fill in all the fields.</div>";


	if (empty($username_email)) {$script .= "form_feedback('username_email', 'Please enter your username or email.'); form_error('username_email');";}

}



if (!empty($password)) {


if ($login_method != "") {



		$check_password = "SELECT * FROM `users` WHERE `user_{$login_method}` = '{$username_email}' AND `user_password` = '{$crypt_password}'";
		$check_password = mysqli_query($connection, $check_password);
		$password_num_rows = mysqli_num_rows($check_password);
		$session_row = mysqli_fetch_assoc($check_password);

				if($password_num_rows == 0) {
					$script .= "form_feedback('password', 'The password  does not match.'); form_error('password');";
					echo "<div class='alert alert-dark'>The {$login_method} and password combination do not match.</div>";
				} else {
session_start(); 
					$_SESSION['user_id'] = $session_row['user_id'];
					$script .= "window.location.replace('../index.php');";


		}


}



} else {

	$script .= "form_feedback('password', 'Please enter your password.'); form_error('password');";

}


} else {

header("Location: index.html");


}


?>

<script>
	
<?php echo $script; ?>

</script>



