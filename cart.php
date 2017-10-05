<?php
session_start();
require_once('functions.php');
$cart = $_SESSION['cart'];

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
<?php
displayCart($cart);
?>

<form action='confirm.php' method=post>
    <input type='submit' value='Confirm'>

</form>
<?php include ('includes/footer.php')?>
</body>
</html>