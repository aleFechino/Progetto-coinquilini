<?php
session_start();
include('../conf/db_config.php');

$id_utenteVisto = $_GET['id'];


$stmt = $conn->prepare("INSERT INTO `utente_visto_utente`(`idUtente`, `idUtenteVisto`, `mi_piace`) VALUES ('?','?','?')");
$stmt->bind_param("sss",$_SESSION['id'], $id_utenteVisto, 1);
$stmt->execute();

?>