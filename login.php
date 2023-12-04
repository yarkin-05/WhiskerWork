<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
session_start();
logged();
?>

<?= template_header('Login', 'Login') ?>


  <div class="form">
    <form id='login' method ="post">

      <input type='text' name='username' id='username' placeholder='Username'>

      <p>Forgot username? Retrieve it <a href="recover_username.php"> here</a> 
      </p>  
      
      <div class="password">
        <input type='password' name='password' id='password' placeholder="Password">
        <i class="far fa-eye" id="togglePassword"></i>
      </div>

      <a href="recover_password.php">Forgot password?</a>

      <input type='submit' value="Submit">

      <div id='alert'>
        <p>
        </p>
      </div>
    </form>
  </div>

  <p class="server-error">
  <?= display_error();
      unset_error();
  ?>
  </p>

<?= template_footer() ?>

