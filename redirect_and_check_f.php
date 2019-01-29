<?php
function redirect_user($page = 'view_viaggi.php') {

    // Start defining the URL...
    // URL is http:// plus the host name plus the current directory:
    //http_host da il dominio e php server il path fino a quel file
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

    // Remove any trailing slashes:
    $url = rtrim($url, '/\\');

    // Add the page:
    $url .= '/' . $page;

    // Redirect the user:
    header("Location: $url");
    exit(); // Quit the script.

}

function check_login($dbc, $email = '') {

    $errors = []; // Initialize error array.

    // Validate the email address:
    if (empty($email)) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = mysqli_real_escape_string($dbc, trim($email));
    }

    if (empty($errors)) { // If everything's OK.

        // Retrieve the user_id and first_name for that email/password combination:
        $q = "SELECT matricola as matricola FROM personale_viaggio WHERE matricola='$e'";
        $r = @mysqli_query($dbc, $q); // Run the query.

        // Check the result:
        if (mysqli_num_rows($r) == 1) {

            // Fetch the record:
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

            // Return true and the record:
            return [true, $row];

        } else { // Not a match!
            $errors[] = 'The email address and password entered do not match those on file.';
        }

    } // End of empty($errors) IF.

    // Return false and the errors:
    return [false, $errors];

}