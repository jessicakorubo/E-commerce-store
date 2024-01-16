
 <?php 

include('server/connection.php');

if(isset($_POST['update-categories'])){
    $category_id = $_POST['category_id'];
    $category_name= $_POST['category_name'];
    $category_description = $_POST['category_description'];
    print_r($_POST);

    $stmt= $conn->prepare("UPDATE category SET category=?, category_description =? WHERE category_id = ?");

    $stmt->bind_param('ssi', $category_name, $category_description, $category_id);
    
    // if the statement exeutes correctly 
    if ($stmt->execute()){
        header("location: categories_view.php?message=Category successfully updated");
    }
    else {
        header('lcoation: category_update.php?error= An error occured. Try again!');
    }
}