<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'functions.php';
?>

<?= template_header('Register') ?>
<form method = "post" >
  <input type='text' name='name' id='name' placeholder="Name">

  <input type='text' name='last_name' id='last_name' placeholder="Last Name">

  <input type='text' name='username' id='username' placeholder='Username'>

  <input type='email' name='email' id='email' placeholder='Email'>

  <input type='password' name='password' id='password' placeholder="Password">
  <i class="far fa-eye" id="togglePassword"></i>
  <input type='password' name='password_verification' id='verification' placeholder="Verify password" >
  <input type='button' id='registration_form'>
  <div id='alert'>
    <p>

    </p>
  </div>
</form>
<?= template_footer() ?>
