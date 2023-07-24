<?php
  include '../../php/head/head.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include '../../layout/head.php';
        include 'custom_css.php';
    ?>
    <link rel="stylesheet" href="../../asset/produk.css">
</head>
<body>
    <!-- =============== NAVIGATION BAR =============== -->
    <?php include '../../layout/navbar.php'; ?>

    <?php include 'main_page.php'; ?>
    <!-- =============== FOOTER =============== -->
    <?php include "../../layout/footer.php" ?>
    <!-- script for navbar -->
    <script src="../../asset/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
    $("input:checkbox").on('click', function() {
        var $check = $(this);
        if ($check.is(":checked")) {
            var group="input:checkbox[name='"+$check.attr("name")+"']";
            $(group).prop("checked", false);
            $check.prop("checked", true);
        } else {
            $check.prop("checked", false);
        }
    })

    </script>
 <!-- Place this script in your HTML header or footer -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function addCart(productId, userId, buttonElement) {
        // Create a POST request to the server using jQuery AJAX
        $.ajax({
            type: 'POST',
            url: 'add_to_cart.php', // Replace with the PHP file that handles adding to the cart
            data: { product_id: productId, user_id: userId }, // Pass both product_id and user_id
            success: function(response) {
                if (response === 'success') {
                    // Product added to cart successfully, toggle button text between "Add to Cart" and "Added"
                    var buttonText = $(buttonElement).text();
                    var jumlah = parseInt($("#jumlah-keranjang").text()); // Parse the current jumlah value as an integer

                    if (buttonText === 'Add to Cart') {
                        // If the button text is "Add to Cart," increase the jumlah value
                        jumlah += 1;
                        $(buttonElement).addClass('added-to-cart'); // Add the CSS class for the "Added" state
                    } else {
                        // If the button text is "Added," decrease the jumlah value
                        jumlah -= 1;
                        $(buttonElement).removeClass('added-to-cart'); // Remove the CSS class for the "Added" state
                    }

                    // Update the jumlah value inside the element with id "jumlah-keranjang"
                    $("#jumlah-keranjang").text(jumlah);

                    // Toggle the button text between "Add to Cart" and "Added"
                    $(buttonElement).text(buttonText === 'Add to Cart' ? 'Added' : 'Add to Cart');
                }else {
                    // Failed to add product to cart, show an alert or handle the error
                    alert('Failed to add product to cart.');
                }
            },
            error: function() {
                // AJAX request failed, show an alert or handle the error
                alert('An error occurred. Please try again later.');
            }
        });
    }
</script>



</body>
</html>