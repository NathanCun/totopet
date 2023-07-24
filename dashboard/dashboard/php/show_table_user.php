<?php
    $sql = "SELECT * from user WHERE role = 'admin'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if(isset($_SESSION['username']) && $_SESSION['username'] == $row['username']) {
                echo "<tr>
                    <td>".$row['username']."</td>
                    <td>".$row['password']."</td>
                    <td>-</td>
                </tr>";
            } else {
                echo "<tr>
                    <td>".$row['username']."</td>
                    <td>".$row['password']."</td>
                    <td><a style='text-decoration: none; color: red' href='?delete_id=".$row['id']."'>Delete</a></td>
                </tr>";
            }
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
?>