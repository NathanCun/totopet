<?php
    include '../../php/connection.php'; 

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT COUNT(*) as count FROM tb_kontak WHERE status = 'belum_baca'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo $row['count'];

    $conn->close();
?>