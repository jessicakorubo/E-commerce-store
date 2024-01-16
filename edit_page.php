<?php 
include('server/connection.php');

if(isset($_POST['edit-product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['name'];
    $product_category = $_POST['category'];
    $product_description = $_POST['description'];

    $product_image = $_FILES['image']['tmp_name'];
    $product_image2 = $_FILES['image2']['tmp_name'];
    $product_image3 = $_FILES['image3']['tmp_name'];
    $product_image4 = $_FILES['image4']['tmp_name'];

    $image_name1 = $product_name."1.jpg";
    $image_name2 = $product_name."2.jpg";
    $image_name3 = $product_name."3.jpg";
    $image_name4 = $product_name."4.jpg";

    move_uploaded_file($product_image, "Images/products/".$image_name1);
    move_uploaded_file($product_image2, "Images/products/".$image_name2);
    move_uploaded_file($product_image3, "Images/products/".$image_name3);
    move_uploaded_file($product_image4, "Images/products/".$image_name4);

    $product_color = $_POST['color'];
    $product_price = $_POST['price'];
    $product_special_offer = $_POST['offer'];

    print('<pre>');
    print_r($_POST);
    // die;

    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_category =?, product_description =?,product_image=?,    product_image2=?, product_image3=?, product_image4=?, product_price =?, product_special_offer=?, product_color=? WHERE product_id= ?");

    $stmt->bind_param("ssssssssssi", $product_name, $product_category, $product_description, $image_name1, $image_name2, $image_name3, $image_name4, $product_price, $product_special_offer, $product_color, $product_id);
// sssssssdisi
    if ($stmt-> execute()){
        header('location:manage_products.php?message=Product update successful');
    }
    else {
        header('location:manage_products.php?error=Could not update product');
    }     
}
else {
    header('location: edit_page.php?error=You did not click on the edit product button!');
}
