<?php
//this is for sending emails for passwords, it would be an extra elemet
include 'Backend/templates.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?=template_header('Recover Password') ?>
<form method='post' method="recovery.php">
  <label for='email'> Please enter the email and password to reset your password</label>
  <input type="text" id='email' name="email">
  <input type="submit" value="Recover Password" id="recover_password">
</form>
<div id='alert'>
  <p>

  </p>
</div>
<?=template_footer()?>