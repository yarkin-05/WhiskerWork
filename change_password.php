<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
session_start();

if(!isset($_SESSION['logged']) or !$_SESSION['logged']) header('Location: index.php');
?>

<?= template_header('Reset Password') ?>

<form method='post' id='reset_password'>

  <label for="password"> Please input the new password</label>
  <input type="password" name="new_password" id="new_password">
  <i class="far fa-eye" id="togglePassword"></i>

  <label for="password"> Confirm new password</label>
  <input type="password" name="confirm_new_password" id="confirm_new_password">
  <i class="far fa-eye" id="togglePassword"></i>

  <input type="submit" value='Reset Password' >
</form>

<div id='alert'>
  <p>

  </p>
</div>


<?= template_footer() ?>