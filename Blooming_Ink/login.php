<?php # login.php

// This page processes the login form submission.

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Load required files:
    require ('login_functions.inc.php');
    require ('mysqli_connect.php');
    
    // Check the login:
    list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
    
    if ($check) { // Login success
        
        // Start the session:
        session_start();
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['fname'] = $data['fname'];
        $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']); // For added security
        
        // Redirect to logged-in page:
        redirect_user('loggedin.php');
        
    } else { // Login failed

        // Store the errors to show on the login page:
        $errors = $data;
    }

    // Close the DB connection:
    mysqli_close($dbc);
}

// Display the login page (form):
include ('login_page.inc.php');
?>
