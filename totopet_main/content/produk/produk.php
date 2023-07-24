<?php 
    include '../../php/connection.php';


    if(isset($_GET["kategori"])){
       $kategori = $_GET["kategori"];
        $hewan = $_GET["hewan"];
        $sql = "SELECT * FROM product where category='$kategori' and animal_category='$hewan'";
    }
    else{
        $sql = "SELECT * FROM product ORDER by name ASC";
    }
        
        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
              
                $id = $row['id'];
                $img = '../../../db_totopet/'.$row["animal_category"].'/'.$row["category"].'/'.$row['img'];
                $name = $row['name'];
                $desc = $row['description'];
                $price = $row['price'];

                
                include './item.php';
        }

        mysqli_close($conn);
    ?>

<style>
    .produk__card{
        width: 100%;
        margin: 2% 0;
        float: left;
    }

    .kategori__title{
        text-align: center;
                margin-top: 3rem;
                font-size: 1.5rem;
                font-family: var(--fredoka);
    }

    @media only screen and (min-width: 680px){
        .produk__card{
        width: 46%;
        margin: 1%;
        }
    }

    @media only screen and (min-width: 900px){
        .produk__card{
        width: 30%;
        margin: 1.6%;
        }

        .kategori__title{
            text-align: start;
            margin-left: 2rem;
            margin-top: 2rem;
        }
    }

    .cart-buttons {
        display: flex;
        align-items: center;
    }

    .cart-buttons .btn {
        width: 30px;
        height: 30px;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ccc;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .cart-buttons .btn:hover {
        background-color: #aaa;
    }

    .cart-buttons .quantity {
        margin: 0 10px;
    }

</style>
