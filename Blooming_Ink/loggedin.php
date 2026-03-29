<?php # Script 12.13 - loggedin.php #3
// The user is redirected here from login.php.

session_start(); // Start the session.

// If no session value is present, redirect the user:
// Also validate the HTTP_USER_AGENT!
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	require ('includes/login_functions.inc.php');
	redirect_user();	

}

// Set the page title and include the HTML header:
$page_title = 'Logged In!';
include ('header.php');

// Print a customized message:
echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border:2px solid plum; border-radius:10px; box-shadow:4px 4px 10px mediumorchid; text-align:center; color:mediumorchid;">
<h1>Logged In!</h1>
<p>You are now logged in, ' . $_SESSION['fname'] . '!</p>
<p><a href="logout.php" style="color:mediumorchid;">Logout</a></p>
</div>';
include ('footer.php');
?>