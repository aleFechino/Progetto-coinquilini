<?php
$host = "localhost";
$dbname = "db_coinquilini";
$user = "root";
$pass = "";

$messaggio = "";

function getCoordinate($via, $civico, $cap, $nomeCitta) {
    $indirizzo = urlencode("$via $civico, $cap $nomeCitta, Italia");
    $url = "https://nominatim.openstreetmap.org/search?q=$indirizzo&format=json&limit=1";
    $opts = ["http" => ["header" => "User-Agent: coinquilini-app/1.0"]];
    $context = stream_context_create($opts);
    $risposta = file_get_contents($url, false, $context);
    $dati = json_decode($risposta, true);
    if (!empty($dati)) {
        return ["lat" => $dati[0]["lat"], "lng" => $dati[0]["lon"]];
    }
    return null;
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $citta  = $pdo->query("SELECT * FROM citta")->fetchAll(PDO::FETCH_ASSOC);
    $utenti = $pdo->query("SELECT * FROM utenti WHERE offre_casa = TRUE")->fetchAll(PDO::FETCH_ASSOC);
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $via            = trim($_POST["via"]);
        $civico         = trim($_POST["civico"]);
        $cap            = trim($_POST["cap"]);
        $nPosti         = $_POST["nPosti"];
        $nStanzeLetto   = $_POST["nStanzeLetto"];
        $nBagni         = $_POST["nBagni"];
        $metratura      = $_POST["metratura"];
        $descrizione    = trim($_POST["descrizione"]);
        $idCitta        = $_POST["idCitta"];
        $idProprietario = $_POST["idProprietario"];

        $stmtCitta = $pdo->prepare("SELECT nomeCitta FROM citta WHERE idCitta = ?");
        $stmtCitta->execute([$idCitta]);
        $nomeCitta = $stmtCitta->fetchColumn();

        $coord = getCoordinate($via, $civico, $cap, $nomeCitta);
        $lat = $coord ? $coord["lat"] : null;
        $lng = $coord ? $coord["lng"] : null;

        $stmt = $pdo->prepare("
            INSERT INTO casa (nPosti, via, civico, cap, nStanzeLetto, nBagni, metratura, descrizione, idCitta, idProprietario, lat, lng)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$nPosti, $via, $civico, $cap, $nStanzeLetto, $nBagni, $metratura, $descrizione, $idCitta, $idProprietario, $lat, $lng]);

        // FIX DOUBLE INSERT: redirect immediato dopo il salvataggio
        $esito = $coord ? "ok" : "no_coord";
        header("Location: aggiungi_casa.php?esito=$esito");
        exit();
    }

} catch (PDOException $e) {
    die("Errore DB: " . $e->getMessage());
}

// Messaggio mostrato DOPO il redirect
if (isset($_GET["esito"])) {
    if ($_GET["esito"] === "ok") {
        $messaggio = "✅ Casa aggiunta con successo!";
    } else {
        $messaggio = "⚠️ Casa aggiunta, ma le coordinate non sono state trovate. Controlla l'indirizzo.";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Casa</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; padding: 0 20px; }
        h1 { margin-bottom: 24px; }
        label { display: block; margin-top: 14px; font-weight: bold; font-size: 0.9rem; }
        input, select, textarea {
            width: 100%; padding: 9px 12px; margin-top: 4px;
            border: 1px solid #ccc; border-radius: 6px; font-size: 0.95rem;
        }
        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .row3 { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 12px; }
        button {
            margin-top: 24px; width: 100%; padding: 12px;
            background: #1a1a1a; color: #fff; border: none;
            border-radius: 8px; font-size: 1rem; cursor: pointer;
        }
        button:hover { background: #d94f00; }
        .messaggio {
            margin-bottom: 16px; padding: 12px 16px;
            background: #f0fff0; border: 1px solid #4caf50;
            border-radius: 8px; font-size: 0.9rem;
        }
        .messaggio.warn { background: #fffbe6; border-color: #ffc107; }
        a { display: inline-block; margin-top: 16px; color: #1a1a1a; font-size: 0.9rem; }
    </style>
</head>
<body>

<h1>🏠 Aggiungi una casa</h1>

<?php if ($messaggio): ?>
    <div class="messaggio <?= str_contains($messaggio, '⚠️') ? 'warn' : '' ?>">
        <?= htmlspecialchars($messaggio) ?>
    </div>
<?php endif; ?>

<form method="POST">

    <div class="row3">
        <div>
            <label>Via</label>
            <input type="text" name="via" placeholder="Via Po" required>
        </div>
        <div>
            <label>Civico</label>
            <input type="text" name="civico" placeholder="12" required>
        </div>
        <div>
            <label>CAP</label>
            <input type="text" name="cap" placeholder="10124" maxlength="5" required>
        </div>
    </div>

    <div class="row">
        <div>
            <label>N° Posti</label>
            <input type="number" name="nPosti" min="1" required>
        </div>
        <div>
            <label>N° Stanze da letto</label>
            <input type="number" name="nStanzeLetto" min="1" required>
        </div>
    </div>

    <div class="row">
        <div>
            <label>N° Bagni</label>
            <input type="number" name="nBagni" min="1" required>
        </div>
        <div>
            <label>Metratura (mq)</label>
            <input type="number" name="metratura" min="1" required>
        </div>
    </div>

    <label>Città</label>
    <select name="idCitta" required>
        <?php foreach ($citta as $c): ?>
            <option value="<?= $c['idCitta'] ?>"><?= htmlspecialchars($c['nomeCitta']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Proprietario</label>
    <select name="idProprietario" required>
        <?php foreach ($utenti as $u): ?>
            <option value="<?= $u['idUtente'] ?>"><?= htmlspecialchars($u['nomeUtente'] . ' ' . $u['cognomeUtente']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Descrizione</label>
    <textarea name="descrizione" rows="3" placeholder="Descrivi la casa..."></textarea>

    <button type="submit">Aggiungi casa</button>
</form>

<a href="./mappa.php">← Torna alla mappa</a>

</body>
</html>