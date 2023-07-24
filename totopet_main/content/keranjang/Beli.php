<?php
session_start();
date_default_timezone_set ('Asia/Jakarta'); 
include '../../php/connection.php';
include '../../php/function/transaksi.php';
if(isset($_POST["proses_pembayaran"])){
    
    $produkIds      = $_POST["produk_id"]; // Change to array variable for multiple products
    $nama_pembeli   = $_POST["nama"];
    $nomor_telepon  = $_POST["nomor_telepon"];
    $alamat         = mysqli_real_escape_string($conn, $_POST["alamat"]); // Escape special characters in $alamat

    $nama_produk    = $_POST["nama_produk"];
    $jumlah         = $_POST["jumlah"];
    $harga          = $_POST["harga"];
    $totalPrice     = $_POST["total_price"];
    $totalProduk    = count($nama_produk);

    $tanggal        = date("Y-m-d");
    $waktu          = date("H:i:s");

    // Insert into tb_transaksi table
    $insert_tb_transaksi = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES ('', '$tanggal', '$waktu', '$_SESSION[user_id]', '$nama_pembeli', '$totalPrice', '$alamat', '$nomor_telepon', '', 'menunggu-konfirmasi', '')");
    if ($insert_tb_transaksi) {
        // Get the last inserted ID (id_transaksi)
        $id_transaksi = mysqli_insert_id($conn);

        // Insert detail transaksi
        for ($x = 0; $x < $totalProduk; $x++) {
            $insert_detail_transaksi = mysqli_query($conn, "INSERT INTO detail_transaksi VALUES('', '$id_transaksi', '{$produkIds[$x]}', '{$nama_produk[$x]}', '{$jumlah[$x]}', '{$harga[$x]}')");
        }

        // Clean keranjang user
        $delete_keranjang = mysqli_query($conn, "DELETE FROM tb_keranjang WHERE user_id = '$_SESSION[user_id]'");

        // Done
        header("location:../transaksi");
        exit;
    }
}
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
    background-color: #add8e6;
}

.checkout-container {
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.checkout-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #000;
}

.shipping-address {
    margin-bottom: 20px;
}

.shipping-address input,
.shipping-address textarea {
    width: 100%;
    max-width: 400px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 5px;
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
    border-radius: 5px;
}

.product-details {
    flex-grow: 1;
}

.product-name {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
    color: #000;
}

.product-description {
    color: #666;
    margin-bottom: 5px;
}

.product-price {
    font-weight: bold;
    color: black;
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
    color: #000;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.total-price {
    font-weight: bold;
    color: black;
}

.payment-options {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    color: black;

.payment-option {
    display: flex;
    align-items: center;
}

.payment-option input {
    margin-right: 5px;
}

.payment-option-label {
    font-size: 14px;
    color: black;
}

.pay-btn {
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

.pay-btn:hover {
    background-color: #2a9ead;
}

    </style>
    <title>Checkout</title>
</head>
<body>
    <form action="" method = "POST">
        <div class="checkout-container">
            <h2 class="checkout-title">Checkout</h2>
            
            <div class="shipping-address">
                <h3>Alamat Pengiriman</h3>
                <input type="text" placeholder="Nama" name="nama">
                <input type="text" placeholder="Nomor Telepon" name="nomor_telepon"> <br>
                <textarea placeholder="Alamat" rows=4 name="alamat"></textarea>
            </div>
            
            <?php
                $produkId = $_POST["produkId"];
                $jumlah  = $_POST["jumlah"];
                $totalProduk = count($jumlah);
                $totalPrice = 0; // Initialize total price variable
                

                for($x=0;$x<count($produkId);$x++){
                        $sql_data_produk = mysqli_query($conn, "SELECT * FROM product WHERE id = '$produkId[$x]'");
                        $data = mysqli_fetch_assoc($sql_data_produk);
        
                        // Calculate the total price for each product based on quantity
                        $subTotal = $data['price'] * $jumlah[$x];
                        $totalPrice += $subTotal;
        
                        echo "
                        <div class='product-item'>
                            <!-- Your product item content goes here -->
                            <img src='../../../db_totopet/$data[animal_category]/$data[category]/$data[img]' alt='Gambar Produk'>
                            <div class='product-details'>
                                <div class='product-name'>$data[name] 
                                <input type='hidden' name='produk_id[]' value='$produkId[$x]' >
                                <input type='hidden' name='nama_produk[]' value='$data[name]' ></div>
                                <div class='product-description'>$jumlah[$x] <input type='hidden' name='jumlah[]' value='$jumlah[$x]' ></div>
                                <div class='product-price'>Rp. $data[price]  <input type='hidden' name='harga[]' value='$data[price]' ></div>
                            </div>
                        </div>
                        ";
                }
                ?>
                
            
            <div class="summary-container">
                <h3 class="summary-title">Ringkasan Belanja</h3>
                
                <div class="summary-row">
                    <span>Total (<?php echo $totalProduk; ?> Produk)</span>
                </div>
                
                <div class="summary-row">
                    <span>Total Harga</span>
                    <span class="total-price">Rp. <?php echo $totalPrice; ?> <input type="hidden" name="total_price" value = "<?php echo $totalPrice; ?>"></span>
                </div>
                
                <div class="payment-options">
                    <div class="payment-option">
                        <input type="radio" name="payment" id="payment-cod">
                        <label for="payment-cod" class="payment-option-label"><?php echo pembayaran(); ?></label>
                    </div>
                </div>
                
                <button type="submit" name="proses_pembayaran" class="pay-btn">Bayar</a>
            </div>
        </div>
    </form>
</body>
</html>