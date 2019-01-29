<?php
include("html/header.html");
require_once ("connection_to_sql.php");


echo "<title>Aggiungi viaggio</title>
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">
    <style> pre{ background-color: transparent; border-color: transparent}
    </style>
    <title> Registra un viaggio </title>";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $errors = [];

    if (empty($_POST['trip-start'])) {
        $errors[] = 'Non hai inserito la data di partenza.';
    } else {
        $ts = mysqli_real_escape_string($dbc, trim($_POST['trip-start']));
    }

    if (empty($_POST['trip-back'])) {
        $errors[] = 'Non hai inserito la data di arrivo.';
    } else {
        $tb = mysqli_real_escape_string($dbc, trim($_POST['trip-back']));
    }

    if (empty($_POST['id'])) {
        $errors[] = 'Non hai inserito il codice della nave.';
    } else {
        $id_nave_inserito = mysqli_real_escape_string($dbc, trim($_POST['id']));
    }

    if (empty($_POST['trip-back'])) {
        $errors[] = 'Non hai inserito la data di arrivo.';
    } else {
        $tb = mysqli_real_escape_string($dbc, trim($_POST['trip-back']));
    }


    if (empty($_POST['porto-partenza'])) {
        $errors[] = 'Non hai inserito il porto di partenza.';
    } else {
        $pp = mysqli_real_escape_string($dbc, trim($_POST['porto-partenza']));
    }

    if (empty($_POST['porto-ritorno'])) {
        $errors[] = 'Non hai inserito il porto di ritorno.';
    } else {
        $pt = mysqli_real_escape_string($dbc, trim($_POST['porto-ritorno']));
    }

    if (empty($_POST['carico'])) {
        $errors[] = 'Non hai inserito il carico.';
    } else {
        $c = mysqli_real_escape_string($dbc, trim($_POST['carico']));
    }

    if ($_POST['trip-start'] < $_POST['trip-back']){
        $errors[] = 'La data di partenza non può essere dopo di quella di arrivo!';
    }

    $now = date('Y-m-d h:i:s', time());
    if($_POST['trip-start'] < $now){
        $errors[] = 'Il viaggio non può essere già passato!';
    }

    if(empty($errors))
        $q = "insert into viaggio(id_nave, data_ora_partenza,porto_partenza, data_ora_arrivo, porto_arrivo ,carico) values ('$id_nave_inserito', '$ts', '$pp', '$tb', '$pt', $c)";
    else
        echo $errors;

    $runner = @mysqli_query($dbc, $q);

    if($runner){
        echo '<div class="container-fluid"><h1>Hai registrato un nuovo viaggio! </h1></div>';
    }
    else {

        echo '<div class="container-fluid"><h2>Ci spiace per l\'inconveniente. Si è verificato un\'errore interno.</h2></div>';

    }
} else {
    $queryitem = "select distinct id_nave as id from viaggio";
    $queryexe = @mysqli_query($dbc, $queryitem);

    $queryitem_porto = "select distinct id_porto as id from porto";
    $queryexe_porto = @mysqli_query($dbc, $queryitem_porto);

    echo "<div class='container-fluid'>";

    echo "<h1>Registra un viaggio</h1> ";


    echo "<form action=\"add_trip.php\" method=\"post\">";

    echo "<div id='add-trip-container' >";

    //////////////////////data e ora di ANDATA
    echo "<label class='col-md-4'  for=\"trip-start\">Data e ora partenza: </label>
        <input type=\"datetime-local\" class='col-md-4' id='my_i' name='trip-start'>";

    echo '<pre></pre>';


    //////////////////////data e ora di RITORNO
    echo "<label class='col-md-4'  for=\"trip-back\">Data e ora arrivo: </label>
        <input type=\"datetime-local\" class='col-md-4'  id='my_i2' name='trip-back'>";

    echo '<pre></pre>';

    ///////////////////////////CODICE NAVE

    echo "<select id='id-nave-add' class='form-control'> <option> Seleziona il codice della nave</option>";

    while ($r = mysqli_fetch_array($queryexe))
         echo "<option value='$r[id]'>$r[id]</option>";

    echo "</select> <pre></pre>";

    //////////////////////CODICE PORTO PARTENZA
    echo "<select name='porto-partenza' id='id-portop-add' class='form-control'>";
    echo "<option>Seleziona il codice del porto di partenza</option>";

    while ($r1 = mysqli_fetch_array($queryexe_porto))
        echo "<option value='$r1[id]'>$r1[id]</option>";

    echo "</select> <pre></pre>";

    $queryexe_porto = @mysqli_query($dbc, $queryitem_porto);
//////////////////////CODICE PORTO ARRIVO
    echo "<select name='porto-ritorno' id='id-portoa-add'  class='form-control'>";
    echo "<option>Seleziona il codice del porto di arrivo</option>";

    while ($r2 = mysqli_fetch_array($queryexe_porto))
        echo "<option value='$r2[id]'>$r2[id]</option>";

    echo "</select> <pre></pre>";

    echo "<div id='aligner'>";
    echo "<input placeholder='Inserisci il carico della nave' class='form-control' id='carico' name='carico' min='100' type='number'>";

    echo '<input type="submit" name="submit" id="sub" value="Registra" class="btn btn-primary">';

    echo '</div>';
    echo "</div>";
    echo "</form>";

    echo "</div>";

}

include_once ('html/footer.html');




