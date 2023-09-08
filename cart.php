<?php 

session_start();
if(isset($_POST['add_to_cart'])){
     //addd if user has already added product to cart

    if (isset($_SESSION['cart'])) {

        // $_Session['cart'], product_id
       //first product
       $products_array_ids = array_column($_SESSION['cart'],"product_id");

       if (!in_array($_POST['product_id'], $products_array_ids)){

            $product_array = array(
                            'product_id' => $_POST['product_id'],
                            'product_name' => $_POST['product_name'],
                            'product_price' => $_POST['product_price'],
                            'product_image' => $_POST['product_image'],
                            'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][$_POST['product_id']] = $product_array;
            // you are creating an array using the product id of the particular product.
        } 

        else {

            echo '<script>alert ("Product has already been added!"); </script>';
            // echo '<script>window.location="index.php" </script>';

        } 
    }

    else {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['product_quantity'];


            $product_array = array(
                                'product_id' => $product_id,
                                'product_name' => $product_name,
                                'product_price' => $product_price,
                                'product_image' => $product_image,
                                'product_quantity' => $product_quantity
            );

    $_SESSION['cart'][$product_id] = $product_array;   
    
    }
    //to get the subtotal product price
        calculateTotalCart();
    
}

// remove product from cart
 
else if(isset($_POST["remove_product"])) {

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);


    // calculate total
    calculateTotalCart();

}
else if (isset($_POST['edit_quantity'])){
    $product_id = $_POST["product_id"];
    $product_quantity = $_POST['product_quantity'];

    // get the product array from the session
    $product_array = $_SESSION["cart"][$product_id];

    // update product quanity
    $product_array['product_quantity'] = $product_quantity;

    // return array back in its place
    $_SESSION["cart"][$product_id] = $product_array;

    // calcualte total
    calculateTotalCart();

}
else {
    // header('location: index.php');
}


function  calculateTotalCart() {
    $total = 0;
    foreach($_SESSION['cart'] as $key => $value){

        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity =  $product['product_quantity'];

        $total = $total + ($price * $quantity);
    }

    $_SESSION["total"] =  $total;
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

    <section id="page-header" class="about-header"> 
        <h2>#Checkout</h2>
        <p>Get to know how we can help you!</p>

    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td class="cart_products">Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>

            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

            <tbody>

                <tr>
                    <td>
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                            <input type="submit" name="remove_product" class="remove-btn" value="remove"/>
                            <!-- <i class="fa-regular fa-circle-xmark"></i> -->
                        </form>
                    </td>
                    <td><img src="Images/products/<?php echo $value['product_image'] ?>" alt=""></td>
                    <td><?php echo $value['product_name'] ?></td>
                    <td>$<?php echo $value['product_price'] ?></td>

                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                        
                        <td><input class="input-quantity" type="number" name="product_quantity" value="<?php echo $value['product_quantity'] ?>" id="">
                        <input type="submit" class="edit-btn" value="edit" name="edit_quantity"></td>
                    </form>

                    <td class="total">$<?php echo ($value['product_price'])*($value['product_quantity']); ?></td>
                </tr>
                
            </tbody>

            <?php } ?>
        </table>
    </section>
    
    <section class="cart-totals">
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td><strong>$<?php echo $_SESSION['total'] ?></strong></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$<?php echo $_SESSION['total'] ?></strong></td>
                </tr>
            </table>

            <!-- form id = checkout-form action= place_order, method = post -->

            <!-- chaneg checout-form if to place order form-> -->
            <form action="checkout.php" method="post" id="checkout-form">
                <input type="submit" class="btn normal" name="checkout" id="checkout-btn" value="Proceed to checkout"></input>
            </form>
            
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

    <script src="script.js"></script>
  </body>
</html>
