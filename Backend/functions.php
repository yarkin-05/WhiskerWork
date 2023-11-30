<?php

function redirectIfNotLoggedIn() {
  // Check if session variables are set
  if (!isset($_SESSION['username']) || !isset($_SESSION['id']) || !isset($_SESSION['logged_in'])) {
      header('Location: ../welcome.php');
      exit;
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