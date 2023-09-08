<?php 
include('server/connection.php');


$stmt= $conn->prepare("SELECT * FROM users, orders
            WHERE users.user_id = orders.user_id;");


$stmt->execute();
$orders = $stmt->get_result();
$rows = $stmt->affected_rows;


$stmt1= $conn->prepare("SELECT * FROM products");
$stmt1->execute();
$products = $stmt1->get_result();
$rows2 = $stmt1->affected_rows;

$stmt2 = $conn->prepare("SELECT SUM(order_cost) FROM ORDERS");
$stmt2->execute();
$order_cost = $stmt2->get_result();

// while($rowData = $order_cost->fetch_array()){
//   		echo $rowData[0].'result'.'<br>';
// 	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
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
    <div class="view-body admin-body">

       

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
                                    <a href="manage_products.php" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
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

        <section class="product-body view-flex">
            
            <div class="product-cards">
                <div class="product-card">
                    <div class="card-div">
                        <div class="icon">
                            <i class='fa-solid fa-naira-sign'></i>
                        </div>
                        <div class="info">
                            <p>Total Order Cost</p>
                            <hr>
                            <?php while($order_sum = $order_cost->fetch_array()){ ?>

                            <p> <?php echo number_format($order_sum[0], 2) ?></p>

                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="product-card">
                    <div class="card-div">
                        <div class="icon">
                            <i class="fa-regular fa-note-sticky"></i>
                        </div>
                        <div class="info">
                            <p>Total Orders</p>
                            <hr>
                            <p><?php echo $rows?></p>
                        </div>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="card-div">
                        <div class="icon">
                          <i class="fa-regular fa-note-sticky"></i>
                        </div>
                        <div class="info">
                            <p>Available Products</p>
                            <hr>
                            <p><?php echo $rows2 ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="recent-orders ">
                <h4>RECENT ORDERS</h4>
                <table>
                    <thead>
                        <tr>
                            <td>User ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Amount</td>
                            <td>Order Address</td>
                            <td>Order Status</td>
                            <td>Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($rs = $orders->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $rs['user_id'] ?></td>
                            <td><?php echo $rs['user_name'] ?></td>
                            <td><?php echo $rs['user_email'] ?></td>
                            <td> &#8358;<?php echo $rs['order_cost'] ?></td>
                            <td><?php echo $rs['user_address'] ?></td>
                            <td><?php echo $rs['order_status'] ?></td>
                            <td><?php echo $rs['order_date'] ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>

        
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>