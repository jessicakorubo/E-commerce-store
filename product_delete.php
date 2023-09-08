<?php 

include('server/connection.php');

if(isset($_POST['delete'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];

    $stmt= $conn->prepare("DELETE FROM products WHERE product_id =?");
    $stmt->bind_param('i', $product_id);

    if($stmt-> execute()){
        header('location: manage_products.php?message=Product delete successful.');
    }
    
}
else {
    header('location: manage_products.php?error=Could not delete item');
}
print_r($_POST);
?>