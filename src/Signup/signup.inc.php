<script>

$('#_firstname, #_lastname, #_username, #_email, #_password, #_month, #_day, #_year').removeClass('has-error');
$('.form-feedback').html('');

function form_error($data) {$('#_' + $data).addClass('has-error');}
function form_feedback($data1, $data2) {$('#' + $data1 + '_').html($data2);}

</script>


<?php



include ("../external/db.inc.php");
include ("../external/functions.inc.php");





if ($_SERVER['REQUEST_METHOD'] == "POST") {


$firstname =  test_input($_POST['firstname']);
$lastname =  test_input($_POST['lastname']);
$username =  test_input($_POST['username']);
$email =  test_input($_POST['email']);
$password =  test_input($_POST['password']);
$month =  test_input($_POST['month']);
$day =  test_input($_POST['day']);
$year =  test_input($_POST['year']);
$dob = $year . "-" . $month . "-" . $day;


$salt = '$2y$10$iusesomecrazystrings22';
$crypt_password = crypt($password, $salt);    


$num_usernames_query = "SELECT * FROM `users` WHERE `user_username` = '{$username}'";
$num_usernames_query = mysqli_query($connection, $num_usernames_query);
$num_usernames = mysqli_num_rows($num_usernames_query);

$num_emails_query = "SELECT * FROM `users` WHERE `user_email` = '{$email}'";
$num_emails_query = mysqli_query($connection, $num_emails_query);
$num_emails = mysqli_num_rows($num_emails_query);

$script = "";

$alert_display = false;



if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($day) || empty($year) || $month == "0" || strlen($firstname) < 2 || strlen($lastname) < 2 || strlen($username) < 3 || strlen($password) < 6 || $num_usernames > 0 || $num_emails > 0 || $day < 1 || $month < 1 || $month > 12 || $year < 1900 || $year > date("Y") || !ctype_digit($year) || !ctype_digit($month) || !ctype_digit($day) || (($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) && $day > 31) || (($month == 4 || $month == 6 || $month == 9 || $month == 11) && $day > 30) || ($month == 2 && $day > 29) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !validate_username($username)) {



if ((empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($day) || empty($year) || $month == "0") && $alert_display == false) {

	echo "<div style='border-radius: 3px !important;' class='alert alert-dark'>Please fill in all the fields.</div>";
	$alert_display = true;

}

if (((($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) && $day > 31) || (($month == 4 || $month == 6 || $month == 9 || $month == 11) && $day > 30) || ($month == 2 && $day > 29)) && $alert_display == false) {

	echo "<div style='border-radius: 3px !important;' class='alert alert-dark'>The date of birth you entered is invalid.</div>"; 
	$script .= "form_error('day');";
	$alert_display = true;
}

if (($day < 1 || $month < 1 || $month > 12 || $year < 1900 || $year > date("Y") || !ctype_digit($year) || !ctype_digit($month) || !ctype_digit($day)) && $alert_display == false) {

	echo "<div style='border-radius: 3px !important;' class='alert alert-dark'>The date of birth you entered is invalid.</div>"; 
	$alert_display = true;

	if ($day < 1 || !ctype_digit($day)) {$script .= "form_error('day');";}
	if ($month < 1 || $month > 12 || !ctype_digit($month)) {$script .= "form_error('month');";}
	if ($year < 1900 || $year > date("Y") || !ctype_digit($year)) {$script .= "form_error('year');";}

}


// checks if input is empty
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {$script .=  "form_error('email'); form_feedback('email', 'Please enter a valid email address.');";} 
	if ($month == "0") {$script .= "form_error('month');";} 
	if (empty($day)) {$script .= "form_error('day');";} 
	if (empty($year)) {$script .= "form_error('year');";}
	if (strlen($firstname) < 2) {$script .= "form_feedback('firstname', 'The firstname must be at least 2 charachters.'); form_error('firstname');";}
	if (strlen($lastname) < 2) {$script .= "form_feedback('lastname', 'The lastname must be at least 2 charachters.'); form_error('lastname');";}
	if (strlen($username) < 3) {
		$script .= "form_feedback('username', 'The username must be at least 3 charachters.'); form_error('username');";
	} elseif (!validate_username($username)) {
		$script .= "form_feedback('username', 'The username must only contain letters, numbers, periods, and underscores'); form_error('username');";
	}
	if (strlen($password) < 6) {$script .= "form_feedback('password', 'The password must be at least 6 charachters.'); form_error('password');";}

// checks if input is too long
	if (strlen($firstname) > 25) {$script .= "form_feedback('firstname', 'The firstname must be under 25 charachters.'); form_error('firstname');";}
	if (strlen($lastname) > 25) {$script .= "form_feedback('lastname', 'The lastname must be under 25 charachters.'); form_error('lastname');";}
	if (strlen($username) > 25) {$script .= "form_feedback('username', 'The username must be under 25 charachters.'); form_error('username');";}

// checks if username and email already exist
	if ($num_usernames > 0) {$script .= "form_feedback('username', 'This username already exists.'); form_error('username');";}
	if ($num_emails > 0) {$script .= "form_feedback('email', 'This email already exists.'); form_error('email');";}




} else {


$dob =  test_input($dob);


$query = "INSERT INTO `users`(`user_firstname`, `user_lastname`, `user_username`, `user_email`, `user_password`, `user_dob`) VALUES ('$firstname', '$lastname', '$username', '$email', '$crypt_password', '$dob')";

$query = mysqli_query($connection, $query);

if (!$query) {

	echo mysqli_error($connection);

} else {

$url = "../index.html";
$script .= "$(location).attr('href', '{$url}');";

}

}



} else {

header("Location: index.html");


}


?>

<script>
	
<?php echo $script; ?>

</script>




