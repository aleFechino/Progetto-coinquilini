<?php
include ('./templates/header_riservata.php');
include('./conf/db_config.php');


    $stmt = $conn->prepare("
        SELECT u.idUtente, u.nomeUtente, u.cognomeUtente, u.sesso, u.universita_lavoro, u.linguaParlata, u.dataNascita, u.soprannome, u.cellulare, u.mail,u.nickname_instagram
        FROM utenti as u 
        WHERE u.cerca_casa = 1 AND u.idUtente = ?)
    ");
    
    $stmt->bind_param("s", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $coinquilini = $result->fetch_all(MYSQLI_ASSOC);

?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Il mio profilo</h2>
        <p class="text-muted">Gestisci le tue informazioni e preferenze</p>
    </div>

    
</div>

<?php include ('./templates/footer.php'); ?>