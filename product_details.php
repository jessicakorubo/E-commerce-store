
<?php
// $pid = md5(rand(12345,67890).date('Ymdhis'));
// die;


include('server/connection.php');
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $stmt= $conn->prepare("SELECT * FROM products where product_id = ?");
    $stmt->bind_param('i', $product_id);

    $stmt->execute();

    $product = $stmt ->get_result();

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v6.4.0/css/all.css"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous"
    />
</head>

<body>
    
    <section class="admin_navbar">
            <div class="admin_logo">
                <p>CARRA</p>
            </div>
            <hr>
            <div class="admin-links">
                <div class="dash-links"><a href="admin.php"> <i class="fa-solid fa-user"></i> Account</a></div>
                <div class="dash-links accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <a href="#" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa-solid fa-user"></i> Products
                            </a>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body accordion">
                                <a href="product_view.php">View Product Details</a>
                            </div> 
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body accordion" id="products-options">
                                <a href="#  " class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                    Manage Products
                                </a>
                                <div id="collapseTwo" class="accordion-collapse collapse " data-bs-parent="#products-options">
                                    <div class="accordion-body">
                                        <a href="category.php">Add category </a>    
                                    </div>      
                                    <div class="accordion-body">
                                        <a href="product_add.php">Add a Product </a>                                                                             
                                    </div>      
                                    <div class="accordion-body">
                                        <a href="manage_products.php">View products</a>                                                                             
                                    </div>      
                                </div>
                            </div>    
                        </div>   
                            </div>
                        </div>
                         
                    </div>
                </div>
                
                <div class="dash-links"><a href="#"> <i class="fa-solid fa-cart-shopping"></i> Orders</a></div>
                <div class="dash-links"><a href="#"> <i class="fa-solid fa-star"></i> Reviews</a></div>
                <div class="dash-links"><a href="#"> <i class="fa-solid fa-user"></i> Logout</a></div>
                
            </div>
        </section>

    <section class="product-body">
        <div class="product-header">
            <div class="logo">
                <img src="images/apple-icon.png" alt="">
            </div>
            <div class="details">
                <p>Product Details</p>
                <p>View your product details here</p>
            </div>
        </div>

        <?php $row = $product->fetch_assoc()  ?>
        <section class="products-info-section">
            <section class="images_details">
                <img id="MainImg" class="big-image" src="Images/products/<?php echo $row['product_image'] ?>" alt="">
                <div class="small-img-group">

                    <img class="small-img" src="Images/products/<?php echo $row['product_image'] ?>" alt="">

                    <img class="small-img" src="Images/products/<?php echo $row['product_image2'] ?>" alt="">

                    <img class="small-img" src="Images/products/<?php echo $row['product_image3'] ?>" alt="">
                </div>
            </section>
            <section class="products-data">
                <p> Product name: <br/> <?php echo $row['product_name']?></p>
                <p>Product id: <br/> <?php echo $row['product_id']?></p>
                <p>Product price: <br/> <?php echo $row['product_price']?></p>
                <p>Product color: <br/> <?php echo $row['product_color']?></p>
                <p>Product category: <br/> <?php echo $row['product_category']?></p>
                
                <div class="star">
                    <p>Product rating: </p>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </section>
        </section>

        <div class="product-description">

            <h2>Description</h2>
            <p>
                <?php echo $row['product_category'] ?>
            </p>
        </div>

    </section>

    <script src="script.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>