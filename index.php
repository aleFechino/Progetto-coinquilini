<?php
include ('./templates/header.php');
?>
    <section>
    <div class="login-container">
        <h1>LOGIN</h1>
        
        <form action="" method="POST">
        <div class="input-group">
            <label for="user">USERNAME</label>
            <input type="text" id="user" name="user" placeholder="user" required>
        </div>
        
        <div class="input-group">
            <label for="password">PASSWORD</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
        
        <button type="submit">SIGN IN</button>
        </form>
        
        <div class="divider">OR</div>
        
        <div class="register-link">
            Don't have an account? <a>Sign up</a>
        </div>
    </div>
    </section>
    
<?php
include ('./templates/footer.php');
?>