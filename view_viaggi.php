<?php

require("connection_to_sql.php");
include("html/header.html");
include("html/css_includer.html");

echo '<title>Registro viaggi</title><h1> Registro di navigazione</h1>';
session_start();

$query = "SELECT id_nave as id, data_ora_partenza as data_partenza, porto_partenza as porto_partenza, data_ora_arrivo as data_arrivo, porto_arrivo as porto_arrivo, carico as carico FROM viaggio ORDER BY porto_partenza ASC";
$result = @mysqli_query($dbc, $query);

echo '<h4> Sono disponibili attualmente ' . mysqli_num_rows($result) . ' viaggi ';

echo '<table width ="80%" class="table">
<thead>
	<tr>
		<th scope="col" align="center"><strong>Codice viaggio</strong></th>
		<th scope="col" align="center"><strong>Ora partenza</strong></th>
		<th scope="col" align="center"><strong>Codice porto partenza</strong></th>
		<th scope="col" align="center"><strong>Ora arrivo</strong></th>
		<th scope="col" align="center"><strong>Codice porto arrivo</strong></th>
		<th scope="col" align="center"><strong>Carico nave</strong></th>
		<th scope="col" align="center"><strong>Registro personale</strong></th>';
        if(isset($_SESSION['matricola']) && !empty($_SESSION['matricola']))
		    echo '<th scope="col" align="center"><strong>Invia messaggio</strong></th>';
	echo '</tr>
</thead><tbody>';

$date = date('Y-m-d h:i:s ', time());

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo '<tr> 
            <th scope="row"><a href="ship_details.php?id=' . $row['id'] . '"> ' . $row['id'] . '</a></th>
            <th scope="row"><a> ' . $row['data_partenza'] . '</a></th>
            <th scope="row"><a> ' . $row['porto_partenza'] . '</a></th>
            <th scope="row"><a> ' . $row['data_arrivo'] . '</a></th>
            <th scope="row"><a> ' . $row['porto_arrivo'] . '</a></th>
            <th scope="row"><a> ' . $row['carico'] . '</a></th>
            <th scope="row"><a href="view_personale.php?id=' . $row['id'] . '&o=' . $row['data_partenza'] .'">Visualizza personale</a></th>';
    if($date < $row['data_partenza'] && isset($_SESSION['matricola']) && !empty($_SESSION['matricola']))
        echo '<th scope="row"><a href="send_message.php?id=' . $row['id'] . '&o=' . $row['data_partenza'] .'">Invia messaggio</a></th>';
echo '</tr>';

}

echo '</tbody></table>';

if(isset($_SESSION['matricola'])) {
        echo "<button type=\"button\" class=\"btn btn-secondary\">
            <a href='add_trip.php'>Aggiungi un viaggio</a>
        </button>";
}

include_once ('html/footer.html');