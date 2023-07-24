
<nav class="z-100">
    <!-- ======== NAVIGATION MENU ======== -->
    <ul class="nav__menu" id="nav-menu">
        <li><a href="../landing_page">Beranda</a></li>
        <li><a href="../produk?">Produk</a></li>
        <li><a href="../peluangusaha">Peluang Usaha</a></li>
        <li><a href="../tentangkami">Tentang Kami</a></li>
        <li><a href="../kontak">Kontak</a></li>
      
        <?php
        if(isLogin()){ // User is logged in
        ?>
        <li>
            <a href="../keranjang">Cart</a>
        </li>
        <li>
            <button class="notification-badge" id="jumlah-keranjang">
                <?php echo jumlahKeranjang($_SESSION["user_id"]); ?>
            </button>
        </li> 
        <li><a href="../transaksi">Transaksi</a></li>
        <li><a href="?logout">Logout</a></li>
        <?php
        } 
        else { // User is not logged in
        ?>
        <li><a href="../register">Register</a></li>
        <li><a href="../login">Login</a></li>
        <?php
        }
        ?>
    </ul>

    <div class="nav__buttons">
        <!-- Toggle button -->
        <div class="nav__toggle" id="nav-toggle">
            <i class="uil uil-bars"></i>
        </div>
    </div>

    <!-- ======== NAVIGATION LOGO ======== -->
    <a href="../landing_page">
        <img src="../../src/logo.png" alt="logo" class="nav__logo">
    </a>
</nav>
