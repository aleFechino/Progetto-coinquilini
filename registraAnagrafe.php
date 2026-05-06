<?php 
include("./templates/header.php"); 
include("./conf/db_config.php"); //[cite: 20]
?>

<div class="registration-wrapper py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <!-- Progress Bar per indicare lo step attuale -->
                <div class="progress mb-4" style="height: 8px;">
                    <div class="progress-bar" role="progressbar" style="width: 25%; background: #fd267a;"></div>
                </div>
                
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-white border-0 pt-4 text-center">
                        <h2 class="fw-bold text-dark">Iniziamo!</h2>
                        <p class="text-muted">Raccontaci qualcosa di te per trovare il match perfetto.</p>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="./php/registrazioneAn.php">
                            
                            <!-- Sezione 1: Account -->
                            <h5 class="section-title mb-3">Dati Account</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="mail" class="form-label small fw-bold">E-mail</label>
                                    <input type="email" id="mail" name="mail" class="form-control" placeholder="nome@esempio.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="psw" class="form-label small fw-bold">Password</label>
                                    <input type="password" id="psw" name="psw" class="form-control" placeholder="••••••••" required>
                                </div>
                            </div>

                            <!-- Sezione 2: Anagrafica -->
                            <h5 class="section-title mb-3">Dati Personali</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label for="nome" class="form-label small fw-bold">Nome</label>
                                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Mario" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="cognome" class="form-label small fw-bold">Cognome</label>
                                    <input type="text" id="cognome" name="cognome" class="form-control" placeholder="Rossi" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="user" class="form-label small fw-bold">Soprannome</label>
                                    <input type="text" id="user" name="user" class="form-control" placeholder="mario92">
                                </div>
                                <div class="col-md-6">
                                    <label for="dataNascita" class="form-label small fw-bold">Data di Nascita</label>
                                    <input type="date" id="dataNascita" name="dataNascita" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="selezioneSesso" class="form-label small fw-bold">Sesso</label>
                                    <select id="selezioneSesso" name="sesso" class="form-select" required>
                                        <option value="" selected disabled>Scegli...</option>
                                        <option value="femmina">Femmina</option>
                                        <option value="maschio">Maschio</option>
                                        <option value="non specificato">Altro / Non specificato</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Sezione 3: Profilo e Ricerca -->
                            <h5 class="section-title mb-3">Preferenze e Contatti</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="ruolo" class="form-label small fw-bold">Cosa cerchi?</label>
                                    <select id="ruolo" name="ruolo" class="form-select" required>
                                        <option value="" selected disabled>Seleziona ruolo...</option>
                                        <option value="cerco">Cerco casa</option>
                                        <option value="offro">Offro casa</option>
                                        <option value="cerco-offro">Entrambi</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="luogoRicerca" class="form-label small fw-bold">Città di interesse</label>
                                    <select id="luogoRicerca" name="luogo_ricerca" class="form-select" required>
                                        <option value="" selected disabled>Scegli città...</option>
                                        <?php
                                        // Caricamento dinamico delle città dal DB[cite: 6]
                                        $stmt = $conn->query("SELECT idCitta, nomeCitta FROM citta ORDER BY nomeCitta ASC");
                                        while ($row = $stmt->fetch_assoc()) {
                                            echo "<option value=\"".htmlspecialchars($row['idCitta'])."\">".htmlspecialchars($row['nomeCitta'])."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="instagram" class="form-label small fw-bold">Instagram (opzionale)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">@</span>
                                        <input type="text" id="instagram" name="instagram" class="form-control border-start-0" placeholder="username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefono" class="form-label small fw-bold">Telefono</label>
                                    <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="+39...">
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-bold border-0" style="background: linear-gradient(90deg, #fd267a, #ff6036);">
                                    SALVA E CONTINUA <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p class="text-muted">Hai già un account? <a href="./index.php" class="text-decoration-none fw-bold" style="color: #fd267a;">Accedi qui</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("./templates/footer.php"); ?>