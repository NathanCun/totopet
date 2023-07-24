<div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="me-md-3 me-xl-5">
                  <h2>Welcome back, <?php echo $username; ?>.</h2>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab"
                        aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <br>
                      <div class="container-fluid m-3">
                        <div class="row">
                          <div class="col-md-3">
                              <div class="list-item">
                              <a type="button" href= '?search=menunggu-konfirmasi' style= 'width:250px' class="btn btn-primary">
                                Menunggu Konfirmasi <span class="badge badge-light">4</span>
                              </a>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="list-item">
                              <a type="button" href= '?search=sedang-dikirim' style= 'width:250px'  class="btn btn-warning">
                                Sedang Dikirim <span class="badge badge-light">4</span>
                              </a>
                              </div>
                          </div>
                          <div class="col-md-3">
                          <a type="button" href= '?search=selesai' style= 'width:250px'   class="btn btn-success">
                                Selesai <span class="badge badge-light">4</span>
                          </a>
                          </div>
                          <div class="col-md-3">
                              <div class="list-item">
                              <a type="button" href= '?search=dibatalkan-penjual' style= 'width:250px'  class="btn btn-danger">
                                Dibatalkan <span class="badge badge-light">4</span>
                              </a>
                              </div>
                          </div>
                        </div>
                      </div>
                    
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Message</p>
                  
                        
                        
                  <div class="table-responsive">
                  <table class="table table-bordered table-sm">
                  <thead>
                      <th>Tanggal</th>
                      <th>kode Transaksi</th>
                      <th>Total</th>
                      <th>Status Pembayaran</th>
                      <th>Status Pengiriman</th>
                  </thead>
                  <tbody>
                  <?php
                  if(isset($_GET["search"])){
                    $query = "WHERE status_pengiriman = '".$_GET["search"]. "'";
                  }
                  else{
                    $query = "";
                  }
                      $sql_transaksi = mysqli_query($conn,"SELECT * FROM tb_transaksi $query ORDER by id DESC");
                      if(mysqli_num_rows($sql_transaksi) > 0){
                          while( $r_transaksi = mysqli_fetch_assoc($sql_transaksi)){
                              echo "<tr>";
                              echo "<td>$r_transaksi[tanggal]</td>";
                              echo "<td>$r_transaksi[id]</td>";
                              echo "<td>$r_transaksi[total]</td>";
                              echo "<td><img src='../../../../totopet_main/asset/bukti_bayar/$r_transaksi[bukti_pembayaran]' class='img-fluid' style='width:150px;border-radius:0;'>  ";
                              if($r_transaksi["bukti_pembayaran"] == "pending payment"){
                                  echo "<a href= '../upload_pembayaran/?id_transaksi=$r_transaksi[id]' class='btn btn-danger btn-sm btn-square' ><i class='uil uil-upload'></i></a>";
                              }
                              elseif($r_transaksi["bukti_pembayaran"] == "tidak valid"){
                                  echo "<a class='btn btn-danger btn-sm btn-square' ><i class='uil uil-upload'></i></a>";
                              }
                              else{

                              }
                              
                              echo "<td><button  type='button' class='btn btn-square btn-sm btn-light me-1' data-toggle='modal' data-target='#detailModal' data-id='$r_transaksi[id]'>
                                  <i class='fas fa-info-circle'></i>
                              </button> </td>";

                              echo"</td>";
                              echo "<td>$r_transaksi[status_pengiriman]</td>";
                              if($r_transaksi["status_pengiriman"] == "diproses-penjual"){
                                echo "<td> <a class='btn btn-sm btn-danger' href='?batal=$r_transaksi[id]'><i class='fas fa-trash'></i></a><a class='btn btn-sm btn-info' href='?kirim=$r_transaksi[id]'><i class='fas fa-truck'></i></a></td>";
                              }
                              elseif($r_transaksi["status_pengiriman"] == "dibatalkan-penjual"){
                                echo "<td>Batal</td>";
                              }
                              elseif($r_transaksi["status_pengiriman"] == "sedang-  dikirim"){
                                echo "<td></td>";
                              }
                              elseif($r_transaksi["status_pengiriman"] == "menunggu-konfirmasi"){
                                echo "<td><a class='btn btn-sm btn-warning' href='?approve_pembayaran=$r_transaksi[id]'><i class='fas fa-check'></i></a><a class='btn btn-sm btn-danger' href='?batal=$r_transaksi[id]'><i class='fas fa-trash'></i></a></td>";
                              }
                              else{
                                echo "<td>Selesai</td>";
                              }
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    <!-- Detail Modal -->
    <div class='modal fade' id='detailModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog modal-dialog-centered modal-lg' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>Detail Transaksi</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div class='modal-body'>
            <!-- Display details here -->
          </div>
        </div>
      </div>
    </div>

<script>
  $(document).ready(function(){
    $('#detailModal').on('show.bs.modal', function(e){
      var id = $(e.relatedTarget).data('id');
      $.ajax({
        type: 'GET',
        url: 'detail_transaksi.php?id=' + id,
        success: function(response){
          $('#detailModal .modal-body').html(response);
        }
      });
    });
  });
</script>