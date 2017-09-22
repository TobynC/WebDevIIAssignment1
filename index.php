<?php
session_start();
require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Computer Hardware Store </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="To-Do" content="Computer Hardware Store">
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <?php include ('header.php'); ?>
    <main>
        <?php display_items() ?>
    </main>
        <?php include ('footer.php')?>
    </body>
</html>
