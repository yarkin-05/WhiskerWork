<?php
include 'db.php';
@session_start();


function fetchImg(){
  if(isset($_SESSION['info']['profile_image'])) return $_SESSION['info']['profile_image'];
  else return 'images/no_profile.png';
}


function fetchTasks(){
  $pdo = pdo_connect_mysql();
  $stmt = $pdo -> prepare('SELECT * FROM tasks WHERE user_id = ?');
  $stmt->execute([$_SESSION['info']['id']]);
  $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
  if ($result === false){
    return [];
  }
  return $result;
}

function redirectIfNotLoggedIn() {
  // Check if session variables are set
  if (!isset($_SESSION['logged'])) {
      header('Location: index.php');
      exit();
  }
}

function logged(){
  if(isset($_SESSION['logged'])){
    header('Location: dashboard.php');
  }
}

function display_error(){
  if(isset($_SESSION['error'])){
    return $_SESSION['error'];
  }
}

function unset_error(){
  if (isset($_SESSION['error'])){
    unset($_SESSION['error']);
  }
}

function isValidDomain($email) {
  $validDomains = array(
    "@gmail",
    "@outlook",
    "@yahoo",
    "@hotmail",
    "@icloud",
    "@aol",
    "@protonmail",
    "@mail",
    "@live",
    "@yandex",
    "@zoho",
    "@mail.com"
    // Add more valid domains here as needed
  );

  foreach ($validDomains as $domain) {
      if (strpos($email, $domain) !== false) {
          return true; // Email has a valid domain
      }
  }
  return false; // Email domain is not valid
}?>