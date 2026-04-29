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
        $salt = "a2rewsqw1FDA2edSD";
        $pswcript = crypt($pwd, $salt);
        return $pswcript;
    }
?>
