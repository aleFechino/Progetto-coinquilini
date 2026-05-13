<?php
include('../conf/db_config.php');
$idUtenteVisto=$_POST["idUtente"]

$stmt = $conn->prepare("INSERT TO utente_visto_utente(idUtente, idUtenteVisto,mi_piace) VALUES (?,?,?)");
?>