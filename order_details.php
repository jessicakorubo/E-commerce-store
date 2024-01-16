<?php 

session_start();

// to make a query, import server connection file.
include ('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {

    $order_id = $_POST['order_id'];

    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT *FROM order_items WHERE order_id=?");

    $stmt->bind_param('i',  $order_id);

    $stmt->execute();

    $order_details = $stmt->get_result();
}
else {
    header('location: account.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
    <link rel="stylesheet" href="styles.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" />

</head>
<body>


    <section id="header">

      <a href="#"><img src="images/lotus.png" class="logo" alt="" /></a>

      <div class="">
        <ul id="navbar">

          <li><a class="active" href="index.php">Home</a></li>
          <li><a href="shop.php">Shop</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="contact.html">Contact</a></li>

          <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
          <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
          <a href="#" id="close"><i class="fa-regular fa-circle-xmark"></i></a>
        </ul>
      </div>
      <div id="mobile">
        <a href="cart.html">
            <i class="fa-solid fa-cart-shopping"></i>
        </a> 
         <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
        <i id="bar" class="fas fa-outdent">  </i>
              
      </div>
    </section>

    <section id="orders">
        <h3 style="text-align: center">Order details</h3>
        
        <section id="cart" class="section-p1 ">
            <table width="100%">
                <thead>
                    <tr>
                        <th class="order_product_header">Product image</th>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Quanity</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $order_details->fetch_assoc()) { ?>
                        <tr>
                            <td class="order_info">
                                <img src="Images/products/<?php echo $row['product_image']; ?>" alt="">
                                
                            </td>

                            <td>
                                <span><p><?php echo $row['product_name']; ?></p></span>
                            </td>

                            <td>
                                <span>$ <?php echo $row['product_price']; ?> </span>
                            </td>
                            <td>
                                <span> <?php echo $row['product_quantity']; ?> </span>
                            </td>
                            
                        </tr>

                        <?php } ?>

                    </tbody>
                </table>

                <?php
                    if ($order_status == "not paid") { ?>
                        <form style="float:right">
                            <input type="submit" class="btn normal" value="Pay now">
                        </form>
                <?php } ?> 
                 
                 
            </section>
    </section>

 
    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="Images/lotus.png" alt="">
            <h4>Contact</h4>
            <p><strong>Address:</strong> 324 yewr street NY city</p>
            <p><strong>Phone:</strong> + 886 47392 (73)</p>
            <p><strong>Hours:</strong>10:00 - 18:00, Mon - Sat</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest-p"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
            </p>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="#">About us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>

        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="Images/apple-icon.png" alt="">
                <img src="Images/icons8-play-store.png" alt="">
            </div>
            <img src="" alt="">
            <p>Secured Payemnt Gateways</p>
        </div>

        <div class="copyright">
            <p>© 2021, Tech2 etc - HTML CSS Ecommerce Templates</p>
        </div>
    </footer>

    <script src="script.js"></script>

</body>


</html>