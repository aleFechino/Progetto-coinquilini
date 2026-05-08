<?php
session_start();
include("../conf/db_config.php");

// Controlla che l'utente sia loggato/registrato e che abbia un ID in sessione
if (!isset($_SESSION['login'])) {
    header("Location: ../registraAnagrafe.php");
    exit();
}

$id_utente = $_SESSION['id'];

// Controlla che almeno un interesse sia stato selezionato
if (empty($_POST['personalita'])) {
    header("Location: ../registraPersonalita.php?errore=nessuna_personalita");
    exit();
}

$personalita = $_POST['personalita'];

// Inserisce ogni interesse selezionato nella tabella di collegamento
$stmt = $conn->prepare("INSERT INTO utente_personalita (idUtente, idPersonalita) VALUES (?, ?)");

try {
    foreach ($personalita as $id_pers) {
        $stmt->bind_param("ii", $id_utente, $id_pers);
        $stmt->execute();
    }
    //$conn->commit();
    header("Location: ../registraAbitudini.php");
    exit();
} catch (Exception $e) {
    //$conn->rollback();

    echo "<script> 
        alert('Errore nel salvataggio dei dati');
        window.location.href='../registraPersonalita.php'
        </script>";

    exit();
}
?>