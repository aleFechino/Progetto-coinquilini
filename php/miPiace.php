<?php
session_start();
include('../conf/db_config.php');

$id_utenteVisto = $_GET['id'];


$stmt = $conn->prepare("INSERT INTO `utente_visto_utente`(`idUtente`, `idUtenteVisto`, `mi_piace`) VALUES (?,?,1)");
$stmt->bind_param("ss",$_SESSION['id'], $id_utenteVisto);
$stmt->execute();

header("location: ../home.php");

?>