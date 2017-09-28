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
    $cartNotification = "<script type='text/javascript'>alert('Item was added to the cart.')</script>";

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array(
            array(
                    'item' => $addedItem,
                    'purchaseQuantity' => $purchasedQuantity
            )
        );
        echo $cartNotification;
    }
    else{
        $tampArray = array(
                'item' => $addedItem,
                'purchasedQuantity' => $purchasedQuantity
        );
        array_push($_SESSION['cart'], $addedItem);
        echo $cartNotification;
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
        <?php include('includes/header.php'); ?>
    <main>
        <?php include('includes/filter.php') ?>
        <?php
            $filterName = null;
            if(isset($_POST['filter']))
                $filterName = $_POST['filter'];

            if($filterName)
                echo "<h2>Filtering by: $filterName</h2>"
        ?>
        <div class="display-items">
            <?php
                if(isset($_POST['filter'])){
                    $filter = htmlspecialchars(filter_input(INPUT_POST, 'filter'));
                    display_items($allItems, $filter);
                }
                else{
                    display_items($allItems, "");
                }
            ?>
        </div>
    </main>
        <?php include('includes/footer.php') ?>
    </body>
</html>
