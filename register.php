<?php
include 'Backend/templates.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?= template_header('Register') ?>
<form method="POST">

  <input type='text' name='name' id='name' placeholder="Name" value='hannah'>

  <input type='text' name='last_name' id='last_name' placeholder="Last Name" value='Bang'>

  <input type='text' name='username' id='username' placeholder='Username' value='hannahbang'>

  <input type='email' name='email' id='email' placeholder='Email' value='yarkin_@outlook.com'>

  <input type='button' id='register_pt1' value='Register'>
</form>


<form method="POST">
  <input type="hidden" name="action" value="register">
    <p>When clicking send email, you will get a temporary password that functions for 30 minutes, you will use that to register, then you can change the password</p>
    <label for='password'>Please input the temporary password</label>
    <input type='password' name='Temporary_password' id='temporary_password' placeholder="Temporary password">
      <i class="far fa-eye" id="togglePassword"></i>
    <input type='button' id='temporary_registration' value='Register'>
</form>

<div id="alert">
  <p>

  </p>
</div>

<a href="change_password.php">
  <button style='display: none;'>Go to Example.com</button>
</a><?= template_footer() ?>
