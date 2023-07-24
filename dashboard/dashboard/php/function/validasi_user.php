<?php

if (empty($_SESSION['username']) || empty($_SESSION['level']) ) {
    header("Location: ../../../index.php");
    exit;
  }
  $username = $_SESSION['username'];

  if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../../../index.php"); 
    exit;
  }


?>