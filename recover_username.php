<?php
include 'functions.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$msg = ''; // Initialize an empty message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare('SELECT username FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $username = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($username) {
        $msg = $username['username'] . ' is your username'; // Access 'username' field from $username array
    } else {
        $msg = 'There is no account associated with that email, please enter a valid email';
    }
}
?>

<?= template_header_login('Recover Username') ?>
<form method='post' action='recover_username.php'>
    <input type="email" name='email' placeholder="Email" id="email">
    <input type="submit" value="Recover Username" id="recover_username">
</form>

<?= $msg ?> <!-- Display the result message -->
<a href='login.php'> Return to Login </a>


<?= template_footer() ?>
