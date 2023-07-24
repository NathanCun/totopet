<?php
    session_start();
    include '../../php/connection.php';
    
    $id= $_GET["id_transaksi"];

    if(isset($_POST["upload_bukti_bayar"])){
        $uploadedFile = $_FILES["gambar"]["tmp_name"];
        $originalFileName = $_FILES["gambar"]["name"];
        $targetDirectory = "../../asset/bukti_bayar/";
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    
        // Get the file extension
        $fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
    
        // Check if the file extension is allowed
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        } else {
            // Generate a new unique file name with the same extension
            $newFileName = uniqid() . "." . $fileExtension;
    
            // Set the target file path with the new name and original extension
            $targetFile = $targetDirectory . $newFileName;
    
            if (move_uploaded_file($uploadedFile, $targetFile)) {
                // File uploaded and renamed successfully
                $update = mysqli_query($conn,"UPDATE tb_transaksi SET bukti_pembayaran = '$newFileName' WHERE id = '$id'");
    
                header("location:../transaksi");
            } else {
                // Failed to move the uploaded file to the destination
                echo "Error uploading the file.";
            }
        }
    }
?>