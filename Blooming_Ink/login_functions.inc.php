<?php
// login_functions.inc.php

function check_login($dbc, $email_input, $pass_input) {
    $errors = [];

    // Sanitize and validate email:
    if (empty($email_input)) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $email = mysqli_real_escape_string($dbc, trim($email_input));
    }

    // Sanitize and validate password:
    if (empty($pass_input)) {
        $errors[] = 'You forgot to enter your password.';
    } else {
        $pass = mysqli_real_escape_string($dbc, trim($pass_input));
    }

    // Only proceed if no input errors:
    if (empty($errors)) {
        $query = "SELECT * FROM users WHERE email='$email' AND pass = SHA2('$pass', 256)";
        $result = mysqli_query($dbc, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return [true, $row];
        } else {
            $errors[] = 'The email address and password entered do not match those on file.';
        }
    }

    return [false, $errors];
}

// Redirection helper:
function redirect_user($page = 'index.php') {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;
    header("Location: $url");
    exit();
}
?>
