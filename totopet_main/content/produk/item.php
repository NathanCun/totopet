<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fresca&display=swap');

        .produk__card {
            width: 300px;
            overflow: hidden;
        }

        .produk__wrap {
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 
        }

        .produk__img {
            transition: all 0.4s;
            border-radius: 2rem;
        }

        .produk__card:hover img {
            transform: scale(1.2);
        }

        .produk__card p {
            font-family: fresca;
            font-size: 1rem;
            text-align: center;
        }

        .product-card .price {
        color: #3bece3;
        }

        .cart-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: blue;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 12px;
        }

        .fa-shopping-cart {
            font-size: 24px;
        }

        .quantity {
         background-color: #3bece3;
         color: white;
         padding: 2px 6px;
         border-radius: 50%;
        }
        .added-to-cart {
        background-color: red;
        color: white;
        }

    </style>
    <title>Document</title>
</head>
<body>
    <div class="produk__card">
        <div class="produk__wrap">
            <img class="produk__img" src="<?php echo $img;   ?>" alt="">
        </div>
        <p>
            <b style="font-size: 1.25rem"><?php echo $name; ?></b><br>
            <?php echo $desc; ?><br>
            <?php echo $price; ?><br>
            <br>
            <?php
            if(isLogin()){
                $status = (cekKeranjang($id,$_SESSION["user_id"])) ? "Added" : "Add to Cart";
                $class = ($status === "Added") ? "added-to-cart" : "";
                echo "<button class='btn btn-add-to-cart $class' id='add$id' onclick ='addCart($id,$_SESSION[user_id],this)'>$status</button>"; 
            }
            ?>
        </p>
    </div>
    <!-- <script>
        // Ambil elemen yang dibutuhkan
        const minusBtn = document.querySelector('.minus-btn');
        const plusBtn = document.querySelector('.plus-btn');
        const quantityInput = document.querySelector('.quantity-input');
        
        // Tambah event listener pada tombol minus
        minusBtn.addEventListener('click', function () {
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 0) {
                currentQuantity--;
                quantityInput.value = currentQuantity;
            }
        });
        
        // Tambah event listener pada tombol plus
        plusBtn.addEventListener('click', function () {
            let currentQuantity = parseInt(quantityInput.value);
            currentQuantity++;
            quantityInput.value = currentQuantity;
        });
    </script> -->

</body>
</html>
