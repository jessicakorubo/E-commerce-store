<?php 

include('server/connection.php');
session_start();

 if(isset($_GET['category_id'])){

    $category_id = $_GET['category_id'];
    $stmt= $conn->prepare("SELECT * FROM category WHERE category_id = ?");
    $stmt->bind_param('i', $category_id);
    $stmt->execute();
    $category = $stmt->get_result();

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
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
    <link rel="stylesheet" href="styles.css">

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
                                    <a href="manage_products.html" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                        Manage Products
                                    </a>
                                    <div id="collapseTwo" class="accordion-collapse collapse " data-bs-parent="#products-options">
                                        <div class="accordion-body">
                                            <a href="category.php">Add category </a>    
                                        </div>      
                                        <div class="accordion-body">
                                            <a href="product_add.php">Add a product </a>                                                                             
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
                
        
    </section>

    <div class="category product-body">
        
        <div class="cat-container">
            <div>
                <h3 style="text-align:center">Update your category</h3>
            </div> 
             <?php $row = $category->fetch_assoc() ?>
            <form action="cat-update-page.php" method="POST">
                <input type="hidden" name="category_id" value="<?php echo $row['category_id']?>">
                <input class="p1" type="text" name="category_name" placeholder="Category Name" required value="<?php echo $row['category']?>"><br>
                <input class="category-input p1" type="message"  name="category_description" placeholder="Category Description" value="<?php echo $row['category_description']?>"><br>
                <input type="reset" value="Cancel">
                <input type="submit" value="Update" name="update-categories"><br>
                <a href="categories_view.php">View categories</a>
            </form>
            
        </div>
        <a class="back-link" href="categories_view.php">Back to Categories page</a>
    </div>
    <script src="script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


</body>
</html>