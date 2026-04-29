<?php
include("./templates/header.php");

include("./conf/db_config.php");
$stmt= $conn->prepare("SELECT nomePersonalita FROM personalita");
$stmt->execute();
$result= $stmt->get_result(); //prendo i risultati
$prsonalita=$result->fetch_all(MYSQLI_ASSOC);
?>

<div class="container mt-4">
  <form method="POST" action="registrazioneInteressi.php">
    <div class="d-flex flex-wrap gap-2">
      <?php foreach ($personalita as $pers): ?>
        <input type="checkbox" class="btn-check" name="interessi[]" 
          id="interesse_<?php echo htmlspecialchars($personalita['nomeInteresse']); ?>"
          value="<?php echo htmlspecialchars($personalita['nomeInteresse']); ?>"
          autocomplete="off"
        >
        <label 
          class="btn btn-outline-primary" 
          for="interesse_<?php echo htmlspecialchars($personalita['nomeInteresse']); ?>"
        >
          <?php echo htmlspecialchars($personalita['nomeInteresse']); ?>
        </label>
      <?php endforeach; ?>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Continua →</button>
  </form>
</div>
    
<?php
include("./templates/footer.php");
?>