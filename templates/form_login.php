<form action="./php/loginCheck.php" method="POST" class="px-3">
    <!-- Input Email/User -->
    <div class="mb-3">
        <input type="text" id="user" name="user" 
               class="form-control login-input rounded-pill text-center" 
               placeholder="EMAIL" required>
    </div>
    
    <!-- Input Password -->
    <div class="mb-4">
        <input type="password" id="password" name="password" 
               class="form-control login-input rounded-pill text-center" 
               placeholder="PASSWORD" required>
    </div>
    
    <!-- Bottone SIGN IN -->
    <button type="submit" class="btn btn-light w-100 rounded-pill fw-bold text-uppercase py-3 shadow-lg" style="color: #fd267a;">
        SIGN IN
    </button>
</form>