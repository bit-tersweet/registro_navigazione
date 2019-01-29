<?php

include_once("html/header.html");

echo '<title>Successo</title><h2> Messaggio inviato con successo!';

header("refresh:3; url=view_viaggi.php");

include_once ('html/footer.html');