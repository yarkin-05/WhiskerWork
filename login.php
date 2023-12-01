<?php
include 'Backend/templates.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?= template_header_login('Login') ?>
<form method = "post" >

  <input type='text' name='username' id='username' placeholder='Username'>

  <p>Forgot username? Retrieve it <a href="recover_username.php"> here</a> 
  </p>  


  <input type='password' name='password' id='password' placeholder="Password">
  <i class="far fa-eye" id="togglePassword"></i>

  <input type='button' id='login_form' value="Submit">
  
  <a href="recover_password.php">Forgot password?</a>

  <div id='alert'>
    <p>
    </p>
  </div>
</form>
<?= template_footer() ?>

