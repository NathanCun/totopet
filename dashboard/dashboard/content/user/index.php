<?php include '../../php/head/user.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  
  <?php include '../../layout/head.php' ?>
</head>

<body>
  <div class="container-scroller">
    <!-- navbar -->
   <?php include '../../layout/navbar.php'; ?>

    <div class="container-fluid page-body-wrapper">
      <!-- sidebar -->
      <?php include '../../layout/sidebar.php'; ?>
      
      <!-- content -->
      <?php include 'main_page.php'; ?>
    </div>
  </div>
 <?php include '../../layout/script.php'; ?>
</body>

</html>