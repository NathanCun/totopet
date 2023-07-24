<?php
    include '../../php/connection.php';
    $sql = "SELECT * FROM brand";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<img src='../../../db_totopet/brand/" . $row["img"] . "' alt=''>";

        }
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
?>