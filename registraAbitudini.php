<?php
include ('./templates/header.php');
include('./conf/db_config.php');

$stmt = $conn->prepare("SELECT idAbitudine, nomeAbitudine FROM abitudini");
$stmt->execute();
$result = $stmt->get_result();
$abitudini = $result->fetch_all(MYSQLI_ASSOC); // fetch ALL rows, not just one
?>

<div class="registration-wrapper py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <!-- Progress Bar per indicare lo step attuale 
                <div class="progress mb-4" style="height: 8px;">
                    <div class="progress-bar" role="progressbar" style="width: 25%; background: #fd267a;"></div>
                </div>-->
                
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="container mt-4 pb-4">
                        <h2 class="mb-4">Le tue abitudini</h2>
                        <p>1=niente, 2=poco, 3=medio, 4=abbastanza, 5=molto</p>
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
                                                <label class="btn btn-custom" for="ab_<?= $abitudine['idAbitudine'] ?>_<?= $i ?>">
                                                    <?= $i ?>
                                                </label>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-bold border-0" style="background: linear-gradient(90deg, #fd267a, #ff6036);">
                                Salva e Completa</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>





<?php include('./templates/footer.php'); ?>