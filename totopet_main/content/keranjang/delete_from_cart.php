<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'])) {
        // Assuming you have a database connection established
        include '../../php/connection.php';

        // Sanitize the input and get the product ID
        $productId = mysqli_real_escape_string($conn, $_POST['product_id']);
        $userId = mysqli_real_escape_string($conn, $_POST['user_id']);

        $sql_cek = mysqli_query($conn,"SELECT * FROM tb_keranjang WHERE produk_id = '$productId' AND user_id = '$userId'");
        if(mysqli_num_rows($sql_cek) > 0){
           // Perform the database insertion
            $query = "DELETE FROM tb_keranjang WHERE produk_id = '$productId' AND user_id = '$userId'";
            if (mysqli_query($conn, $query)) {
                // Return success response to the client
                echo 'success';
            } else {
                // Return error response to the client
                echo 'error';
            }
        }
        
    }
}
?>
