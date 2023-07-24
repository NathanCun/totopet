
<div class="peluang">
<p class="peluang__title">Kerja Sama Dengan <span style="color: var(--blue)">TotoPet</span></p>
<p class="peluang__sub">Menggapai Kemajuam Bersama TotoPet: Tempat Peluang Berpadu Dengan Kesuksesan</p>

<br>
<table class="table">
    <thead>
        <th>Tanggal</th>
        <th>kode Transaksi</th>
        <th>Total</th>
        <th>Status Pembayaran</th>
        <th>Status Pengiriman</th>
    </thead>
    <tbody>
    <?php
    //$confirmationScript = ";";
        $sql_transaksi = mysqli_query($conn,"SELECT * FROM tb_transaksi WHERE user_id = '$_SESSION[user_id]' ORDER by id DESC");
        if(mysqli_num_rows($sql_transaksi) > 0){
            while( $r_transaksi = mysqli_fetch_assoc($sql_transaksi)){
                echo "<tr>";
                echo "<td>$r_transaksi[tanggal]</td>";
                echo "<td><a href='../upload_pembayaran/detail_produk.php?id_transaksi=$r_transaksi[id]'>$r_transaksi[id]</a></td>";
                echo "<td>$r_transaksi[total]</td>";
                echo "<td>$r_transaksi[bukti_pembayaran]  ";
                if($r_transaksi["bukti_pembayaran"] == ""){
                    echo "<a href= '../upload_pembayaran/?id_transaksi=$r_transaksi[id]' class='btn btn-danger btn-sm btn-square' ><i class='uil uil-upload'></i></a>";
                }
                echo"</td>";
                echo "<td>$r_transaksi[status_pengiriman]";
                if($r_transaksi["status_pengiriman"] == "sedang-dikirim"){
                  echo "<a href='?diterima=$r_transaksi[id]' onclick=\"return confirm('Apakah barang telah diterima?')\"><i style='color:green;text-decoration:none;' class='uil uil-truck'></i></a>";
                }
                echo"</td>";
                echo "</tr>";
           }
        }
        else{
            echo "<td colspan=5>Belum Ada Transaksi</td>";
        }
    ?>
    </tbody>
</table>
</div>