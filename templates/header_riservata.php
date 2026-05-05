<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>RooMatch</title>
</head>
<body>
    <?php
    session_start(); //apre o crea una sessione

    if(!isset($_SESSION["login"])){  //gestisce la sicurezza dell'area privata: se uno accede dall'url alla pagine senza la sessione attiva viene reindirizzato al login
        header("location: ./index.php");
        exit();
    }
    ?>
    <header>
            <div class="contenitore">
                <h1>RooMatch</h1>
                <nav>
                    <ul>
                        <li><a href="./home.php">Home</a></li>
                        <li><a href="./conquiPreferiti.php">Conquilini preferiti</a></li>
                        <li><a href="./cercaCasa.php">Cerca case</a></li>
                        <li><a href="./offreCasa.php">Offri casa</a></li>
                        <li><a href="./profiloUtente.php">Profilo</a></li>
                        <li><a href="./logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
    </header>


