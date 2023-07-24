<?php
    include '../../php/connection.php';

    $sql = "SELECT COUNT(*) as count FROM user";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo $row['count'];


?>