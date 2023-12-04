<?php
include 'Backend/templates.php';
include 'Backend/functions.php';
session_start();

redirectIfNotLoggedIn();
?>

<?=template_header('Create task', 'Create Task') ?>

  <div class="form-create">
    <form method='post' id="create_task">
        <label for="task_name">Task Name:</label>
        <input type="text" id="task_name" name="task_name" required>

        <div class="dates">
          <div class="date">
          <label for="start_date">Start Date:</label>
          <input type="date" id="start_date" name="start_date">

          </div>
          <div class="date">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date">
          </div>
        </div>
        

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50"></textarea>

        <label for="importance">Importance:</label>
        <select id="importance" name="importance">
            <option value="high">High</option>
            <option value="middle">Middle</option>
            <option value="low">Low</option>
        </select>

        <input type="submit" value="Create task">

      <div id="alert">
        <p>

        </p>
      </div>
    </form>
  </div>

<<<<<<< HEAD
  <p>
    <?= display_error();
        unset_error();
    ?>
  </p>

=======
>>>>>>> 6e3884c1a531ff32990e5e72c561a538308863c7
<?= template_footer() ?>