<?php

function isLogin(){
  if(isset($_SESSION["username"])){
    return true;
  }
  return false;
}

  if(isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../landing_page/"); 
    exit;
  }


?>