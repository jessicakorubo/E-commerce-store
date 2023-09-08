<?php

include('server/get_featured_products.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
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
    <section class="admin-body manage_products">
        
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
                                <a href="#" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
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
        </section>
        
        <section class="product-body all-products">

            <div class="components">
                    <a href="product_add.php">ADD A PRODUCT</a>
                    <a href="">STATISTICS</a>
                    <a href="product_view.php">REPORTS</a>
            </div>
            <p><?php if(isset($_GET['message'])){ echo $_GET['message'];}?></p>
            <p><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
            <div class="table-products">
                <table id="t01">
                    <thead>
                        <tr>
                            <th> Image </th>
                            <th> Name</th>
                            <th> Category</th>
                            <th> Price</th>
                            <th>---</th>
                            <th>
                                ---
                            </th>
                            <th>
                                ---
                            </th>
                        </tr>
                    </thead>
                
                    <?php while($row = $shop_products->fetch_assoc()){ ?>
                        <tr class="admin-prod-body">
                            <td><img src="Images/products/<?php echo $row['product_image']; ?>" alt=""></td>
                                <td><?php echo $row['product_name']; ?> </td>
                                <td><?php echo $row['product_category']; ?>  </td>
                                <td>&#8358;<?php echo number_format($row['product_price'],2); ?></td>
                                <td>
                                    <a  href=<?php echo "product_details.php?product_id=".$row['product_id'];?>> Details </a>
                                </td>
                                <td>
                                    
                                    
                                    <form action="product_delete.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                                        <input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>">
                                        <input class="btn" type="submit" value="DELETE" name="delete">
                                    </form>
                                    
                                </td>
                                <td>
                                    <a  href="product_edit.php?product_id=<?php echo $row['product_id'];?>"> EDIT </a>
                                    
                                </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </section>
        
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>