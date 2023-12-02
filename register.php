<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
session_start();


?>

<?= template_header('Register') ?>
<form method="POST" id="send_verification_code">

  <input type='text' name='name' id='name' placeholder="Name">

  <input type='text' name='last_name' id='last_name' placeholder="Last Name" >

  <input type='text' name='username' id='username' placeholder='Username' >

  <input type='email' name='email' id='email' placeholder='Email' >

  <input type='submit' value='Send Verification Code'>
</form>


<form method="POST" id="verify_code">
  <input type="hidden" name="action" value="register">

    <p>When clicking send email, you will get a temporary code that functions for 30 minutes, you will use that to register, then you can change the password</p>

    <label for='password'>Please input the temporary password</label>

    <input type='password' name='Temporary_password' id='temporary_password' placeholder="Verification code">
      <i class="far fa-eye" id="togglePassword"></i>

    <input type='submit' value='Verify Code'>
</form>

<div id="alert">
  <p>

  </p>
</div>

<a href="change_password.php">
  <button style='display: none;'>Go to Example.com</button>
</a>

<p>
<?= display_error();
    unset_error();
?>
</p>
<?= template_footer() ?>
