<?php include("./templates/header.php"); ?>

<section>
  <form method="POST" action="./php/registrazioneA.php">

    <!-- Dati personali -->
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" placeholder="Mario" required>

    <label for="cognome">Cognome:</label>
    <input type="text" id="cognome" name="cognome" placeholder="Rossi" required>

    <label for="user">Soprannome:</label>
    <input type="text" id="user" name="user" placeholder="mario92">

    <label for="mail">E-mail:</label>
    <input type="email" id="mail" name="mail" placeholder="nome.cognome@gmail.com" required>

    <label for="psw">Password:</label>
    <input type="password" id="psw" name="psw" placeholder="••••••••" required>

    <label for="dataNascita">Data di nascita:</label>
    <input type="date" id="dataNascita" name="dataNascita" required>

    <!-- ✅ name aggiunto ai select -->
    <label for="selezioneSesso">Sesso:</label>
    <select id="selezioneSesso" name="sesso" required>
      <option value="">— seleziona —</option>
      <option value="femmina">Femmina</option>
      <option value="maschio">Maschio</option>
      <option value="non specificato">Preferisco non specificarlo</option>
    </select>

    <label for="selezioneLingua">Lingua parlata:</label>
    <select id="selezioneLingua" name="lingua" required>
      <option value="">— seleziona —</option>
      <option value="italiano">Italiano</option>
      <option value="inglese">Inglese</option>
      <option value="francese">Francese</option>
      <option value="spagnolo">Spagnolo</option>
    </select>

    <label for="ruolo">Ruolo:</label>
    <select id="ruolo" name="ruolo" required>
      <option value="">— seleziona —</option>
      <option value="cerco">Cerco casa</option>
      <option value="offro">Offro casa</option>
      <option value="cerco-offro">Cerco e offro casa</option>
    </select>

    <!-- ✅ Città caricate dal DB -->
    <label for="luogoRicerca">Dove cerchi il coinquilino:</label>
    <select id="luogoRicerca" name="luogo_ricerca" required>
      <option value="">— seleziona città —</option>
      <?php
        // Includi qui la tua connessione al DB
        include("./php/db.php");

        $stmt = $pdo->query("SELECT id, nome FROM citta ORDER BY nome ASC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $id   = htmlspecialchars($row['id']);
          $nome = htmlspecialchars($row['nome']);
          echo "<option value=\"$id\">$nome</option>";
        }
      ?>
    </select>

    <label for="universitaLavoro">Università o lavoro:</label>
    <input type="text" id="universitaLavoro" name="universitaLavoro" required>

    <label for="telefono">Numero di telefono:</label>
    <input type="tel" id="telefono" name="telefono">

    <label for="instagram">Nickname Instagram:</label>
    <input type="text" id="instagram" name="instagram">

    <input type="submit" value="Salva e continua">
  </form>
</section>

<?php include("./templates/footer.php"); ?>