<?php
  session_start();
  include '../../php/connection.php'; 

  include '../../php/function/validasi_user.php'; 
  
  if(isset($_POST['input-data'])) {
    $name = $_POST['product-name'];
    $description = $_POST['product-description'];
    $image_name = $_FILES['product-image']['name'];
    $animal_category = $_POST['animal-category'];
    $category = $_POST['product-category'];
    $price = $_POST["price"];

    $target_dir = "../../../../db_totopet/".$animal_category."/".$category."/";

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if ($_FILES["product-image"]["error"] == UPLOAD_ERR_OK) {
        // add timestamp to the image name to make it unique
        $timestamp = time();
        $image_name = $timestamp . '_' . $image_name;
        $target_file = $target_dir . basename($image_name);
        if (move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO product (name, description, img, category, animal_category,price) VALUES ('$name', '$description', '$image_name', '$category', '$animal_category', '$price')";
            mysqli_query($conn, $sql);
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Error uploading the file.";
    }
}



  if(isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "SELECT * FROM product WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $image_path = "../../db_totopet/".$row['animal_category']."/" .$row['category']."/" . $row['img'];
      
      unlink($image_path);
      $id = $_GET['delete_id'];
      $sql = "DELETE FROM product WHERE id = '$id'";
      mysqli_query($conn, $sql);
      header("location:?category=$_GET[category]");
  }
}
?>
