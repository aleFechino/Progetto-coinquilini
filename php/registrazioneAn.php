<?php
include("../conf/db_config.php");

// Recupero dati dal POST
$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$soprannome = $_POST["user"];
$mail = $_POST["mail"];

// CORREZIONE QUI: da criptPwd a cryptPwd
$pwdCript = cryptPwd($_POST["psw"]); 

$dataNascita = $_POST["dataNascita"];
$sesso = $_POST["sesso"];
$lingua = $_POST["lingua"];
$ruolo = $_POST["ruolo"];
$universitaLavoro = $_POST["universitaLavoro"];
$telefono = $_POST["telefono"];
$instagram = $_POST["instagram"];
$luogo_ricerca = $_POST["luogo_ricerca"];

$cercoCasa = 0; // In SQL BOOLEAN è 0 o 1
$offroCasa = 0;

if($ruolo == "cerco"){
    $cercoCasa = 1;
} elseif($ruolo == "offro"){
    $offroCasa = 1;
} elseif($ruolo == "cerco-offro"){
    $cercoCasa = 1;
    $offroCasa = 1;
}

// Preparazione Query (Assicurati che il numero di ? corrisponda ai parametri)
$stmt = $conn->prepare("INSERT INTO utenti (nomeUtente, cognomeUtente, sesso, universita_lavoro, cerca_casa, offre_casa, linguaParlata, dataNascita, mail, psw, cellulare, soprannome, nickname_instagram, luogo_ricerca) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 

// bind_param: "ssssiisssssssi" significa stringa o intero per ogni campo
$stmt->bind_param("ssssiisssssssi", 
    $nome, $cognome, $sesso, $universitaLavoro, $cercoCasa, $offroCasa, 
    $lingua, $dataNascita, $mail, $pwdCript, $telefono, $soprannome, 
    $instagram, $luogo_ricerca
);

if($stmt->execute()){
    session_start();
    $_SESSION['login'] = 'attiva';
    $_SESSION['id'] = $conn->insert_id; // Recupera l'ID appena creato nel DB
    header("Location: ../registraInteressi.php");
    exit();
} else {
    echo "Errore durante la registrazione: " . $stmt->error;
}

$conn->close();
?>