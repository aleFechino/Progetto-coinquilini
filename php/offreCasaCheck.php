
<?php

include("../conf/db_config.php");

// Prendo il nome della città dal DB tramite l'id selezionato nel form
$idCitta = $_POST["citta"];
$res = $conn->query("SELECT nomeCitta FROM citta WHERE idCitta = $idCitta");
$riga = $res->fetch_assoc();
$nomeCitta = $riga['nomeCitta'];

// Funzione per ottenere le coordinate dall'indirizzo
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

// Calcolo le coordinate con i dati del form
$coordinate = getCoordinate($_POST["via"], $_POST["civico"], $_POST["cap"], $nomeCitta);
$lat = $coordinate ? $coordinate["lat"] : null;
$lng = $coordinate ? $coordinate["lng"] : null;

// Inserisco la casa nel DB con tutti i dati, lat e lng incluse
$stmt = $conn->prepare("INSERT INTO casa(idCitta, via, civico, cap, nPosti, nStanzeLetto, nBagni, metratura, descrizione, lat, lng) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $_POST["citta"], $_POST["via"], $_POST["civico"], $_POST["cap"], $_POST["nPosti"], $_POST["nStanzeLetto"], $_POST["nBagni"], $_POST["metratura"], $_POST["descrizione"], $lat, $lng);
$stmt->execute();

header("location: ../home.php");

$conn->close();

?>