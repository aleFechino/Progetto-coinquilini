<?php
include ('./templates/header_riservata.php');
include('./conf/db_config.php');


    $stmt = $conn->prepare("
        SELECT u.idUtente, u.nomeUtente, u.cognomeUtente, u.sesso, u.universita_lavoro, u.linguaParlata, u.dataNascita, u.soprannome, u.cellulare, u.mail,u.nickname_instagram
        FROM utenti as u 
        WHERE u.cerca_casa = 1 AND u.luogo_ricerca = ? AND u.idUtente NOT IN (SELECT utente_visto_utente.idUtenteVisto
                                                                      FROM utente_visto_utente
                                                                      WHERE utente_visto_utente.idUtente=?)
    ");
    
    $stmt->bind_param("ss",$_SESSION['luogo_ricerca'], $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $coinquilini = $result->fetch_all(MYSQLI_ASSOC);

?>

<h3>Ecco gli altri utenti che cercano cassa</h3>
<h2>Metti mi piace/nonmi piace</h2>
<?php //if (count($coinquilini) > 0)
{ ?>
    
    <div>
        <?php//foreach($coinquilini as $coinquilino)
        {
            echo    '<div class="card" style="width: 18rem;">
                        <img src="./immagini/user_neutro.png" 
                            class="card-img-top img-fluid w-25"
                            alt="immagine profilo">

                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">An item</li>
                            <li class="list-group-item">A second item</li>
                            <li class="list-group-item">A third item</li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>';
        }
        ?>
    </div>
<?php
}
//else
{
    echo "<h2>NON CI SONO NUOVI UTENTI: continua</h2>";
}