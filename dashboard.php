<?php
include 'Backend/templates.php';
include 'Backend/functions.php';

@session_start();
redirectIfNotLoggedIn();

$tasks = fetchTasks();
$img = fetchImg();

?>

<?= template_header('Dashboard', 'Dashboard', $img) ?>

<div class="task-wrapper">
      <div class="task--container">
        <?php foreach ($tasks as $task): ?>
          <div class="task--wrapper">
            <div class="task--card">
              <div class="task--header">
                <div class="importance-level">
                  <div class="level">
                    <?= $task['importance'] ?>
                      <div class="<?php echo trim($task['importance']) ?>"></div>
                  </div>
                  <div class="icons">
                    <?php if($task['completed'] == '0') :?>
                      <i class="bi bi-check-lg check" id="<?= $task['id']?>" ></i>
                      <i class="bi bi-trash3-fill" id="<?= $task['id']?>"> </i>
                    <?php else :?>
                      <i class="bi bi-trash3-fill" id="<?= $task['id']?>" ></i>
                      <?php endif; ?>
                  </div>
                  
                </div>
                <div class="title"> 
                  <?= $task['name'] ?>
                </div>  
              </div>
              <div class="description">
                  <p>
                  <?= $task['description'] ?>
                  </p>
              </div>
              <div class="dates">
                <div class="start-date">
                  Start Date
                  <div class="date">
                    <?= $task['start_date'] ?>
                  </div>
                </div>
                <div class="end-date">
                  End Date
                  <div class="date">
                    <?= $task['end_date'] ?>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        <?php endforeach; ?>
    </div>
  </div>
  
      
   

  <div class="tabular--wrapper">
    <h3 class="main--title"> Your table information </h3>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Importance</th>
            <th>Start</th>
            <th>Deadline</th>
            <th>Completed</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task) :?>
          <tr>
              <td><?= $task['name'] ?></td>
              <td><?= $task['importance'] ?></td>
              <td><?= $task['start_date'] ?></td>
              <td><?= $task['end_date'] ?></td>

              <?php if($task['completed'] === '1') :?>
                <td>Yes</td>
              <?php else :?>
                <td>No</td>
              <?php endif; ?>
          </tr>
        <?php endforeach; ?>
        </tbody>
        </th>
      </table>
    </div>

  <p>
    <?= display_error();
        unset_error();
    ?>
  </p>
<?= template_footer()?>

<!-- 



-->