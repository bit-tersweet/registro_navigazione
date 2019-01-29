<?php

require_once ("html/header.html");
require_once ("html/css_includer.html");
require_once ("connection_to_sql.php");

$id_nave="";
if ( (isset($_GET['id']))) {
    $id_nave = $_GET['id'];
}

$query_nave = "SELECT nome, nazione, anno, lunghezza, stazza, potenza FROM nave where id_nave='$id_nave'";
$result_nave = @mysqli_query($dbc, $query_nave);

echo "
<h1>Specifiche " . $id_nave . "</h1><div class='container-fluid'>";

    echo '<table id="sd" class="table">
<thead>
	<tr>
		<th scope="col" align="center"><strong>Nome</strong></th>
		<th scope="col" align="center"><strong>Nazione</strong></th>
		<th scope="col" align="center"><strong>Anno</strong></th>
		<th scope="col" align="center"><strong>Lunghezza</strong></th>
		<th scope="col" align="center"><strong>Stazza</strong></th>
		<th scope="col" align="center"><strong>Potenza</strong></th>
</thead><tbody>';

while ($row = mysqli_fetch_array($result_nave, MYSQLI_ASSOC)) {
    echo '<tr> 
            <th scope="row"><a> ' . $row['nome'] . '</a></th>
            <th scope="row"><a> ' . $row['nazione'] . '</a></th>
            <th scope="row"><a> ' . $row['anno'] . '</a></th>
            <th scope="row"><a> ' . $row['lunghezza'] . '</a></th>
            <th scope="row"><a> ' . $row['stazza'] . '</a></th>
            <th scope="row"><a> ' . $row['potenza'] . '</a></th>';
}

echo '</tbody></table></div>';

include_once ('html/footer.html');