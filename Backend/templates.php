<?php
function template_header($title){
  echo <<<EOT
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
    <link rel="icon" type="image/x-icon" href="images/logo_patita.png">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href = "styles.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/calendar.css">

  </head>

  <body>
    <div class="container">
      <nav class="navbar">
   
        <div class="logo">
          <img src="images/logo_patita.png" > 

          <h2>WhiskerWorks</h2>
        </div>

        <div class="links">
          <a href="#"> <b>Login</b> </a>
          <a href="#"> <b>Logout</b> </a>
          <a href="#"> Home </a>
        </div>

        <div class="profile">
          <i class="bi bi-bell"></i> 
          <img class="profile-picture" src="images/no_profile.png" onclick="toggleMenu()">     
        </div>

        <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
            <div class="user-info">
              <img src="images/no_profile.png">
              <p> Name, last name</p>
            </div>
            <hr>
            <a href="#" class="sub-menu-link">
              <img src="images/no_profile.png">
              <p> Edit Profile </p>
              <span>></span>

            </a>
            <a href="#" class="sub-menu-link">
              <img src="images/settings.png">
              <p> Settings </p>
              <span>></span>
            </a>
          </div>
        </div>
      </nav>
    </div>
  EOT;
}

function template_header_login($title){
  echo <<<EOT
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
    <link rel="icon" type="image/x-icon" href="images/logo_patita.png">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href = "styles.css" rel="stylesheet">

  </head>

  <body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
      <a
        href="#"
        class="navbar-brand mb-0 h1">
        <img 
        class="d-inline-block align-top"
        src="images/logo_patita.png" width="24px" height="auto">
        WhiskerWorks
      </a>
      
      <a href="logout.php">Log Out </a>
    </nav>
    
    
    

  EOT;
}
function template_footer(){
  echo <<<EOT
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>

  <script src="./js/events.js" ></script>
  <script src="./js/todo.js"></script>
  <script src="./js/animations.js"></script>
  </body>
  </html>


  EOT;
}


?>


    