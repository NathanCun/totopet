<?php
// Connect to database
include '../../php/connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get id from URL parameter
$id = $_GET['id'];

// fetch data from transasksi_hotel
$sql_detail = mysqli_query($conn, "SELECT * FROM tb_transaksi  WHERE id = '$id'");

while($row_detail = mysqli_fetch_assoc($sql_detail)){
    echo "<table class=''>";
    echo "<tr><th>Kode Transaksi</th><td> : ".$row_detail['id']."</td></tr>";
    echo "<tr><th>Tanggal</th><td> : ".$row_detail['tanggal']."</td></tr>";
    echo "<tr><th>Waktu</th><td> : ".$row_detail['waktu']."</td></tr>";
    echo "<tr><th>Pembeli</th><td> : ".$row_detail['nama_pembeli']."</td></tr>";
    echo "<tr><th>Alamat Pengiriman</th><td> : ".$row_detail['alamat_pengiriman']."</td></tr>";
    echo "<tr><th>Status Pengiriman</th><td> : ".$row_detail['status_pengiriman']."</td></tr>";
    echo "<tr><th>Total</th><td> : ".$row_detail['total']."</td></tr>";
    echo "</table>";
    echo "<hr>";
}

// Fetch data from table_detail
$sql = "SELECT * FROM detail_transaksi WHERE id_transaksi = '$id'";
$result = $conn->query($sql);

// Display data in a table
if ($result->num_rows > 0) {
    echo "<table class='table table-sm'>";
    echo "<tr><th>Item</th><th>jumlah</th><th>harga</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nama_produk'] . "</td>";
        echo "<td>" . $row['jumlah'] . "</td>";
        echo "<td>" . $row['harga'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data found.";
}

$conn->close();
?>
