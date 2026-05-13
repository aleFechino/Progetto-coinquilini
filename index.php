<?php
include('./templates/header_non_loggato.php');
require("./conf/db_config.php");

$result = $conn->query("
    SELECT c.idCasa, c.via, c.civico, c.nPosti, c.nStanzeLetto, c.nBagni, c.metratura, c.descrizione, c.lat, c.lng,
           u.nomeUtente, u.cognomeUtente
    FROM casa c
    LEFT JOIN utenti u ON c.idProprietario = u.idUtente
    WHERE c.lat IS NOT NULL AND c.lng IS NOT NULL
      AND c.lat != '' AND c.lng != ''
");

if (!$result) {
    die("Errore query: " . $conn->error);
}

$case = [];
while ($row = $result->fetch_assoc()) {
    $case[] = $row;
}

// Centro mappa fisso (Italia)
$mapLat  = 41.9;
$mapLng  = 12.5;
$mapZoom = 6;
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

#mappa {
    height: calc(100vh - 80px);
    width: 100%;
}

.btn-aggiungi {
    position: fixed;
    top: 16px;
    right: 16px;
    z-index: 1000;
    background: #d94f00;
    color: #fff;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
}
</style>

</head>
<body>

<div id="mappa"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var case_db = <?= json_encode($case) ?>;

// Mappa centrata su Italia
var mappa = L.map('mappa').setView([<?= $mapLat ?>, <?= $mapLng ?>], <?= $mapZoom ?>);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(mappa);

case_db.forEach(function(casa) {
    var lat = parseFloat(casa.lat);
    var lng = parseFloat(casa.lng);

    if (!isNaN(lat) && !isNaN(lng)) {
        var marker = L.marker([lat, lng]).addTo(mappa);

        marker.bindPopup(
            "<b>" + casa.via + " " + casa.civico + "</b><br>" +
            "👥 " + casa.nPosti + " posti | 📐 " + casa.metratura + " mq<br>" +
            "🛏 " + casa.nStanzeLetto + " stanze | 🚿 " + casa.nBagni + " bagni<br>" +
            "<small>" + casa.descrizione + "</small><br><br>" +
            "Proprietario: <b>" + casa.nomeUtente + " " + casa.cognomeUtente + "</b><br>" +
            "<a href='./login.php'>Vedi dettagli →</a>"
        );
    }
});
</script>

</body>
</html>