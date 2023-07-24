<?php
    include '../../php/head/upload_pembayaran.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        .cart-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
        }
        
        .cart-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .product-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }
        
        .product-item img {
            width: 80px;
            height: 80px;
            margin-right: 20px;
        }
        
        .product-details {
            flex-grow: 1;
        }
        
        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .product-description {
            color: #666;
            margin-bottom: 5px;
        }
        
        .product-price {
            font-weight: bold;
        }
        
        .product-quantity {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        
        .quantity-input {
            width: 40px;
            height: 30px;
            text-align: center;
            margin: 0 5px;
            font-weight: bold;
        }
        
        .quantity-btn {
            width: 30px;
            height: 30px;
            background-color: #ccc;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }
        
        .summary-container {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
        }
        
        .summary-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .total-price {
            font-weight: bold;
        }
        
        .checkout-btn {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #3bece3;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
        }
        
        .notes-container {
            margin-top: 20px;
        }
        
        .notes-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .notes-input {
            width: 100%;
            height: 100px;
            resize: vertical;
            padding: 5px;
        }
    </style>
    <title>Keranjang</title>
</head>
<body>
       
    <div class="cart-container">
            <?php
            $totalPrice = 0; // Initialize total price variable
            $sql = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE id = '$id' ");
            $r = mysqli_fetch_assoc($sql);
            
            $sql_data_produk = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE id_transaksi = '$id'");
            while($data = mysqli_fetch_assoc($sql_data_produk)){

            // Calculate the total price for each product based on quantity
            $subTotal = $data['harga'] * $data['jumlah'];
            $totalPrice += $subTotal;

            echo "
            <div class='product-item product-container'>
                <!-- Your product item content goes here -->
                <div class='product-details'>
                    <div class='product-name'>$data[nama_produk]</div>
                    <div class='product-description'>$data[jumlah]</div>
                    <div class='product-price'>Rp. $data[harga]</div>
                </div>
            </div>
            ";
            }
            ?>
        
    </div>
</body>
</html>
