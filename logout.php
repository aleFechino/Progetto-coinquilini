<?php
session_unset(); // Rimuove tutte le variabili di sessione
session_destroy(); // Distrugge la sessione sul server

// Rimanda l'utente alla home page
header("Location: index.php");
exit();
?>