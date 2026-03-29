<?php # Script 9.7 - password.php
// This page lets a user change their password.

$page_title = 'Change Your Password';
include ('header.php');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
	}

	// Check for a new password and match 
	// against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
			$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}
	
	if (empty($errors)) { // If everything's OK.

		// Check that they've entered the right email address/password combination:
		$q = "SELECT user_id FROM users WHERE (email='$e' AND pass=SHA2('$p',256) )";
		$r = @mysqli_query($dbc, $q);
		$num = @mysqli_num_rows($r);
		if ($num == 1) { // Match was made.
	
			// Get the user_id:
			$row = mysqli_fetch_array($r, MYSQLI_NUM);

			// Make the UPDATE query:
			$q = "UPDATE users SET pass=SHA2('$np',256) WHERE user_id=$row[0]";		
			$r = @mysqli_query($dbc, $q);
			
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message.
				echo '<h1>Thank you!</h1>
				<p>Your password has been updated.</p><p><br /></p>';	

			} else { // If it did not run OK.

				// Public message:
				echo '<h1>System Error</h1>
				<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
	
				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	
			}

			mysqli_close($dbc); // Close the database connection.

			// Include the footer and quit the script (to not show the form).
			include ('footer.php'); 
			exit();
				
		} else { // Invalid email address/password combination.
			echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border-radius:7px; box-shadow:4px 4px 10px mediumorchid; text-align:center;">
			<h1 style="color:red;">Error!</h1>
			<p style="color:red; font-size:1.5em; font-weight:bold;">The email address and password do not match those on file.</p>
			</div>';
		}
		
	} else { // Report the errors.

		echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border-radius:7px; box-shadow:4px 4px 10px mediumorchid; text-align:center;">
		<h1 style="color:red;">Error!</h1>
		<p style="color:red; font-size:1.5em; font-weight:bold;">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p style="color:mediumorchid;">Please try again.</p>
		</div>';
	
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>
<style>
    #passwordcontainer{
        width: fit-content;
        background-color:lavenderblush;
        border: 2px solid plum;
        border-radius:10px;
        box-shadow: 4px 4px 10px mediumorchid;
        margin:40px auto;
        padding: 2% 3%;
    }
    
    
    #passwordcontainer h1{
        text-align: center;
        color: mediumorchid;
    }
    
    #submitbutton{
        text-align:center;
    }
    
    #submitbutton input[type="submit"]{
        background-color:mediumorchid;
        color:lavenderblush;
        border:none;
        border: 2px solid mediumorchid;
        border-radius: 7px;
        box-shadow: 4px 4px 10px darkorchid;
        cursor: pointer;
    }
    
</style>


<div id="passwordcontainer">
<h1>Change Your Password</h1>
<form action="password.php" method="post">
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Current Password: <input type="password" name="pass" size="10" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"  /></p>
	<p>New Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm New Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p id="submitbutton"><input type="submit" name="submit" value="Change Password" /></p>
</form>
</div>
<?php include ('footer.php'); ?>