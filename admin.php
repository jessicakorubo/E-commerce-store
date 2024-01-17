<?php 

session_start();

include ('server/connection.php');

if(!isset($_SESSION['logged'])) {
    header('location: admin_login.php');
    exit;
}

if(isset($_GET['adminlogout'])) {
    if(isset($_SESSION['logged'])) {
        unset($_SESSION['logged']);
        unset($_SESSION['admin_username']);

        header('location:admin_login.php');
        exit;
    }
}
if (isset($_POST['change_admin_password'])) {
    $admin_password = $_POST['admin_password'];
    $confirmPassword = $_POST['confirmPassword'];
    $admin_username = $_SESSION['admin_username'];

    if($admin_password !== $confirmPassword) {
        header('location:admin.php?error=Passwords do not match');
    }
    else {
        $stmt = $conn->prepare('UPDATE admin SET admin_password = ? WHERE admin_username = ?' );
        $stmt ->bind_param('ss', md5($admin_password), $admin_username);

        if($stmt->execute()) {
            header('location:admin.php?message= Password updated successfully');
        }
        else {
            header('location:admin.php?error= Password update unsuccessful');
        }
    }
}
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
    <section class="admin-body">
        <section class="admin_navbar">
            <div class="admin_logo">
                <p>CARRA</p>
            </div>
            <hr>
            <div class="admin-links">
                <div class="dash-links"><a href="#"> <i class="fa-solid fa-user"></i> Account</a></div>
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
                
            </div>
        </section>

        <section class="product-body admin-panel">
          
            <h2 class="panel-title">ADMIN PANEL</h2>

            <div class="admin-flex">
                <div class="admin-panel-card">
                    <h5>ADMIN, WELCOME TO YOUR ACCOUNT</h5>
                    <p>In your account, you have the permission to delete, edit, update and review products.
                        Your changes will be reflected in the database and all operations should be carefully considered
                        before action.
                        <br> <a class='log-out btn' href="admin.php?adminlogout=1">Logout of my account.</a>
                    </p>
                </div>
                <div class="admin-panel-card">
                    <div class="change-password">
                        <form action="admin.php" id="account-form" method="POST">
                            <p style="text-align:center; color:red"> <?php if(isset($_GET['error'])){echo $_GET['error']; } ?> </p>
                            <p style="text-align:center; color:green"> <?php if(isset($_GET['message'])){echo $_GET['message']; } ?> </p>
                            <h5>Change Your Password</h5>
                            <input type="password" name="admin_password" id="account-password" placeholder="New Password" required>
                            <br>
                            <input type="password" name="confirmPassword" id="account-password-confirm" placeholder="Confirm Password" required>
                            <br/>
                            <input class="btn" type="submit" value="Change Password" id="change-pass-btn" name="change_admin_password">
                        </form>
                    </div>
                </div>
                <div class="admin-panel-card">
                    <h5>View Products</h5>
                    <p>In this panel, you have the authority to view the products
                        stored in your database. These products can be edited and further reviewed.
                        To view your products, click here.
                    </p>
                    <a class="btn" href="manage_products.php">View Products</a>
                </div>
                <div class="admin-panel-card">
                    <h5>Add a Product</h5>
                    <p>In this panel, you have the authority to add the products
                        you wish to store in your database. These products will be displayed immediately 
                        after saving on your site's shop. To ad a product, click here.
                    </p>
                    <a class="btn" href="product_add.php">Add a Product</a>
                </div>
            </div>

            <section class="essentials">
                <div class="welcome-admin">
                    <p>ADMIN, Welcome to your account</p>
                    <p></p>
                    <p></p>
            
                </div>
            </section>
        </section>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>