<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Register';
include ('header.php');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO users (fname, lname, email, pass, registration_date) VALUES ('$fn', '$ln', '$e', SHA2('$p',256), NOW() )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<div style="width:fit-content; margin:40px auto; padding:2% 3%; background-color:lavenderblush; border:2px solid plum; border-radius:5px; box-shadow:4px 4px 10px mediumorchid; text-align:center; color:mediumorchid;">
		<h1>Thank you!</h1>
		<p>You are now registered.</p>
		<p>(˶ᵔ ᵕ ᵔ˶)</p>
		</div>';
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border-radius:7px; box-shadow:4px 4px 10px mediumorchid; text-align:center;">
			<h1 style="color:red;">System Error</h1>
			<p style="color:red; font-size:1.5em; font-weight:bold;">You could not be registered due to a system error. We apologize for any inconvenience.</p>
			</div>';
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		echo '</div>'; //closes main-content div
		include ('footer.php'); 
		exit();
		
	} else { // Report the errors.
	echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border-radius:7px; box-shadow:4px 4px 10px mediumorchid; text-align:center;">
		<h1 style="color:red;">Error!</h1>
		<p style="color:red; font-size:1.5em; font-weight:bold;">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p style="color:mediumorchid;">Please try again.</p>
		</div>';
	
	}
	 // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>
<style>

body{
display:flex;
flex-direction: column;
min-height:100vh;
margin:0;
}

.main-content{
    flex:1;
}


    #registerform{
        width: fit-content;
        background-color:lavenderblush;
        border:2px solid plum;
        border-radius: 20px;
        box-shadow: 4px 4px 10px mediumorchid;
        margin: 40px auto;
        padding: 2% 3%;
        
    }
    
    #registerform h1{
        text-align:center;
        color:mediumorchid;
    }
    #submitbutton{
        text-align: center;
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

<div class="main-content">

<div id="registerform">
<h1>Register</h1>
<form action="register.php" method="post">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p id='submitbutton'><input type="submit" name="submit" value="Register" /></p>
</form>
</div>

</div> <!-- closes div for main content-->


<?php include ('footer.php'); ?>