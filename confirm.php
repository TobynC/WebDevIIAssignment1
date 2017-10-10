<?php
session_start();
require_once('functions.php');
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
if(!isset($_SESSION['allItems'])){
    $_SESSION['allItems'] = array();
}
$cart = $_SESSION['cart'];
$allItems = $_SESSION['allItems'];

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
updateInventory($allItems, $cart);
unset($_SESSION['cart']);
?>
<main>
    <h1>Thank you for ordering from Oldegg</h1>
    <h2>Your order has been received and is being processed. Order details can be viewed below.</h2>
    <table>
        <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for($i = 0; $i < count($cart); $i++){
            $totalPrice = (int)$cart[$i]['item']['price'] * (int)$cart[$i]['purchaseQuantity'];
            echo <<<HTML
    <tr>
        <td>{$cart[$i]['item']['name']}</td>
        <td>{$cart[$i]['purchaseQuantity']}</td>
        <td>\${$totalPrice}</td>
    </tr>
HTML;
        }


        ?>
        </tbody>
    </table>
</main>
<?php include ('includes/footer.php')?>
</body>
</html>