<?php

echo '<title>Login</title>';

include("html/header.html");
include("html/css_includer.html");
require ("redirect_and_check_f.php");

session_start();

$isday = true;
if(!(date('H')> '7' && date('H') < '18')){
    $isday = false;
}
if(!isset($_SESSION['matricola']) && empty($_SESSION['matricola']) && $_SERVER['REQUEST_METHOD'] == 'GET' ){
    echo '<h1> Login </h1>';

    echo '
<div class="container-fluid">
    <div class="input-group mb-3">
<form action="login.php" class="form-search pull-right" method="post">
    <div id=\'aligner\'>
    <input placeholder="Inserisci il tuo codice matricola"  type="name" class="form-control" name="matricola" size="24" maxlength="60">
	<input  type="submit" name="submit" id="sub"  class="btn btn-primary" value="Login">
    </div>
    </div>
</form>
</div>';


}

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once("html/header.html");
    include_once("html/css_includer.html");
    require("connection_to_sql.php");

    list($check, $data) = check_login($dbc, $_POST['matricola']);

    if($check){
        $_SESSION['matricola'] = $data['matricola'];
        echo $isday ?  "<h1> Buon giorno, sei loggato " . $_POST['matricola'] . "!</h1>" : "<h1> Buona sera, sei loggato " . $_POST['matricola'] . "!</h1>";
    }
}

if(isset($_SESSION['matricola']) && !empty($_SESSION['matricola']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    echo $isday ?  "<h1> Buon giorno, sei loggato " . $_SESSION['matricola'] . "!</h1>" : "<h1> Buona sera, sei loggato " . $_SESSION['matricola'] . "!</h1>";

}

include_once ('html/footer.html');

