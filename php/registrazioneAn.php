<?php
$nome= $_POST["nome"]
$cognome= $_POST["cognome"]
$soprannome= $_POST["user"]
$mail= $_POST["mail"]
$pwdCript=criptPwd($_POST["psw"]);
$dataNascita= $_POST["dataNascita"]
$sesso= $_POST["sesso"]
$lingua= $_POST["lingua"]
$ruolo= $_POST["ruolo"]
$universitaLavoro= $_POST["universitaLavoro"]
$telefono= $_POST["telefono"]
$instagram= $_POST["instagram"]
$luogo_ricerca= $_POST["luogo_ricerca"]
$cercoCasa=FALSE
$offroCasa=FALSE

if($ruolo=="cerco"){
    $cercoCasa=TRUE
} elseif($ruolo=="offro"){
    $offroCasa=TRUE
} elseif($ruolo=="cerco-offro"){
    $cercoCasa=TRUE
    $offroCasa=TRUE
}

include("../conf/db_config.php");

$stmt = $conn->prepare("INSERT TO utenti(nomeUtente,cognomeUtente, sesso,universita_lavoro,cerca_casa,offre_casa,linguaParlata,dataNascita,mail,psw,cellulare,soprannome,nickname_instagram,luogo_ricerca) 
                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?)"); 
$stmt->bind_param("ssssssssssss",$nome, $cognome,$sesso,$universitaLavoro,$cercoCasa,$offroCasa,$lingua,$dataNascita,$mail,$pwdCript,$telefono, $soprannome,$instagram,$luogo_ricerca);  
$stmt->execute();

session_start();
$_SESSION['login']='attiva'; 
$_SESSION['id']=$row['idUutente'];
$_SESSION['nomeUtente'] = $row['nomeUtente'];
header("location: ../registraInteressi.php"); //reindirizza in un'altra pagina
?>