<?php
<<<<<<< HEAD
    include('./templates/header_riservata.php');
?>

<div>
    <form>
        <label for="Citta">Città</label><br>
        <input type="text" id="Citta" name="Citta" value=""><br>
        
        <label for="nStanzeLetto">Numero camere da letto</label><br>
        <input type="text" id="nStanzeLetto" name="nStanzeLetto" value=""><br>

        <label for="Citta">Numero bagni</label><br>
        <input type="text" id="Citta" name="Citta" value=""><br>

        <label for="Citta">Città</label><br>
        <input type="text" id="Citta" name="Citta" value=""><br>

        <label for="Citta">Città</label><br>
        <input type="text" id="Citta" name="Citta" value=""><br>

        <label for="Citta">Città</label><br>
        <input type="text" id="Citta" name="Citta" value=""><br>

        <label for="Citta">Città</label><br>
        <input type="text" id="Citta" name="Citta" value=""><br>

        <label for="Citta">Città</label><br>
        <input type="text" id="Citta" name="Citta" value=""><br>

        <input type="submit" value="Submit">
    </form>
</div>
=======
include('./templates/header_riservata.php');
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
>>>>>>> 4331ee42c0408e4d259426c96140301047eda799
