<?php
session_start();
include("./conf/db_config.php");

// Controlla che l'utente sia loggato/registrato e che abbia un ID in sessione
if (!isset($_SESSION['login'])) {
    header("Location: ../registraAnagrafe.php");
    exit();
}

$id_utente = $_SESSION['id_utente'];

// Controlla che almeno un interesse sia stato selezionato
if (empty($_POST['interessi'])) {
    header("Location: ../registraInteressi.php?errore=nessun_interesse");
    exit();
}

$interessi = $_POST['interessi'];

// Inserisce ogni interesse selezionato nella tabella di collegamento
// (assumendo una tabella utente_interessi con colonne id_utente e nomeInteresse)
$stmt = $conn->prepare("INSERT INTO utente_interessi (id_utente, nomeInteresse) VALUES (?, ?)");

try {
    foreach ($interessi as $interesse) {
        $stmt->bind_param("is", $id_utente, $interesse);
        $stmt->execute();
    }
    $conn->commit();
    header("Location: ../prossimaPagina.php");
    exit();
} catch (Exception $e) {
    $conn->rollback();
    header("Location: ../registrazioneInteressi.php?errore=db");
    exit();
}
?>