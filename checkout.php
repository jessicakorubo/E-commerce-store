
<?php 
session_start();

if (!empty($_SESSION['cart']) && isset($_POST['checkout'])) {
    //send user to homepage
}
else {
    // send user to home page
header ('location: index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place order</title>
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

    <section class="place-order-form">
        <div class="form-section">
            <form id="checkout-form" name="place-order" method="POST" action="place_order.php">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="name" name="name" id="" required>

                <label>Email</label>
                <input type="text" class="form-control" placeholder="name" name="email" id="" required>

                <label>Phone</label>
                <input type="tel" class="form-control" placeholder="number" name="phone" id="" required>

                <label>City</label>
                <input type="text" class="form-control" placeholder="city" name="city" id="" required>

                <label>Address</label>
                <input type="text" class="form-control" placeholder="address" name="address" id="" required>  

                <div class="form-group checkout-btn-container">
                    <p>Total amount: $  <?php echo $_SESSION['total']; ?>.</p>
                    <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order"/>
                </div>
                
            </form>
        </div>
    </section>
</body>
</html>