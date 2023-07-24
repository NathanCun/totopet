<?php
include '../../php/connection.php';

if($conn->connect_error){
    die('Connection failed: ' . $conn->connect_error);
}

$output = '';

if(isset($_POST['animalCategory'])){
    $query = $_POST["query"];
    $animalCategory = $_POST['animalCategory'];
    if(!empty($query)){
        $stmt = mysqli_query($conn,"SELECT DISTINCT category FROM product WHERE animal_category = '$animalCategory' AND category LIKE '%".$query."%' ORDER BY category ASC");
    }
    else{
        $stmt = mysqli_query($conn,"SELECT DISTINCT category FROM product WHERE animal_category = '$animalCategory' ORDER BY category ASC");
    }
    
    if(mysqli_num_rows($stmt) > 0){
        while($row = mysqli_fetch_assoc($stmt)){
            $output .= '<li id="list-category">'.$row['category'].'</li>';
        }
    } else {
        echo "No results found.<br>";
    }
    
}

echo $output;
?>
