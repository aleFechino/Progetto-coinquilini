<?php

include("../conf/db_config.php");

$pwdCript=cryptPwd($_POST["password"]);


$stmt = $conn->prepare("SELECT * FROM utenti WHERE mail = ? AND psw = ?"); 
$stmt->bind_param("ss", $_POST['user'], $pwdCript);  
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc(); //restituisce un array, tipo dizionario python che ha come chiave il nome del campo del db e come valore il valore dell'attributo

if($result->num_rows>0)
{
    session_start();
    $_SESSION['login']='attiva'; 
    $_SESSION['id']=$row['idUutente'];
    $_SESSION['nomeUtente'] = $row['nomeUtente'];
    header("location: ../home.php"); //reindirizza in un'altra pagina
}
else
{
    include('../templates/header.php');
    ?>
    <section>
    <div class="login-container">
        <h1>LOGIN</h1>
        <h3>Password o utente sbagliati</h3>

        <?php include ('./templates/header.php'); ?>    
        
        <div class="register-link">
            Don't have an account? <a href="./registraAnagrafe.php">Sign up</a>
        </div>
    </div>
    </section>
    <?php
}


$conn->close();

?>