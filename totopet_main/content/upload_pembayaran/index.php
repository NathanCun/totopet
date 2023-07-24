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
        <form  method="POST"  enctype='multipart/form-data'>
        <div class="summary-container">
            <!-- Your summary container content goes here -->
            <h3>Upload Bukti Bayar</h3>
            <!-- Display the total price dynamically -->
            <div class="summary-row">
                <span>Total Harga</span>
                <span class="total-price">Rp. <?php echo $totalPrice; ?></span>
                <span><input type="file" name='gambar'></span>
                <input type="submit" value="Upload" name="upload_bukti_bayar">
            </div>

            <!-- Rest of your summary container content -->
        </div>
    
    </form>
    </div>
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Add a common class 'product-container' to each product item
    const productContainers = document.querySelectorAll('.product-container');
    const totalPriceElement = document.querySelector('.total-price');

    // Function to update the total price dynamically
    function updateTotalPrice() {
        let totalPrice = 0;
        productContainers.forEach(productContainer => {
            if (!productContainer.classList.contains('removed-product')) {
                const productPrice = parseFloat(productContainer.querySelector('.product-price').innerText.replace('Rp. ', ''));
                const productQuantity = parseInt(productContainer.querySelector('.quantity-input').value);
                totalPrice += productPrice * productQuantity;
            }
        });
        totalPriceElement.innerText = 'Rp. ' + totalPrice;
    }

    // Loop through each product container to set event listeners
    productContainers.forEach(productContainer => {
        const minusBtn = productContainer.querySelector('.minus-btn');
        const plusBtn = productContainer.querySelector('.plus-btn');
        const quantityInput = productContainer.querySelector('.quantity-input');
        const deleteBtn = productContainer.querySelector('.delete-btn');

        // Tambah event listener pada tombol minus
        minusBtn.addEventListener('click', function () {
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 0) {
                currentQuantity--;
                quantityInput.value = currentQuantity;
                updateTotalPrice();
            }
        });

        // Tambah event listener pada tombol plus
        plusBtn.addEventListener('click', function () {
            let currentQuantity = parseInt(quantityInput.value);
            currentQuantity++;
            quantityInput.value = currentQuantity;
            updateTotalPrice();
        });

        // Tambah event listener untuk deteksi perubahan pada input
        quantityInput.addEventListener('change', function () {
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity < 0) {
                currentQuantity = 0;
            }
            quantityInput.value = currentQuantity;
            updateTotalPrice();
        });

        deleteBtn.addEventListener('click', function () {
        const productId = deleteBtn.getAttribute('data-product-id');
        const containerToRemove = productContainer;
        const productPrice = parseFloat(containerToRemove.querySelector('.product-price').innerText.replace('Rp. ', ''));
        const productQuantity = parseInt(containerToRemove.querySelector('.quantity-input').value);

        // Implement the AJAX call to remove the item from the database
        $.ajax({
            type: 'POST',
            url: 'delete_from_cart.php', // Replace with the PHP file that handles the delete action
            data: { product_id: productId, user_id: <?php echo $_SESSION["user_id"]; ?> },
            success: function (response) {
                if (response === 'success') {
                    // Add class to the product container to mark it for removal
                    containerToRemove.classList.add('removed-product');
                    // Recalculate and update the total price after deletion
                    updateTotalPrice();

                    containerToRemove.remove();
                } else {
                    alert('Failed to delete product from cart.');
                }
            },
            error: function () {
                alert('An error occurred. Please try again later.');
            }
        });
    });
    });
</script>


</body>
</html>
