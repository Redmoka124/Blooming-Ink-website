<?php # Script 12.1 - login_page.inc.php
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';
include ('header.php');

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border-radius:7px; box-shadow:4px 4px 10px mediumorchid; text-align:center;">
	<h1 style="color:red;">Error!</h1>
	<p style="color:red; font-size:1.5em; font-weight:bold;">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p style="color:mediumorchid;">Please try again.</p>
	</div>';
}

// Display the form:
?>

<style>
    
    #logincontainer{
        width: fit-content;
        background-color:lavenderblush;
        border: 2px solid plum;
        border: 10px;
        border-radius: 10px;
        box-shadow:4px 4px 10px mediumorchid;
        margin:40px auto;
        padding:2% 3%;
    }
    
    #logincontainer h1{
        text-align: center;
    }
    #submitbutton{
        text-align: center;
    }
    #submitbutton input[type="submit"]{
        background-color:mediumorchid;
        color:lavenderblush;
        border: 2px solid mediumorchid;
        border-radius: 7px;
        box-shadow: 4px 4px 10px darkorchid;
        cursor: pointer;
    }
    
    
</style>

<div id="logincontainer">
<h1>Login</h1>
<form action="login.php" method="post">
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" /> </p>
	<p>Password: <input type="password" name="pass" size="20" maxlength="20" /></p>
	<p id="submitbutton"><input type="submit" name="submit" value="Login" /></p>
</form>
</div>
<?php include ('footer.php'); ?>