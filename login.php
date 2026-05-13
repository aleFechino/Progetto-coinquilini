<?php

session_start();
session_unset();
session_destroy();

//include ('./templates/header.php');
?>
    <section>
    <div class="login-container">
        <h1></h1>

        <?php include ('./templates/header.php'); ?>    
        <?php include ('./templates/form_login.php'); ?>    
        
    </div>
    </section>
    
<?php
include ('./templates/footer.php');
?>