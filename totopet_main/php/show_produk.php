<?php
            $x = 1;
            include '../../php/connection.php';
            $sql = mysqli_query($conn,"SELECT DISTINCT(animal_category) FROM product ORDER BY animal_category ASC");
            while($r = mysqli_fetch_assoc($sql)){
                
                    echo "<div class='dropdown'>
                
                    <label for='touch$x'>
                        <span style='display: flex; align-items: center;'>
                            <div style='display: flex; align-items: center; justify-content: space-around;'>
                                
                                <p><a class='h2-dark'>$r[animal_category]</a></p>
                            </div>

                        </span>
                    </label>
                                
                    <input type='checkbox' name='touch[]' id='touch$x' class='checkbox'> 
                    
                    <ul class='slide'>

                    ";
                
                $sql_kategori = mysqli_query($conn,"SELECT DISTINCT(category) FROM product WHERE animal_category = '$r[animal_category]' ORDER by category ASC ");
                while($r_kategori = mysqli_fetch_assoc($sql_kategori)){
                    echo "<li><a href='?kategori=$r_kategori[category]&hewan=$r[animal_category]'>$r_kategori[category]</a></li>";
                }
                echo"
                </ul>
            </div>";
            $x++;
            }
            ?>