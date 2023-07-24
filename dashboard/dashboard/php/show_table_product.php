<?php
    include '../../php/connection.php';
    if (isset($_GET["category"])) {
        $total_product = 0;
        $category = mysqli_real_escape_string($conn, $_GET["category"]);
        if(!empty($category)){
        $sql = "SELECT * FROM product WHERE animal_category='$category' ORDER by name ASC";
        }
        else{
        $sql = "SELECT * FROM product  ORDER by name ASC";
        }
        $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $total_product ++;
            $image_path = "../../../../db_totopet/".$row['animal_category']."/".$row['category']."/". $row['img'];
            echo "<tr>
                <td><img src='$image_path' /style='height: 150px; width: 150px'></td>
                <td>".$row['name']."</td>
                <td>".$row['description']."</td>
                <td>".$row['category']."</td>
                <td><a style='text-decoration: none; color: red' href='?delete_id=$row[id]&category=$_GET[category]'>Delete</a></td>
                </tr>";
        }
    }
    else 
    {
    echo "0 results";
    }
    mysqli_close($conn);
    }
?>