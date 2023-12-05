<?php

include 'Backend/templates.php';
include 'Backend/functions.php';
@session_start();
logged();
$img = fetchImg();

?>

<?= template_header('Welcome','Welcome', $img) ?>

<?= template_footer() ?>