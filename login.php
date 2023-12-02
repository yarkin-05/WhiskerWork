<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
session_start();
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

<p>
<?= display_error();
    unset_error();
?>
</p>

<?= template_footer(); ?>

