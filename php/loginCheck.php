<?php
session_start();
include("../conf/db_config.php");

$pwdCript=cryptPwd($_POST["password"]);


$stmt = $conn->prepare("SELECT * FROM utenti WHERE mail = ? AND psw = ?"); 
$stmt->bind_param("ss", $_POST['user'], $pwdCript);  
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc(); //restituisce un array, tipo dizionario python che ha come chiave il nome del campo del db e come valore il valore dell'attributo

if ($result->num_rows > 0) {
    $_SESSION['login'] = 'attiva';
    $_SESSION['id'] = $row['idUtente'];
    $_SESSION['luogo_ricerca'] = $row['luogo_ricerca'];
    $_SESSION['nomeUtente'] = $row['nomeUtente'];
    header("location: ../home.php");
    exit();
} else {
    header("location: ../index.php?error=1");
    exit();
}


$conn->close();

?>