<?php
include("./templates/header.php");
?>

    <section>
        <form method="POST" action="./php/registrazione.php">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" placeholder="nome" required><br>

            <label for="cognome">Cognome:</label><br>
            <input type="text" id="cognome" name="cognome" placeholder="cognome" required><br><br>

            <label for="user">Soprannome:</label><br>
            <input type="text" id="user" name="user" placeholder="user"><br>

            <label for="mail">E-mail:</label><br>
            <input type="text" id="mail" name="mail" placeholder="nome.cognome@gmail.com" required><br>

            <label for="psw">Password:</label><br>
            <input type="password" id="psw" name="psw" placeholder="password" required><br>

            <label for="dataNascita">Data nascita:</label><br>
            <input type="date" id="dataNascita" name="dataNascita" required><br><br>

            <label for="sesso">Sesso:</label><br>
            <select id="selezioneSesso" required>
                <option value="femmina">Femmina</option>
                <option value="maschio">Maschio</option>
                <option value="Non specificato">Preferisco non specificarlo</option>
            </select>

            <label for="lingua">Lingua parlata:</label><br>
            <select id="selezioneLingua" required>
                <option value="italiano">Italiano</option>
                <option value="inglese">Inglese</option>
                <option value="francese">Francese</option>
                <option value="spagnolo">Spagnolo</option>
            </select>

            <label for="ruolo">Ruolo:</label><br>
            <select id="ruolo" required>
                <option value="cerco">Cerco casa</option>
                <option value="offro">Offro casa</option>
                <option value="cerco-offro">Cerco e offro casa</option>
            </select>

            <label for="universitaLavoro">Università o lavoro:</label><br>
            <input type="text" id="universitaLavoro" name="universitaLavoro" required><br><br>

            <label for="telefono">Numero di telefono:</label><br>
            <input type="text" id="telefono" name="telefono"><br>


            <label for="instagram">Nickname instagram</label><br>
            <input type="text" id="instagram" name="instagram"><br><br>


            <a href="./registraInteressi.php"><button type="button">Avanti</button></a>
        </form>
    </section>

<?php
include("./templates/footer.php");
?>