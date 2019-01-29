<?php
require("html/header.html");
require ("html/css_includer.html");

echo '<title>Invia messaggio</title><div class="container-fluid"><h2>Invia un messaggio </h2>';

require_once ("connection_to_sql.php");
require ("redirect_and_check_f.php");

session_start();
$id_nave="";
$ora_partenza="";
if ( (isset($_GET['id'])) && (isset($_GET['o']))) {
    $id_nave = $_GET['id'];
    $ora_partenza = $_GET['o'];
}


//se l'utente prova ad accedere senza aver inserito l'id della nave e l'ora lo redirigo sulla view
if($_SERVER['REQUEST_METHOD'] == 'GET' && $ora_partenza=="" && $id_nave==""){
    redirect_user("view_viaggi.php");
}

//se l'utente prova ad accedere da non loggato lo redirigo sulla view
if(!isset($_SESSION['matricola']) || empty($_SESSION['matricola'])){
    redirect_user("view_viaggi.php");
}



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $error = [];
    if(empty($_POST['latitudine']) || empty($_POST['longitudine']) || empty($_POST['velocita']) || empty($_POST['direzione']) || empty($_POST['note'])){
        $error = "Inserisci tutti i valori";
    }else{
        //genero una stringa random per l'id_messaggio
        $mes = generateRandomString();
        $now = date('Y-m-d h:i:s', time());
        //prendo i campi dalla post
        $id_n = $_POST['id_nave_name'];
        $ora_p = $_POST['ora_p'];
        $lat = $_POST['latitudine'];
        $long = $_POST['longitudine'];
        $vel = $_POST['velocita'];
        $dir = $_POST['direzione'];
        $note = $_POST['note'];
        //inserisco i valori nel db
        $query_insert = "INSERT INTO messaggio (id_messaggio, data_ora, id_nave, data_ora_partenza, lat, lng, velocità, direzione, note) values('$mes', '$now', '$id_n', '$ora_p', '$lat', '$long','$vel',
        '$dir', '$note')";
        $result = @mysqli_query($dbc, $query_insert);
        redirect_user('success_message.php');
    }
}
echo "<form action=\"send_message.php\" method=\"post\"><div class='container-fluid'>";
echo " <div id='msg-sender' class='form-row'><div class='form-group col-md-6'><label for='latitudine'> Latitudine  </label> <input class=\"form-control\" name='latitudine' step='0.00001' type='number'> </div>";
echo "<div class='form-group col-md-6'><label for='longitudine'> Longitudine  </label> <input class=\"form-control\" name='longitudine' step='0.00001' type='number'></div>";

echo "<div class='form-row'><div class='form-group col-md-3'><label for='velocita'>Velocità </label> <input class='form-control' name='velocita'  type='number' min='1'></div>";
echo "<div class='form-group col-md-3'><label for='direzione'>Direzione </label> <input class='form-control' name='direzione' type='number' step='0.001'></div>";

echo "<pre></pre>
<pre></pre>
<pre></pre>
<div class='form-group' id='notes'>
    <label for='messaggio' >Inserisci le note </label>
    <textarea type='text' row='4' class=\"form-control\"  name='note'></textarea>
</div>
";

echo "<input hidden value='$id_nave' type='text' name='id_nave_name'>";
echo "<input hidden value='$ora_partenza' type='text' name='ora_p'>";

echo '<input type="submit" id = "sub" name="submit" value="Invia" class="btn btn-primary">';

echo "</div></form></div>";

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

include_once ('html/footer.html');

