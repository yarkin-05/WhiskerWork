<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
session_start();
?>

<?= template_header('Calendar', 'Calendar') ?>


  <div class="wrapper">
    <header>
      <p class="current-date"></p>
      <div class="icons">
        <span id="prev" class="material-symbols-rounded">
          <i class="fa-solid fa-chevron-left"></i>                
        </span>
        <span id="next" class="material-symbols-rounded">
          <i class="fa-solid fa-chevron-right"></i>
        </span>
      </div>
    </header>
    <div class="calendar">
      <ul class="weeks">
        <li>Sun</li>
        <li>Mon</li>
        <li>Tue</li>
        <li>Wed</li>
        <li>Thu</li>
        <li>Fri</li>
        <li>Sat</li>
      </ul>
      <ul class="days">
        
      </ul>
    </div>


  </div>

<p>
<?= display_error();
    unset_error();
?>
</p>

<?= template_footer() ?>

