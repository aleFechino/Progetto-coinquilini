<?php
session_start();
include("../conf/db_config.php");

// Controlla che l'utente sia loggato/registrato e che abbia un ID in sessione
if (!isset($_SESSION['id'])) {
    header("Location: ../registraAnagrafe.php");
    exit();
}

$id_utente = $_SESSION['id'];
$interessi = $_POST['interessi'] ?? []; // Usa un array vuoto se non è stato inviato nulla

// Controlla che almeno un interesse sia stato selezionato
if (empty($_POST['interessi'])) {
    header("Location: ../registraInteressi.php?errore=vuoto");
    exit();
}

//$interessi = $_POST['interessi'];

// Inserisce ogni interesse selezionato nella tabella di collegamento
// (assumendo una tabella utente_interessi con colonne id_utente e nomeInteresse)
//$stmt = $conn->prepare("INSERT INTO utente_interessi (id_utente, idInteresse) VALUES (?, ?)");

try {
    $stmt = $conn->prepare("INSERT INTO utente_interessi (idUtente, idInteresse) VALUES (?, ?)");

    foreach ($interessi as $id_interesse) {
        $stmt->bind_param("ii", $id_utente, $id_interesse);
        $stmt->execute();
    }
    //$conn->commit();
    header("Location: ../registraPersonalita.php");
    exit();
} catch (Exception $e) {
    echo "Errore tecnico: " . $e->getMessage();
    //$conn->rollback();

    /*echo "<script> 
        alert('Errore nel salvataggio dei dati');
        window.location.href='../registraInteressi.php'
        </script>";*/
}
?>