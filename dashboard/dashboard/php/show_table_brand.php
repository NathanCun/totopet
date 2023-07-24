<?php
    include '../../php/connection.php';
    $sql = "SELECT * from brand";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $image_path = "../../../../db_totopet/brand/" . $row['img'];
            echo "<tr>
                <td><img src='$image_path' /style='height: 125px; width: auto; border-radius: 0'></td>
                <td>".$row['name']."</td>
                <td><a style='text-decoration: none; color: red' href='?delete_id=".$row['id']."'>Delete</a></td>
                </tr>";
        }
    }
    else 
    {
    echo "0 results";
    }
    mysqli_close($conn);
?>