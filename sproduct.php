<?php

include ('server/connection.php');

if (isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id =?");
    $stmt-> bind_param("i", $product_id);

    $stmt->execute();

    $product = $stmt->get_result();

}else {
    header('location: index.php');
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

          <li><a href="index.php">Home</a></li>
          <li><a  class="active" href="shop.php">Shop</a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li id="lg-bag"><a href="cart.php" class="active"><i class="fa-solid fa-cart-shopping"></i></a></li>
          <li><a  href="login.php"><i class="fa-solid fa-user"></i></a></li>
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


    <?php while($row = $product->fetch_assoc()){ ?>

        <section id="prodetails" class="section-p1">

            <div class="single-pro-image">
                <img src="Images/products/<?php echo $row['product_image']; ?>" width="100%" id="MainImg" alt="">
            
                <div class="small-img-group">
            
                    <div class="small-img-col">
                        <img src="Images/products/<?php echo $row['product_image']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="Images/products/<?php echo $row['product_image2']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="Images/products/<?php echo $row['product_image3']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="Images/products/<?php echo $row['product_image4']; ?>" width="100%" class="small-img" alt="">
                    </div>
                
                </div>

            </div>

            <div class="single-pro-details">

                <h6> Home / <?php echo $row['product_category']; ?> </h6>
                <h4> <?php echo $row['product_name']; ?> </h4>
                <h1> <?php echo $row['product_price']; ?></h1>
                <p> <?php echo $row['product_id']; ?></p>

                <select>
                    <option disabled>Select Size</option>
                    <option>XL</option>
                    <option>XXL</option>
                    <option>Small</option>
                    <option>Large</option>
                </select>

                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_image" value= "<?php echo $row['product_image']; ?>">
                    <input type="hidden" name="product_name" value= "<?php echo $row['product_name']; ?>">
                    <input type="hidden" name="product_price" value= "<?php echo $row['product_price']; ?>">
                    <input type="number" name="product_quantity" value="1">
                    <button class="normal" type="submit" name="add_to_cart">Add to cart</button>
                </form>
                
                <h4>Product Details</h4>

                <span>
                    The Gildan Ultra Cotton T-Shirt is made from a substantial 6.0 oz. per 
                    sq. yd. fabric constructed from 100% cotton, this classic fit preshunk
                    jersey Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Rerum consequatur aliquam optio.
                </span>

            </div>

         <?php } ?>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        
        <div class="pro-container">
            
             <?php include('server/get_featured_products.php'); ?>
        <?php while($row = $shop_products->fetch_assoc()){ ?>

            <div class="pro" href="<?php echo "sproduct.php?product_id=".$row['product_id'];?>">
                <img src="Images/products/<?php echo $row['product_image'];?>" alt="">
                <div class="des">
                    <span>addidas</span>
                    <h5><?php echo $row['product_name']; ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                    </div>
                    <h4> &#8358 <?php echo $row['product_price'];?></h4>
                    <a href="<?php echo "sproduct.php?product_id=".$row['product_id'];?>"><svg class="cart" fill="#EBC5ED" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg></i></a>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign up for newsletter</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers</span></p>
        </div>
        <div class="form">
            <input type="text" name="" id="" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
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

    <script>
        var MainImg = document.getElementById('MainImg');

        var smallimg = document.getElementsByClassName('small-img');

        var smallImages = [].slice.call(smallimg);
        
        console.log(smallImages);
        
        smallImages.forEach(small => {
           small.onclick = function() {
            MainImg.src = small.src;
           }
        });
    </script>

    <script src="script.js"></script>
  </body>
</html>
