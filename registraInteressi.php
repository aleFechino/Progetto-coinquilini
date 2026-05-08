<?php
include("./templates/header.php");

include("./conf/db_config.php");
$stmt= $conn->prepare("SELECT idInteresse,nomeInteresse FROM interessi");
$stmt->execute();
$result= $stmt->get_result(); //prendo i risultati
$interessi=$result->fetch_all(MYSQLI_ASSOC);
?>

<div class="container mt-4">
  <form method="POST" action="./php/registrazioneI.php">
    <div class="d-flex flex-wrap gap-2">
      <?php foreach ($interessi as $interesse): ?>
        <input type="checkbox" class="btn-check" name="interessi[]" 
          id="interesse_<?php echo htmlspecialchars($interesse['idInteresse']); ?>"
          value="<?php echo htmlspecialchars($interesse['idInteresse']); ?>"
          autocomplete="off"
        >
        <label 
          class="btn btn-outline-primary" 
          for="interesse_<?php echo htmlspecialchars($interesse['idInteresse']); ?>"
        >
          <?php echo htmlspecialchars($interesse['nomeInteresse']); ?>
        </label>
      <?php endforeach; ?>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Continua →</button>
  </form>
</div>
    
<?php
include("./templates/footer.php");
?>