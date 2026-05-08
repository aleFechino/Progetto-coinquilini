<?php
include ('./templates/header.php');
include('./conf/db_config.php');

$stmt = $conn->prepare("SELECT idAbitudine, nomeAbitudine FROM abitudini");
$stmt->execute();
$result = $stmt->get_result();
$abitudini = $result->fetch_all(MYSQLI_ASSOC); // fetch ALL rows, not just one
?>

<div class="container mt-4">
    <h2 class="mb-4">Le tue abitudini</h2>
    <form method="POST" action="./php/registrazioneAb.php">
        <?php foreach ($abitudini as $abitudine): ?>
            <div class="row mb-3 align-items-center border-bottom pb-2">
                <div class="col-md-4">
                    <label class="fw-bold"><?= htmlspecialchars(str_replace('_', ' ', $abitudine['nomeAbitudine'])) ?></label>
                </div>
                <div class="col-md-8">
                    <div class="btn-group" role="group">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <input 
                                type="radio" 
                                class="btn-check" 
                                name="valori[<?= $abitudine['idAbitudine'] ?>]" 
                                id="ab_<?= $abitudine['idAbitudine'] ?>_<?= $i ?>" 
                                value="<?= $i ?>" 
                                required
                            >
                            <label class="btn btn-outline-primary" for="ab_<?= $abitudine['idAbitudine'] ?>_<?= $i ?>">
                                <?= $i ?>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg">Salva e Completa</button>
        </div>
    </form>
</div>

<?php include('./templates/footer.php'); ?>