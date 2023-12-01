<?php
include 'Backend/templates.php';
include 'Backend/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
redirectIfNotLoggedIn();
?>

<?= template_header_login('Navigation') ?>

<div style="display: flex;">
  <div style="display: flex; flex-direction: column; ">

  </div>
  <div style="display: flex; ">

  </div>
</div>

<a href='create_task.php' id='add_task' class="btn-link">
  <i class="bi bi-plus-circle"></i>
</a>
<?= template_footer()?>