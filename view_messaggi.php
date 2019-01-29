<?php

require("connection_to_sql.php");
include("html/header.html");
include("html/css_includer.html");

echo '<title>Registro messaggi</title>';
$q_msg = "select data_ora, id_nave, data_ora_partenza, lat, lng, velocità, direzione, note from messaggio";
$res = @mysqli_query($dbc, $q_msg);

echo '<h1>Registro dei messaggi</h1>';

echo '<div class="container-fluid"><table width ="80%" class="table">
<thead>
	<tr>
		<th scope="col" align="center"><strong>Data invio </strong></th>
		<th scope="col" align="center"><strong>Nave</strong></th>
		<th scope="col" align="center"><strong>Data partenza</strong></th>
		<th scope="col" align="center"><strong>Latitudine</strong></th>
		<th scope="col" align="center"><strong>Longitudine</strong></th>
		<th scope="col" align="center"><strong>Velocità</strong></th>
        <th scope="col" align="center"><strong>Direzione</strong></th>
        <th scope="col" align="center"><strong>Note</strong></th>
</thead><tbody>';

while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    echo '<tr> 
    <th scope="row"><a> ' . $row['data_ora'] . '</a></th>
    <th scope="row"><a href="ship_details.php?id=' . $row['id_nave'] .'"> ' . $row['id_nave'] . '</a></th>
    <th scope="row"><a> ' . $row['data_ora_partenza'] . '</a></th>
    <th scope="row"><a> ' . $row['lat'] . '</a></th>
    <th scope="row"><a> ' . $row['lng'] . '</a></th>
    <th scope="row"><a> ' . $row['velocità'] . '</a></th>
    <th scope="row"><a> ' . $row['direzione'] . '</a></th>
    <th scope="row"><a> ' . $row['note'] . '</a></th>';

}
echo '</div>';

include_once ('html/footer.html');