<?php
    include '../../php/connection.php';
    $sql = "SELECT * from tb_kontak ORDER by id DESC";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>$row[tanggal]</td>
                <td>".$row['nama']."</td>
                <td>$row[no_telepon]</td>
                <td>$row[pesan]</td>";
                if($row['status'] == "belum_baca"){
                    echo "<td><a class='btn btn-circle btn-sm btn-success text-light font-weight-bold' href='?sudahbaca=$row[id]'>read</a></td>";
                }
                else{
                    echo "<td></td>";
                }
                echo "  
                </tr>";
        }
    }
    else 
    {
    echo "0 results";
    }

  

    
    mysqli_close($conn);
?>