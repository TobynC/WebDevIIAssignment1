<?php
session_start();
require_once('functions.php');

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
$cart = $_SESSION['cart'];

if (isset($_POST['remove'])){
    $index = $_POST['remove'];
    delete_item($index, $cart);
    $_SESSION['cart'] = $cart;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Shopping Cart </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="cart" content="View contents of shopping cart">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php include ('includes/header.php'); ?>
<main>
    <?php
    displayCart($cart);
    ?>
    <?php
        if(count($cart))
        {
          echo "
            <form action='confirm.php' method=post>
                <input type='submit' value='Confirm'>
            </form>";
        }
        else{
            echo "<h2>There's nothing in here yet.</h2>";
        }
    ?>
</main>
<?php include ('includes/footer.php')?>
</body>
</html>