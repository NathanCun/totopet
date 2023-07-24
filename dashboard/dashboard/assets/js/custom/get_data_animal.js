
//jquery for autocomplete, get data form get_data.php usingajax
$(document).ready(function () {
    $('#total_product').html("<?php echo $total_product; ?>");
    $('#animal-category').on('keyup keydown focus', function () {
        var query = $(this).val();
        $.ajax({
            url: '../../assets/getData/animal_category.php',
            method: 'POST',
            data: {
                query: query
            },
            success: function (data) {
                $('#search-animal-category').html(data);
            }
        });
    });
});

$(document).ready(function () {
    $(document).on('click', '#list-animal-category', function () {
        var value = $(this).text();
        $('#animal-category').val(value);
        $('#search-animal-category').html('');
    });
});
$(document).on('click keyup', '#product-category', function () {
    var query = $(this).val();
    var animalCategory = $('#animal-category').val();
    if (animalCategory != '') {
        $.ajax({
            url: '../../assets/getData/product_category.php',
            method: 'POST',
            data: {
                query: query,
                animalCategory: animalCategory
            },
            success: function (data) {
                $('#search-category').html(data);
            }
        });
    } else {
        $('#search-category').html('');
    }
});
$(document).ready(function () {
    $(document).on('click', '#list-category', function () {
        var value = $(this).text();
        $('#product-category').val(value);
        $('#search-category').html('');
    });
});

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("show-modal-btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function () {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
