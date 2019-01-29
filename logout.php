<?php
echo '<title>Logout </title>';

include('html/header.html');
include ('html/css_includer.html');
session_start();

if (!isset($_SESSION['matricola'])) {// se l'utente non è loggato
    echo '<h1> Devi prima effettuare il <a href="login.php">login </a></h1>';
} else { //cancello i cookie e lo redirigo sulla view
    echo "<div class='container-fluid'>
            <h1>Arrivederci, {$_SESSION['matricola']}!</h1>
            <h4> Puoi tornare alla <a href='view_viaggi.php'>lista viaggi</a> oppure rieffettuare il <a href='login.php'> login </a>
          <div>";
    $_SESSION = [];
    session_destroy();
    setcookie('PHPSESSID', '', time()-3600);
    session_write_close();
    header("refresh:3; url=view_viaggi.php");
}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';

include_once ('html/footer.html');