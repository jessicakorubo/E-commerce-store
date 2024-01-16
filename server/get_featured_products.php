<?php 

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");
$stmt->execute();
$featured_products = $stmt->get_result();

$new = $conn->prepare("SELECT * FROM products LIMIT 4 , 4 ");
$new->execute();
$new_arrivals = $new->get_result();

$shop = $conn-> prepare("SELECT * FROM products");
$shop->execute();
$shop_products = $shop->get_result();

?>

