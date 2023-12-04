<?php
include 'Backend/templates.php';
include 'Backend/functions.php';

/*
<?php foreach($task as $key => $value ):?>
  <?php if($key ===' importance' ) :?>

  <?php elseif($key === 'name') :?>

  <?php elseif ($key === 'description') :?>

  <?php elseif ($key === 'start_date') :?>

  <?php elseif ($key === 'end_date') : ?>

  <?php elseif ($key === 'completed') : ?>


  <?php endif; ?>
*/
session_start();
redirectIfNotLoggedIn();

$tasks = fetchTasks();
?>

<?= template_header('Dashboard', 'Dashboard') ?>

<div class="task-wrapper">
      <div class="task--container">
        <?php foreach ($tasks as $task): ?>
          <div class="task--wrapper">
            <div class="task--card">
              <div class="task--header">
                <div class="importance-level">
                  <div class="level">
                    <?= $task['importance'] ?>
                      <div class="<?php trim($task['importance']) ?>"></div>
                  </div>
                  <i style="color: gray;" class="bi bi-trash3-fill"></i>
                </div>
                <div class="title"> 
                  <?= $task['title'] ?>
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
              <div class="completed">
                <p>Completed: </p>
                <input type="checkbox" id="completed" name="completed">
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
            <th>Completed</th>
            <th>Start</th>
            <th>Deadline</th>
            <th>Importance</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tasks as $task) :?>
            <tr>
              <?php foreach ($task as $key => $value) :?>
                <?php if($key ==='name' ) :?>
                  <td><?=$value?></td>
                <?php elseif($key === 'importance') :?>
                  <td><?=$value?></td>
                <?php elseif ($key === 'start_date') :?>
                  <td><?=$value?></td>

                <?php elseif ($key === 'end_date') : ?>
                  <td><?=$value?></td>

                <?php elseif ($key === 'completed') : ?>
                  <?php if ($value == '0'):?>
                    <td> No </td>
                  <?php else : ?>
                    <td> Yes </td>
                  <?php endif; ?>
                <?php endif; ?>
               
              <?php endforeach ;?>
            </tr>
          <?php endforeach ;?>
        </tbody>
        </th>
      </table>
    </div>
<?= template_footer()?>

<!-- 



-->