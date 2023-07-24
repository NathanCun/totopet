<?php
include '../../php/connection.php';

if($conn->connect_error){
    die('Connection failed: ' . $conn->connect_error);
}

$output = '';

if(isset($_POST['query'])){
    $query = $_POST['query'];
    if (!empty($query)) {
        $stmt = mysqli_query($conn,"SELECT DISTINCT animal_category FROM product WHERE animal_category LIKE '%".$query."%' ORDER BY animal_category ASC");
    } else {
        $stmt = mysqli_query($conn,"SELECT DISTINCT animal_category FROM product ORDER BY animal_category ASC");
    }
    if(mysqli_num_rows($stmt) > 0){
        while($row = mysqli_fetch_assoc($stmt)){
            $output .= '<li id="list-animal-category">'.$row['animal_category'].'</li>';
        }
    } else {
        echo "No results found.<br>";
    }
    
}

echo $output;
?>
