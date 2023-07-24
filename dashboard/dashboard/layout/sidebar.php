<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
  <li class="nav-item">
      <a class="nav-link" href="../user/index.php">
        <i class="mdi mdi-account" style="margin-right: 18px"></i>
        <span class="menu-title">User</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../brand/index.php">
        <i class=" mdi mdi-tablet-android" style="margin-right: 18px"></i>
        <span class="menu-title">Brand</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../message/index.php">
        <i class=" mdi mdi-tablet-android" style="margin-right: 18px"></i>
        <span class="menu-title">Message</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../transaksi/index.php">
        <i class=" mdi mdi-tablet-android" style="margin-right: 18px"></i>
        <span class="menu-title">Transaksi</span>
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
            $sql = "SELECT DISTINCT animal_category FROM product ORDER by animal_category ASC";
            $result = mysqli_query($conn, $sql);
            echo '<li class="nav-item"><a class="nav-link" href="../product/index.php?category=">All</a></li>';
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<li class="nav-item"><a class="nav-link" href="../product/index.php?category=' . $row["animal_category"] . '">' . $row["animal_category"] . '</a></li>';
              }
            }
          ?>
        </ul>
      </div>
    </li>
  </ul>
</nav>