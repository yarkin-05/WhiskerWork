<?php
session_start();

function redirectIfNotLoggedIn() {
  // Check if session variables are set
  if (!isset($_SESSION['info']['username']) || !isset($_SESSION['info']['id']) || !isset($_SESSION['logged'])) {
      header('Location: ../index.php');
      exit;
  }
}

function logged(){
  if(isset($_SESSION['logged']) and $_SESSION['logged'] === true){
    header('Location: ../dashboard.php');
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