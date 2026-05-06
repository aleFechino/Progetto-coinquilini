<?php
session_start();
include('./conf/db_config.php');

// Controlla che l'utente sia loggato/registrato e che abbia un ID in sessione
if (!isset($_SESSION['login'])) {
    header("Location: ../registraAnagrafe.php");
    exit();
}

$id_utente = $_SESSION['id_utente'];

if (empty($_POST['valori'])) {
    header('Location: registraAbitudini.php');
    exit;
}

$abitudini = $_POST['valori'];
// Prepare insert statement
$stmt = $conn->prepare("INSERT INTO utente_abitudini(idutente, idAbitudine, valore) VALUES (?, ?, ?)");

try{
    foreach ($valori as $id_abitudine => $valore) {
        $id_abitudine = (int) $id_abitudine; 
        $valore       = (int) $valore;      
        $stmt->bind_param("iii", $id_utente, $id_abitudine, $valore);
        $stmt->execute();
    }
    $conn->commit();
    header("Location: ../home.php");
    exit();
}
catch (Exception $e) {
    $conn->rollback();
    header('Location: index.php?error=' . urlencode($e->getMessage()));
    echo "<script>
            alert('Errore nel salvataggio dei dati')
            window.location.href ='../registrazioneAbitudini'.php)
            </script>"
    exit;
} finally {
    $stmt->close();
    $conn->close();
}
?>