<style>
    <?php
    include '../../php/connection.php';
    $x=1;
        $sql = mysqli_query($conn,"SELECT DISTINCT(animal_category) FROM product ORDER BY animal_category ASC");
        while($r = mysqli_fetch_assoc($sql)){
              echo "#touch$x {
                position: absolute; opacity:0; height:0;
              }
              ";  
              $x++;
        }
        $x=1;
        $sql = mysqli_query($conn,"SELECT DISTINCT(animal_category) FROM product ORDER BY animal_category ASC");
        while($r = mysqli_fetch_assoc($sql)){
              $sql_count = mysqli_query($conn,"SELECT COUNT(DISTINCT category) AS jumlah FROM product WHERE animal_category = '$r[animal_category]'");
              $count = mysqli_fetch_array($sql_count);

              $jumlah = $count["jumlah"];
              if($jumlah > 1){
                $height = ($jumlah*3) + 1;
              }
              else{
                $height = 4;
              }
              echo "
              #touch$x:checked + .slide {height: $height"; echo"rem}
                "; 
              $x++;
        }
        ?>
</style>