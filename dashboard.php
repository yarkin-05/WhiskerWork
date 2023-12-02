<?php
include 'Backend/templates.php';
include 'Backend/functions.php';

session_start();
//redirectIfNotLoggedIn();
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