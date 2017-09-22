<?php
session_start();
require_once('functions.php');

$allItems = read_file();
if(!isset($_SESSION['allItems']))
    $_SESSION['allItems'] = $allItems;

if (isset($_POST['purchaseQuantity']) && isset($_POST['index'])){
    $index = filter_input(INPUT_POST, 'index', FILTER_VALIDATE_INT);
    $purchasedQuantity = filter_input(INPUT_POST, 'purchaseQuantity', FILTER_VALIDATE_INT);
    $addedItem = $allItems[$index];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array(
            array(
                    'item' => $addedItem,
                    'purchaseQuantity' => $purchasedQuantity
            )
        );
        echo "<script type='text/javascript'>alert('Item was added to the cart.')</script>";
    }
    else{
        $tampArray = array(
                'item' => $addedItem,
                'purchasedQuantity' => $purchasedQuantity
        );
        array_push($_SESSION['cart'], $addedItem);
        echo "<script type='text/javascript'>alert('Item was added to the cart.')</script>";
    }
}
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
        <?php display_items($allItems) ?>
    </main>
        <?php include ('footer.php')?>
    </body>
</html>
