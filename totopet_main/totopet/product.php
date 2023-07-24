<?php
  session_start();
  include '../../php/connection.php'; 

  if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
  }
  $username = $_SESSION['username'];

  if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php"); 
    exit;
  }
  
  if(isset($_POST['input-data'])) {
    $name = $_POST['product-name'];
    $description = $_POST['product-description'];
    $image_name = $_FILES['product-image']['name'];
    $animal_category = $_POST['animal-category'];
    $category = $_POST['product-category'];

    if ($_FILES["product-image"]["error"] == UPLOAD_ERR_OK) {
      $target_dir = "../../db_totopet/".$animal_category."/".$category."/";
      $target_file = $target_dir . basename($_FILES["product-image"]["name"]);
      if (move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO product (name, description, img, category, animal_category) VALUES ('$name', '$description', '$image_name', '$category', '$animal_category')";
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
    $sql = "SELECT * FROM product WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $image_path = "../../db_totopet/".$row['animal_category']."/" .$row['category']."/" . $row['img'];
      
      unlink($image_path);
      $id = $_GET['delete_id'];
      $sql = "DELETE FROM product WHERE id = '$id'";
      mysqli_query($conn, $sql);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/modal_style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div class="container-scroller">
    
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <!-- <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo" /></a> -->
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search"
                aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face5.jpg" alt="profile" />
              <span class="nav-profile-name"><?php echo $username; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <form method="POST">
                <button type="submit" name="logout" class="dropdown-item">
                    <i class="mdi mdi-logout text-primary"></i>
                    Logout
                </button>
              </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="user.php">
              <i class="mdi mdi-account" style="margin-right: 18px"></i>
              <span class="menu-title">User</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="brand.php">
              <i class=" mdi mdi-tablet-android" style="margin-right: 18px"></i>
              <span class="menu-title">Brand</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
              <i class="mdi mdi-crown menu-icon"></i>
              <span class="menu-title">Product</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
              <ul class="nav flex-column sub-menu" style="list-style-type: none">
                <?php
                  include '../../php/connection.php'; 
                  $sql = "SELECT DISTINCT animal_category FROM category_product";
                  $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<li class="nav-item"><a class="nav-link" href="?category=' . $row["animal_category"] . '">' . $row["animal_category"] . '</a></li>';
                    }
                  }
                  mysqli_close($conn);
                ?>
              </ul>
            </div>
          </li>

        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="me-md-3 me-xl-5">
                  <h2>Welcome back, <?php echo $username; ?>.</h2>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab"
                        aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div
                          class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-basket me-3 icon-lg text-primary" ></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Product</small>
                            <h5 class="me-2 mb-0">
                            <?php
                                include '../../php/connection.php'; 

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                $sql = "SELECT COUNT(*) as count FROM product";

                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                echo $row['count'];

                                $conn->close();
                            ?>
                            </h5>
                          </div>
                        </div>
                    
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Product</p>
                  
                  <button id="show-modal-btn" type="submit" name="send-email" class="btn btn-primary" style="color: white">Add New +</button>
                  <br><br>

                        <!-- The Modal -->
                        <div id="myModal" class="modal">

                          <!-- Modal content -->
                          <div class="modal-content">
                            <span class="close">&times;</span>
                            <form class="forms-sample" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="c-name">Name</label>
                                <input type="text" class="form-control" id="c-name" placeholder="Name" name="product-name" autocomplete="off">
                              </div>
                              <div class="form-group">
                                <label>File upload</label>
                                <input type="file" class="file-upload-default" name="product-image" autocomplete="off">
                                <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" placeholder="Description" name="product-description" autocomplete="off">
                              </div>
                              <div class="form-group">
                                <label for="animal-category">Animal Category</label>
                                <select class="form-control" id="animal-category" name="animal-category">
                                  <?php
                                    // Connect to the database
                                    include '../../php/connection.php';
                                    // Retrieve the categories from the database
                                    $sql = "SELECT DISTINCT animal_category FROM category_product";
                                    $result = $conn->query($sql);

                                    // Loop through the categories and create an option for each one
                                    while ($row = mysqli_fetch_assoc($result)) {
                                      echo '<option value="' . $row['animal_category'] . '">' . $row['animal_category'] . '</option>';
                                    }
                                    mysqli_close($conn);
                                  ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="product-category">Product Category</label>
                                <select class="form-control" id="product-category" name="product-category">
                                  <?php
                                    // Connect to the database
                                    include '../../php/connection.php';
                                    // Retrieve the categories from the database
                                    $sql = "SELECT name, animal_category FROM category_product";
                                    $result = $conn->query($sql);

                                    // Loop through the categories and create an option for each one
                                    while ($row = mysqli_fetch_assoc($result)) {
                                      echo '<option value="' . $row['name'] . '" data-animal-category="' . $row['animal_category'] . '">' . $row['name'] . '</option>';
                                    }
                                    mysqli_close($conn);
                                  ?>
                                </select>
                              </div>

                              <script>
                                // Get the animal category select element
                                const animalCategorySelect = document.getElementById('animal-category');
                                // Get the product category select element
                                const productCategorySelect = document.getElementById('product-category');

                                // Listen for changes to the animal category select element
                                animalCategorySelect.addEventListener('change', (event) => {
                                  // Get the selected animal category value
                                  const selectedAnimalCategory = event.target.value;

                                  // Loop through the product category options
                                  for (let i = 0; i < productCategorySelect.options.length; i++) {
                                    const option = productCategorySelect.options[i];
                                    // Get the animal category value for the option
                                    const animalCategory = option.getAttribute('data-animal-category');

                                    // If the animal category matches the selected animal category, show the option, otherwise hide it
                                    if (selectedAnimalCategory === animalCategory) {
                                      option.style.display = '';
                                    } else {
                                      option.style.display = 'none';
                                    }
                                  }
                                });
                              </script>

                              

                              
                              <button type="submit" class="btn btn-primary me-2" name="input-data">Submit</button>
                            </form>
                          </div>

                        </div>
                        
                        
                        <script>
                          // Get the modal
                          var modal = document.getElementById("myModal");

                          // Get the button that opens the modal
                          var btn = document.getElementById("show-modal-btn");

                          // Get the <span> element that closes the modal
                          var span = document.getElementsByClassName("close")[0];

                          // When the user clicks the button, open the modal
                          btn.onclick = function() {
                            modal.style.display = "block";
                          }

                          // When the user clicks on <span> (x), close the modal
                          span.onclick = function() {
                            modal.style.display = "none";
                          }

                          // When the user clicks anywhere outside of the modal, close it
                          window.onclick = function(event) {
                            if (event.target == modal) {
                              modal.style.display = "none";
                            }
}
                        </script>
                        
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Category</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            include '../../php/connection.php'; 
                            
                    
                            // $sql = "SELECT * from product";
                            // $result = mysqli_query($conn, $sql);
                            if (isset($_GET["category"])) {
                              // Sanitize the input to prevent SQL injection attacks
                              $category = mysqli_real_escape_string($conn, $_GET["category"]);
                              // Retrieve data from the "category_product" table that matches the selected category
                              $sql = "SELECT * FROM product WHERE animal_category='$category'";
                              $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                  $image_path = "../../db_totopet/".$row['animal_category']."/".$row['category']."/". $row['img'];
                                    echo "<tr>
                                        <td><img src='$image_path' /style='height: 150px; width: 150px'></td>
                                        <td>".$row['name']."</td>
                                        <td>".$row['description']."</td>
                                        <td>".$row['category']."</td>
                                        <td><a style='text-decoration: none; color: red' href='?delete_id=".$row['id']."'>Delete</a></td>
                                        </tr>";
                                }
                            }
                            else 
                            {
                            echo "0 results";
                            }
                            mysqli_close($conn);
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->

  <script src="js/jquery.cookie.js" type="text/javascript"></script>
  <script src="js/file-upload.js"></script>
  
</body>

</html>