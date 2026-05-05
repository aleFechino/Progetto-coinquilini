<?php
include('./templates/header_riservata.php');
include

try {
    // Connessione al database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recupera tutte le case con coordinate valide e il nome del proprietario
    $stmt = $pdo->query("
        SELECT c.idCasa, c.via, c.civico, c.nPosti, c.nStanzeLetto, c.nBagni, c.metratura, c.descrizione, c.lat, c.lng,
               u.nomeUtente, u.cognomeUtente
        FROM casa c
        JOIN utenti u ON c.idProprietario = u.idUtente
        WHERE c.lat IS NOT NULL AND c.lng IS NOT NULL
    ");
    $case = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Errore DB: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Mappa Case</title>
    <!-- Foglio di stile Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- CSS personalizzato -->
    <link rel="stylesheet" href="style.css" />
</head>
<body>

<a href="offreCasa.php" class="btn-aggiungi">+ Aggiungi casa</a>

<div id="mappa"></div>

<!--CHAT-->
<!-- Libreria Leaflet -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Case recuperate dal database (passate da PHP a JS come JSON)
    var case_db = <?= json_encode($case) ?>;

    // Inizializza la mappa centrata sull'Italia con zoom adeguato
    var mappa = L.map('mappa').setView([41.9, 12.5], 6);

    // Tile layer OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(mappa);

    // Aggiunge un marker per ogni casa con popup informativo
    case_db.forEach(function(casa) {
        var marker = L.marker([parseFloat(casa.lat), parseFloat(casa.lng)]).addTo(mappa);
        marker.bindPopup(
            "<b>" + casa.via + " " + casa.civico + "</b><br>" +
            "👥 " + casa.nPosti + " posti | 📐 " + casa.metratura + "mq<br>" +
            "🛏 " + casa.nStanzeLetto + " stanze | 🚿 " + casa.nBagni + " bagni<br>" +
            "<small>" + casa.descrizione + "</small><br><br>" +
            "Proprietario: <b>" + casa.nomeUtente + " " + casa.cognomeUtente + "</b><br>" +
            "<a href='casa.php?id=" + casa.idCasa + "'>Vedi dettagli →</a>"
        );
    });
</script>

</body>
</html>