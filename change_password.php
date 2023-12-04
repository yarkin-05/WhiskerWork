<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
session_start();

?>

<?= template_header('Reset Password', 'Reset Password') ?>

  <div class="form">
    <form method='post' id='reset_password'>

      <div class="password">
        <label for="password"> Please input the new password</label>
        <input type="password" name="new_password" id="new_password">
        <i class="far fa-eye" id="togglePassword"></i>
      </div>
        
      <div class="password">
        <label for="password"> Confirm new password</label>
        <input type="password" name="confirm_new_password" id="confirm_new_password">
        <i class="far fa-eye" id="togglePassword"></i>
      </div>
        
      <input type="submit" value='Reset Password' >
    </form>
  </div>

<div id='alert'>
  <p>

  </p>
</div>


<?= template_footer() ?>