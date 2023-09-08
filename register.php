<?php 

session_start();

include('server/connection.php');

if (isset($_SESSION['logged_in'])){
        header('location: account.php');
        exit;
    }

if (isset($_POST['register'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];


        // if passwords do not match
        if($password !== $confirmPassword) {
            header('location: register.php?error=Passwords do not match');
        }
        else if(strlen($password) < 6){
            header('location: register.php?error=Password should be greater than 5 characters');
        }

        else {
                // check whether there is a user with this email or not
                $stmt1 = $conn -> prepare("SELECT COUNT(*) FROM users WHERE user_email=?");
                $stmt1 ->bind_param('s', $email);
                $stmt1 -> execute();
                $stmt1 -> bind_result($num_rows);
                $stmt1 -> store_result();
                $stmt1 -> fetch();

                // if there is a user already registered with this email
                if ($num_rows !=0) {
                    header('location: register.php?register_error=User with this email already exists! Try logging in');
                }

                // if there is no user registered with this email, proceed with new account
                else {
                    $stmt = $conn-> prepare("INSERT INTO users (user_name, user_email, user_password)
                            VALUES (?,?,?)");

                    $stmt-> bind_param('sss', $name, $email, md5($password));

                    // if account was created successfully
                    if($stmt-> execute()){
                        $user_id = $stmt->insert_id;
                        $_SESSION['user_id'] = $user_id;
                        
                        $_SESSION['user_email'] = $email;
                        $_SESSION['user_name'] = $name;
                        $_SESSION['logged_in'] = true;
                        header("location: account.php?register_success=You registered succesfully");
                    }else {
                        header('location: register.php?error=Could not create an account.');
                    }
                }
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

          <li><a  href="index.php">Home</a></li>
          <li><a href="shop.php">Shop</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li id="lg-bag"><a  class="active" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
          <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
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


      <section id="login-section" class="register-section">
        <h4>REGISTER</h4>
        <hr id="login">
        <form action="register.php" method="POST">
            <p style="color: red"><?php if (isset($_GET['error'])) {echo $_GET['error']; }?></p>
            <div>
                <input type="text" name="name" id="" placeholder="Name" required>
            </div>
            <div>
                <input type="email" name="email" id="" placeholder="Email address" required>
            </div>
            <div>
                <input type="password" name="password" id="" placeholder="Password" required>
            </div>
            <div>
                <input type="password" name="confirmPassword" id="" placeholder="Confrim Password" required>
            </div>
            <div>
                <input type="submit" name="register" id="register-btn" value="Register">
            </div>
            <div class="no-account">
                <a href="login.php">Already a member? Login.</a>
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
