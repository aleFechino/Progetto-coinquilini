<?php
include("./templates/header.php");

include("./conf/db_config.php");
$stmt= $conn->prepare("SELECT idPersonalita, nomePersonalita FROM personalita");
$stmt->execute();
$result= $stmt->get_result(); //prendo i risultati
$personalita=$result->fetch_all(MYSQLI_ASSOC);
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
                    <form method="POST" action="./php/registrazioneP.php">
                      <div class="d-flex flex-wrap gap-2 mb-4">
                        <?php foreach ($personalita as $pers): ?>
                          <input type="checkbox" class="btn-check" name="personalita[]" 
                            id="personalita_<?php echo htmlspecialchars($pers['idPersonalita']); ?>"
                            value="<?php echo htmlspecialchars($pers['idPersonalita']); ?>"
                            autocomplete="off"
                          >
                          <label 
                            class="btn btn-custom" 
                            for="personalita_<?php echo htmlspecialchars($pers['idPersonalita']); ?>"
                          >
                            <?php echo htmlspecialchars($pers['nomePersonalita']); ?>
                          </label>
                        <?php endforeach; ?>
                      </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-bold border-0" style="background: linear-gradient(90deg, #fd267a, #ff6036);">
                        CONTINUA <i class="bi bi-arrow-right ms-2"></i>
                      </button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php
include("./templates/footer.php");
?>