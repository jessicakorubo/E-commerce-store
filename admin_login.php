<?php
session_start();

include('server/connection.php');

if(isset($_SESSION['logged'])) {
    header('location: admin.php');
    exit;
}

if (isset($_POST['admin_login'])) {
    $admin_username = $_POST['username'];
    $admin_password = md5($_POST['password']);

    $stmt = $conn-> prepare("SELECT admin_username, admin_password FROM admin WHERE admin_username= ? and admin_password =?");
    $stmt-> bind_param('ss', $admin_username, $admin_password);
 
    if ($stmt->execute()) {

        $stmt-> bind_result($admin_username, $admin_password);
        $stmt->store_result();

        if ($stmt->num_rows() ==1) {
            $stmt->fetch();
            
            $_SESSION['admin_username'] = $admin_username;
            $_SESSION['admin_password'] = $admin_password;
            $_SESSION['logged'] = true;

            header('location: admin.php?Logged in successfully');
        }
         else {
        header('location:admin_login.php?error=No rows fetched');
        }
    }
     else {
        header('location:admin_login.php?error=Something went wrong');
    }
   
   
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" />
</head>
<body>
    <!-- <section id="header">
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
    </section> -->
    <section class="hero-body">
        <section>
            <div class="logo-container">
                <div class="logo_div">
                     Logo
                </div>
            </div>
            <div class="welcome">
                <h4>WELCOME, ADMIN.</h4>
                <p>Please sign in to your account</p>
            </div>
        </section>

        <form class="form" method="POST" action="admin_login.php">
            <p style="color:red; text-align:center"> <?php if (isset($_GET['error'])){echo $_GET['error'];} ?> </p>
            <p style="color:green; text-align:center"> <?php if (isset($_GET['logged'])){echo $_GET['logged'];}; ?> </p>
            <div class="input-con">
                <label for="username">Username</label>
                <div class="input-field">
                    <input type="text" name="username"/>
                    <svg 
                        stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M477.5 536.3L135.9 270.7l-27.5-21.4 27.6 21.5V792h752V270.8L546.2 536.3a55.99 55.99 0 0 1-68.7 0z"></path><path d="M876.3 198.8l39.3 50.5-27.6 21.5 27.7-21.5-39.3-50.5z"></path><path d="M928 160H96c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32zm-94.5 72.1L512 482 190.5 232.1h643zm54.5 38.7V792H136V270.8l-27.6-21.5 27.5 21.4 341.6 265.6a55.99 55.99 0 0 0 68.7 0L888 270.8l27.6-21.5-39.3-50.5h.1l39.3 50.5-27.7 21.5z"></path>
                    </svg>
                </div>
            </div>
            <div class="input-con">
                <label for="password">Password</label>
                <div class="input-field">
                    <input type="password" name="password"/>
                    <svg
                        stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><defs><clipPath><path fill="none" d="M124-288l388-672 388 672H124z" clip-rule="evenodd"></path></clipPath></defs><path d="M508 624a112 112 0 0 0 112-112c0-3.28-.15-6.53-.43-9.74L498.26 623.57c3.21.28 6.45.43 9.74.43zm370.72-458.44L836 122.88a8 8 0 0 0-11.31 0L715.37 232.23Q624.91 186 512 186q-288.3 0-430.2 300.3a60.3 60.3 0 0 0 0 51.5q56.7 119.43 136.55 191.45L112.56 835a8 8 0 0 0 0 11.31L155.25 889a8 8 0 0 0 11.31 0l712.16-712.12a8 8 0 0 0 0-11.32zM332 512a176 176 0 0 1 258.88-155.28l-48.62 48.62a112.08 112.08 0 0 0-140.92 140.92l-48.62 48.62A175.09 175.09 0 0 1 332 512z"></path><path d="M942.2 486.2Q889.4 375 816.51 304.85L672.37 449A176.08 176.08 0 0 1 445 676.37L322.74 798.63Q407.82 838 512 838q288.3 0 430.2-300.3a60.29 60.29 0 0 0 0-51.5z"></path>
                    </svg>
                </div>
            </div>
            <div class="remember">
                <span class="checkbox"><input type="checkbox" name="" id=""/> <p>Remember me</p></span>
                <a href="#">Forgot password?</a>
            </div>
            <div class="login-btn">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.646 11.354a.5.5 0 010-.708L14.293 8l-2.647-2.646a.5.5 0 01.708-.708l3 3a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M4.5 8a.5.5 0 01.5-.5h9a.5.5 0 010 1H5a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M2 13.5A1.5 1.5 0 01.5 12V4A1.5 1.5 0 012 2.5h7A1.5 1.5 0 0110.5 4v1.5a.5.5 0 01-1 0V4a.5.5 0 00-.5-.5H2a.5.5 0 00-.5.5v8a.5.5 0 00.5.5h7a.5.5 0 00.5-.5v-1.5a.5.5 0 011 0V12A1.5 1.5 0 019 13.5H2z" clip-rule="evenodd"></path></svg>
                <input style="padding: 1rem" type="submit" value="LOGIN" name="admin_login">

            </div>
        </form>

    </section>
</body>
</html>