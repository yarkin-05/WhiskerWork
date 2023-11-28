<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'functions.php';
session_start();
?>

<?= template_header_login('Reset Password') ?>

<form method='post'>
  <label for="username"> Please input the username associated with your account</label>
  <input type="text" name="username" id="username">

  <label for="password"> Please input the new password</label>
  <input type="password" name="new_password" id="new_password">
  <i class="far fa-eye" id="togglePassword"></i>

  <label for="password"> Confirm new password</label>
  <input type="password" name="confirm_new_password" id="confirm_new_password">
  <i class="far fa-eye" id="togglePassword"></i>

  <input type="submit" value='Reset Password' id='reset_password' >
</form>

<div id='alert'>
  <p>

  </p>
</div>
<p>Return to <a href='login.php'>login</a></p>


<?= template_footer() ?>