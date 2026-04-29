<?php
include ('./templates/header.php');
include('./conf/db_config.php');

    $stmt = $conn->prepare("SELECT abitudini.nomeAbitudine FROM abitudini");
    $stmt->execute(); 

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    print_r($row)

    
?>
    <?php
include('./templates/header.php');

$stmt = $conn->prepare("SELECT abitudini.nomeAbitudine FROM abitudini");
$stmt->execute();
$result = $stmt->get_result();
$abitudini = $result->fetch_all(MYSQLI_ASSOC); // fetch ALL rows, not just one
?>

<div class="abitudini-container">
    <h2>Le tue abitudini</h2>
    <form method="POST" action="salva_valori.php">
        <?php foreach ($abitudini as $abitudine): ?>
            <div class="abitudine-row">
                <label><?= htmlspecialchars($abitudine['nomeAbitudine']) ?></label>
                <div class="rating-buttons">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <label class="rating-option">
                            <input 
                                type="radio" 
                                name="valori[<?= htmlspecialchars($abitudine['nomeAbitudine']) ?>]" 
                                value="<?= $i ?>"
                            >
                            <span><?= $i ?></span>
                        </label>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit">Salva</button>
    </form>
</div>

<?php include('./templates/footer.php'); ?>