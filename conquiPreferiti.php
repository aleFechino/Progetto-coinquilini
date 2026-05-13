<?php
include ('./templates/header_riservata.php');
include('./conf/db_config.php');

$stmt = $conn->prepare("SELECT * FROM utente_visto_utente WHERE idUtente=? AND mi_piace=TRUE");
$stmt->bind_param("s", $_SESSION["id"]);  
$stmt->execute();
$result = $stmt->get_result();
$preferiti = $result->fetch_all(MYSQLI_ASSOC);
?>
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">I tuoi conquilini preferiti</h2>
    </div>

    <?php if (count($preferiti) > 0): ?>
        <div class="row g-4 justify-content-center">
            <?php foreach($preferiti as $pref): ?>
                <div class="col-9 col-md-5 col-lg-3">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden h-100">
                        <!-- Profile Header Color -->
                        <div style="height: 80px; background: linear-gradient(90deg, #fd267a, #ff6036);"></div>
                        
                        <div class="card-body text-center position-relative">
                            <!-- Circular Profile Image -->
                            <img src="./immagini/user_neutro.png" 
                                 class="rounded-circle border border-4 border-white shadow-sm position-absolute start-50 translate-middle"
                                 style="width: 100px; height: 100px; top: 0;"
                                 alt="immagine profilo">
                            
                            <div class="mt-5 pt-3">
                                <h4 class="fw-bold mb-0">
                                    <?php echo htmlspecialchars($coinquilino['nomeUtente'] . " " . $coinquilino['cognomeUtente']); ?>
                                </h4>
                                <small class="text-muted d-block mb-3">@<?php echo htmlspecialchars($coinquilino['soprannome']); ?></small>
                                
                                <ul class="list-group list-group-flush text-start mb-3">
                                    <li class="list-group-item border-0 px-0">
                                        <i class="bi bi-mortarboard-fill me-2 text-primary"></i> 
                                        <?php echo htmlspecialchars($coinquilino['universita_lavoro']); ?>
                                    </li>
                                    <li class="list-group-item border-0 px-0">
                                        <i class="bi bi-translate me-2 text-primary"></i> 
                                        <?php echo htmlspecialchars($coinquilino['linguaParlata']); ?>
                                    </li>
                                    <li class="list-group-item border-0 px-0 text-truncate">
                                        <i class="bi bi-instagram me-2 text-danger"></i> 
                                        <?php echo htmlspecialchars($coinquilino['nickname_instagram']); ?>
                                    </li>
                                </ul>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-2 justify-content-center mt-4">
                                    <button class="btn btn-outline-secondary rounded-circle shadow-sm" style="width: 50px; height: 50px;">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                    <button class="btn btn-primary rounded-pill px-4 fw-bold border-0 shadow-sm flex-grow-1" 
                                            style="background: linear-gradient(90deg, #fd267a, #ff6036);">
                                        MI PIACE <i class="bi bi-heart-fill ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-person-x display-1 text-muted"></i>
            </div>
            <h3 class="text-muted">Non ci sono nuovi utenti in questa zona</h3>
            <a href="home.php" class="btn btn-primary rounded-pill px-5 mt-3 border-0" 
               style="background: linear-gradient(90deg, #fd267a, #ff6036);">Torna alla Home</a>
        </div>
    <?php endif; ?>
</div>

<?php include ('./templates/footer.php'); ?>