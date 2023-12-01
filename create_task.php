<?php
include 'Backend/templates.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
redirectIfNotLoggedIn();
?>

<?=template_header_login('Create task') ?>
<form method='post'>
  <div style='display: flex; flex-direction: column;'>
    <input type='text' placeholder='Name of the Task' id='name_task'>
    <input type="date" placeholder='Start date' id='start_date'>
    <input type="date" placeholder='End date' id='end_date'>
    <input type="text" placeholder='Description' id='description'>
    <button id='add_todo'>
      <i class="bi bi-plus-circle"> Add to-do</i>
    </button>
    <div id='to-dos'>

    </div>
    <input type='submit' value='Add task'>
  </div>

  


</form>
<div id='nomas'>
  <p>

  </p>
</div>

<?= template_footer() ?>