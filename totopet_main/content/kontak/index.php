<?php
include '../../php/head/head.php';
include '../../php/header_kontak.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include '../../layout/head.php';
    ?>
    <link rel="stylesheet" href="../../asset/kontak.css">
</head>
<body>
    <!-- =============== NAVIGATION BAR =============== -->
    <?php include '../../layout/navbar.php'; ?>


    <!-- =============== KONTAK================ -->
    <?php include 'main_page.php'; ?>


    <!-- =============== FOOTER =============== -->
    <?php include '../../layout/footer.php' ?>

    <!-- script for navbar -->
    <script src="../../asset/script.js"></script>
    <!-- Email JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
</body>
</html>