<?php
include("./templates/header.php");

include("../conf/db_config.php");
$stmt= $conn->prepare("SELECT nomeInteresse FROM interessi");
$stmt->execute();
$result= $stmt->get_result(); //prendo i risultati
$interessi=$result->fetch_all(MYSQLI_ASSOC);
?>

<div class="container">
  <?php foreach ($interessi as $interesse): ?>
    <div class="tag"><?php echo htmlspecialchars($interesse['nomeInteresse']); ?></div>
  <?php endforeach; ?>
</div>
    
<?php
include("./templates/footer.php");
?>