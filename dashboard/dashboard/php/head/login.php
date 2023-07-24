<?php
include '../../php/connection.php'; 
session_start();

if (isset($_POST['login'])){
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Using prepared statements to prevent SQL injection
    $sql = "SELECT * FROM user WHERE username=? AND password=? AND role='admin' AND verifikasi='Y'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["level"] = $row["role"];
        header("Location: ../brand/index.php");
        exit;
    } else {
        header("Location:../login/?gagal");
    }

    $stmt->close();
    $conn->close();  
}
?>
