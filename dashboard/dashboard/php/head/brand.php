<?php
session_start();
  include '../../php/connection.php'; 
  include '../../php/function/validasi_user.php'; 
  
  if(isset($_POST['input-data'])) {
    $name = $_POST['brand-name'];
    $image_name = $_FILES['brand-image']['name'];

    if ($_FILES["brand-image"]["error"] == UPLOAD_ERR_OK) {

      $target_dir = "../../../../db_totopet/brand/"; 
      $target_file = $target_dir . basename($_FILES["brand-image"]["name"]);
      if (move_uploaded_file($_FILES["brand-image"]["tmp_name"], $target_file)) {
        // Insert data into database
        $sql = "INSERT INTO brand (name, img) VALUES ('$name', '$image_name')";
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
      $sql = "DELETE FROM brand WHERE id = '$id'";
      mysqli_query($conn, $sql);
}
?>