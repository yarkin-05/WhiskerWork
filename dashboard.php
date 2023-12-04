<?php
include 'Backend/templates.php';
include 'Backend/functions.php';

session_start();
redirectIfNotLoggedIn();
?>

<?= template_header('Dashboard', 'Dashboard') ?>

<div class="task-wrapper">
      <div class="task--container">
        <div class="task--wrapper">
          <div class="task--card">
            <div class="task--header">
              <div class="importance-level">
                <div class="level">
                  <div class="very"></div>
                  high         
                </div>
                  
                <i style="color: gray;" class="bi bi-trash3-fill"></i>
  
              </div>
              <div class="title"> 
                task name
              </div>  
            </div>
            <div class="description">
              <p>description</p>
            </div>
            <div class="dates">
              <div class="start-date">
                Start Date
                <div class="date">
                  21 Sept
                </div>
              </div>
              <div class="end-date">
                End Date
                <div class="date">
                  30 Oct
                </div>
              </div>
          </div>
          
        </div>
      </div>
  
      <div class="task--card">
        <div class="task--header">
          <div class="importance-level">
            <div class="level">
              <div class="very"></div>
              high         
            </div>
              
            <i style="color: gray;" class="bi bi-trash3-fill"></i>
  
          </div>
          <div class="title"> 
            task name
          </div>  
        </div>
        <div class="description">
          <p>description</p>
        </div>
        <div class="dates">
          <div class="start-date">
            Start Date
            <div class="date">
              21 Sept
            </div>
          </div>
          <div class="end-date">
            End Date
            <div class="date">
              30 Oct
            </div>
          </div>
      </div>
      <div class="completed">
        <p>Completed: </p>
         <input type="checkbox" id="completed" name="completed">
      </div>
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
          <tr>
            <td>Name</td>
            <td> high</td>
            <td>23 Sept</td>
            <td>23 Oct</td>
            <td> no </td>
          </tr>

          <tr>
            <td>Name</td>
            <td> high</td>
            <td>23 Sept</td>
            <td>23 Oct</td>
            <td> no </td>
          </tr>

          <tr>
            <td>Name</td>
            <td> high</td>
            <td>23 Sept</td>
            <td>23 Oct</td>
            <td> no </td>
          </tr>

        </tbody>
        </th>
      </table>
    </div>
<?= template_footer()?>