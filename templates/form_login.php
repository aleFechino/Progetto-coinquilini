<div class="registration-wrapper py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-3 p-md-5">
                        <form action="./php/loginCheck.php" method="POST">
                            <h2 class="fw-bold text-dark text-center">Benvenuti!</h2>
                            <p class="text-muted mb-4 text-center">Effettua il login al tuo account</p>

                            <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                                <div class="alert alert-danger text-center rounded-3" role="alert">
                                    Email o password errati.
                                </div>
                            <?php endif; ?>

                            <div class="form-outline mb-4">
                                <input type="text" id="user" name="user" class="form-control" 
                                    placeholder="Email address" required />
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control" 
                                    placeholder="Password" required />
                            </div>

                            <div class="text-center pt-1 mb-5 pb-1">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-bold border-0" style="background: linear-gradient(90deg, #fd267a, #ff6036);">
                                    LOG IN
                                </button>
                                <br>
                                <!-- <a class="text-muted text-decoration-none small" href="#!">Forgot password?</a> -->
                            </div>

                            <div class="d-flex align-items-center justify-content-center pb-1">
                                <p class="mb-0 me-2">Non hai un account?</p>
                                <a href="./registraAnagrafe.php" class="btn btn-outline-danger rounded-pill px-4">CREA NUOVO</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
