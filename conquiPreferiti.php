<?php
include ('./templates/header_riservata.php');
include('./conf/db_config.php');

$stmt = $conn->prepare("SELECT * FROM utente_visto_utente WHERE idUtente=? AND mi_piace=TRUE");
$stmt->execute();
$result = $stmt->get_result();
$abitudini = $result->fetch_all(MYSQLI_ASSOC);
?>