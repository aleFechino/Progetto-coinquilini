<?php
include('./conf/db_config.php');
include('./templates/header_riservata.php');

//FUNZIONE PER TROVARE LE COORDINATE SULLA MAPPA
function getCoordinate($via, $civico, $cap, $nomeCitta) {
    $indirizzo = urlencode("$via $civico, $cap $nomeCitta, Italia");
    $url = "https://nominatim.openstreetmap.org/search?q=$indirizzo&format=json&limit=1";
    $opts = ["http" => ["header" => "User-Agent: coinquilini-app/1.0"]];
    $context = stream_context_create($opts);
    $risposta = file_get_contents($url, false, $context);
    $dati = json_decode($risposta, true);
    if (!empty($dati)) {
        return ["lat" => $dati[0]["lat"], "lng" => $dati[0]["lon"]];
    }
    return null;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offri casa</title>
</head>
<body>
    <h1>AGGIUNGI LA CASA</h1>

</body>

<section>
    <form method="POST" action="./php/aggiungiCasaCheck.php" class="form">

        <label for="citta">citta</label><br>
        <input type="text" id="citta" name="citta" value=""><br>

        <label for="via">via</label><br>
        <input type="text" id="via" name="via" value=""><br>

        <label for="civico">civico</label><br>
        <input type="text" id="civico" name="civico" value=""><br>

        <label for="cap">cap</label><br>
        <input type="text" id="cap" name="cap" value=""><br>

        <label for="nPosti">nPosti</label><br>
        <input type="text" id="nPosti" name="nPosti" value=""><br>

        <label for="nStanzeLetto">nStanzeLetto</label><br>
        <input type="text" id="nStanzeLetto" name="nStanzeLetto" value=""><br>

        <label for="nBagni">nBagni</label><br>
        <input type="text" id="nBagni" name="nBagni" value=""><br>

        <label for="metratura">metratura</label><br>
        <input type="text" id="metratura" name="metratura" value=""><br>

        <label for="descrizione">descrizione</label><br>
        <input type="text" id="descrizione" name="descrizione" value=""><br>

        <input type="submit" value="aggiungiCasa">

</html>


