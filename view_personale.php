<?php

require_once ("html/header.html");
require_once ("html/css_includer.html");

require_once ("connection_to_sql.php");


$id_nave="";
$ora_partenza="";
if ( (isset($_GET['id']))) {
    $id_nave = $_GET['id'];
}
if ( (isset($_GET['o']))) {
    $ora_partenza = $_GET['o'];
}

$query_personale = "SELECT matricola, ruolo FROM personale_viaggio where id_nave='$id_nave' and data_ora_partenza='$ora_partenza' ";
$result_personale = @mysqli_query($dbc, $query_personale);

if(mysqli_num_rows($result_personale) != 0) { // se la nave ha un'equipaggio
    echo '<h1>Equipaggio della nave <a href="ship_details.php?id=' . $id_nave . '">';
    echo $id_nave;
    echo '</a></h1><div class="container-fluid">';

    echo '<table class="table">
<thead>
	<tr>
		<th scope="col" align="center"><strong>Matricola</strong></th>
		<th scope="col" align="center"><strong>Ruolo</strong></th>
</thead><tbody>';


    while ($row = mysqli_fetch_array($result_personale, MYSQLI_ASSOC)) {
        echo '<tr> 
            <th scope="row"><a> ' . $row['matricola'] . '</a></th>
            <th scope="row"><a> ' . $row['ruolo'] . '</a></th>';
    }

    echo '</tbody></table></div>';
}else{
    echo '<h1> Non c\'è nessun equipaggio per la nave ' . $id_nave . ' </h1>';
}

include_once ('html/footer.html');