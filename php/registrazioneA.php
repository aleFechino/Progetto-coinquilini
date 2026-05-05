<?php
$nome= $_POST["nome"]
$pwdCript=criptPwd($_POST["psw"]);
.....


include("../conf/db_config.php");

$stmt = $conn->prepare("INSERT TO utenti() VALUES()"); 
$stmt->bind_param("ss", $_POST['user'], $pwdCript);  
$stmt->execute();

session_start();
session_start();
$_SESSION['login']='attiva'; 
$_SESSION['id']=$row['idUutente'];
$_SESSION['nomeUtente'] = $row['nomeUtente'];
header("location: ../registraInteressi.php"); //reindirizza in un'altra pagina
?>