<?php 

session_start();

include ('server/connection.php');

if (isset($_SESSION['logged_in'])){
        header('location: account.php');
        exit;
    }

if(isset($_POST['login_btn'])){

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $stmt = $conn-> prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email= ? AND 
            user_password = ? LIMIT 1");

        $stmt->bind_param('ss', $email, $password);

        if ($stmt->execute()){
          
            $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
            $stmt ->store_result();

            // if ($password != $user_password){
            //   header('location: login.php?error=The password you have entered is incoorect');
            // }

            
           

            if ($stmt->num_rows() == 1){
                  $stmt->fetch();

                  $_SESSION['user_id'] = $user_id;
                  $_SESSION['user_name'] = $user_name;
                  $_SESSION['user_email'] = $user_email;
                  $_SESSION['logged_in'] = true;


                  header('location:account.php?login_success=Logged in successfully!');
            } //rows 20
            
            else {
              //error
              header('location: login.php?error=Could not find your account, register your account.');
            } //else close 31
        } //execute 14
        
        else {
            header('location:login.php?error=Something went wrong');
        }
      }
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-shoppers</title>
    <link rel="stylesheet" href="styles.css" />

    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" />


  </head>


  <body>
    <section id="header">
      <a href="#"><img src="images/lotus.png" class="logo" alt="" /></a>

      <div class="">
        <ul id="navbar">

          <li><a  href="index.html">Home</a></li>
          <li><a href="shop.html">Shop</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
          <li><a class="active" href="login.php"><i class="fa-solid fa-user"></i></a></li>
          <a href="#" id="close"><i class="fa-regular fa-circle-xmark"></i></a>
        </ul>
      </div>

      <div id="mobile">
        <a href="cart.html">
            <i class="fa-solid fa-cart-shopping"></i>
        </a> 
        <i id="bar" class="fas fa-outdent">  </i>
              
      </div>
    </section>


      <section id="login-section">
        <h4>LOGIN</h4>
        <hr id="login">
        <form id="login-form" action="login.php" method="POST">
          <p style="color: red; text-align:center"><?php if(isset($_GET['error'])){echo $_GET['error'];}?> </p>
            <div>
                <input type="email" name="email" id="" placeholder="Email address">
            </div>
            <div>
                <input type="password" name="password" id="" placeholder="Password">
            </div>
            <div>
                <input type="submit" name="login_btn" id="login-btn" value="Login">
            </div>
            <div class="no-account">
                <a href="register.php">Dont have an account? Register.</a>
            </div>
        </form>
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
