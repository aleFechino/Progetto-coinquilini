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


// query per prendere le città dal DB per poi metterle nel form
$risultato = $conn->query("SELECT idCitta, nomeCitta FROM citta ORDER BY nomeCitta ASC");

?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header Section -->
            <div class="text-center mb-4">
                <h2 class="fw-bold">Aggiungi la tua Casa</h2>
                <p class="text-muted">Inserisci i dettagli dell'immobile per trovare il coinquilino ideale.</p>
            </div>

            <!-- Form Card -->
            <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">
                <form method="POST" action="./php/offreCasaCheck.php">
                    
                    <!-- Città e Via -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="citta" class="form-label fw-semibold">Città</label>
                            <select id="citta" name="citta" class="form-select rounded-pill border-2" required>
                                <option value="">-- Seleziona una città --</option>
                                <?php while ($riga = $risultato->fetch_assoc()): ?>
                                    <option value="<?= $riga['idCitta'] ?>"><?= htmlspecialchars($riga['nomeCitta']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="via" class="form-label fw-semibold">Via / Indirizzo</label>
                            <input type="text" id="via" name="via" class="form-control rounded-pill border-2" placeholder="Es. Via Roma" required>
                        </div>
                    </div>

                    <!-- Civico, CAP e Posti Letto -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="civico" class="form-label fw-semibold">Civico</label>
                            <input type="text" id="civico" name="civico" class="form-control rounded-pill border-2" placeholder="12/A">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cap" class="form-label fw-semibold">CAP</label>
                            <input type="text" id="cap" name="cap" class="form-control rounded-pill border-2" placeholder="40100">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nPosti" class="form-label fw-semibold">Posti Letto</label>
                            <input type="number" id="nPosti" name="nPosti" class="form-control rounded-pill border-2" min="1">
                        </div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <!-- Dettagli Tecnici -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nStanzeLetto" class="form-label fw-semibold">Camere</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 rounded-start-pill"><i class="bi bi-houses"></i></span>
                                <input type="number" id="nStanzeLetto" name="nStanzeLetto" class="form-control border-start-0 rounded-end-pill" placeholder="N.">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nBagni" class="form-label fw-semibold">Bagni</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 rounded-start-pill"><i class="bi bi-droplet"></i></span>
                                <input type="number" id="nBagni" name="nBagni" class="form-control border-start-0 rounded-end-pill" placeholder="N.">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="metratura" class="form-label fw-semibold">Metratura (mq)</label>
                            <input type="text" id="metratura" name="metratura" class="form-control rounded-pill border-2" placeholder="Es. 85">
                        </div>
                    </div>

                    <!-- Descrizione -->
                    <div class="mb-4">
                        <label for="descrizione" class="form-label fw-semibold">Descrizione</label>
                        <textarea id="descrizione" name="descrizione" class="form-control border-2" rows="4" style="border-radius: 15px;" placeholder="Raccontaci qualcosa della casa..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-bold border-0" 
                                style="background: linear-gradient(90deg, #fd267a, #ff6036);">
                            PUBBLICA ANNUNCIO <i class="bi bi-house-add ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('./templates/footer.php'); ?>