<?php

@session_start();
function template_header($title, $page_name, $img){
  echo <<<EOT
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
    <link rel="icon" type="image/x-icon" href="images/logo_patita.png">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="styles/dashboard.css">

  </head>

  <body>
      <div class="sidebar">
      <div class="logo">
        <ul class="menu">
          <li class="active">
            <a href="index.php" >
              <i class="bi bi-chevron-right"></i>
              <span> Menu </span>
            </a>
          </li>
          <li>
            <a href="create_task.php">
              <i class="bi bi-plus-circle"></i>
              <span> Create task </span>
            </a>
          </li>
          <li>
            <a href="profile.php">
              <i class="bi bi-person-circle"></i>
              <span>Profile</span>
            </a>
          </li>
          <li>
            <a href="calendar.php">
              <i class="bi bi-calendar"></i>
              <span>Calendar</span>
            </a>
          </li>
          <li>
            <a href="workspace.php">
              <i class="bi bi-person-workspace"></i>
              <span>Workspace</span>
            </a>
          </li>
          <li>
            <a href="dashboard.php">
            <i class="bi bi-table"></i>              
            <span>Dashboard</span>
            </a>
          </li>
          <li class="register">
            <a href="register.php">
              <i class="bi bi-person-add"></i>
              <span>Register</span>
            </a>
          </li>
          <li class="login">
            <a href="login.php">
              <i class="bi bi-box-arrow-in-right"></i>
              <span>Login</span>
            </a>
          </li>
          <li class="logout">
            <a href="logout.php">
              <i class="bi bi-box-arrow-in-left"></i>
              <span>Logout</span>
            </a>
          </li>
            
        </ul>

        <div class="page-logo">
          <img src="images/logo_patita.png" > 
          <p>WhiskerWorks</p>
        </div>
      </div>
    </div>

    <div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">
          <span>Whisker Works</span>
          <h2>$page_name</h2>
        </div>
        <div class="user--info">
          <div class="search--box">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search">
          </div>
          
          <img src="$img" alt="">
        </div>
    </div>
  EOT;
}

function template_footer(){
  echo <<<EOT

  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>


  <script src="./js/events.js" ></script>
  <script src="./js/animations.js"></script>
  </body>
  </html>


  EOT;
}


?>


    