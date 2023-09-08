
<?php 
session_start();

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

    <section class="place-order-form">
        <div class="form-section">
            <h2>Payment</h2>    
            <p><?php echo $_GET['order_status'] ?></p>
            <p>Total payment: $<?php echo $_SESSION['total']; ?>.</p>
            <input type="submit" class="btn normal"  value="Pay now"/>
            </div>
                
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>