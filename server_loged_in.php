<?php
include 'functions.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
redirectIfNotLoggedIn();
//for managing all the server side requests when logged in
?>