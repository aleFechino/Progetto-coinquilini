<form action="./php/loginCheck.php" method="POST">
    <p class="text-muted mb-4">Please login to your account</p>

    <div class="form-outline mb-4">
        <input type="text" id="user" name="user" class="form-control" 
               placeholder="Phone number or email address" required />
    </div>

    <div class="form-outline mb-4">
        <input type="password" id="password" name="password" class="form-control" 
               placeholder="Password" required />
    </div>

    <div class="text-center pt-1 mb-5 pb-1">
        <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 w-100 py-3 fw-bold border-0">
            LOG IN
        </button>
        <br>
        <a class="text-muted text-decoration-none small" href="#!">Forgot password?</a>
    </div>

    <div class="d-flex align-items-center justify-content-center pb-4">
        <p class="mb-0 me-2">Don't have an account?</p>
        <a href="./registraAnagrafe.php" class="btn btn-outline-danger rounded-pill px-4">CREATE NEW</a>
    </div>
</form>