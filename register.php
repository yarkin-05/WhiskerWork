<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
session_start();
logged();

?>

<?= template_header('Register', 'Register') ?>

  <div class="form">
  <div class="main--title"> User Verification</div>

    <form method="POST" id="send_verification_code">

      <input type='text' name='name' autocomplete="off" id='name' placeholder="Name">

      <input type='text' name='last_name' autocomplete="off" id='last_name' placeholder="Last Name" >

      <input type='text' name='username' autocomplete="off" id='username' placeholder='Username' >

      <input type='email' name='email' autocomplete="off" id='email' placeholder='Email' >

      <input type='submit' value='Send Verification Code'>
    </form>
    <div id="alert">
      <p>

      </p>
    </div>
  </div>

  <div class="form">
    <form method="POST" id="verify_code">

      <label for='password'>Please input the temporary password</label>

      <div class="password">
        <input type='password' name='Temporary_password' id='temporary_password' placeholder="Verification code">
        <i class="far fa-eye" id="togglePassword"></i>
      </div>
     
      <input type='submit' value='Verify Code'>
      <div id="code_verification">
        <p>

        </p>
      </div>
    </form>
  </div>






<p>
<?= display_error();
    unset_error();
?>
</p>
<?= template_footer() ?>
