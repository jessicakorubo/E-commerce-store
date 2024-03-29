<?php 

include('server/connection.php');

$stmt= $conn->prepare("SELECT * FROM category");
$stmt->execute();
$category = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCT ADD</title>
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
                                    <a href="#">Add category </a>    
                                </div>      
                                <div class="accordion-body">
                                    <a href="product_add.php">Add a Product</a>                                                                             
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


    <section class="product-body add-product">
         <div class="product-header">
            <div class="logo">
                <img src="images/apple-icon.png" alt="">
            </div>
            <div class="details">
                <p>Product Details</p>
                <p>View your product details here</p>
            </div>
        </div>
        <section class="product-add">
            <section class="add-card">
                <form action="product_create.php" method="POST" enctype="multipart/form-data">
                     <div class="add">
                        <div class="colOne">
                            <div class="product-input">"<?php echo "<i class='fa-solid fa-file-signature'> </i>"?>
                                <input required type="text" value="" placeholder= "Product name" name="name">
                            </div>

                            <div class="product-input">"<?php echo "<i class='fa-solid fa-file-signature'> </i>"?>
                                <select required name="category">
                                    <?php while($cat= $category->fetch_assoc()) { ?>
                                    <option><?php echo $cat['category_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="product-input">"<?php echo "<i class='fa-solid fa-file-signature'> </i>"?><input required type="text" value="" placeholder= "Product description" name="description"></div>

                            <div class="product-input">"<?php echo "<i class='fa-solid fa-file-signature'> </i>"?><input required type="file" value="" placeholder= "Product image" name="image"></div>

                            <div class="product-input">"<?php echo "<i class='fa-solid fa-file-signature'> </i>"?><input type="file" value="" placeholder= "Product image2" name="image2"></div>
                        </div>
                        <div class="colTwo">
                                <div class="product-input"> "<?php echo "<i class='fa-solid fa-file-signature'> </i>"?><input type="file" value="" placeholder= "Product image3" name="image3"></div>

                                <div class="product-input">"<?php echo "<i class='fa-solid fa-file-signature'> </i>"?><input type="file" value="" placeholder= "Product image4" name="image4"></div>

                                <div class="product-input">"<?php echo "<i class='fa-solid fa-file-signature'> </i>"?><input required type="text" value="" placeholder= "Product price" name="price"></div>

                                <div class="product-input">"<?php echo "<i class='fa-solid fa-file-signature'> </i>"?><input required type="text" value="" placeholder= "Product special offer" name="offer"></div>

                                <div class="product-input">"<?php echo "<i class='fa-solid fa-file-signature'> </i>"?><input required type="text" value="" placeholder= "Product color" name="color"></div>
                            </div>
                        </div>
                    <div class="functions">
                            <input type="submit" value="SAVE" name="add" class="btn"/>
                            <input type="reset" value="Reset" name="reset" class="btn" />
                            <!-- <a href="product_delete?discard=1" class="btn">DISCARD</a> -->
                    </div>
                </form>
            </section>
            <p style="text-align:center; color:white;"><?php if(isset($_GET['message'])){echo $_GET['message'];} ?></p>
        </section>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>