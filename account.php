<?php 

session_start();

// to make a query, import server connection file.
include ('server/connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

if(isset($_GET['logout'])){
    if (isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);

        header('location: login.php');
        exit;
    }
}

if (isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    //confirm whether the passwords match
    if($password !== $confirmPassword) {
                header('location: account.php?error=passwords do not match');
    }
    //check if password is less than 6 characters
    else if(strlen($password) < 6){
        header('location: account.php?error=password should be greater than 5 characters');
    }
    else {
        $stmt = $conn->prepare("UPDATE users SET user_password =? WHERE user_email = ?");
        $stmt ->bind_param('ss', md5($password), $user_email);

        if($stmt->execute()){

            header('location: account.php?message= password updated succecssfully');
        }
        else {
            header('location: account.php?error=could not update password');
        }
    }
}

//get orders 
if (isset($_SESSION['logged_in'])){

    // coat code
    // $stmt = prepare("SELECT * FROM products WHERE product_category = 'coats' LIMIT 4" );
    // $stmt->execute();
    // $coats_products = $stmt->get_result();

    $user_id = $_SESSION['user_id'];


    $stmt= $conn->prepare("SELECT * FROM orders WHERE user_id = ?" );

    $stmt->bind_param('i', $user_id);

    $stmt->execute();

    $orders = $stmt->get_result();
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

    <section class ='account-body'>

        <h3>Welcome to your account, <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></h3>

        <section class= "account-details">

            <div class="account-info">
                <p style="text-align:center; color: red"> <?php if(isset($_GET['register_success'])){echo $_GET['register_success']; } ?> </p>
                <p style="text-align:center; color: green"><?php if(isset($_GET['login_success'])){echo $_GET['login_success']; } ?> </p>
                <div class="account-info">
                    <p style="">Name : <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} ?> </p>
                    <p style="">Email : <?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];} ?></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                    <p><a href="#orders" id="orders-btn">Your orders</a></p>
                </div>
            </div>

            <div class="change-password">
                <form action="account.php" id="account-form" method="POST">
                    <p style="text-align:center; color:red"> <?php if(isset($_GET['error'])){echo $_GET['error']; } ?> </p>
                    <p style="text-align:center; color:green"> <?php if(isset($_GET['message'])){echo $_GET['message']; } ?> </p>
                    <h5>Change Password</h5>
                    <input type="password" name="password" id="account-password" placeholder="New Password" required>
                    <br>
                    <input type="password" name="confirmPassword" id="account-password-confirm" placeholder="Confirm Password" required> 
                    <br/>
                    <input type="submit" value="Change Password" id="change-pass-btn" name="change_password">
                    <div id="orders"></div>
                </form>
                
            </div>
        </section>
    </section>
    
    
    

    <section id="orders-table">
        <h4 style="text-align:center">Your orders</h4>
        
        <section id="cart" class="section-p1 ">
            <table width="100%">
                <thead>
                    <tr>
                        <th class="order_product_header">Order_id</th>
                        <th>Order Cost</th>
                        <th>Order status</th>
                        <th>Date</td>
                        <th>Order Details</td>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = $orders->fetch_assoc()) { ?>
                        <tr>
                            <td class="order_info">
                                <!-- <img src="Images/products/product_7.jpg" alt=""> -->
                                    <p><?php echo $row['order_id']; ?></p>
                            
                            </td>

                            <td>
                                <span> <?php echo $row['order_cost'] ?> </span>
                            </td>
                            <td>
                                <span> <?php echo $row['order_status'] ?> </span>
                            </td>
                            <td>
                                <span> <?php echo $row['order_date'] ?> </span>
                            </td>
                            <td>
                                <form method="POST" action="order_details.php">
                                    <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status"/>
                                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id"/>
                                    <input type="submit" name="order_details_btn" class="btn normal" value="Details"/>
                                </form>    
                            </td>
                        </tr>
                        <?php }  ?>
                    </tbody>
                </table>
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