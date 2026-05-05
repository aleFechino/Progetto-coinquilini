<?php
    $servername = "localhost"; //ip server
    $username = "root"; //username per il database, amministratore 
    $password = ""; //password per il database
    $dbname = "db_coinquilini";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection nash
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    function cryptPwd($pwd){
        $salt="1234567890987654321";        //il sale deve essere sempre lo stesso. Quando inserisco e quando controllo
        $pswcript = crypt($pwd, $salt);
        return $pswcript;
    }
?>
