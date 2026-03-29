<?php # Script 12.11 - logout.php #2
// This page lets the user logout.
// This version uses sessions.

session_start(); // Access the existing session.

// If no session variable exists, redirect the user:
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ('login_functions.inc.php');
	redirect_user();	
	
} else { // Cancel the session:

	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.

}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';
include ('header.php');

// Print a customized message:
echo '<div style="width:fit-content; margin:40px auto; padding:2% 3%; background-color:lavenderblush; border:2px solid plum; border-radius:5px; box-shadow:4px 4px 10px mediumorchid; text-align:center; color:mediumorchid; font-family:cursive;">
<h1>Logged Out!</h1>
<p>You are now logged out!</p>
<p>(˶ᵔᗜᵔ˶)ﾉﾞ</p>
</div>';

include ('footer.php');
?>