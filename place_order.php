<?php 

session_start();
 include('server/connection.php');



if (isset($_POST['place_order'])){

    // // 1. get user info and store in database.
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = 'on_hold';
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
         VALUES (?,?,?,?,?,?,?); ");


    $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

    $stmt -> execute();

    // 2. insert order into database
    $order_id = $stmt->insert_id;


    // 3. get products from cart (from session)
    foreach($_SESSION['cart']as $key => $value){
        // to get each single product as an array
        $product = $_SESSION['cart'][$key]; //[]
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image= $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];

        // 4.Store each single item in order_items databse
        $stmt1 = $conn ->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image,product_price, product_quantity, user_id, order_date)
                    VALUES (?,?,?,?,?,?,?,?)");
        
        $stmt1 -> bind_param('iissiiss', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);

        $stmt1->execute();
    }

    header('location: payment.php?order_status=Order placed successfully');
}

?>

